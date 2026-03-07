<!-- Reports View -->
<div x-data="{
    reports: [
        { id: 1, type: 'Income', amount: 45000000, date: '2023-10-01' },
        { id: 2, type: 'Expense', amount: 12000000, date: '2023-10-05' },
        { id: 3, type: 'Income', amount: 32000000, date: '2023-10-10' },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Financial Reports</h1>
        <div class="flex space-x-2">
            <button class="bg-white border border-slate-200 text-slate-600 px-4 py-2 rounded-lg hover:bg-slate-50 flex items-center">
                <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                Export CSV
            </button>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
                <i data-lucide="calendar" class="w-4 h-4 mr-2"></i>
                Filter Date
            </button>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-slate-500">Total Income</h3>
                <div class="p-2 bg-emerald-50 rounded-lg text-emerald-600">
                    <i data-lucide="trending-up" class="w-5 h-5"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Rp 77.0M</h2>
            <p class="text-xs text-emerald-600 mt-1">+12% from last month</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-slate-500">Total Expenses</h3>
                <div class="p-2 bg-red-50 rounded-lg text-red-600">
                    <i data-lucide="trending-down" class="w-5 h-5"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Rp 12.0M</h2>
            <p class="text-xs text-red-600 mt-1">+5% from last month</p>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-sm font-medium text-slate-500">Net Profit</h3>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-600">
                    <i data-lucide="dollar-sign" class="w-5 h-5"></i>
                </div>
            </div>
            <h2 class="text-2xl font-bold text-slate-900">Rp 65.0M</h2>
            <p class="text-xs text-blue-600 mt-1">Healthy margin</p>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-200">
            <h3 class="font-bold text-slate-900">Transaction History</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Type</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <template x-for="report in reports" :key="report.id">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 text-slate-900" x-text="report.date"></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium capitalize" 
                                    :class="report.type === 'Income' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'"
                                    x-text="report.type"></span>
                            </td>
                            <td class="px-6 py-4 text-slate-500">Monthly Subscription Payment</td>
                            <td class="px-6 py-4 text-right font-medium" 
                                :class="report.type === 'Income' ? 'text-emerald-600' : 'text-red-600'"
                                x-text="(report.type === 'Income' ? '+' : '-') + ' Rp ' + report.amount.toLocaleString()"></td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
