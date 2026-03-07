<!-- Dashboard View -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stat Card 1 -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-slate-500">Total Revenue</h3>
            <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                <i data-lucide="dollar-sign" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-2xl font-bold text-slate-900">Rp 45.2M</h2>
            <span class="ml-2 text-sm font-medium text-emerald-600">+12.5%</span>
        </div>
    </div>

    <!-- Stat Card 2 -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-slate-500">Active Customers</h3>
            <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                <i data-lucide="users" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-2xl font-bold text-slate-900">1,245</h2>
            <span class="ml-2 text-sm font-medium text-blue-600">+4.2%</span>
        </div>
    </div>

    <!-- Stat Card 3 -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-slate-500">Network Uptime</h3>
            <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                <i data-lucide="activity" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-2xl font-bold text-slate-900">99.9%</h2>
            <span class="ml-2 text-sm font-medium text-indigo-600">Stable</span>
        </div>
    </div>

    <!-- Stat Card 4 -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-medium text-slate-500">Pending Tickets</h3>
            <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                <i data-lucide="alert-circle" class="w-5 h-5"></i>
            </div>
        </div>
        <div class="flex items-baseline">
            <h2 class="text-2xl font-bold text-slate-900">12</h2>
            <span class="ml-2 text-sm font-medium text-orange-600">-2</span>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Recent Activity -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Recent Activity</h3>
        <div class="space-y-4">
            <div class="flex items-start space-x-3 pb-4 border-b border-slate-100 last:border-0">
                <div class="w-2 h-2 mt-2 rounded-full bg-emerald-500"></div>
                <div>
                    <p class="text-sm font-medium text-slate-900">New customer registration</p>
                    <p class="text-xs text-slate-500">John Doe - 2 mins ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 pb-4 border-b border-slate-100 last:border-0">
                <div class="w-2 h-2 mt-2 rounded-full bg-blue-500"></div>
                <div>
                    <p class="text-sm font-medium text-slate-900">Payment received</p>
                    <p class="text-xs text-slate-500">Invoice #INV-2024-001 - 1 hour ago</p>
                </div>
            </div>
            <div class="flex items-start space-x-3 pb-4 border-b border-slate-100 last:border-0">
                <div class="w-2 h-2 mt-2 rounded-full bg-orange-500"></div>
                <div>
                    <p class="text-sm font-medium text-slate-900">Ticket created</p>
                    <p class="text-xs text-slate-500">Slow connection report - 3 hours ago</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Network Status -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-6">
        <h3 class="text-lg font-bold text-slate-900 mb-4">Network Status</h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-emerald-100 rounded text-emerald-600">
                        <i data-lucide="server" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Main Gateway</p>
                        <p class="text-xs text-slate-500">192.168.1.1</p>
                    </div>
                </div>
                <span class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Online</span>
            </div>
            <div class="flex items-center justify-between p-3 bg-slate-50 rounded-lg">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-emerald-100 rounded text-emerald-600">
                        <i data-lucide="wifi" class="w-4 h-4"></i>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-900">Distribution OLT</p>
                        <p class="text-xs text-slate-500">192.168.1.2</p>
                    </div>
                </div>
                <span class="px-2 py-1 text-xs font-medium bg-emerald-100 text-emerald-800 rounded-full">Online</span>
            </div>
        </div>
    </div>
</div>
