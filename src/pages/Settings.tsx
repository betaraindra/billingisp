import React, { useState } from 'react';
import { 
  Settings as SettingsIcon, 
  Globe, 
  Image, 
  Router, 
  MessageSquare, 
  CreditCard, 
  Clock, 
  ShieldAlert, 
  BellRing,
  Save
} from 'lucide-react';

export default function Settings() {
  const [activeTab, setActiveTab] = useState<'general' | 'integrations' | 'automation'>('general');

  return (
    <div className="space-y-6">
      <div className="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <h1 className="text-2xl font-bold text-slate-900 flex items-center">
          <SettingsIcon className="mr-2 h-6 w-6 text-indigo-600" />
          System Settings
        </h1>
        
        <div className="flex space-x-2 bg-white p-1 rounded-lg border border-slate-200 shadow-sm">
          <button
            onClick={() => setActiveTab('general')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'general' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            General
          </button>
          <button
            onClick={() => setActiveTab('integrations')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'integrations' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Integrations
          </button>
          <button
            onClick={() => setActiveTab('automation')}
            className={`px-4 py-2 text-sm font-medium rounded-md transition-colors ${
              activeTab === 'automation' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'
            }`}
          >
            Automation
          </button>
        </div>
      </div>

      {activeTab === 'general' && <GeneralSettings />}
      {activeTab === 'integrations' && <IntegrationsSettings />}
      {activeTab === 'automation' && <AutomationSettings />}
    </div>
  );
}

function GeneralSettings() {
  return (
    <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
      <div className="p-6 border-b border-slate-200">
        <h3 className="text-lg font-bold text-slate-900">General Configuration</h3>
        <p className="text-sm text-slate-500">Basic information about your ISP company.</p>
      </div>
      
      <div className="p-6 space-y-6">
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700 flex items-center">
              <Globe className="h-4 w-4 mr-2" />
              ISP Name
            </label>
            <input 
              type="text" 
              defaultValue="My ISP Company" 
              className="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>

          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700 flex items-center">
              <Globe className="h-4 w-4 mr-2" />
              Billing Domain
            </label>
            <div className="flex">
              <span className="inline-flex items-center px-3 rounded-l-lg border border-r-0 border-slate-300 bg-slate-50 text-slate-500 text-sm">
                https://
              </span>
              <input 
                type="text" 
                defaultValue="billing.myisp.com" 
                className="flex-1 px-3 py-2 border border-slate-300 rounded-r-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
              />
            </div>
          </div>

          <div className="space-y-2 md:col-span-2">
            <label className="text-sm font-medium text-slate-700 flex items-center">
              <Image className="h-4 w-4 mr-2" />
              Company Logo
            </label>
            <div className="flex items-center space-x-4">
              <div className="h-16 w-16 bg-slate-100 rounded-lg border border-slate-200 flex items-center justify-center text-slate-400">
                Logo
              </div>
              <button className="px-4 py-2 border border-slate-300 rounded-lg text-sm font-medium text-slate-700 hover:bg-slate-50">
                Upload New Logo
              </button>
            </div>
          </div>
          
          <div className="space-y-2 md:col-span-2">
            <label className="text-sm font-medium text-slate-700">Address</label>
            <textarea 
              rows={3}
              defaultValue="Jl. Teknologi No. 123, Jakarta Selatan"
              className="w-full px-3 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
            />
          </div>
        </div>

        <div className="pt-4 border-t border-slate-200 flex justify-end">
          <button className="flex items-center px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
            <Save className="h-4 w-4 mr-2" />
            Save Changes
          </button>
        </div>
      </div>
    </div>
  );
}

function IntegrationsSettings() {
  return (
    <div className="space-y-6">
      {/* Router API */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200 flex justify-between items-center">
          <div>
            <h3 className="text-lg font-bold text-slate-900 flex items-center">
              <Router className="h-5 w-5 mr-2 text-indigo-600" />
              Router API (MikroTik)
            </h3>
            <p className="text-sm text-slate-500">Connection settings for your main router.</p>
          </div>
          <div className="flex items-center">
            <span className="w-3 h-3 bg-emerald-500 rounded-full mr-2"></span>
            <span className="text-sm font-medium text-emerald-600">Connected</span>
          </div>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">IP Address</label>
            <input type="text" defaultValue="192.168.1.1" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">API Port</label>
            <input type="text" defaultValue="8728" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Username</label>
            <input type="text" defaultValue="admin" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Password</label>
            <input type="password" defaultValue="********" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
        </div>
      </div>

      {/* WhatsApp Gateway */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200">
          <h3 className="text-lg font-bold text-slate-900 flex items-center">
            <MessageSquare className="h-5 w-5 mr-2 text-green-600" />
            WhatsApp Gateway
          </h3>
          <p className="text-sm text-slate-500">Configure WA notifications for billing and alerts.</p>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">API Endpoint</label>
            <input type="text" defaultValue="https://api.whatsapp.com/send" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">API Key / Token</label>
            <input type="password" defaultValue="wa_token_123456" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
        </div>
      </div>

      {/* Payment Gateway */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200">
          <h3 className="text-lg font-bold text-slate-900 flex items-center">
            <CreditCard className="h-5 w-5 mr-2 text-blue-600" />
            Payment Gateway (Midtrans/Xendit)
          </h3>
          <p className="text-sm text-slate-500">Accept automated payments via VA, QRIS, etc.</p>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Server Key</label>
            <input type="password" defaultValue="SB-Mid-server-xxxx" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Client Key</label>
            <input type="text" defaultValue="SB-Mid-client-xxxx" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="flex items-center space-x-2">
            <input type="checkbox" id="sandbox" defaultChecked className="rounded text-indigo-600 focus:ring-indigo-500" />
            <label htmlFor="sandbox" className="text-sm text-slate-700">Sandbox Mode (Testing)</label>
          </div>
        </div>
      </div>
      
      <div className="flex justify-end">
        <button className="flex items-center px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
          <Save className="h-4 w-4 mr-2" />
          Save All Integrations
        </button>
      </div>
    </div>
  );
}

function AutomationSettings() {
  return (
    <div className="space-y-6">
      {/* Auto Invoice */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200 flex justify-between items-center">
          <div>
            <h3 className="text-lg font-bold text-slate-900 flex items-center">
              <Clock className="h-5 w-5 mr-2 text-indigo-600" />
              Automatic Invoicing
            </h3>
            <p className="text-sm text-slate-500">Automatically generate monthly invoices for active customers.</p>
          </div>
          <div className="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle-invoice" className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 checked:border-indigo-600" defaultChecked/>
            <label htmlFor="toggle-invoice" className="toggle-label block overflow-hidden h-6 rounded-full bg-indigo-600 cursor-pointer"></label>
          </div>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Generation Date</label>
            <select className="w-full px-3 py-2 border border-slate-300 rounded-lg">
              <option value="1">1st of every month</option>
              <option value="5">5th of every month</option>
              <option value="10">10th of every month</option>
              <option value="25">25th of every month</option>
            </select>
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Due Date (Days after generation)</label>
            <input type="number" defaultValue="7" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
        </div>
      </div>

      {/* Auto Isolate */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200 flex justify-between items-center">
          <div>
            <h3 className="text-lg font-bold text-slate-900 flex items-center">
              <ShieldAlert className="h-5 w-5 mr-2 text-red-600" />
              Auto Isolation (Suspend)
            </h3>
            <p className="text-sm text-slate-500">Automatically suspend services for overdue invoices.</p>
          </div>
          <div className="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle-isolate" className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 checked:border-indigo-600" defaultChecked/>
            <label htmlFor="toggle-isolate" className="toggle-label block overflow-hidden h-6 rounded-full bg-indigo-600 cursor-pointer"></label>
          </div>
        </div>
        <div className="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Grace Period (Days after due date)</label>
            <input type="number" defaultValue="3" className="w-full px-3 py-2 border border-slate-300 rounded-lg" />
          </div>
          <div className="space-y-2">
            <label className="text-sm font-medium text-slate-700">Action</label>
            <select className="w-full px-3 py-2 border border-slate-300 rounded-lg">
              <option value="disable">Disable Internet Access</option>
              <option value="redirect">Redirect to Payment Page</option>
              <option value="throttle">Throttle Speed (128kbps)</option>
            </select>
          </div>
        </div>
      </div>

      {/* Payment Reminder */}
      <div className="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div className="p-6 border-b border-slate-200 flex justify-between items-center">
          <div>
            <h3 className="text-lg font-bold text-slate-900 flex items-center">
              <BellRing className="h-5 w-5 mr-2 text-yellow-600" />
              Payment Reminders
            </h3>
            <p className="text-sm text-slate-500">Send WhatsApp reminders before and after due date.</p>
          </div>
          <div className="relative inline-block w-12 mr-2 align-middle select-none transition duration-200 ease-in">
            <input type="checkbox" name="toggle" id="toggle-reminder" className="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer checked:right-0 checked:border-indigo-600" defaultChecked/>
            <label htmlFor="toggle-reminder" className="toggle-label block overflow-hidden h-6 rounded-full bg-indigo-600 cursor-pointer"></label>
          </div>
        </div>
        <div className="p-6 space-y-4">
          <div className="flex items-center space-x-2">
            <input type="checkbox" defaultChecked className="rounded text-indigo-600" />
            <span className="text-sm text-slate-700">Send reminder 3 days before due date</span>
          </div>
          <div className="flex items-center space-x-2">
            <input type="checkbox" defaultChecked className="rounded text-indigo-600" />
            <span className="text-sm text-slate-700">Send reminder 1 day before due date</span>
          </div>
          <div className="flex items-center space-x-2">
            <input type="checkbox" defaultChecked className="rounded text-indigo-600" />
            <span className="text-sm text-slate-700">Send reminder on due date</span>
          </div>
          <div className="flex items-center space-x-2">
            <input type="checkbox" defaultChecked className="rounded text-indigo-600" />
            <span className="text-sm text-slate-700">Send daily reminder after due date (until suspended)</span>
          </div>
        </div>
      </div>

      <div className="flex justify-end">
        <button className="flex items-center px-6 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium">
          <Save className="h-4 w-4 mr-2" />
          Save Automation Settings
        </button>
      </div>
    </div>
  );
}
