import React, { useState } from 'react';
import { 
  User, 
  Lock, 
  Wifi, 
  CreditCard, 
  Download, 
  Clock, 
  MessageSquare, 
  AlertCircle,
  CheckCircle,
  LogOut,
  ChevronRight
} from 'lucide-react';

// Mock Data
const customerData = {
  name: 'John Doe',
  id: 'CUST-00123',
  package: 'Home Pro 50 Mbps',
  status: 'active',
  ip: '192.168.100.5',
  dueAmount: 250000,
  dueDate: '2023-11-05'
};

const invoices = [
  { id: 'INV-2023-10-001', date: '2023-10-01', amount: 250000, status: 'paid' },
  { id: 'INV-2023-09-001', date: '2023-09-01', amount: 250000, status: 'paid' },
  { id: 'INV-2023-08-001', date: '2023-08-01', amount: 250000, status: 'paid' },
];

const tickets = [
  { id: 'TKT-001', subject: 'Internet Slow', status: 'closed', date: '2023-09-15' },
  { id: 'TKT-002', subject: 'Router Blinking Red', status: 'open', date: '2023-10-25' },
];

export default function Portal() {
  const [isLoggedIn, setIsLoggedIn] = useState(false);
  const [username, setUsername] = useState('');
  const [password, setPassword] = useState('');
  const [activeTab, setActiveTab] = useState<'dashboard' | 'billing' | 'support' | 'settings'>('dashboard');

  const handleLogin = (e: React.FormEvent) => {
    e.preventDefault();
    if (username && password) {
      setIsLoggedIn(true);
    }
  };

  if (!isLoggedIn) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-slate-100 p-4">
        <div className="bg-white p-8 rounded-2xl shadow-lg w-full max-w-md">
          <div className="text-center mb-8">
            <div className="h-16 w-16 bg-indigo-600 rounded-xl flex items-center justify-center mx-auto mb-4">
              <Wifi className="h-8 w-8 text-white" />
            </div>
            <h1 className="text-2xl font-bold text-slate-900">Customer Portal</h1>
            <p className="text-slate-500">Login to manage your internet account</p>
          </div>

          <form onSubmit={handleLogin} className="space-y-6">
            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Customer ID / Email</label>
              <div className="relative">
                <User className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" />
                <input 
                  type="text" 
                  className="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  placeholder="Enter your ID"
                  value={username}
                  onChange={(e) => setUsername(e.target.value)}
                  required
                />
              </div>
            </div>

            <div>
              <label className="block text-sm font-medium text-slate-700 mb-1">Password</label>
              <div className="relative">
                <Lock className="absolute left-3 top-1/2 -translate-y-1/2 h-5 w-5 text-slate-400" />
                <input 
                  type="password" 
                  className="w-full pl-10 pr-4 py-3 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                  placeholder="Enter your password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  required
                />
              </div>
            </div>

            <button 
              type="submit"
              className="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-bold text-lg"
            >
              Login
            </button>
          </form>
          
          <div className="mt-6 text-center text-sm text-slate-500">
            Forgot password? <a href="#" className="text-indigo-600 hover:underline">Contact Support</a>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-slate-50 pb-20">
      {/* Header */}
      <header className="bg-white shadow-sm sticky top-0 z-10">
        <div className="max-w-5xl mx-auto px-4 h-16 flex items-center justify-between">
          <div className="flex items-center font-bold text-slate-900 text-lg">
            <Wifi className="h-6 w-6 text-indigo-600 mr-2" />
            MyISP Portal
          </div>
          <div className="flex items-center space-x-4">
            <span className="text-sm text-slate-600 hidden sm:inline">Welcome, {customerData.name}</span>
            <button 
              onClick={() => setIsLoggedIn(false)}
              className="p-2 text-slate-400 hover:text-red-600 transition-colors"
            >
              <LogOut className="h-5 w-5" />
            </button>
          </div>
        </div>
      </header>

      <main className="max-w-5xl mx-auto px-4 py-6 space-y-6">
        {/* Navigation Tabs */}
        <div className="flex space-x-2 overflow-x-auto pb-2 scrollbar-hide">
          <button
            onClick={() => setActiveTab('dashboard')}
            className={`px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors ${
              activeTab === 'dashboard' ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-100'
            }`}
          >
            Dashboard
          </button>
          <button
            onClick={() => setActiveTab('billing')}
            className={`px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors ${
              activeTab === 'billing' ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-100'
            }`}
          >
            Billing & History
          </button>
          <button
            onClick={() => setActiveTab('support')}
            className={`px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors ${
              activeTab === 'support' ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-100'
            }`}
          >
            Support Ticket
          </button>
          <button
            onClick={() => setActiveTab('settings')}
            className={`px-4 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-colors ${
              activeTab === 'settings' ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 hover:bg-slate-100'
            }`}
          >
            Settings
          </button>
        </div>

        {activeTab === 'dashboard' && <PortalDashboard />}
        {activeTab === 'billing' && <PortalBilling />}
        {activeTab === 'support' && <PortalSupport />}
        {activeTab === 'settings' && <PortalSettings />}
      </main>
    </div>
  );
}

