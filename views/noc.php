<!-- NOC / Monitoring View -->
<div x-data="{
    logs: [
        { id: 1, time: '10:45:23', level: 'info', message: 'User john_doe connected (PPPoE)', router: 'Main Gateway' },
        { id: 2, time: '10:42:10', level: 'warning', message: 'High CPU Usage (85%)', router: 'Distribution OLT' },
        { id: 3, time: '10:30:05', level: 'error', message: 'Interface ether2 link down', router: 'Main Gateway' },
        { id: 4, time: '10:15:00', level: 'info', message: 'System backup created', router: 'System' },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">NOC & Monitoring</h1>
        <div class="flex space-x-2">
            <button class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-lg hover:bg-slate-50 flex items-center">
                <i data-lucide="refresh-cw" class="w-4 h-4 mr-2"></i>
                Refresh
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Live Traffic Graph Placeholder -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-900 mb-4">Live Traffic (Main Gateway)</h3>
            <div class="h-64 bg-slate-50 rounded-lg flex items-center justify-center border border-dashed border-slate-300">
                <p class="text-slate-400">Traffic Graph Visualization</p>
            </div>
        </div>

        <!-- System Health -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-900 mb-4">System Health</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-600">CPU Load</span>
                        <span class="font-medium text-slate-900">12%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: 12%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-600">Memory Usage</span>
                        <span class="font-medium text-slate-900">45%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="text-slate-600">Disk Space</span>
                        <span class="font-medium text-slate-900">28%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-indigo-500 h-2 rounded-full" style="width: 28%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logs -->
    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-200 bg-slate-900 text-white flex justify-between items-center">
            <h3 class="font-mono text-sm">System Logs</h3>
            <span class="text-xs text-slate-400">Live Stream</span>
        </div>
        <div class="p-0">
            <table class="w-full text-left text-sm font-mono">
                <tbody class="divide-y divide-slate-100">
                    <template x-for="log in logs" :key="log.id">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-4 py-2 text-slate-400 w-24" x-text="log.time"></td>
                            <td class="px-4 py-2 w-24">
                                <span class="px-2 py-0.5 rounded text-xs font-bold uppercase" 
                                    :class="{
                                        'bg-blue-100 text-blue-700': log.level === 'info',
                                        'bg-yellow-100 text-yellow-700': log.level === 'warning',
                                        'bg-red-100 text-red-700': log.level === 'error'
                                    }"
                                    x-text="log.level"></span>
                            </td>
                            <td class="px-4 py-2 text-slate-700" x-text="log.message"></td>
                            <td class="px-4 py-2 text-slate-400 text-right" x-text="log.router"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
