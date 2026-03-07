import React, { useState } from 'react';
import { 
  Upload, 
  Download, 
  Database, 
  RotateCcw, 
  FileSpreadsheet, 
  FileJson, 
  History, 
  AlertCircle, 
  CheckCircle, 
  User, 
  Server 
} from 'lucide-react';

// Mock Data for Logs
const adminLogs = [
  { id: 1, user: 'admin', action: 'Created new customer', target: 'John Doe', time: '2023-10-25 10:30:00', ip: '192.168.1.10' },
  { id: 2, user: 'kasir', action: 'Processed payment', target: 'Invoice #00123', time: '2023-10-25 11:15:00', ip: '192.168.1.12' },
  { id: 3, user: 'teknisi', action: 'Updated router config', target: 'Core Router 1', time: '2023-10-25 14:00:00', ip: '192.168.1.15' },
  { id: 4, user: 'admin', action: 'Deleted package', target: 'Old Promo', time: '2023-10-24 09:00:00', ip: '192.168.1.10' },
];

const systemLogs = [
  { id: 1, level: 'info', message: 'Backup completed successfully', source: 'System', time: '2023-10-25 00:00:00' },
  { id: 2, level: 'warning', message: 'High latency detected on ODP-Cluster-B', source: 'Network Monitor', time: '2023-10-25 03:30:00' },
  { id: 3, level: 'error', message: 'Failed to sync with payment gateway', source: 'Billing Service', time: '2023-10-25 08:45:00' },
  { id: 4, level: 'info', message: 'Daily invoice generation started', source: 'Cron Job', time: '2023-10-25 01:00:00' },
];

