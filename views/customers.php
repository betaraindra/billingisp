<!-- Customers View -->
<div x-data="{ 
    customers: [], 
    services: [],
    search: '',
    loading: true,
    showModal: false,
    newCustomer: { fullname: '', email: '', phone: '', service_plan: '', bill_date: 1, address: '' },
    async fetchCustomers() {
        this.loading = true;
        // Mock fetch for now, replace with actual API call
        // const res = await fetch('api/customers.php');
        // this.customers = await res.json();
        
        // Mock Data
        setTimeout(() => {
            this.customers = [
                { id: 1, name: 'John Doe', email: 'john@example.com', phone: '628123456789', package: 'Home 20Mbps', bill_date: 1, status: 'active' },
                { id: 2, name: 'Jane Smith', email: 'jane@example.com', phone: '628123456788', package: 'Home 50Mbps', bill_date: 5, status: 'active' },
                { id: 3, name: 'Bob Wilson', email: 'bob@example.com', phone: '628123456787', package: 'Gamer 100Mbps', bill_date: 10, status: 'inactive' },
            ];
            this.loading = false;
        }, 500);
    },
    async fetchServices() {
        try {
            const res = await fetch('api/services.php');
            this.services = await res.json();
        } catch (e) {
            console.error('Failed to fetch services', e);
            // Fallback mock
            this.services = [
                { name: 'Home 20Mbps' },
                { name: 'Home 50Mbps' },
                { name: 'Gamer 100Mbps' }
            ];
        }
    },
    get filteredCustomers() {
        return this.customers.filter(c => c.name.toLowerCase().includes(this.search.toLowerCase()));
    },
    saveCustomer() {
        // Here you would send this.newCustomer to the API
        console.log('Saving customer:', this.newCustomer);
        // Mock adding to list
        this.customers.push({
            id: this.customers.length + 1,
            name: this.newCustomer.fullname,
            email: this.newCustomer.email,
            phone: this.newCustomer.phone,
            package: this.newCustomer.service_plan,
            bill_date: this.newCustomer.bill_date,
            status: 'active'
        });
        this.showModal = false;
        this.newCustomer = { fullname: '', email: '', phone: '', service_plan: '', bill_date: 1, address: '' };
    },
    async sendBill(customer) {
        if(!confirm('Send WhatsApp bill to ' + customer.name + '?')) return;
        
        try {
            const res = await fetch('api/whatsapp.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ 
                    phone: customer.phone, 
                    message: `Dear ${customer.name}, your bill for ${customer.package} is due on date ${customer.bill_date}.` 
                })
            });
            const data = await res.json();
            alert(data.message);
        } catch (e) {
            alert('Failed to send bill: ' + e.message);
        }
    }
}" x-init="fetchCustomers(); fetchServices();">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Customer Management</h1>
        <button @click="showModal = true" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add Customer
        </button>
    </div>

    <!-- Add Customer Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Add New Customer</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input x-model="newCustomer.fullname" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Email</label>
                            <input x-model="newCustomer.email" type="email" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Phone (WhatsApp)</label>
                            <input x-model="newCustomer.phone" type="text" placeholder="628..." class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Service Plan</label>
                            <select x-model="newCustomer.service_plan" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option value="">Select Plan</option>
                                <template x-for="service in services" :key="service.name">
                                    <option :value="service.name" x-text="service.name"></option>
                                </template>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Bill Date (Day of Month)</label>
                            <input x-model="newCustomer.bill_date" type="number" min="1" max="31" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Address</label>
                            <textarea x-model="newCustomer.address" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="saveCustomer()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
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
            <div class="relative w-64">
                <i data-lucide="search" class="absolute left-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                <input x-model="search" type="text" placeholder="Search customers..." class="w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 outline-none">
            </div>
            <button class="text-slate-500 hover:text-slate-700">
                <i data-lucide="filter" class="w-4 h-4"></i>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                    <tr>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Package</th>
                        <th class="px-6 py-4">Bill Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <template x-if="loading">
                        <tr><td colspan="5" class="px-6 py-4 text-center">Loading...</td></tr>
                    </template>
                    
                    <template x-for="customer in filteredCustomers" :key="customer.id">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3" x-text="customer.name.charAt(0)"></div>
                                    <div>
                                        <div class="font-medium text-slate-900" x-text="customer.name"></div>
                                        <div class="text-xs text-slate-500" x-text="customer.email"></div>
                                        <div class="text-xs text-slate-400" x-text="customer.phone"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-medium bg-slate-100 text-slate-800" x-text="customer.package"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="text-slate-700" x-text="'Every ' + customer.bill_date"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium capitalize" 
                                    :class="customer.status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'"
                                    x-text="customer.status"></span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <button @click="sendBill(customer)" class="text-green-600 hover:text-green-800 mr-2" title="Send WhatsApp Bill">
                                    <i data-lucide="message-circle" class="w-4 h-4"></i>
                                </button>
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
