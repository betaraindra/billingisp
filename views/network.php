<!-- Network View -->
<div x-data="{
    routers: [],
    loading: true,
    showModal: false,
    newRouter: { name: '', ip_address: '', username: '', password: '', port: 8728, model: '' },
    async fetchRouters() {
        this.loading = true;
        try {
            const res = await fetch('api/routers.php');
            this.routers = await res.json();
        } catch (e) {
            console.error(e);
        } finally {
            this.loading = false;
        }
    },
    async saveRouter() {
        try {
            const res = await fetch('api/routers.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(this.newRouter)
            });
            const data = await res.json();
            if (res.ok) {
                alert(data.message);
                this.showModal = false;
                this.newRouter = { name: '', ip_address: '', username: '', password: '', port: 8728, model: '' };
                this.fetchRouters();
            } else {
                alert('Error: ' + data.message);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    },
    async deleteRouter(id) {
        if(!confirm('Are you sure you want to delete this router?')) return;
        try {
            const res = await fetch('api/routers.php?id=' + id, { method: 'DELETE' });
            const data = await res.json();
            if (res.ok) {
                this.fetchRouters();
            } else {
                alert('Error: ' + data.message);
            }
        } catch (e) {
            alert('Error: ' + e.message);
        }
    }
}" x-init="fetchRouters()">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Network Management</h1>
        <button @click="showModal = true" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add Router
        </button>
    </div>

    <!-- Add Router Modal -->
    <div x-show="showModal" class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true" @click="showModal = false">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
            <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <h3 class="text-lg leading-6 font-medium text-gray-900 mb-4">Add New Router</h3>
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Router Name</label>
                            <input x-model="newRouter.name" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">IP Address</label>
                                <input x-model="newRouter.ip_address" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Port (API)</label>
                                <input x-model="newRouter.port" type="number" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Username</label>
                                <input x-model="newRouter.username" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Password</label>
                                <input x-model="newRouter.password" type="password" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Model (Optional)</label>
                            <input x-model="newRouter.model" type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button @click="saveRouter()" type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
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
        <template x-for="router in routers" :key="router.id">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div class="flex items-center">
                            <div class="p-2 rounded-lg mr-3" :class="router.status === 'online' ? 'bg-emerald-100 text-emerald-600' : 'bg-red-100 text-red-600'">
                                <i data-lucide="server" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-900" x-text="router.name"></h3>
                                <p class="text-sm text-slate-500" x-text="router.ip_address"></p>
                            </div>
                        </div>
                        <div class="relative group">
                            <button @click="deleteRouter(router.id)" class="text-slate-400 hover:text-red-600">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <p class="text-xs text-slate-500 mb-1">Model</p>
                            <p class="font-medium text-slate-900" x-text="router.model || 'Unknown'"></p>
                        </div>
                        <div class="bg-slate-50 p-3 rounded-lg">
                            <p class="text-xs text-slate-500 mb-1">Last Seen</p>
                            <p class="font-medium text-slate-900" x-text="router.last_seen || 'Never'"></p>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm">
                        <div class="flex items-center text-slate-600">
                            <i data-lucide="activity" class="w-4 h-4 mr-1"></i>
                            Status
                        </div>
                        <span class="px-2 py-1 rounded text-xs font-medium capitalize" 
                            :class="router.status === 'online' ? 'bg-emerald-100 text-emerald-800' : 'bg-red-100 text-red-800'"
                            x-text="router.status"></span>
                    </div>
                </div>
                <div class="bg-slate-50 px-6 py-3 border-t border-slate-200 flex justify-between items-center">
                    <span class="text-xs text-slate-500">API Port: <span x-text="router.port || 8728"></span></span>
                    <button @click="alert('Testing connection to ' + router.ip_address + '... (Feature coming soon)')" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Test Connection</button>
                </div>
            </div>
        </template>
    </div>
</div>
