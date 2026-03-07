<!-- Customers View -->
<div x-data="{ 
    customers: [], 
    search: '',
    loading: true,
    async fetchCustomers() {
        this.loading = true;
        // Mock fetch for now, replace with actual API call
        // const res = await fetch('api/customers.php');
        // this.customers = await res.json();
        
        // Mock Data
        setTimeout(() => {
            this.customers = [
                { id: 1, name: 'John Doe', email: 'john@example.com', package: 'Home 20Mbps', status: 'active' },
                { id: 2, name: 'Jane Smith', email: 'jane@example.com', package: 'Home 50Mbps', status: 'active' },
                { id: 3, name: 'Bob Wilson', email: 'bob@example.com', package: 'Gamer 100Mbps', status: 'inactive' },
            ];
            this.loading = false;
        }, 500);
    },
    get filteredCustomers() {
        return this.customers.filter(c => c.name.toLowerCase().includes(this.search.toLowerCase()));
    }
}" x-init="fetchCustomers()">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Customer Management</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add Customer
        </button>
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
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-200">
                    <template x-if="loading">
                        <tr><td colspan="4" class="px-6 py-4 text-center">Loading...</td></tr>
                    </template>
                    
                    <template x-for="customer in filteredCustomers" :key="customer.id">
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold mr-3" x-text="customer.name.charAt(0)"></div>
                                    <div>
                                        <div class="font-medium text-slate-900" x-text="customer.name"></div>
                                        <div class="text-xs text-slate-500" x-text="customer.email"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded text-xs font-medium bg-slate-100 text-slate-800" x-text="customer.package"></span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-medium capitalize" 
                                    :class="customer.status === 'active' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'"
                                    x-text="customer.status"></span>
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
