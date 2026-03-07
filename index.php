<?php
// Main Router
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$title = ucfirst($page);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ISP Billing - <?php echo $title; ?></title>
    <!-- Tailwind CSS (CDN) -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons (CDN) -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Alpine.js (CDN) -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-slate-900 font-sans antialiased" x-data="{ sidebarOpen: false }">

    <!-- Mobile Header -->
    <div class="lg:hidden flex items-center justify-between bg-white border-b border-gray-200 px-4 py-3 sticky top-0 z-30">
        <div class="flex items-center space-x-3">
            <div class="w-8 h-8 bg-indigo-600 rounded-lg flex items-center justify-center">
                <i data-lucide="wifi" class="text-white w-5 h-5"></i>
            </div>
            <span class="font-bold text-lg text-slate-900">ISP Billing</span>
        </div>
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 hover:text-gray-700">
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
    </div>

    <div class="flex h-screen overflow-hidden">
        
        <!-- Sidebar -->
        <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed inset-y-0 left-0 z-20 w-64 bg-slate-900 text-white transition-transform duration-300 ease-in-out lg:static lg:translate-x-0 flex flex-col">
            <div class="flex items-center space-x-3 px-6 py-4 border-b border-slate-800">
                <div class="w-8 h-8 bg-indigo-500 rounded-lg flex items-center justify-center">
                    <i data-lucide="wifi" class="text-white w-5 h-5"></i>
                </div>
                <span class="font-bold text-lg">ISP Billing</span>
            </div>

            <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
                <a href="?page=dashboard" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'dashboard' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="layout-dashboard" class="w-5 h-5 mr-3"></i>
                    Dashboard
                </a>
                <a href="?page=customers" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'customers' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="users" class="w-5 h-5 mr-3"></i>
                    Customers
                </a>
                <a href="?page=billing" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'billing' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="credit-card" class="w-5 h-5 mr-3"></i>
                    Billing
                </a>
                <a href="?page=payments" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'payments' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="banknote" class="w-5 h-5 mr-3"></i>
                    Payments
                </a>
                <a href="?page=services" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'services' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="package" class="w-5 h-5 mr-3"></i>
                    Services & Plans
                </a>
                <a href="?page=network" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'network' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="server" class="w-5 h-5 mr-3"></i>
                    Network
                </a>
                <a href="?page=noc" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'noc' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="activity" class="w-5 h-5 mr-3"></i>
                    NOC / Monitoring
                </a>
                <a href="?page=tools" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'tools' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="wrench" class="w-5 h-5 mr-3"></i>
                    Tools
                </a>
                <a href="?page=settings" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'settings' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="settings" class="w-5 h-5 mr-3"></i>
                    Settings
                </a>
                <a href="?page=users" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'users' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="user-cog" class="w-5 h-5 mr-3"></i>
                    User Manager
                </a>
                <a href="?page=whatsapp" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'whatsapp' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="message-circle" class="w-5 h-5 mr-3"></i>
                    WhatsApp
                </a>
                <a href="?page=portal" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'portal' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="globe" class="w-5 h-5 mr-3"></i>
                    Client Portal
                </a>
                <a href="?page=notifications" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'notifications' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="bell" class="w-5 h-5 mr-3"></i>
                    Notifications
                </a>
                <a href="?page=reports" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'reports' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="file-text" class="w-5 h-5 mr-3"></i>
                    Reports
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold">JD</div>
                    <div>
                        <p class="text-sm font-medium">John Doe</p>
                        <p class="text-xs text-slate-500">Admin</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto bg-gray-50 p-4 lg:p-8">
            <?php
            $file = "views/{$page}.php";
            if (file_exists($file)) {
                include $file;
            } else {
                echo "<div class='bg-white p-6 rounded-lg shadow-sm text-center'><h2 class='text-xl font-bold text-red-600'>Page Not Found</h2><p class='text-gray-500'>The requested page '{$page}' does not exist.</p></div>";
            }
            ?>
        </main>

        <!-- Overlay -->
        <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-10 bg-black bg-opacity-50 lg:hidden" x-transition.opacity></div>
    </div>

    <script>
        // Initialize Lucide Icons
        lucide.createIcons();
    </script>
</body>
</html>
