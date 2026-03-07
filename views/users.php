<!-- Users View -->
<div x-data="{
    users: [
        { id: 1, username: 'admin', fullname: 'Administrator', role: 'admin', last_login: '2023-10-25 10:00' },
        { id: 2, username: 'sales1', fullname: 'Sales Agent', role: 'sales', last_login: '2023-10-24 15:30' },
        { id: 3, username: 'support1', fullname: 'Support Tech', role: 'support', last_login: '2023-10-25 08:45' },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">User Management</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add User
        </button>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        <table class="w-full text-left text-sm text-slate-600">
            <thead class="bg-slate-50 text-xs uppercase font-semibold text-slate-500">
                <tr>
                    <th class="px-6 py-4">Username</th>
                    <th class="px-6 py-4">Full Name</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Last Login</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <template x-for="user in users" :key="user.id">
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-900" x-text="user.username"></td>
                        <td class="px-6 py-4 text-slate-700" x-text="user.fullname"></td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium capitalize" 
                                :class="{
                                    'bg-purple-100 text-purple-800': user.role === 'admin',
                                    'bg-blue-100 text-blue-800': user.role === 'sales',
                                    'bg-orange-100 text-orange-800': user.role === 'support'
                                }"
                                x-text="user.role"></span>
                        </td>
                        <td class="px-6 py-4 text-slate-500" x-text="user.last_login"></td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-slate-400 hover:text-slate-600 mr-2">
                                <i data-lucide="edit" class="w-4 h-4"></i>
                            </button>
                            <button class="text-red-400 hover:text-red-600">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</div>
