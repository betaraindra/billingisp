import React, { useState } from 'react';
import { 
  FileText, 
  TrendingUp, 
  Users, 
  Activity, 
  Download, 
  Calendar,
  DollarSign
} from 'lucide-react';
import { 
  BarChart, 
  Bar, 
  XAxis, 
  YAxis, 
  CartesianGrid, 
  Tooltip, 
  ResponsiveContainer,
  PieChart,
  Pie,
  Cell
} from 'recharts';

// Mock Data
const revenueData = [
  { month: 'Jan', revenue: 12000000 },
  { month: 'Feb', revenue: 15000000 },
  { month: 'Mar', revenue: 14500000 },
  { month: 'Apr', revenue: 18000000 },
  { month: 'May', revenue: 20000000 },
  { month: 'Jun', revenue: 22000000 },
];

const customerStatusData = [
  { name: 'Active', value: 145, color: '#10b981' },
  { name: 'Inactive', value: 12, color: '#64748b' },
  { name: 'Isolated', value: 8, color: '#ef4444' },
];

export default function Reports() {
  const [activeTab, setActiveTab] = useState<'financial' | 'customer' | 'traffic'>('financial');

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <FileText className="mr-2 h-6 w-6 text-indigo-600" />
          System Reports
        </h1>
        
        <div className="flex space-x-2 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
          <button
            onClick={() => setActiveTab('financial')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'financial' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Financial
          </button>
          <button
            onClick={() => setActiveTab('customer')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'customer' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Customers
          </button>
          <button
            onClick={() => setActiveTab('traffic')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'traffic' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Traffic
          </button>
        </div>
      </div>

      {activeTab === 'financial' && <FinancialReports />}
      {activeTab === 'customer' && <CustomerReports />}
      {activeTab === 'traffic' && <TrafficReports />}
    </div>
  );
}

function FinancialReports() {
  return (
    <div className="space-y-6">
      {/* Summary Cards */}
      <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <p className="text-sm font-medium text-slate-500">Total Revenue (This Month)</p>
          <p className="text-2xl font-bold text-slate-900 mt-1">Rp 22,000,000</p>
          <div className="mt-2 text-sm text-emerald-600 flex items-center">
            <TrendingUp className="h-4 w-4 mr-1" />
            +10% from last month
          </div>
        </div>
        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <p className="text-sm font-medium text-slate-500">Payments Received</p>
          <p className="text-2xl font-bold text-slate-900 mt-1">142</p>
          <div className="mt-2 text-sm text-slate-500">
            Transactions
          </div>
        </div>
        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <p className="text-sm font-medium text-slate-500">Outstanding Receivables</p>
          <p className="text-2xl font-bold text-red-600 mt-1">Rp 3,500,000</p>
          <div className="mt-2 text-sm text-slate-500">
            From 15 customers
          </div>
        </div>
      </div>

      {/* Chart */}
      <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div className="flex items-center justify-between mb-6">
          <h3 className="text-lg font-bold text-slate-900">Monthly Revenue</h3>
          <button className="flex items-center text-sm text-indigo-600 hover:text-indigo-800">
            <Download className="h-4 w-4 mr-1" />
            Export CSV
          </button>
        </div>
        <div className="h-80">
          <ResponsiveContainer width="100%" height="100%">
            <BarChart data={revenueData}>
              <CartesianGrid strokeDasharray="3 3" vertical={false} />
              <XAxis dataKey="month" />
              <YAxis />
              <Tooltip formatter={(value) => `Rp ${value.toLocaleString()}`} />
              <Bar dataKey="revenue" fill="#4f46e5" radius={[4, 4, 0, 0]} />
            </BarChart>
          </ResponsiveContainer>
        </div>
      </div>
    </div>
  );
}

function CustomerReports() {
  return (
    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 className="text-lg font-bold text-slate-900 mb-6">Customer Status Distribution</h3>
        <div className="h-64">
          <ResponsiveContainer width="100%" height="100%">
            <PieChart>
              <Pie
                data={customerStatusData}
                cx="50%"
                cy="50%"
                innerRadius={60}
                outerRadius={80}
                paddingAngle={5}
                dataKey="value"
              >
                {customerStatusData.map((entry, index) => (
                  <Cell key={`cell-${index}`} fill={entry.color} />
                ))}
              </Pie>
              <Tooltip />
            </PieChart>
          </ResponsiveContainer>
        </div>
        <div className="flex justify-center space-x-6 mt-4">
          {customerStatusData.map((item) => (
            <div key={item.name} className="flex items-center">
              <span className="w-3 h-3 rounded-full mr-2" style={{ backgroundColor: item.color }}></span>
              <span className="text-sm text-slate-600">{item.name} ({item.value})</span>
            </div>
          ))}
        </div>
      </div>

      <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 className="text-lg font-bold text-slate-900 mb-4">Recent Activations</h3>
        <div className="space-y-4">
          {[1, 2, 3, 4, 5].map((i) => (
            <div key={i} className="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
              <div className="flex items-center">
                <div className="h-8 w-8 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600 font-bold mr-3">
                  U{i}
                </div>
                <div>
                  <p className="text-sm font-medium text-slate-900">New User {i}</p>
                  <p className="text-xs text-slate-500">Activated today</p>
                </div>
              </div>
              <span className="text-xs font-medium text-emerald-600 bg-emerald-50 px-2 py-1 rounded">
                Active
              </span>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
}

function TrafficReports() {
  return (
    <div className="space-y-6">
      <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 className="text-lg font-bold text-slate-900 mb-4">Bandwidth Usage (Last 24 Hours)</h3>
        <div className="h-64 flex items-center justify-center bg-slate-50 rounded-lg border border-slate-200 border-dashed">
          <p className="text-slate-500">Traffic chart visualization would go here</p>
        </div>
      </div>

      <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <h3 className="text-lg font-bold text-slate-900 mb-4">Top Consumers</h3>
        <table className="w-full text-left text-sm text-slate-600">
          <thead className="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
            <tr>
              <th className="px-6 py-3">Customer</th>
              <th className="px-6 py-3">Download</th>
              <th className="px-6 py-3">Upload</th>
              <th className="px-6 py-3">Total</th>
            </tr>
          </thead>
          <tbody className="divide-y divide-slate-200">
            {[1, 2, 3].map((i) => (
              <tr key={i}>
                <td className="px-6 py-3 font-medium text-slate-900">Customer {i}</td>
                <td className="px-6 py-3">45.2 GB</td>
                <td className="px-6 py-3">12.5 GB</td>
                <td className="px-6 py-3 font-bold">57.7 GB</td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}
