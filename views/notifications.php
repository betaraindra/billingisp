<!-- Notifications View -->
<div x-data="{
    notifications: [
        { id: 1, title: 'New Payment Received', message: 'John Doe paid Rp 250,000', time: '10:00', read: false },
        { id: 2, title: 'System Alert', message: 'High CPU Usage on Main Gateway', time: '09:45', read: true },
        { id: 3, title: 'New Ticket', message: 'Customer Jane Smith reported slow internet', time: '09:30', read: true },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Notifications</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="check-circle" class="w-4 h-4 mr-2"></i>
            Mark All as Read
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="divide-y divide-slate-100">
            <template x-for="notification in notifications" :key="notification.id">
                <div class="p-4 hover:bg-slate-50 transition-colors cursor-pointer flex items-start" :class="notification.read ? 'opacity-75' : 'bg-blue-50'">
                    <div class="w-2 h-2 mt-2 rounded-full mr-4 flex-shrink-0" :class="notification.read ? 'bg-slate-300' : 'bg-blue-600'"></div>
                    <div class="flex-1">
                        <div class="flex justify-between items-baseline mb-1">
                            <h4 class="font-medium text-slate-900" x-text="notification.title"></h4>
                            <span class="text-xs text-slate-500" x-text="notification.time"></span>
                        </div>
                        <p class="text-sm text-slate-600" x-text="notification.message"></p>
                    </div>
                </div>
            </template>
        </div>
        <div class="p-4 border-t border-slate-200 text-center">
            <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View All History</button>
        </div>
    </div>
</div>
