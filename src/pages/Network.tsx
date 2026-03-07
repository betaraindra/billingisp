import React, { useState, useEffect } from 'react';
import { 
  Server, 
  Activity, 
  Wifi, 
  Plus, 
  MoreVertical, 
  RefreshCw, 
  Power, 
  Trash2, 
  Edit2, 
  Shield, 
  Users, 
  ArrowUp, 
  ArrowDown,
  Clock,
  Lock
} from 'lucide-react';

// Mock Data
const routers = [
  { id: 1, name: 'Main Gateway', ip: '192.168.1.1', model: 'RB4011', status: 'online', cpu: 15, uptime: '15d 2h' },
  { id: 2, name: 'Distribution OLT', ip: '192.168.1.2', model: 'ZTE C320', status: 'online', cpu: 45, uptime: '30d 5h' },
  { id: 3, name: 'Backup Router', ip: '192.168.1.3', model: 'RB750Gr3', status: 'offline', cpu: 0, uptime: '0d 0h' },
];

const onlineUsers = [
  { id: 1, username: 'user_001', ip: '10.0.0.5', uptime: '2h 15m', download: '1.2 GB', upload: '300 MB', profile: 'Home 20M' },
  { id: 2, username: 'user_002', ip: '10.0.0.6', uptime: '5h 30m', download: '3.5 GB', upload: '800 MB', profile: 'Home 50M' },
  { id: 3, username: 'user_003', ip: '10.0.0.7', uptime: '0h 45m', download: '150 MB', upload: '20 MB', profile: 'Gamer 100M' },
];

const connectionLogs = [
  { id: 1, time: '2023-10-26 10:30:00', username: 'user_001', message: 'logged in via pppoe', type: 'info' },
  { id: 2, time: '2023-10-26 10:25:00', username: 'user_004', message: 'logged out: lost carrier', type: 'warning' },
  { id: 3, time: '2023-10-26 10:15:00', username: 'user_002', message: 'login failure: invalid password', type: 'error' },
];

