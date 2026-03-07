import React, { useState, useEffect } from 'react';
import { 
  Activity, 
  Server, 
  Map as MapIcon, 
  Wifi, 
  AlertTriangle, 
  CheckCircle,
  Cpu,
  HardDrive,
  Zap
} from 'lucide-react';
import { 
  LineChart, 
  Line, 
  XAxis, 
  YAxis, 
  CartesianGrid, 
  Tooltip, 
  ResponsiveContainer,
  AreaChart,
  Area
} from 'recharts';
import { MapContainer, TileLayer, Marker, Popup } from 'react-leaflet';
import 'leaflet/dist/leaflet.css';
import L from 'leaflet';

// Fix Leaflet icon issue
import icon from 'leaflet/dist/images/marker-icon.png';
import iconShadow from 'leaflet/dist/images/marker-shadow.png';

let DefaultIcon = L.icon({
    iconUrl: icon,
    shadowUrl: iconShadow,
    iconSize: [25, 41],
    iconAnchor: [12, 41]
});

L.Marker.prototype.options.icon = DefaultIcon;

// Mock Data for Charts
const bandwidthData = Array.from({ length: 20 }, (_, i) => ({
  time: `${i}:00`,
  upload: Math.floor(Math.random() * 50) + 10,
  download: Math.floor(Math.random() * 100) + 50,
}));

const pingData = Array.from({ length: 20 }, (_, i) => ({
  time: `${i}:00`,
  latency: Math.floor(Math.random() * 20) + 5,
}));

// Mock Data for Devices
const devices = [
  { id: 1, name: 'Core Router MikroTik', type: 'Router', ip: '192.168.1.1', status: 'online', uptime: '14d 2h', cpu: 12, temp: 45 },
  { id: 2, name: 'OLT Huawei MA5608T', type: 'OLT', ip: '192.168.2.1', status: 'online', uptime: '45d 10h', cpu: 25, temp: 48 },
  { id: 3, name: 'Switch Distribution A', type: 'Switch', ip: '192.168.2.5', status: 'online', uptime: '10d 5h', cpu: 8, temp: 40 },
  { id: 4, name: 'ODP-Cluster-B-01', type: 'ODP', ip: '-', status: 'offline', uptime: '-', cpu: 0, temp: 0 },
  { id: 5, name: 'ONU-Cust-005', type: 'ONU', ip: '192.168.100.5', status: 'online', uptime: '2d 1h', cpu: 5, temp: 38 },
];

// Mock Data for Map
const mapLocations = [
  { id: 1, name: 'Head Office (NOC)', type: 'HQ', lat: -6.200000, lng: 106.816666, status: 'online' },
  { id: 2, name: 'ODP Cluster A', type: 'ODP', lat: -6.205000, lng: 106.820000, status: 'online' },
  { id: 3, name: 'ODP Cluster B', type: 'ODP', lat: -6.195000, lng: 106.810000, status: 'offline' },
  { id: 4, name: 'Customer John Doe', type: 'Customer', lat: -6.202000, lng: 106.818000, status: 'online' },
  { id: 5, name: 'Customer Jane Smith', type: 'Customer', lat: -6.208000, lng: 106.822000, status: 'online' },
];

