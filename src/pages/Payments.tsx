import React, { useState } from 'react';
import { 
  Wallet, 
  CreditCard, 
  Upload, 
  Search, 
  Filter, 
  CheckCircle, 
  XCircle, 
  Clock, 
  MoreVertical, 
  Save,
  QrCode,
  Smartphone,
  Landmark
} from 'lucide-react';

// Mock Data
const transactions = [
  { id: 'TRX-001', customer: 'John Doe', amount: 250000, method: 'BCA VA', date: '2023-10-26 14:30', status: 'success', gateway: 'Xendit' },
  { id: 'TRX-002', customer: 'Jane Smith', amount: 150000, method: 'QRIS', date: '2023-10-26 10:15', status: 'pending', gateway: 'Tripay' },
  { id: 'TRX-003', customer: 'Bob Wilson', amount: 300000, method: 'Manual Transfer', date: '2023-10-25 09:00', status: 'failed', gateway: 'Manual' },
];

export default function Payments() {
  const [activeTab, setActiveTab] = useState<'history' | 'manual' | 'gateways'>('history');

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <Wallet className="mr-2 h-6 w-6 text-indigo-600" />
          Payment Management
        </h1>
        
        <div className="flex space-x-2 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
          <button
            onClick={() => setActiveTab('history')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'history' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            History
          </button>
          <button
            onClick={() => setActiveTab('manual')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'manual' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Manual Input
          </button>
          <button
            onClick={() => setActiveTab('gateways')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'gateways' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Gateways
          </button>
        </div>
      </div>

      {activeTab === 'history' && <PaymentHistory />}
      {activeTab === 'manual' && <ManualPayment />}
      {activeTab === 'gateways' && <GatewaySettings />}
    </div>
  );
}

function PaymentHistory() {
  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="p-6 border-b border-slate-200 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div className="relative flex-1 max-w-md">
          <Search className="absolute left-3 top-1/2 -translate-y-1/2 h-4 w-4 text-slate-400" />
          <input 
            type="text" 
            placeholder="Search transaction ID or customer..." 
            className="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500"
          />
        </div>
        <button className="flex items-center px-4 py-2 border border-slate-300 rounded-lg text-slate-600 hover:bg-slate-50">
          <Filter className="h-4 w-4 mr-2" />
          Filter
        </button>
      </div>
      
      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm text-slate-600">
          <thead className="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
            <tr>
              <th className="px-6 py-4">Transaction ID</th>
              <th className="px-6 py-4">Customer</th>
              <th className="px-6 py-4">Date</th>
              <th className="px-6 py-4">Method</th>
              <th className="px-6 py-4">Gateway</th>
              <th className="px-6 py-4">Amount</th>
              <th className="px-6 py-4">Status</th>
              <th className="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody className="divide-y divide-slate-200">
            {transactions.map((trx) => (
              <tr key={trx.id} className="hover:bg-slate-50 transition-colors">
                <td className="px-6 py-4 font-mono text-xs font-medium text-slate-900">{trx.id}</td>
                <td className="px-6 py-4">{trx.customer}</td>
                <td className="px-6 py-4 text-xs">{trx.date}</td>
                <td className="px-6 py-4">
                  <span className="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">
                    {trx.method}
                  </span>
                </td>
                <td className="px-6 py-4 text-xs text-slate-500">{trx.gateway}</td>
                <td className="px-6 py-4 font-bold text-slate-900">Rp {trx.amount.toLocaleString()}</td>
                <td className="px-6 py-4">
                  <span className={`inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium capitalize
                    ${trx.status === 'success' ? 'bg-emerald-100 text-emerald-800' : 
                      trx.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                      'bg-red-100 text-red-800'}`}>
                    {trx.status === 'success' && <CheckCircle className="w-3 h-3 mr-1" />}
                    {trx.status === 'pending' && <Clock className="w-3 h-3 mr-1" />}
                    {trx.status === 'failed' && <XCircle className="w-3 h-3 mr-1" />}
                    {trx.status}
                  </span>
                </td>
                <td className="px-6 py-4 text-right">
                  <button className="text-slate-400 hover:text-slate-600">
                    <MoreVertical className="h-4 w-4" />
                  </button>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}

function ManualPayment() {
  return (
    <div className="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="p-6 border-b border-slate-200">
        <h3 className="text-lg font-bold text-slate-900">Input Manual Payment</h3>
        <p className="text-sm text-slate-500">Record payments made via cash or direct transfer.</p>
      </div>
      <div className="p-6 space-y-6">
        <div>
          <label className="block text-sm font-medium text-slate-700 mb-1">Customer</label>
          <select className="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500">
            <option>Select Customer...</option>
            <option>John Doe (CUST-001)</option>
            <option>Jane Smith (CUST-002)</option>
          </select>
        </div>

        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <label className="block text-sm font-medium text-slate-700 mb-1">Amount (Rp)</label>
            <input type="number" className="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="0" />
          </div>
          <div>
            <label className="block text-sm font-medium text-slate-700 mb-1">Date</label>
            <input type="date" className="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500" />
          </div>
        </div>

        <div>
          <label className="block text-sm font-medium text-slate-700 mb-1">Payment Method</label>
          <div className="grid grid-cols-3 gap-4">
            <label className="border border-slate-200 rounded-lg p-3 flex items-center justify-center cursor-pointer hover:bg-slate-50 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
              <input type="radio" name="method" className="hidden" />
              <span className="text-sm font-medium">Cash</span>
            </label>
            <label className="border border-slate-200 rounded-lg p-3 flex items-center justify-center cursor-pointer hover:bg-slate-50 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
              <input type="radio" name="method" className="hidden" />
              <span className="text-sm font-medium">Bank Transfer</span>
            </label>
            <label className="border border-slate-200 rounded-lg p-3 flex items-center justify-center cursor-pointer hover:bg-slate-50 has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50">
              <input type="radio" name="method" className="hidden" />
              <span className="text-sm font-medium">EDC / Other</span>
            </label>
          </div>
        </div>

        <div>
          <label className="block text-sm font-medium text-slate-700 mb-1">Proof of Transfer (Optional)</label>
          <div className="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:bg-slate-50 transition-colors cursor-pointer">
            <Upload className="h-8 w-8 text-slate-400 mx-auto mb-2" />
            <p className="text-sm text-slate-600">Click to upload or drag and drop</p>
            <p className="text-xs text-slate-400">JPG, PNG up to 2MB</p>
          </div>
        </div>

        <div>
          <label className="block text-sm font-medium text-slate-700 mb-1">Notes</label>
          <textarea rows={3} className="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500" placeholder="Additional notes..."></textarea>
        </div>

        <div className="flex justify-end pt-4">
          <button className="px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
            Save Payment
          </button>
        </div>
      </div>
    </div>
  );
}

function GatewaySettings() {
  return (
    <div className="space-y-6">
      {/* Xendit */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200 flex justify-between items-center">
          <h3 className="text-lg font-bold text-slate-900">Xendit Configuration</h3>
          <div className="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle-xendit" className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 checked:border-indigo-600" defaultChecked/>
            <label htmlFor="toggle-xendit" className="toggle-label block overflow-hidden h-6 rounded-full bg-indigo-600 cursor-pointer"></label>
          </div>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">API Key (Secret)</label>
            <input type="password" defaultValue="xnd_development_..." className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Callback Token</label>
            <input type="text" defaultValue="token_..." className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
        </div>
      </div>

      {/* Tripay */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200 flex justify-between items-center">
          <h3 className="text-lg font-bold text-slate-900">Tripay Configuration</h3>
          <div className="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle-tripay" className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 checked:border-indigo-600"/>
            <label htmlFor="toggle-tripay" className="toggle-label block overflow-hidden h-6 rounded-full bg-slate-300 cursor-pointer"></label>
          </div>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 opacity-50 pointer-events-none">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">API Key</label>
            <input type="password" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Private Key</label>
            <input type="password" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Merchant Code</label>
            <input type="text" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
        </div>
      </div>

      {/* Duitku */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200 flex justify-between items-center">
          <h3 className="text-lg font-bold text-slate-900">Duitku Configuration</h3>
          <div className="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle-duitku" className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 checked:border-indigo-600"/>
            <label htmlFor="toggle-duitku" className="toggle-label block overflow-hidden h-6 rounded-full bg-slate-300 cursor-pointer"></label>
          </div>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 gap-6 opacity-50 pointer-events-none">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Merchant Code</label>
            <input type="text" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">API Key</label>
            <input type="password" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
        </div>
      </div>

      {/* Payment Methods */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200">
          <h3 className="text-lg font-bold text-slate-900">Active Payment Channels</h3>
          <p className="text-sm text-slate-500">Select which methods are available to customers.</p>
        </div>
        <div className="p-6 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
          <div className="border border-slate-200 rounded-lg p-4 flex items-center space-x-3">
            <div className="p-2 bg-blue-100 rounded-lg text-blue-600">
              <Landmark className="h-5 w-5" />
            </div>
            <div>
              <p className="font-medium text-slate-900">Virtual Account</p>
              <p className="text-xs text-slate-500">BCA, BRI, BNI, Mandiri</p>
            </div>
            <input type="checkbox" defaultChecked className="ml-auto rounded text-indigo-600" />
          </div>
          <div className="border border-slate-200 rounded-lg p-4 flex items-center space-x-3">
            <div className="p-2 bg-slate-100 rounded-lg text-slate-600">
              <QrCode className="h-5 w-5" />
            </div>
            <div>
              <p className="font-medium text-slate-900">QRIS</p>
              <p className="text-xs text-slate-500">All E-Wallets</p>
            </div>
            <input type="checkbox" defaultChecked className="ml-auto rounded text-indigo-600" />
          </div>
          <div className="border border-slate-200 rounded-lg p-4 flex items-center space-x-3">
            <div className="p-2 bg-indigo-100 rounded-lg text-indigo-600">
              <Smartphone className="h-5 w-5" />
            </div>
            <div>
              <p className="font-medium text-slate-900">E-Wallet</p>
              <p className="text-xs text-slate-500">OVO, DANA, ShopeePay</p>
            </div>
            <input type="checkbox" defaultChecked className="ml-auto rounded text-indigo-600" />
          </div>
          <div className="border border-slate-200 rounded-lg p-4 flex items-center space-x-3">
            <div className="p-2 bg-green-100 rounded-lg text-green-600">
              <Landmark className="h-5 w-5" />
            </div>
            <div>
              <p className="font-medium text-slate-900">Retail Outlet</p>
              <p className="text-xs text-slate-500">Alfamart, Indomaret</p>
            </div>
            <input type="checkbox" className="ml-auto rounded text-indigo-600" />
          </div>
        </div>
      </div>

      <div className="flex justify-end">
        <button className="flex items-center px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
          <Save className="h-4 w-4 mr-2" />
          Save Configurations
        </button>
      </div>
    </div>
  );
}
