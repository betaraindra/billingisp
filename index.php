<?php
session_start();
require_once 'config.php';

// Handle Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}

// Handle Login
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Simple check against database or hardcoded fallback
    if (isset($conn)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password";
        }
    } else {
        // Fallback if DB not connected (for demo purposes)
        if ($username === 'admin' && $password === 'password') {
            $_SESSION['user_id'] = 1;
            $_SESSION['username'] = 'admin';
            $_SESSION['role'] = 'admin';
            header("Location: index.php");
            exit;
        } else {
            $error = "Invalid username or password (Demo: admin/password)";
        }
    }
}

// Check if logged in
if (!isset($_SESSION['user_id'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ISP Billing</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-gray-100">
    <?php include 'views/login.php'; ?>
</body>
</html>
<?php
    exit;
}

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
                <a href="?page=network" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg <?php echo $page == 'network' ? 'bg-indigo-600 text-white' : 'text-slate-400 hover:bg-slate-800 hover:text-white'; ?>">
                    <i data-lucide="server" class="w-5 h-5 mr-3"></i>
                    Network
                </a>
            </nav>

            <div class="p-4 border-t border-slate-800">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 rounded-full bg-slate-700 flex items-center justify-center text-xs font-bold">
                            <?php echo strtoupper(substr($_SESSION['username'], 0, 2)); ?>
                        </div>
                        <div>
                            <p class="text-sm font-medium"><?php echo htmlspecialchars($_SESSION['username']); ?></p>
                            <p class="text-xs text-slate-500"><?php echo ucfirst($_SESSION['role']); ?></p>
                        </div>
                    </div>
                    <a href="?logout=true" class="text-slate-400 hover:text-white" title="Logout">
                        <i data-lucide="log-out" class="w-5 h-5"></i>
                    </a>
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
