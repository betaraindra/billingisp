<!-- Reports View -->
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-slate-900">Financial Reports</h1>
        <div class="flex space-x-2">
            <select class="rounded-lg border-slate-300 text-sm">
                <option>This Month</option>
                <option>Last Month</option>
                <option>This Year</option>
            </select>
            <button class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-50 flex items-center text-sm">
                <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                Export PDF
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 mb-2">Total Income</h3>
            <p class="text-3xl font-bold text-slate-900">Rp 45.200.000</p>
            <p class="text-sm text-emerald-600 mt-2 flex items-center">
                <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i> +12.5% from last month
            </p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 mb-2">Total Expenses</h3>
            <p class="text-3xl font-bold text-slate-900">Rp 12.500.000</p>
            <p class="text-sm text-red-600 mt-2 flex items-center">
                <i data-lucide="trending-down" class="w-4 h-4 mr-1"></i> +5.2% from last month
            </p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-sm font-medium text-slate-500 mb-2">Net Profit</h3>
            <p class="text-3xl font-bold text-slate-900">Rp 32.700.000</p>
            <p class="text-sm text-emerald-600 mt-2 flex items-center">
                <i data-lucide="trending-up" class="w-4 h-4 mr-1"></i> +15.3% from last month
            </p>
        </div>
    </div>

    <!-- Charts Section (Mocked with CSS/HTML) -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Monthly Revenue</h3>
            <div class="h-64 flex items-end justify-between space-x-2">
                <!-- Simple Bar Chart Mockup -->
                <div class="w-full bg-indigo-100 rounded-t-lg relative group" style="height: 40%">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">40%</div>
                </div>
                <div class="w-full bg-indigo-200 rounded-t-lg relative group" style="height: 60%">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">60%</div>
                </div>
                <div class="w-full bg-indigo-300 rounded-t-lg relative group" style="height: 55%">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">55%</div>
                </div>
                <div class="w-full bg-indigo-400 rounded-t-lg relative group" style="height: 75%">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">75%</div>
                </div>
                <div class="w-full bg-indigo-500 rounded-t-lg relative group" style="height: 90%">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">90%</div>
                </div>
                <div class="w-full bg-indigo-600 rounded-t-lg relative group" style="height: 85%">
                    <div class="absolute -top-8 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs py-1 px-2 rounded opacity-0 group-hover:opacity-100 transition-opacity">85%</div>
                </div>
            </div>
            <div class="flex justify-between mt-4 text-xs text-slate-500">
                <span>Jan</span><span>Feb</span><span>Mar</span><span>Apr</span><span>May</span><span>Jun</span>
            </div>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="text-lg font-bold text-slate-900 mb-6">Payment Methods</h3>
            <div class="space-y-4">
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-slate-700">Bank Transfer (Manual)</span>
                        <span class="text-slate-500">45%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-blue-500 h-2 rounded-full" style="width: 45%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-slate-700">Xendit (Virtual Account)</span>
                        <span class="text-slate-500">30%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-indigo-500 h-2 rounded-full" style="width: 30%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-slate-700">Tripay (Alfamart/Indomaret)</span>
                        <span class="text-slate-500">15%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-orange-500 h-2 rounded-full" style="width: 15%"></div>
                    </div>
                </div>
                <div>
                    <div class="flex justify-between text-sm mb-1">
                        <span class="font-medium text-slate-700">Cash</span>
                        <span class="text-slate-500">10%</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2">
                        <div class="bg-emerald-500 h-2 rounded-full" style="width: 10%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
