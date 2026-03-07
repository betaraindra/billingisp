import React, { useState } from 'react';
import { 
  Bell, 
  MessageSquare, 
  Mail, 
  FileText, 
  Save, 
  CheckCircle,
  AlertTriangle
} from 'lucide-react';

export default function Notifications() {
  const [activeTab, setActiveTab] = useState<'settings' | 'templates'>('settings');

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <Bell className="mr-2 h-6 w-6 text-indigo-600" />
          Notification Center
        </h1>
        
        <div className="flex space-x-2 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
          <button
            onClick={() => setActiveTab('settings')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'settings' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Settings
          </button>
          <button
            onClick={() => setActiveTab('templates')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'templates' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Message Templates
          </button>
        </div>
      </div>

      {activeTab === 'settings' && <NotificationSettings />}
      {activeTab === 'templates' && <MessageTemplates />}
    </div>
  );
}

function NotificationSettings() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
      {/* WhatsApp Settings */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200">
          <h3 className="text-lg font-bold text-slate-900 flex items-center">
            <MessageSquare className="h-5 w-5 mr-2 text-green-600" />
            WhatsApp Notifications
          </h3>
          <p className="text-sm text-slate-500">Configure automated WA messages.</p>
        </div>
        <div className="p-6 space-y-4">
          <div className="flex items-center justify-between">
            <div>
              <p className="font-medium text-slate-900">Send Invoice</p>
              <p className="text-xs text-slate-500">When a new invoice is generated</p>
            </div>
            <input type="checkbox" defaultChecked className="toggle-checkbox h-5 w-5 text-indigo-600 rounded" />
          </div>
          <div className="flex items-center justify-between">
            <div>
              <p className="font-medium text-slate-900">Payment Reminder</p>
              <p className="text-xs text-slate-500">3 days before due date</p>
            </div>
            <input type="checkbox" defaultChecked className="toggle-checkbox h-5 w-5 text-indigo-600 rounded" />
          </div>
          <div className="flex items-center justify-between">
            <div>
              <p className="font-medium text-slate-900">Payment Confirmation</p>
              <p className="text-xs text-slate-500">After successful payment</p>
            </div>
            <input type="checkbox" defaultChecked className="toggle-checkbox h-5 w-5 text-indigo-600 rounded" />
          </div>
          <div className="flex items-center justify-between">
            <div>
              <p className="font-medium text-slate-900">Service Isolation</p>
              <p className="text-xs text-slate-500">When service is suspended</p>
            </div>
            <input type="checkbox" defaultChecked className="toggle-checkbox h-5 w-5 text-indigo-600 rounded" />
          </div>
        </div>
      </div>

      {/* Email Settings */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200">
          <h3 className="text-lg font-bold text-slate-900 flex items-center">
            <Mail className="h-5 w-5 mr-2 text-blue-600" />
            Email Notifications
          </h3>
          <p className="text-sm text-slate-500">Configure automated emails.</p>
        </div>
        <div className="p-6 space-y-4">
          <div className="flex items-center justify-between">
            <div>
              <p className="font-medium text-slate-900">Send Invoice PDF</p>
              <p className="text-xs text-slate-500">Attach PDF invoice to email</p>
            </div>
            <input type="checkbox" defaultChecked className="toggle-checkbox h-5 w-5 text-indigo-600 rounded" />
          </div>
          <div className="flex items-center justify-between">
            <div>
              <p className="font-medium text-slate-900">Admin Alerts</p>
              <p className="text-xs text-slate-500">Notify admin on critical errors</p>
            </div>
            <input type="checkbox" className="toggle-checkbox h-5 w-5 text-indigo-600 rounded" />
          </div>
        </div>
      </div>
      
      <div className="md:col-span-2 flex justify-end">
        <button className="flex items-center px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
          <Save className="h-4 w-4 mr-2" />
          Save Settings
        </button>
      </div>
    </div>
  );
}

function MessageTemplates() {
  const [template, setTemplate] = useState('invoice');

  const templates = {
    invoice: "Halo {name},\n\nTagihan internet Anda untuk bulan {month} sebesar Rp {amount} telah terbit. Jatuh tempo pada {due_date}.\n\nSilakan lakukan pembayaran melalui link berikut: {payment_link}\n\nTerima kasih.",
    isolate: "Halo {name},\n\nLayanan internet Anda telah diisolir sementara karena keterlambatan pembayaran. Mohon segera lakukan pembayaran sebesar Rp {amount} agar layanan dapat aktif kembali.\n\nTerima kasih.",
    activation: "Halo {name},\n\nSelamat! Layanan internet Anda paket {package} telah aktif mulai hari ini. \n\nID Pelanggan: {customer_id}\nPassword: {password}\n\nTerima kasih telah memilih kami.",
    payment: "Halo {name},\n\nPembayaran tagihan sebesar Rp {amount} telah kami terima. Terima kasih atas pembayaran Anda."
  };

  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="grid grid-cols-1 md:grid-cols-4">
        <div className="border-r border-slate-200 bg-slate-50 p-4 space-y-2">
          <button 
            onClick={() => setTemplate('invoice')}
            className={`w-full text-left px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
              template === 'invoice' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-600 hover:bg-white hover:text-slate-900'
            }`}
          >
            Tagihan (Invoice)
          </button>
          <button 
            onClick={() => setTemplate('isolate')}
            className={`w-full text-left px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
              template === 'isolate' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-600 hover:bg-white hover:text-slate-900'
            }`}
          >
            Isolir (Suspend)
          </button>
          <button 
            onClick={() => setTemplate('activation')}
            className={`w-full text-left px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
              template === 'activation' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-600 hover:bg-white hover:text-slate-900'
            }`}
          >
            Aktivasi Baru
          </button>
          <button 
            onClick={() => setTemplate('payment')}
            className={`w-full text-left px-4 py-2 rounded-lg text-sm font-medium transition-colors ${
              template === 'payment' ? 'bg-white shadow-sm text-indigo-600' : 'text-slate-600 hover:bg-white hover:text-slate-900'
            }`}
          >
            Konfirmasi Pembayaran
          </button>
        </div>
        
        <div className="col-span-3 p-6">
          <h3 className="text-lg font-bold text-slate-900 mb-4 capitalize">{template} Template</h3>
          <div className="bg-yellow-50 border border-yellow-100 rounded-lg p-4 mb-4 text-sm text-yellow-800 flex items-start">
            <AlertTriangle className="h-4 w-4 mr-2 mt-0.5 flex-shrink-0" />
            <p>
              Use variables like <strong>{`{name}`}</strong>, <strong>{`{amount}`}</strong>, <strong>{`{due_date}`}</strong> to dynamically insert data.
            </p>
          </div>
          
          <textarea 
            rows={8}
            className="w-full px-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 font-mono text-sm"
            defaultValue={templates[template as keyof typeof templates]}
          ></textarea>
          
          <div className="mt-4 flex justify-end">
            <button className="flex items-center px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
              <Save className="h-4 w-4 mr-2" />
              Save Template
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
