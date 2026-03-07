<!-- Client Portal View -->
<div x-data="{
    portal_url: 'https://portal.myisp.com',
    theme: 'light',
    enabled: true
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">Client Portal Settings</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="external-link" class="w-4 h-4 mr-2"></i>
            Visit Portal
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-900 mb-4">Portal Configuration</h3>
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Portal URL</label>
                    <input type="text" x-model="portal_url" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                </div>
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Theme</label>
                    <select x-model="theme" class="w-full px-3 py-2 border border-slate-300 rounded-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="light">Light</option>
                        <option value="dark">Dark</option>
                    </select>
                </div>
                <div class="flex items-center">
                    <input type="checkbox" x-model="enabled" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                    <label class="ml-2 block text-sm text-slate-900">Enable Client Portal</label>
                </div>
            </div>
            <button class="mt-4 w-full bg-emerald-600 text-white py-2 rounded-lg text-sm font-medium hover:bg-emerald-700">Save Settings</button>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-900 mb-4">Preview</h3>
            <div class="h-64 bg-slate-100 rounded-lg border border-slate-200 flex items-center justify-center">
                <p class="text-slate-400">Portal Preview Frame</p>
            </div>
        </div>
    </div>
</div>
