import React, { useEffect, useState } from 'react';
import { Wifi, Edit2, Trash2, Plus } from 'lucide-react';

interface Package {
  id: number;
  name: string;
  speed: string;
  price: number;
  bandwidth_limit: string;
  description: string;
}

export default function Services() {
  const [packages, setPackages] = useState<Package[]>([]);

  useEffect(() => {
    fetch('/api/packages')
      .then(res => res.json())
      .then(data => setPackages(data))
      .catch(err => console.error('Failed to fetch packages:', err));
  }, []);

  return (
    <div className="space-y-6">
      <div className="flex items-center justify-between">
        <h1 className="text-2xl font-bold text-slate-900">Internet Packages</h1>
        <button className="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors">
          <Plus className="h-4 w-4 mr-2" />
          Add Package
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {packages.map((pkg) => (
          <div key={pkg.id} className="bg-white rounded-xl shadow-sm border border-slate-200 p-6 hover:shadow-md transition-shadow">
            <div className="flex items-center justify-between mb-4">
              <div className="p-3 bg-indigo-50 rounded-lg text-indigo-600">
                <Wifi className="h-6 w-6" />
              </div>
              <div className="flex space-x-2">
                <button className="p-2 text-slate-400 hover:text-indigo-600 rounded-full hover:bg-indigo-50">
                  <Edit2 className="h-4 w-4" />
                </button>
                <button className="p-2 text-slate-400 hover:text-red-600 rounded-full hover:bg-red-50">
                  <Trash2 className="h-4 w-4" />
                </button>
              </div>
            </div>
            
            <h3 className="text-lg font-bold text-slate-900">{pkg.name}</h3>
            <div className="mt-2 flex items-baseline text-slate-900">
              <span className="text-3xl font-bold tracking-tight">Rp {pkg.price.toLocaleString('id-ID')}</span>
              <span className="ml-1 text-sm font-semibold text-slate-500">/month</span>
            </div>
            
            <ul className="mt-6 space-y-4">
              <li className="flex items-center text-sm text-slate-600">
                <span className="w-2 h-2 bg-emerald-500 rounded-full mr-3" />
                Speed up to {pkg.speed}
              </li>
              <li className="flex items-center text-sm text-slate-600">
                <span className="w-2 h-2 bg-emerald-500 rounded-full mr-3" />
                {pkg.bandwidth_limit} Quota
              </li>
              <li className="flex items-center text-sm text-slate-600">
                <span className="w-2 h-2 bg-emerald-500 rounded-full mr-3" />
                24/7 Support
              </li>
            </ul>
          </div>
        ))}
      </div>
    </div>
  );
}
