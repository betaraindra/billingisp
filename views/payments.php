<!-- Payments View -->
<div x-data="{
    payments: [
        { id: 'TRX-001', customer: 'John Doe', amount: 250000, method: 'Bank Transfer', status: 'verified', date: '2023-10-25 14:30' },
        { id: 'TRX-002', customer: 'Jane Smith', amount: 150000, method: 'Cash', status: 'pending', date: '2023-10-26 09:15' },
        { id: 'TRX-003', customer: 'Bob Wilson', amount: 300000, method: 'Xendit VA', status: 'verified', date: '2023-10-20 11:00' },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Payment History</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Record Manual Payment
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-200 flex justify-between items-center">
            <div class="relative w-64">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input type="text" placeholder="Search transaction..." class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <button class="text-slate-500 hover:text-slate-700">
                <i data-lucide="filter" class="w-4 h-4"></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Transaction ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Method</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <template x-for="payment in payments" :key="payment.id">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-medium text-slate-900" x-text="payment.id"></td>
                            <td class="px-6 py-4 font-medium text-slate-900" x-text="payment.customer"></td>
                            <td class="px-6 py-4 text-xs text-slate-500" x-text="payment.date"></td>
                            <td class="px-6 py-4 text-slate-700" x-text="payment.method"></td>
                            <td class="px-6 py-4 font-bold text-slate-900" x-text="'Rp ' + payment.amount.toLocaleString()"></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium capitalize" 
                                    :class="{
                                        'bg-emerald-100 text-emerald-800': payment.status === 'verified',
                                        'bg-yellow-100 text-yellow-800': payment.status === 'pending',
                                        'bg-red-100 text-red-800': payment.status === 'failed'
                                    }"
                                    x-text="payment.status"></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-slate-600">
                                    <i data-lucide="printer" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
