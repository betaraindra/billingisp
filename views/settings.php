<!-- Settings View -->
<div x-data="{
    activeTab: 'general',
    settings: {
        company_name: 'My ISP',
        currency: 'Rp',
        timezone: 'Asia/Jakarta',
        mikrotik_ip: '192.168.1.1',
        mikrotik_user: 'admin',
        mikrotik_pass: 'password'
    }
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">System Settings</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="save" class="w-4 h-4 mr-2"></i>
            Save Changes
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden flex flex-col md:flex-row">
        <!-- Sidebar Settings -->
        <div class="w-full md:w-64 bg-slate-50 border-r border-slate-200 p-4">
            <nav class="space-y-1">
                <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'bg-white shadow text-indigo-600' : 'text-slate-600 hover:bg-slate-100'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                    <i data-lucide="settings" class="w-4 h-4 mr-3"></i>
                    General
                </button>
                <button @click="activeTab = 'mikrotik'" :class="activeTab === 'mikrotik' ? 'bg-white shadow text-indigo-600' : 'text-slate-600 hover:bg-slate-100'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                    <i data-lucide="router" class="w-4 h-4 mr-3"></i>
                    Mikrotik API
                </button>
                <button @click="activeTab = 'payment'" :class="activeTab === 'payment' ? 'bg-white shadow text-indigo-600' : 'text-slate-600 hover:bg-slate-100'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                    <i data-lucide="credit-card" class="w-4 h-4 mr-3"></i>
                    Payment Gateways
                </button>
                <button @click="activeTab = 'notifications'" :class="activeTab === 'notifications' ? 'bg-white shadow text-indigo-600' : 'text-slate-600 hover:bg-slate-100'" class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-md transition-colors">
                    <i data-lucide="bell" class="w-4 h-4 mr-3"></i>
                    Notifications
                </button>
            </nav>
        </div>

        <!-- Content Settings -->
        <div class="flex-1 p-6">
            <!-- General Tab -->
            <div x-show="activeTab === 'general'" class="space-y-6">
                <h3 class="text-lg font-medium text-slate-900 border-b pb-2">General Configuration</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Company Name</label>
                        <input type="text" x-model="settings.company_name" class="w-full max-w-md px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Currency Symbol</label>
                        <input type="text" x-model="settings.currency" class="w-full max-w-xs px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Timezone</label>
                        <select x-model="settings.timezone" class="w-full max-w-xs px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option>Asia/Jakarta</option>
                            <option>Asia/Makassar</option>
                            <option>Asia/Jayapura</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Mikrotik Tab -->
            <div x-show="activeTab === 'mikrotik'" class="space-y-6" style="display: none;">
                <h3 class="text-lg font-medium text-slate-900 border-b pb-2">Mikrotik API Connection</h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Router IP Address</label>
                        <input type="text" x-model="settings.mikrotik_ip" class="w-full max-w-md px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">API Username</label>
                        <input type="text" x-model="settings.mikrotik_user" class="w-full max-w-md px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">API Password</label>
                        <input type="password" x-model="settings.mikrotik_pass" class="w-full max-w-md px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                    <div>
                        <button class="bg-emerald-600 text-white px-4 py-2 rounded-md hover:bg-emerald-700 text-sm">Test Connection</button>
                    </div>
                </div>
            </div>

            <!-- Payment Tab -->
            <div x-show="activeTab === 'payment'" class="space-y-6" style="display: none;">
                <h3 class="text-lg font-medium text-slate-900 border-b pb-2">Payment Gateways</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 mr-4">
                                <i data-lucide="credit-card" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-slate-900">Xendit / Midtrans</h4>
                                <p class="text-xs text-slate-500">Accept automated payments via VA, E-Wallet</p>
                            </div>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Configure</button>
                    </div>
                    <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg">
                        <div class="flex items-center">
                            <div class="h-10 w-10 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 mr-4">
                                <i data-lucide="banknote" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="text-sm font-medium text-slate-900">Manual Bank Transfer</h4>
                                <p class="text-xs text-slate-500">Customers upload proof of payment manually</p>
                            </div>
                        </div>
                        <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Configure</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
