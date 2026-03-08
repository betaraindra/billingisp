<!-- Services View -->
<div x-data="{
    services: [],
    loading: true,
    showModal: false,
    newService: { name: '', price: 0, speed_mbps: 0, description: '' },
    async fetchServices() {
        this.loading = true;
        try {
            const res = await fetch('api/services.php');
            this.services = await res.json();
        } catch (e) {
            console.error(e);
        } finally {
            this.loading = false;
        }
    },
    async saveService() {
        try {
            const res = await fetch('api/services.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.newService)
            });
            const data = await res.json();
            if (res.ok) {
                alert(data.message);
                this.showModal = false;
                this.newService = { name: '', price: 0, speed_mbps: 0, description: '' };
                this.fetchServices();
            } else {
                alert('Error: ' + data.message);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    },
    async deleteService(id) {
        if(!confirm('Are you sure you want to delete this service?')) return;
        try {
            const res = await fetch('api/services.php?id=' + id, { method: 'DELETE' });
            if (res.ok) {
                this.fetchServices();
            } else {
                alert('Failed to delete service');
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }
}" x-init="fetchServices()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Internet Packages</h1>
        <button @click="showModal = true" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add Package
        </button>
    </div>

    <!-- Add Service Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Add New Package</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Package Name</label>
                            <input x-model="newService.name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Price (Rp)</label>
                                <input x-model="newService.price" type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Speed (Mbps)</label>
                                <input x-model="newService.speed_mbps" type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea x-model="newService.description" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"></textarea>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="saveService()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Save
                    </button>
                    <button @click="showModal = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Cancel
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="service in services" :key="service.id">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="p-3 bg-indigo-50 rounded-xl text-indigo-600">
                            <i data-lucide="wifi" class="w-8 h-8"></i>
                        </div>
                        <div class="relative group">
                            <button @click="deleteService(service.id)" class="text-slate-400 hover:text-red-600">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                    
                    <h3 class="text-xl font-bold text-slate-900 mb-1" x-text="service.name"></h3>
                    <p class="text-sm text-slate-500 mb-4" x-text="service.description"></p>
                    
                    <div class="flex items-baseline mb-4">
                        <span class="text-2xl font-bold text-slate-900" x-text="'Rp ' + parseInt(service.price).toLocaleString()"></span>
                        <span class="text-slate-500 ml-1">/month</span>
                    </div>

                    <div class="flex items-center text-sm text-slate-600 bg-slate-50 p-2 rounded-lg">
                        <i data-lucide="zap" class="w-4 h-4 mr-2 text-yellow-500"></i>
                        <span x-text="'Up to ' + service.speed_mbps + ' Mbps'"></span>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