export default function Tools() {
  const [activeTab, setActiveTab] = useState<'import-export' | 'backup' | 'logs'>('import-export');

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <Database className="mr-2 h-6 w-6 text-indigo-600" />
          System Tools
        </h1>
        
        <div className="flex space-x-2 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
          <button
            onClick={() => setActiveTab('import-export')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'import-export' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Import / Export
          </button>
          <button
            onClick={() => setActiveTab('backup')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'backup' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Backup & Restore
          </button>
          <button
            onClick={() => setActiveTab('logs')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'logs' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Activity Logs
          </button>
        </div>
      </div>

      {activeTab === 'import-export' && <ImportExport />}
      {activeTab === 'backup' && <BackupRestore />}
      {activeTab === 'logs' && <ActivityLogs />}
    </div>
  );
}

function ImportExport() {
  return (
    <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
      {/* Import Section */}
      <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div className="flex items-center mb-4">
          <div className="p-3 bg-indigo-50 rounded-lg mr-4">
            <Upload className="h-6 w-6 text-indigo-600" />
          </div>
          <div>
            <h3 className="text-lg font-bold text-slate-900">Import Data</h3>
            <p className="text-sm text-slate-500">Upload CSV or Excel files to bulk add data.</p>
          </div>
        </div>
        
        <div className="space-y-4">
          <div className="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:bg-slate-50 transition-colors cursor-pointer">
            <FileSpreadsheet className="h-8 w-8 text-slate-400 mx-auto mb-2" />
            <p className="text-sm font-medium text-slate-900">Click to upload or drag and drop</p>
            <p className="text-xs text-slate-500">CSV, XLS, XLSX (Max 10MB)</p>
          </div>
          
          <div className="bg-slate-50 p-4 rounded-lg border border-slate-200">
            <h4 className="text-sm font-semibold text-slate-900 mb-2">Supported Data Types:</h4>
            <ul className="text-sm text-slate-600 space-y-1 list-disc list-inside">
              <li>Customers (Name, Address, Phone, Package)</li>
              <li>Devices (Name, IP, Type, Location)</li>
              <li>Inventory Items</li>
            </ul>
          </div>
          
          <button className="w-full py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
            Process Import
          </button>
        </div>
      </div>

      {/* Export Section */}
      <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
        <div className="flex items-center mb-4">
          <div className="p-3 bg-emerald-50 rounded-lg mr-4">
            <Download className="h-6 w-6 text-emerald-600" />
          </div>
          <div>
            <h3 className="text-lg font-bold text-slate-900">Export Data</h3>
            <p className="text-sm text-slate-500">Download system data for reporting or backup.</p>
          </div>
        </div>

        <div className="space-y-4">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Select Data to Export</label>
            <select className="w-full p-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
              <option>All Customers</option>
              <option>Active Invoices</option>
              <option>Payment History</option>
              <option>Device List</option>
            </select>
          </div>

          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Format</label>
            <div className="grid grid-cols-2 gap-4">
              <button className="flex items-center justify-center p-3 border border-slate-200 rounded-lg hover:bg-slate-50 hover:border-indigo-500 transition-all">
                <FileSpreadsheet className="h-5 w-5 mr-2 text-green-600" />
                <span className="text-sm font-medium">Excel / CSV</span>
              </button>
              <button className="flex items-center justify-center p-3 border border-slate-200 rounded-lg hover:bg-slate-50 hover:border-indigo-500 transition-all">
                <FileJson className="h-5 w-5 mr-2 text-yellow-600" />
                <span className="text-sm font-medium">JSON</span>
              </button>
            </div>
          </div>

          <button className="w-full py-2 bg-white border border-slate-300 text-slate-700 rounded-lg hover:bg-slate-50 transition-colors font-medium mt-4">
            Download Export
          </button>
        </div>
      </div>
    </div>
  );
}

function BackupRestore() {
  return (
    <div className="space-y-6">
      <div className="bg-indigo-50 border border-indigo-100 rounded-xl p-6">
        <div className="flex items-start">
          <AlertCircle className="h-6 w-6 text-indigo-600 mt-0.5 mr-4 flex-shrink-0" />
          <div>
            <h3 className="text-lg font-bold text-indigo-900">Database Backup</h3>
            <p className="text-indigo-700 mt-1">
              Regular backups are essential. The system automatically performs a daily backup at 00:00.
              You can also trigger a manual backup below.
            </p>
          </div>
        </div>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <h3 className="text-lg font-bold text-slate-900 mb-4 flex items-center">
            <Database className="h-5 w-5 mr-2 text-slate-500" />
            Create Backup
          </h3>
          <p className="text-sm text-slate-500 mb-6">
            Generate a full SQL dump of the database. This includes all customers, invoices, and configuration.
          </p>
          <button className="w-full py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium flex items-center justify-center">
            <Download className="h-5 w-5 mr-2" />
            Download SQL Backup
          </button>
          <div className="mt-4 text-xs text-slate-400 text-center">
            Last backup: Today, 00:00 AM (Size: 4.2 MB)
          </div>
        </div>

        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <h3 className="text-lg font-bold text-slate-900 mb-4 flex items-center">
            <RotateCcw className="h-5 w-5 mr-2 text-slate-500" />
            Restore Database
          </h3>
          <p className="text-sm text-slate-500 mb-6">
            Restore the system from a previous backup file. 
            <span className="text-red-600 font-bold"> Warning: This will overwrite current data.</span>
          </p>
          <div className="border-2 border-dashed border-slate-300 rounded-lg p-4 text-center hover:bg-slate-50 transition-colors cursor-pointer mb-4">
            <Upload className="h-6 w-6 text-slate-400 mx-auto mb-2" />
            <p className="text-sm text-slate-600">Select SQL file</p>
          </div>
          <button className="w-full py-3 bg-white border border-red-200 text-red-600 rounded-lg hover:bg-red-50 transition-colors font-medium">
            Restore Data
          </button>
        </div>
      </div>
    </div>
  );
}

function ActivityLogs() {
  const [logType, setLogType] = useState<'admin' | 'system'>('admin');

  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="border-b border-slate-200">
        <nav className="flex -mb-px">
          <button
            onClick={() => setLogType('admin')}
            className={`py-4 px-6 text-sm font-medium border-b-2 transition-colors ${
              logType === 'admin'
                ? 'border-indigo-500 text-indigo-600'
                : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'
            }`}
          >
            <User className="h-4 w-4 inline-block mr-2" />
            Admin Logs
          </button>
          <button
            onClick={() => setLogType('system')}
            className={`py-4 px-6 text-sm font-medium border-b-2 transition-colors ${
              logType === 'system'
                ? 'border-indigo-500 text-indigo-600'
                : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300'
            }`}
          >
            <Server className="h-4 w-4 inline-block mr-2" />
            System Logs
          </button>
        </nav>
      </div>

      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm text-slate-600">
          <thead className="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
            <tr>
              <th className="px-6 py-4">Time</th>
              {logType === 'admin' ? (
                <>
                  <th className="px-6 py-4">User</th>
                  <th className="px-6 py-4">Action</th>
                  <th className="px-6 py-4">Target</th>
                  <th className="px-6 py-4">IP Address</th>
                </>
              ) : (
                <>
                  <th className="px-6 py-4">Level</th>
                  <th className="px-6 py-4">Source</th>
                  <th className="px-6 py-4">Message</th>
                </>
              )}
            </tr>
          </thead>
          <tbody className="divide-y divide-slate-200">
            {logType === 'admin' ? (
              adminLogs.map((log) => (
                <tr key={log.id} className="hover:bg-slate-50 transition-colors">
                  <td className="px-6 py-4 font-mono text-xs text-slate-500">{log.time}</td>
                  <td className="px-6 py-4 font-medium text-slate-900">{log.user}</td>
                  <td className="px-6 py-4">
                    <span className="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-indigo-50 text-indigo-700">
                      {log.action}
                    </span>
                  </td>
                  <td className="px-6 py-4 text-slate-900">{log.target}</td>
                  <td className="px-6 py-4 font-mono text-xs text-slate-500">{log.ip}</td>
                </tr>
              ))
            ) : (
              systemLogs.map((log) => (
                <tr key={log.id} className="hover:bg-slate-50 transition-colors">
                  <td className="px-6 py-4 font-mono text-xs text-slate-500">{log.time}</td>
                  <td className="px-6 py-4">
                    <span className={`inline-flex items-center px-2 py-0.5 rounded text-xs font-medium capitalize
                      ${log.level === 'info' ? 'bg-blue-100 text-blue-800' : 
                        log.level === 'warning' ? 'bg-yellow-100 text-yellow-800' : 
                        'bg-red-100 text-red-800'}`}>
                      {log.level === 'info' && <CheckCircle className="w-3 h-3 mr-1" />}
                      {log.level === 'warning' && <AlertCircle className="w-3 h-3 mr-1" />}
                      {log.level === 'error' && <AlertCircle className="w-3 h-3 mr-1" />}
                      {log.level}
                    </span>
                  </td>
                  <td className="px-6 py-4 font-medium text-slate-900">{log.source}</td>
                  <td className="px-6 py-4 text-slate-600">{log.message}</td>
                </tr>
              ))
            )}
          </tbody>
        </table>
      </div>
    </div>
  );
}