function PortalDashboard() {
  return (
    <div className="space-y-6">
      {/* Status Card */}
      <div className="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
        <div className="flex items-center justify-between mb-6">
          <h2 className="text-lg font-bold text-slate-900">Connection Status</h2>
          <span className="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-800">
            <CheckCircle className="w-4 h-4 mr-1" />
            Online
          </span>
        </div>
        
        <div className="grid grid-cols-1 sm:grid-cols-2 gap-6">
          <div className="p-4 bg-slate-50 rounded-xl">
            <p className="text-sm text-slate-500 mb-1">Current Package</p>
            <p className="text-lg font-bold text-indigo-600">{customerData.package}</p>
          </div>
          <div className="p-4 bg-slate-50 rounded-xl">
            <p className="text-sm text-slate-500 mb-1">IP Address</p>
            <p className="text-lg font-mono font-bold text-slate-700">{customerData.ip}</p>
          </div>
        </div>
      </div>

      {/* Bill Card */}
      <div className="bg-gradient-to-br from-indigo-600 to-purple-700 rounded-2xl p-6 shadow-lg text-white">
        <div className="flex items-start justify-between">
          <div>
            <p className="text-indigo-100 mb-1">Current Bill</p>
            <h3 className="text-3xl font-bold">Rp {customerData.dueAmount.toLocaleString()}</h3>
            <p className="text-sm text-indigo-200 mt-2 flex items-center">
              <Clock className="w-4 h-4 mr-1" />
              Due Date: {new Date(customerData.dueDate).toLocaleDateString()}
            </p>
          </div>
          <div className="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
            <CreditCard className="w-8 h-8 text-white" />
          </div>
        </div>
        
        <button className="mt-6 w-full py-3 bg-white text-indigo-600 rounded-xl font-bold hover:bg-indigo-50 transition-colors">
          Pay Now
        </button>
      </div>
    </div>
  );
}

function PortalBilling() {
  return (
    <div className="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="p-6 border-b border-slate-200">
        <h2 className="text-lg font-bold text-slate-900">Billing History</h2>
      </div>
      <div className="divide-y divide-slate-200">
        {invoices.map((inv) => (
          <div key={inv.id} className="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
            <div>
              <p className="font-medium text-slate-900">{inv.id}</p>
              <p className="text-sm text-slate-500">{new Date(inv.date).toLocaleDateString()}</p>
            </div>
            <div className="text-right">
              <p className="font-bold text-slate-900">Rp {inv.amount.toLocaleString()}</p>
              <span className="inline-block text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded uppercase mt-1">
                {inv.status}
              </span>
            </div>
            <button className="p-2 text-slate-400 hover:text-indigo-600">
              <Download className="w-5 h-5" />
            </button>
          </div>
        ))}
      </div>
    </div>
  );
}

function PortalSupport() {
  return (
    <div className="space-y-6">
      <div className="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
        <h2 className="text-lg font-bold text-slate-900 mb-4">Create New Ticket</h2>
        <form className="space-y-4">
          <div>
            <label className="block text-sm font-medium text-slate-700 mb-1">Subject</label>
            <select className="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
              <option>No Internet Connection</option>
              <option>Slow Connection</option>
              <option>Billing Issue</option>
              <option>Other</option>
            </select>
          </div>
          <div>
            <label className="block text-sm font-medium text-slate-700 mb-1">Description</label>
            <textarea 
              rows={4}
              className="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
              placeholder="Describe your issue..."
            ></textarea>
          </div>
          <button className="w-full py-3 bg-indigo-600 text-white rounded-xl font-bold hover:bg-indigo-700 transition-colors">
            Submit Ticket
          </button>
        </form>
      </div>

      <div className="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200">
          <h2 className="text-lg font-bold text-slate-900">Recent Tickets</h2>
        </div>
        <div className="divide-y divide-slate-200">
          {tickets.map((ticket) => (
            <div key={ticket.id} className="p-4 flex items-center justify-between hover:bg-slate-50 transition-colors">
              <div className="flex items-center">
                <div className={`p-2 rounded-lg mr-4 ${
                  ticket.status === 'open' ? 'bg-orange-100 text-orange-600' : 'bg-slate-100 text-slate-500'
                }`}>
                  <MessageSquare className="w-5 h-5" />
                </div>
                <div>
                  <p className="font-medium text-slate-900">{ticket.subject}</p>
                  <p className="text-xs text-slate-500">{ticket.id} • {new Date(ticket.date).toLocaleDateString()}</p>
                </div>
              </div>
              <ChevronRight className="w-5 h-5 text-slate-300" />
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

function PortalSettings() {
  return (
    <div className="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
      <h2 className="text-lg font-bold text-slate-900 mb-6">Account Settings</h2>
      
      <div className="space-y-6">
        <div>
          <h3 className="text-sm font-bold text-slate-900 mb-4 flex items-center">
            <Lock className="w-4 h-4 mr-2" />
            Change Password
          </h3>
          <div className="space-y-4">
            <input 
              type="password" 
              placeholder="Current Password"
              className="w-full px-4 py-2 border border-slate-300 rounded-lg"
            />
            <input 
              type="password" 
              placeholder="New Password"
              className="w-full px-4 py-2 border border-slate-300 rounded-lg"
            />
            <input 
              type="password" 
              placeholder="Confirm New Password"
              className="w-full px-4 py-2 border border-slate-300 rounded-lg"
            />
            <button className="px-6 py-2 bg-indigo-600 text-white rounded-lg font-medium hover:bg-indigo-700">
              Update Password
            </button>
          </div>
        </div>
      </div>
    </div>
  );
}
