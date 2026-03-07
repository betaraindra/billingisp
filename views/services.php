<!-- Services & Plans View -->
<div x-data="{
    plans: [
        { id: 1, name: 'Home 20Mbps', type: 'PPPoE', bandwidth: '20M/20M', price: 250000, router: 'Main Gateway', enabled: true },
        { id: 2, name: 'Home 50Mbps', type: 'PPPoE', bandwidth: '50M/50M', price: 450000, router: 'Main Gateway', enabled: true },
        { id: 3, name: 'Voucher 1 Day', type: 'Hotspot', bandwidth: '5M/5M', price: 5000, router: 'Distribution OLT', enabled: true },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Services & Plans</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add New Plan
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <template x-for="plan in plans" :key="plan.id">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden hover:shadow-md transition-shadow relative">
                <div class="absolute top-4 right-4">
                    <span class="px-2 py-1 rounded-full text-xs font-medium" 
                        :class="plan.enabled ? 'bg-emerald-100 text-emerald-800' : 'bg-slate-100 text-slate-500'"
                        x-text="plan.enabled ? 'Active' : 'Disabled'"></span>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="p-3 rounded-lg mr-4" :class="plan.type === 'PPPoE' ? 'bg-blue-100 text-blue-600' : 'bg-orange-100 text-orange-600'">
                            <i :data-lucide="plan.type === 'PPPoE' ? 'router' : 'wifi'" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-slate-900 text-lg" x-text="plan.name"></h3>
                            <p class="text-sm text-slate-500" x-text="plan.type"></p>
                        </div>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Bandwidth</span>
                            <span class="font-medium text-slate-900" x-text="plan.bandwidth"></span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-slate-500">Router</span>
                            <span class="font-medium text-slate-900" x-text="plan.router"></span>
                        </div>
                    </div>

                    <div class="flex items-baseline mb-4">
                        <span class="text-2xl font-bold text-slate-900" x-text="'Rp ' + plan.price.toLocaleString()"></span>
                        <span class="text-sm text-slate-500 ml-1">/ month</span>
                    </div>

                    <div class="flex space-x-2">
                        <button class="flex-1 bg-slate-50 text-slate-700 py-2 rounded-lg text-sm font-medium hover:bg-slate-100 border border-slate-200">Edit</button>
                        <button class="flex-1 bg-slate-50 text-red-600 py-2 rounded-lg text-sm font-medium hover:bg-red-50 border border-slate-200">Delete</button>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
