<!-- Tickets View -->
<div x-data="{
    tickets: [],
    loading: true,
    showModal: false,
    newTicket: { customer_id: '', subject: '', message: '', priority: 'medium' },
    customers: [], // Should be fetched from API
    async fetchTickets() {
        this.loading = true;
        try {
            const res = await fetch('api/tickets.php');
            this.tickets = await res.json();
            
            // Also fetch customers for the dropdown
            const custRes = await fetch('api/customers.php'); // Assuming this exists or mocked
            // Mock customers if API fails
            this.customers = [
                { id: 1, name: 'John Doe' },
                { id: 2, name: 'Jane Smith' }
            ];
        } catch (e) {
            console.error(e);
        } finally {
            this.loading = false;
        }
    },
    async saveTicket() {
        try {
            const res = await fetch('api/tickets.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.newTicket)
            });
            const data = await res.json();
            if (res.ok) {
                alert(data.message);
                this.showModal = false;
                this.newTicket = { customer_id: '', subject: '', message: '', priority: 'medium' };
                this.fetchTickets();
            } else {
                alert('Error: ' + data.message);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }
}" x-init="fetchTickets()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Support Tickets</h1>
        <button @click="showModal = true" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            New Ticket
        </button>
    </div>

    <!-- New Ticket Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Create Support Ticket</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Customer</label>
                            <select x-model="newTicket.customer_id" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Select Customer</option>
                                <template x-for="cust in customers" :key="cust.id">
                                    <option :value="cust.id" x-text="cust.name"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Subject</label>
                            <input x-model="newTicket.subject" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Priority</label>
                            <select x-model="newTicket.priority" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="low">Low</option>
                                <option value="medium">Medium</option>
                                <option value="high">High</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Message</label>
                            <textarea x-model="newTicket.message" rows="4" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="saveTicket()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Create Ticket
                    </button>
                    <button @click="showModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Ticket ID</th>
                        <th class="px-6 py-4">Customer</th>
                        <th class="px-6 py-4">Subject</th>
                        <th class="px-6 py-4">Priority</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <template x-if="loading">
                        <tr><td colspan="7" class="px-6 py-4 text-center">Loading...</td></tr>
                    </template>
                    <template x-for="ticket in tickets" :key="ticket.id">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs font-medium text-slate-900" x-text="ticket.ticket_number"></td>
                            <td class="px-6 py-4 font-medium text-slate-900" x-text="ticket.customer_name"></td>
                            <td class="px-6 py-4" x-text="ticket.subject"></td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-medium capitalize" 
                                    :class="{
                                        'bg-red-100 text-red-800': ticket.priority === 'high',
                                        'bg-yellow-100 text-yellow-800': ticket.priority === 'medium',
                                        'bg-blue-100 text-blue-800': ticket.priority === 'low'
                                    }"
                                    x-text="ticket.priority"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium capitalize" 
                                    :class="{
                                        'bg-emerald-100 text-emerald-800': ticket.status === 'closed',
                                        'bg-blue-100 text-blue-800': ticket.status === 'answered',
                                        'bg-slate-100 text-slate-800': ticket.status === 'open'
                                    }"
                                    x-text="ticket.status"></span>
                            </td>
                            <td class="px-6 py-4 text-xs text-slate-500" x-text="ticket.created_at"></td>
                            <td class="px-6 py-4 text-right">
                                <button class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">View</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</div>
