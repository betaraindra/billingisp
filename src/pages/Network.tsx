import React, { useEffect, useState } from 'react';
import { Server, Activity, MapPin, Power } from 'lucide-react';

interface Router {
  id: number;
  name: string;
  ip_address: string;
  status: 'online' | 'offline';
  location: string;
  last_seen: string;
}

export default function Network() {
  const [routers, setRouters] = useState<Router[]>([]);

  useEffect(() => {
    fetch('/api/routers')
      .then(res => res.json())
      .then(data => setRouters(data))
      .catch(err => console.error('Failed to fetch routers:', err));
  }, []);

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-slate-900">Network Monitoring</h1>
        <button className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
          <Plus className="h-4 w-4 mr-2" />
          Add Device
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {routers.map((router) => (
          <div key={router.id} className="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
            <div className="flex items-center justify-between mb-4">
              <div className={`p-3 rounded-lg ${router.status === 'online' ? 'bg-emerald-50 text-emerald-600' : 'bg-red-50 text-red-600'}`}>
                <Server className="h-6 w-6" />
              </div>
              <div className={`flex items-center space-x-2 px-3 py-1 rounded-full text-xs font-medium ${router.status === 'online' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'}`}>
                <span className={`w-2 h-2 rounded-full mr-2 ${router.status === 'online' ? 'bg-emerald-500' : 'bg-red-500'}`} />
                {router.status.toUpperCase()}
              </div>
            </div>
            
            <h3 className="text-lg font-bold text-slate-900">{router.name}</h3>
            <p className="text-sm text-slate-500 font-mono mt-1">{router.ip_address}</p>
            
            <div className="mt-6 space-y-3 border-t border-slate-100 pt-4">
              <div className="flex items-center justify-between text-sm">
                <span className="text-slate-500 flex items-center">
                  <MapPin className="h-4 w-4 mr-2" /> Location
                </span>
                <span className="font-medium text-slate-900">{router.location}</span>
              </div>
              <div className="flex items-center justify-between text-sm">
                <span className="text-slate-500 flex items-center">
                  <Activity className="h-4 w-4 mr-2" /> Latency
                </span>
                <span className="font-medium text-slate-900">
                  {router.status === 'online' ? '12ms' : '-'}
                </span>
              </div>
              <div className="flex items-center justify-between text-sm">
                <span className="text-slate-500 flex items-center">
                  <Power className="h-4 w-4 mr-2" /> Uptime
                </span>
                <span className="font-medium text-slate-900">
                  {router.status === 'online' ? '14d 2h 15m' : '0m'}
                </span>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

function Plus({ className }: { className?: string }) {
  return (
    <svg 
      xmlns="http://www.w3.org/2000/svg" 
      width="24" 
      height="24" 
      viewBox="0 0 24 24" 
      fill="none" 
      stroke="currentColor" 
      strokeWidth="2" 
      strokeLinecap="round" 
      strokeLinejoin="round" 
      className={className}
    >
      <path d="M5 12h14" />
      <path d="M12 5v14" />
    </svg>
  );
}
