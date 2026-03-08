<!-- Billing View -->
<div x-data="{
    invoices: [
        { id: 'INV-001', customer: 'John Doe', amount: 250000, status: 'paid', date: '2023-10-25' },
        { id: 'INV-002', customer: 'Jane Smith', amount: 150000, status: 'unpaid', date: '2023-10-26' },
        { id: 'INV-003', customer: 'Bob Wilson', amount: 300000, status: 'overdue', date: '2023-10-20' },
    ],
    filter: 'all',
    showModal: false,
    newInvoice: { customer: '', amount: 0, date: '' },
    createInvoice() {
        // Mock create invoice
        this.invoices.unshift({
            id: 'INV-' + (this.invoices.length + 1).toString().padStart(3, '0'),
            customer: this.newInvoice.customer,
            amount: parseInt(this.newInvoice.amount),
            status: 'unpaid',
            date: this.newInvoice.date
        });
        this.showModal = false;
        this.newInvoice = { customer: '', amount: 0, date: '' };
    }
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Billing & Invoices</h1>
        <button @click="showModal = true" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Create Invoice
        </button>
    </div>

    <!-- Create Invoice Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Create New Invoice</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Customer Name</label>
                            <input x-model="newInvoice.customer" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Amount (Rp)</label>
                            <input x-model="newInvoice.amount" type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Due Date</label>
                            <input x-model="newInvoice.date" type="date" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="createInvoice()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Create
                    </button>
                    <button @click="showModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-4 border-b border-slate-200 flex justify-between items-center">
            <div class="flex space-x-2">
                <button @click="filter = 'all'" :class="filter === 'all' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'" class="px-4 py-2 text-sm font-medium rounded-md">All</button>
                <button @click="filter = 'unpaid'" :class="filter === 'unpaid' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'" class="px-4 py-2 text-sm font-medium rounded-md">Unpaid</button>
                <button @click="filter = 'paid'" :class="filter === 'paid' ? 'bg-indigo-600 text-white' : 'text-slate-600 hover:bg-slate-50'" class="px-4 py-2 text-sm font-medium rounded-md">Paid</button>
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
                    <template x-for="invoice in invoices.filter(i => filter === 'all' || i.status === filter)" :key="invoice.id">
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
