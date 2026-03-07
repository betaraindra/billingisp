import React, { useState, useEffect } from 'react';
import { 
  MessageSquare, 
  Smartphone, 
  QrCode, 
  RefreshCw, 
  Send, 
  CheckCircle, 
  XCircle,
  LogOut,
  Battery
} from 'lucide-react';

export default function WhatsApp() {
  const [status, setStatus] = useState<'connected' | 'disconnected' | 'connecting'>('disconnected');
  const [qrCode, setQrCode] = useState<string | null>(null);
  const [deviceInfo, setDeviceInfo] = useState<any>(null);
  const [testMessage, setTestMessage] = useState({ phone: '', message: '' });
  const [logs, setLogs] = useState<string[]>([]);

  useEffect(() => {
    checkStatus();
    const interval = setInterval(checkStatus, 5000);
    return () => clearInterval(interval);
  }, []);

  const checkStatus = async () => {
    try {
      const res = await fetch('/api/wa/status');
      const data = await res.json();
      setStatus(data.status);
      setDeviceInfo(data.device);
      
      if (data.status === 'disconnected') {
        fetchQrCode();
      }
    } catch (error) {
      console.error('Failed to check WA status:', error);
    }
  };

  const fetchQrCode = async () => {
    try {
      const res = await fetch('/api/wa/qr');
      const data = await res.json();
      setQrCode(data.qr);
    } catch (error) {
      console.error('Failed to fetch QR:', error);
    }
  };

  const handleSendTest = async (e: React.FormEvent) => {
    e.preventDefault();
    try {
      const res = await fetch('/api/wa/send', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(testMessage)
      });
      
      if (res.ok) {
        addLog(`Successfully sent message to ${testMessage.phone}`);
        setTestMessage({ phone: '', message: '' });
      } else {
        addLog(`Failed to send message to ${testMessage.phone}`);
      }
    } catch (error) {
      addLog(`Error sending message: ${error}`);
    }
  };

  const addLog = (msg: string) => {
    setLogs(prev => [`[${new Date().toLocaleTimeString()}] ${msg}`, ...prev]);
  };

  const handleLogout = async () => {
    if (confirm('Are you sure you want to disconnect?')) {
      await fetch('/api/wa/logout', { method: 'POST' });
      checkStatus();
    }
  };

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <MessageSquare className="mr-2 h-6 w-6 text-green-600" />
          WhatsApp Gateway
        </h1>
        <div className="flex items-center space-x-2">
          <span className={`inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${
            status === 'connected' ? 'bg-green-100 text-green-800' : 
            status === 'connecting' ? 'bg-yellow-100 text-yellow-800' : 
            'bg-red-100 text-red-800'
          }`}>
            {status === 'connected' && <CheckCircle className="w-4 h-4 mr-1" />}
            {status === 'disconnected' && <XCircle className="w-4 h-4 mr-1" />}
            {status === 'connecting' && <RefreshCw className="w-4 h-4 mr-1 animate-spin" />}
            {status.toUpperCase()}
          </span>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Connection Panel */}
        <div className="lg:col-span-1 space-y-6">
          <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 className="text-lg font-bold text-slate-900 mb-4 flex items-center">
              <Smartphone className="h-5 w-5 mr-2 text-slate-500" />
              Device Connection
            </h3>
            
            {status === 'connected' ? (
              <div className="text-center space-y-4">
                <div className="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                  <Smartphone className="h-12 w-12 text-green-600" />
                </div>
                <div>
                  <h4 className="font-bold text-slate-900">{deviceInfo?.name || 'WhatsApp Business'}</h4>
                  <p className="text-slate-500">{deviceInfo?.phone || '+62 812-3456-7890'}</p>
                </div>
                <div className="flex items-center justify-center text-sm text-slate-500 space-x-4">
                  <span className="flex items-center"><Battery className="w-4 h-4 mr-1" /> 85%</span>
                  <span>v2.23.10.77</span>
                </div>
                <button 
                  onClick={handleLogout}
                  className="w-full py-2 border border-red-200 text-red-600 rounded-lg hover:bg-red-50 transition-colors flex items-center justify-center"
                >
                  <LogOut className="w-4 h-4 mr-2" />
                  Disconnect
                </button>
              </div>
            ) : (
              <div className="text-center space-y-4">
                <div className="bg-white p-4 border-2 border-slate-200 rounded-lg inline-block">
                  {qrCode ? (
                    <img src={qrCode} alt="WA QR Code" className="w-48 h-48 object-contain" />
                  ) : (
                    <div className="w-48 h-48 flex items-center justify-center bg-slate-50 text-slate-400">
                      <QrCode className="w-12 h-12" />
                    </div>
                  )}
                </div>
                <p className="text-sm text-slate-500">
                  Open WhatsApp on your phone and scan the QR code to connect.
                </p>
                <button 
                  onClick={checkStatus}
                  className="text-indigo-600 text-sm font-medium hover:underline flex items-center justify-center w-full"
                >
                  <RefreshCw className="w-3 h-3 mr-1" />
                  Refresh QR Code
                </button>
              </div>
            )}
          </div>

          <div className="bg-indigo-50 border border-indigo-100 rounded-xl p-4">
            <h4 className="font-bold text-indigo-900 text-sm mb-2">Integration Info</h4>
            <p className="text-xs text-indigo-700 mb-2">
              This gateway uses <strong>go-whatsapp-web-multidevice</strong> protocol.
            </p>
            <div className="space-y-1 text-xs text-indigo-800 font-mono">
              <div className="flex justify-between">
                <span>API Endpoint:</span>
                <span>/api/wa</span>
              </div>
              <div className="flex justify-between">
                <span>Status:</span>
                <span className="font-bold">Active</span>
              </div>
            </div>
          </div>
        </div>

        {/* Testing & Logs */}
        <div className="lg:col-span-2 space-y-6">
          {/* Test Message */}
          <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 className="text-lg font-bold text-slate-900 mb-4 flex items-center">
              <Send className="h-5 w-5 mr-2 text-slate-500" />
              Send Test Message
            </h3>
            <form onSubmit={handleSendTest} className="space-y-4">
              <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div className="md:col-span-1">
                  <label className="block text-sm font-medium text-slate-700 mb-1">Phone Number</label>
                  <input 
                    type="text" 
                    placeholder="e.g., 628123456789"
                    className="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                    value={testMessage.phone}
                    onChange={(e) => setTestMessage({...testMessage, phone: e.target.value})}
                    required
                  />
                </div>
                <div className="md:col-span-2">
                  <label className="block text-sm font-medium text-slate-700 mb-1">Message</label>
                  <div className="flex space-x-2">
                    <input 
                      type="text" 
                      placeholder="Type a message..."
                      className="flex-1 px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
                      value={testMessage.message}
                      onChange={(e) => setTestMessage({...testMessage, message: e.target.value})}
                      required
                    />
                    <button 
                      type="submit"
                      className="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center"
                    >
                      <Send className="w-4 h-4" />
                    </button>
                  </div>
                </div>
              </div>
            </form>
          </div>

          {/* Activity Logs */}
          <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200 flex-1 h-96 flex flex-col">
            <div className="flex items-center justify-between mb-4">
              <h3 className="text-lg font-bold text-slate-900">Gateway Logs</h3>
              <button 
                onClick={() => setLogs([])}
                className="text-xs text-slate-500 hover:text-red-600"
              >
                Clear Logs
              </button>
            </div>
            <div className="flex-1 bg-slate-900 rounded-lg p-4 overflow-y-auto font-mono text-xs text-green-400 space-y-1">
              {logs.length === 0 ? (
                <span className="text-slate-600 italic">No activity logs yet...</span>
              ) : (
                logs.map((log, i) => (
                  <div key={i}>{log}</div>
                ))
              )}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
}