export default function Network() {
  const [activeTab, setActiveTab] = useState<'routers' | 'monitoring' | 'logs'>('routers');
  const [isModalOpen, setIsModalOpen] = useState(false);

  // Example of using the PHP API
  useEffect(() => {
    // Use relative path for XAMPP compatibility
    // fetch('api/routers.php') ...
  }, []);

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <Server className="mr-2 h-6 w-6 text-indigo-600" />
          Network Management
        </h1>
        
        <div className="flex space-x-2 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
          <button
            onClick={() => setActiveTab('routers')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'routers' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Routers
          </button>
          <button
            onClick={() => setActiveTab('monitoring')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'monitoring' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Monitoring (Online Users)
          </button>
          <button
            onClick={() => setActiveTab('logs')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'logs' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Connection Logs
          </button>
        </div>
      </div>

      {activeTab === 'routers' && <RouterList onAdd={() => setIsModalOpen(true)} />}
      {activeTab === 'monitoring' && <MonitoringPanel />}
      {activeTab === 'logs' && <LogsPanel />}

      {/* Add Router Modal */}
      {isModalOpen && (
        <div className="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
          <div className="bg-white rounded-xl shadow-lg w-full max-w-md p-6">
            <h2 className="text-xl font-bold text-slate-900 mb-4">Add New Router</h2>
            <form className="space-y-4">
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">Router Name</label>
                <input type="text" className="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="e.g., Main Gateway" />
              </div>
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">IP Address</label>
                <input type="text" className="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="e.g., 192.168.1.1" />
              </div>
              <div className="grid grid-cols-2 gap-4">
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">Username</label>
                  <input type="text" className="w-full px-3 py-2 border border-slate-300 rounded-lg" placeholder="admin" />
                </div>
                <div>
                  <label className="block text-sm font-medium text-slate-700 mb-1">Password</label>
                  <input type="password" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
                </div>
              </div>
              <div>
                <label className="block text-sm font-medium text-slate-700 mb-1">API Port</label>
                <input type="number" defaultValue={8728} className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
              </div>
              <div className="flex justify-end space-x-3 pt-4">
                <button 
                  type="button" 
                  onClick={() => setIsModalOpen(false)}
                  className="px-4 py-2 border border-slate-300 rounded-lg text-slate-700 hover:bg-slate-50"
                >
                  Cancel
                </button>
                <button 
                  type="button"
                  onClick={() => setIsModalOpen(false)}
                  className="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700"
                >
                  Connect & Save
                </button>
              </div>
            </form>
          </div>
        </div>
      )}
    </div>
  );
}

function RouterList({ onAdd }: { onAdd: () => void }) {
  return (
    <div className="space-y-6">
      <div className="flex justify-end">
        <button 
          onClick={onAdd}
          className="flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors shadow-sm"
        >
          <Plus className="h-4 w-4 mr-2" />
          Add Router
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {routers.map((router) => (
          <div key={router.id} className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
            <div className="p-6">
              <div className="flex justify-between items-start mb-4">
                <div className="flex items-center">
                  <div className={`p-2 rounded-lg mr-3 ${router.status === 'online' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600'}`}>
                    <Server className="h-6 w-6" />
                  </div>
                  <div>
                    <h3 className="font-bold text-slate-900">{router.name}</h3>
                    <p className="text-sm text-slate-500">{router.ip}</p>
                  </div>
                </div>
                <div className="relative group">
                  <button className="text-slate-400 hover:text-slate-600">
                    <MoreVertical className="h-5 w-5" />
                  </button>
                  <div className="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-slate-100 hidden group-hover:block z-10">
                    <button className="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 flex items-center">
                      <Edit2 className="h-4 w-4 mr-2" /> Edit
                    </button>
                    <button className="w-full text-left px-4 py-2 text-sm text-slate-700 hover:bg-slate-50 flex items-center">
                      <RefreshCw className="h-4 w-4 mr-2" /> Reconnect
                    </button>
                    <button className="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 flex items-center">
                      <Trash2 className="h-4 w-4 mr-2" /> Delete
                    </button>
                  </div>
                </div>
              </div>
              
              <div className="grid grid-cols-2 gap-4 mb-4">
                <div className="bg-slate-50 p-3 rounded-lg">
                  <p className="text-xs text-slate-500 mb-1">Model</p>
                  <p className="font-medium text-slate-900">{router.model}</p>
                </div>
                <div className="bg-slate-50 p-3 rounded-lg">
                  <p className="text-xs text-slate-500 mb-1">Uptime</p>
                  <p className="font-medium text-slate-900">{router.uptime}</p>
                </div>
              </div>

              <div className="flex items-center justify-between text-sm">
                <div className="flex items-center text-slate-600">
                  <Activity className="h-4 w-4 mr-1" />
                  CPU Load: {router.cpu}%
                </div>
                <span className={`px-2 py-1 rounded text-xs font-medium capitalize ${
                  router.status === 'online' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'
                }`}>
                  {router.status}
                </span>
              </div>
            </div>
            <div className="bg-slate-50 px-6 py-3 border-t border-slate-200 flex justify-between items-center">
              <span className="text-xs text-slate-500">Last check: 2 mins ago</span>
              <button className="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View Details</button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

function MonitoringPanel() {
  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="p-6 border-b border-slate-200 flex justify-between items-center">
        <h3 className="text-lg font-bold text-slate-900 flex items-center">
          <Users className="h-5 w-5 mr-2 text-indigo-600" />
          Active Sessions (PPPoE & Hotspot)
        </h3>
        <button className="text-slate-500 hover:text-indigo-600">
          <RefreshCw className="h-5 w-5" />
        </button>
      </div>
      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm text-slate-600">
          <thead className="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
            <tr>
              <th className="px-6 py-4">Username</th>
              <th className="px-6 py-4">IP Address</th>
              <th className="px-6 py-4">Profile</th>
              <th className="px-6 py-4">Uptime</th>
              <th className="px-6 py-4">Traffic (DL/UL)</th>
              <th className="px-6 py-4 text-right">Actions</th>
            </tr>
          </thead>
          <tbody className="divide-y divide-slate-200">
            {onlineUsers.map((user) => (
              <tr key={user.id} className="hover:bg-slate-50 transition-colors">
                <td className="px-6 py-4 font-medium text-slate-900 flex items-center">
                  <div className="w-2 h-2 bg-emerald-500 rounded-full mr-2"></div>
                  {user.username}
                </td>
                <td className="px-6 py-4 font-mono text-xs">{user.ip}</td>
                <td className="px-6 py-4">
                  <span className="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800">
                    {user.profile}
                  </span>
                </td>
                <td className="px-6 py-4 font-mono text-xs">{user.uptime}</td>
                <td className="px-6 py-4 text-xs">
                  <div className="flex items-center space-x-3">
                    <span className="flex items-center text-emerald-600">
                      <ArrowDown className="w-3 h-3 mr-1" /> {user.download}
                    </span>
                    <span className="flex items-center text-blue-600">
                      <ArrowUp className="w-3 h-3 mr-1" /> {user.upload}
                    </span>
                  </div>
                </td>
                <td className="px-6 py-4 text-right space-x-2">
                  <button 
                    title="Disconnect User"
                    className="p-1 text-slate-400 hover:text-red-600 transition-colors"
                  >
                    <Power className="h-4 w-4" />
                  </button>
                  <button 
                    title="Isolate User"
                    className="p-1 text-slate-400 hover:text-orange-600 transition-colors"
                  >
                    <Shield className="h-4 w-4" />
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

function LogsPanel() {
  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="p-6 border-b border-slate-200">
        <h3 className="text-lg font-bold text-slate-900">Connection Logs</h3>
      </div>
      <div className="overflow-x-auto">
        <table className="w-full text-left text-sm text-slate-600">
          <thead className="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
            <tr>
              <th className="px-6 py-4">Time</th>
              <th className="px-6 py-4">Username</th>
              <th className="px-6 py-4">Message</th>
            </tr>
          </thead>
          <tbody className="divide-y divide-slate-200">
            {connectionLogs.map((log) => (
              <tr key={log.id} className="hover:bg-slate-50 transition-colors">
                <td className="px-6 py-4 font-mono text-xs text-slate-500">{log.time}</td>
                <td className="px-6 py-4 font-medium text-slate-900">{log.username}</td>
                <td className="px-6 py-4">
                  <span className={`inline-flex items-center px-2 py-0.5 rounded text-xs font-medium capitalize
                    ${log.type === 'info' ? 'bg-blue-100 text-blue-800' : 
                      log.type === 'warning' ? 'bg-yellow-100 text-yellow-800' : 
                      'bg-red-100 text-red-800'}`}>
                    {log.message}
                  </span>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
}
