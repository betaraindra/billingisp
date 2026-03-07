<!-- Billing View -->
<div x-data="{
    invoices: [
        { id: 'INV-001', customer: 'John Doe', amount: 250000, status: 'paid', date: '2023-10-25' },
        { id: 'INV-002', customer: 'Jane Smith', amount: 150000, status: 'unpaid', date: '2023-10-26' },
        { id: 'INV-003', customer: 'Bob Wilson', amount: 300000, status: 'overdue', date: '2023-10-20' },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Billing & Invoices</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Create Invoice
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-200 flex justify-between items-center">
            <div class="flex space-x-2">
                <button class="px-4 py-2 text-sm font-medium rounded-md bg-indigo-600 text-white">All</button>
                <button class="px-4 py-2 text-sm font-medium rounded-md text-slate-600 hover:bg-slate-50">Unpaid</button>
                <button class="px-4 py-2 text-sm font-medium rounded-md text-slate-600 hover:bg-slate-50">Paid</button>
            </div>
            <button class="text-slate-500 hover:text-slate-700">
                <i data-lucide="filter" class="w-4 h-4"></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Invoice ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <template x-for="invoice in invoices" :key="invoice.id">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-medium text-slate-900" x-text="invoice.id"></td>
                            <td class="px-6 py-4 font-medium text-slate-900" x-text="invoice.customer"></td>
                            <td class="px-6 py-4 text-xs text-slate-500" x-text="invoice.date"></td>
                            <td class="px-6 py-4 font-bold text-slate-900" x-text="'Rp ' + invoice.amount.toLocaleString()"></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium capitalize" 
                                    :class="{
                                        'bg-emerald-100 text-emerald-800': invoice.status === 'paid',
                                        'bg-yellow-100 text-yellow-800': invoice.status === 'unpaid',
                                        'bg-red-100 text-red-800': invoice.status === 'overdue'
                                    }"
                                    x-text="invoice.status"></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-slate-400 hover:text-slate-600">
                                    <i data-lucide="more-vertical" class="w-4 h-4"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
