<!-- Tools View -->
<div x-data="{
    pingResult: '',
    tracerouteResult: '',
    speedtestResult: '',
    target: '8.8.8.8'
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Network Tools</h1>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Ping Tool -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-900 mb-4 flex items-center">
                <i data-lucide="activity" class="w-5 h-5 mr-2 text-indigo-600"></i>
                Ping
            </h3>
            <div class="flex space-x-2 mb-4">
                <input type="text" x-model="target" class="flex-1 px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="IP Address or Domain">
                <button @click="pingResult = 'Pinging ' + target + '...\nReply from ' + target + ': bytes=32 time=12ms TTL=54\nReply from ' + target + ': bytes=32 time=14ms TTL=54\nReply from ' + target + ': bytes=32 time=11ms TTL=54\nReply from ' + target + ': bytes=32 time=13ms TTL=54'" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">Ping</button>
            </div>
            <div class="bg-slate-900 text-slate-300 p-4 rounded-lg font-mono text-xs h-40 overflow-y-auto">
                <pre x-text="pingResult || 'Ready...'"></pre>
            </div>
        </div>

        <!-- Traceroute Tool -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-900 mb-4 flex items-center">
                <i data-lucide="route" class="w-5 h-5 mr-2 text-indigo-600"></i>
                Traceroute
            </h3>
            <div class="flex space-x-2 mb-4">
                <input type="text" x-model="target" class="flex-1 px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="IP Address or Domain">
                <button @click="tracerouteResult = 'Tracing route to ' + target + '...\n1  192.168.1.1  1 ms  1 ms  1 ms\n2  10.10.10.1  2 ms  3 ms  2 ms\n3  202.134.1.1  15 ms  14 ms  16 ms'" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 text-sm">Trace</button>
            </div>
            <div class="bg-slate-900 text-slate-300 p-4 rounded-lg font-mono text-xs h-40 overflow-y-auto">
                <pre x-text="tracerouteResult || 'Ready...'"></pre>
            </div>
        </div>
    </div>
</div>
