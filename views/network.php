<!-- Network View -->
<div x-data="{
    routers: [
        { id: 1, name: 'Main Gateway', ip: '192.168.1.1', model: 'RB4011', status: 'online', cpu: 15, uptime: '15d 2h' },
        { id: 2, name: 'Distribution OLT', ip: '192.168.1.2', model: 'ZTE C320', status: 'online', cpu: 45, uptime: '30d 5h' },
        { id: 3, name: 'Backup Router', ip: '192.168.1.3', model: 'RB750Gr3', status: 'offline', cpu: 0, uptime: '0d 0h' },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Network Management</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add Router
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="router in routers" :key="router.id">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg mr-3" :class="router.status === 'online' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600'">
                                <i data-lucide="server" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900" x-text="router.name"></h3>
                                <p class="text-sm text-slate-500" x-text="router.ip"></p>
                            </div>
                        </div>
                        <div class="relative group">
                            <button class="text-slate-400 hover:text-slate-600">
                                <i data-lucide="more-vertical" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <p class="text-xs text-slate-500 mb-1">Model</p>
                            <p class="font-medium text-slate-900" x-text="router.model"></p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <p class="text-xs text-slate-500 mb-1">Uptime</p>
                            <p class="font-medium text-slate-900" x-text="router.uptime"></p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center text-slate-600">
                            <i data-lucide="activity" class="w-4 h-4 mr-1"></i>
                            CPU Load: <span x-text="router.cpu + '%'"></span>
                        </div>
                        <span class="px-2 py-1 rounded text-xs font-medium capitalize" 
                            :class="router.status === 'online' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'"
                            x-text="router.status"></span>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3 border-t border-slate-200 flex justify-between items-center">
                    <span class="text-xs text-slate-500">Last check: 2 mins ago</span>
                    <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View Details</button>
                </div>
            </div>
        </template>
    </div>
</div>