export default function NOC() {
  const [activeTab, setActiveTab] = useState<'monitoring' | 'map' | 'devices'>('monitoring');

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <Activity className="mr-2 h-6 w-6 text-indigo-600" />
          Network Operation Center (NOC)
        </h1>
        
        <div className="flex space-x-2 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
          <button
            onClick={() => setActiveTab('monitoring')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'monitoring' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Monitoring
          </button>
          <button
            onClick={() => setActiveTab('map')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'map' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Network Map
          </button>
          <button
            onClick={() => setActiveTab('devices')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'devices' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Devices
          </button>
        </div>
      </div>

      {activeTab === 'monitoring' && <MonitoringDashboard />}
      {activeTab === 'map' && <NetworkMap />}
      {activeTab === 'devices' && <DeviceList />}
    </div>
  );
}

function MonitoringDashboard() {
  return (
    <div className="space-y-6">
      {/* Status Cards */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-slate-500">Total Devices</p>
              <p className="text-2xl font-bold text-slate-900 mt-1">142</p>
            </div>
            <div className="p-3 bg-indigo-50 rounded-lg">
              <Server className="h-6 w-6 text-indigo-600" />
            </div>
          </div>
          <div className="mt-4 flex items-center text-sm">
            <span className="text-emerald-600 font-medium flex items-center">
              <CheckCircle className="h-3 w-3 mr-1" /> 138 Online
            </span>
            <span className="mx-2 text-slate-300">|</span>
            <span className="text-red-600 font-medium flex items-center">
              <AlertTriangle className="h-3 w-3 mr-1" /> 4 Offline
            </span>
          </div>
        </div>

        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-slate-500">Avg Latency</p>
              <p className="text-2xl font-bold text-slate-900 mt-1">12 ms</p>
            </div>
            <div className="p-3 bg-emerald-50 rounded-lg">
              <Activity className="h-6 w-6 text-emerald-600" />
            </div>
          </div>
          <div className="mt-4 text-sm text-slate-500">
            Stable connection
          </div>
        </div>

        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-slate-500">Current Load</p>
              <p className="text-2xl font-bold text-slate-900 mt-1">450 Mbps</p>
            </div>
            <div className="p-3 bg-blue-50 rounded-lg">
              <Wifi className="h-6 w-6 text-blue-600" />
            </div>
          </div>
          <div className="mt-4 text-sm text-slate-500">
            Peak: 850 Mbps
          </div>
        </div>

        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <div className="flex items-center justify-between">
            <div>
              <p className="text-sm font-medium text-slate-500">Power Status</p>
              <p className="text-2xl font-bold text-slate-900 mt-1">Normal</p>
            </div>
            <div className="p-3 bg-yellow-50 rounded-lg">
              <Zap className="h-6 w-6 text-yellow-600" />
            </div>
          </div>
          <div className="mt-4 text-sm text-slate-500">
            UPS Battery: 100%
          </div>
        </div>
      </div>

      {/* Charts */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <h3 className="text-lg font-semibold text-slate-900 mb-4">Realtime Bandwidth</h3>
          <div className="h-80">
            <ResponsiveContainer width="100%" height="100%">
              <AreaChart data={bandwidthData}>
                <defs>
                  <linearGradient id="colorDownload" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="5%" stopColor="#4f46e5" stopOpacity={0.8}/>
                    <stop offset="95%" stopColor="#4f46e5" stopOpacity={0}/>
                  </linearGradient>
                  <linearGradient id="colorUpload" x1="0" y1="0" x2="0" y2="1">
                    <stop offset="5%" stopColor="#10b981" stopOpacity={0.8}/>
                    <stop offset="95%" stopColor="#10b981" stopOpacity={0}/>
                  </linearGradient>
                </defs>
                <CartesianGrid strokeDasharray="3 3" vertical={false} />
                <XAxis dataKey="time" />
                <YAxis />
                <Tooltip />
                <Area type="monotone" dataKey="download" stroke="#4f46e5" fillOpacity={1} fill="url(#colorDownload)" name="Download (Mbps)" />
                <Area type="monotone" dataKey="upload" stroke="#10b981" fillOpacity={1} fill="url(#colorUpload)" name="Upload (Mbps)" />
              </AreaChart>
            </ResponsiveContainer>
          </div>
        </div>

        <div className="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
          <h3 className="text-lg font-semibold text-slate-900 mb-4">Ping Latency (ms)</h3>
          <div className="h-80">
            <ResponsiveContainer width="100%" height="100%">
              <LineChart data={pingData}>
                <CartesianGrid strokeDasharray="3 3" vertical={false} />
                <XAxis dataKey="time" />
                <YAxis />
                <Tooltip />
                <Line type="monotone" dataKey="latency" stroke="#f59e0b" strokeWidth={2} dot={false} />
              </LineChart>
            </ResponsiveContainer>
          </div>
        </div>
      </div>
    </div>
  );
}

function NetworkMap() {
  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden h-[600px] relative z-0">
      <MapContainer center={[-6.200000, 106.816666]} zoom={13} style={{ height: '100%', width: '100%' }}>
        <TileLayer
          url="https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"
          attribution='&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        />
        {mapLocations.map((loc) => (
          <Marker key={loc.id} position={[loc.lat, loc.lng]}>
            <Popup>
              <div className="p-2">
                <h3 className="font-bold text-sm">{loc.name}</h3>
                <p className="text-xs text-slate-500">{loc.type}</p>
                <span className={`inline-block px-2 py-0.5 rounded-full text-[10px] font-medium mt-1 ${
                  loc.status === 'online' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'
                }`}>
                  {loc.status.toUpperCase()}
                </span>
              </div>
            </Popup>
          </Marker>
        ))}
      </MapContainer>
      
      {/* Legend Overlay */}
      <div className="absolute bottom-4 right-4 bg-white p-3 rounded-lg shadow-md z-[1000] text-xs">
        <h4 className="font-bold mb-2">Legend</h4>
        <div className="space-y-1">
          <div className="flex items-center"><span className="w-3 h-3 rounded-full bg-blue-500 mr-2"></span> HQ / NOC</div>
          <div className="flex items-center"><span className="w-3 h-3 rounded-full bg-indigo-500 mr-2"></span> ODP</div>
          <div className="flex items-center"><span className="w-3 h-3 rounded-full bg-emerald-500 mr-2"></span> Customer</div>
          <div className="flex items-center"><span className="w-3 h-3 rounded-full bg-red-500 mr-2"></span> Offline</div>
        </div>
      </div>
    </div>
  );
}

function DeviceList() {
  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <table className="w-full text-left text-sm text-slate-600">
        <thead className="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
          <tr>
            <th className="px-6 py-4">Device Name</th>
            <th className="px-6 py-4">Type</th>
            <th className="px-6 py-4">IP Address</th>
            <th className="px-6 py-4">Status</th>
            <th className="px-6 py-4">Uptime</th>
            <th className="px-6 py-4">Load</th>
          </tr>
        </thead>
        <tbody className="divide-y divide-slate-200">
          {devices.map((device) => (
            <tr key={device.id} className="hover:bg-slate-50 transition-colors">
              <td className="px-6 py-4 font-medium text-slate-900">{device.name}</td>
              <td className="px-6 py-4">
                <span className="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-slate-100 text-slate-800 border border-slate-200">
                  {device.type}
                </span>
              </td>
              <td className="px-6 py-4 font-mono text-slate-500">{device.ip}</td>
              <td className="px-6 py-4">
                <span className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium capitalize
                  ${device.status === 'online' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'}`}>
                  {device.status}
                </span>
              </td>
              <td className="px-6 py-4">{device.uptime}</td>
              <td className="px-6 py-4">
                <div className="flex items-center space-x-4">
                  <div className="flex items-center" title="CPU Usage">
                    <Cpu className="h-4 w-4 mr-1 text-slate-400" />
                    <span>{device.cpu}%</span>
                  </div>
                  <div className="flex items-center" title="Temperature">
                    <HardDrive className="h-4 w-4 mr-1 text-slate-400" />
                    <span>{device.temp}°C</span>
                  </div>
                </div>
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
}
