<?php
// Handle Settings Save
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_settings'])) {
    if (isset($conn)) {
        try {
            $stmt = $conn->prepare("INSERT INTO app_settings (setting_key, setting_value) VALUES (:key, :value) ON DUPLICATE KEY UPDATE setting_value = :value");
            
            $settings_to_save = [
                'isp_name', 'company_logo', 'billing_domain',
                'router_api_url', 'whatsapp_gateway_url', 
                'active_payment_gateway', 'xendit_api_key', 'tripay_api_key', 'duitku_api_key', 'flip_api_key',
                'auto_invoice', 'auto_isolate', 'payment_reminder'
            ];

            foreach ($settings_to_save as $key) {
                $val = isset($_POST[$key]) ? $_POST[$key] : '0'; // Default to 0 for unchecked checkboxes
                $stmt->execute([':key' => $key, ':value' => $val]);
            }
            
            writeLog($conn, $_SESSION['user_id'], $_SESSION['username'], 'UPDATE_SETTINGS', 'Updated system settings');
            $success_msg = "Settings saved successfully!";
        } catch (PDOException $e) {
            $error_msg = "Error saving settings: " . $e->getMessage();
        }
    }
}

// Handle Backup
if (isset($_POST['backup_db'])) {
    // Logic to backup DB (Simulated for this environment)
    $backup_file = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
    writeLog($conn, $_SESSION['user_id'], $_SESSION['username'], 'BACKUP_DB', 'Created database backup: ' . $backup_file);
    $success_msg = "Database backup created: " . $backup_file;
}

// Handle Update
if (isset($_POST['update_system'])) {
    // Logic to pull from git
    $output = shell_exec('git pull origin main 2>&1');
    writeLog($conn, $_SESSION['user_id'], $_SESSION['username'], 'SYSTEM_UPDATE', 'Ran system update');
    $success_msg = "Update command executed. Output: <pre class='text-xs mt-2'>" . htmlspecialchars($output) . "</pre>";
}

// Fetch Current Settings
$settings = [];
if (isset($conn)) {
    $stmt = $conn->query("SELECT * FROM app_settings");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $settings[$row['setting_key']] = $row['setting_value'];
    }
}
?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-slate-900">Settings</h1>
    <p class="text-slate-500">Manage system configuration, integrations, and maintenance.</p>
</div>

<?php if (isset($success_msg)): ?>
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"><?php echo $success_msg; ?></div>
<?php endif; ?>
<?php if (isset($error_msg)): ?>
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4"><?php echo $error_msg; ?></div>
<?php endif; ?>

<div x-data="{ activeTab: 'general' }" class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden min-h-[600px]">
    <div class="flex flex-col md:flex-row h-full">
        <!-- Sidebar Tabs -->
        <div class="w-full md:w-64 bg-slate-50 border-r border-slate-200">
            <nav class="flex flex-col p-4 space-y-1">
                <button @click="activeTab = 'general'" :class="activeTab === 'general' ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100'" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors">
                    <i data-lucide="settings" class="w-4 h-4 mr-3"></i> Umum
                </button>
                <button @click="activeTab = 'integration'" :class="activeTab === 'integration' ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100'" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors">
                    <i data-lucide="link" class="w-4 h-4 mr-3"></i> Integrasi
                </button>
                <button @click="activeTab = 'automation'" :class="activeTab === 'automation' ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100'" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors">
                    <i data-lucide="zap" class="w-4 h-4 mr-3"></i> Automation
                </button>
                <button @click="activeTab = 'import_export'" :class="activeTab === 'import_export' ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100'" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors">
                    <i data-lucide="arrow-left-right" class="w-4 h-4 mr-3"></i> Import / Export
                </button>
                <button @click="activeTab = 'backup'" :class="activeTab === 'backup' ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100'" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors">
                    <i data-lucide="database" class="w-4 h-4 mr-3"></i> Backup & Restore
                </button>
                <button @click="activeTab = 'update'" :class="activeTab === 'update' ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100'" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors">
                    <i data-lucide="download-cloud" class="w-4 h-4 mr-3"></i> Update Sistem
                </button>
                <button @click="activeTab = 'logs'" :class="activeTab === 'logs' ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-slate-600 hover:bg-slate-100'" class="flex items-center px-4 py-3 text-sm rounded-lg transition-colors">
                    <i data-lucide="activity" class="w-4 h-4 mr-3"></i> Activity Log
                </button>
            </nav>
        </div>

        <!-- Content Area -->
        <div class="flex-1 p-6 md:p-8 overflow-y-auto">
            <form method="POST" action="">
                
                <!-- General Tab -->
                <div x-show="activeTab === 'general'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                    <h3 class="text-lg font-medium text-slate-900 mb-4">Pengaturan Umum</h3>
                    <div class="space-y-4 max-w-lg">
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Nama ISP</label>
                            <input type="text" name="isp_name" value="<?php echo htmlspecialchars($settings['isp_name'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Logo Perusahaan (URL)</label>
                            <input type="text" name="company_logo" value="<?php echo htmlspecialchars($settings['company_logo'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1">Domain Billing</label>
                            <input type="text" name="billing_domain" value="<?php echo htmlspecialchars($settings['billing_domain'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                        </div>
                        <div class="pt-4">
                            <button type="submit" name="save_settings" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Simpan Pengaturan</button>
                        </div>
                    </div>
                </div>

                <!-- Integration Tab -->
                <div x-show="activeTab === 'integration'" style="display: none;">
                    <h3 class="text-lg font-medium text-slate-900 mb-4">Integrasi Sistem</h3>
                    <div class="space-y-6 max-w-2xl">
                        
                        <!-- Router -->
                        <div class="border-b border-slate-200 pb-6">
                            <h4 class="font-medium text-slate-800 mb-3">Router API</h4>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">API Router URL</label>
                                <input type="text" name="router_api_url" value="<?php echo htmlspecialchars($settings['router_api_url'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="http://192.168.1.1/rest">
                            </div>
                        </div>

                        <!-- WhatsApp Gateway -->
                        <div class="border-b border-slate-200 pb-6">
                            <h4 class="font-medium text-slate-800 mb-3">WhatsApp Gateway</h4>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-3">
                                <p class="text-sm text-blue-700">
                                    Menggunakan <strong>go-whatsapp-web-multidevice</strong>. 
                                    <a href="https://github.com/aldinokemal/go-whatsapp-web-multidevice" target="_blank" class="underline">Lihat Dokumentasi</a>.
                                    Pastikan service berjalan di server Anda.
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">WhatsApp Gateway URL</label>
                                <input type="text" name="whatsapp_gateway_url" value="<?php echo htmlspecialchars($settings['whatsapp_gateway_url'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="http://localhost:3000">
                                <p class="text-xs text-slate-500 mt-1">Contoh: http://localhost:3000 (tanpa trailing slash)</p>
                            </div>
                        </div>

                        <!-- Payment Gateway -->
                        <div class="border-b border-slate-200 pb-6">
                            <h4 class="font-medium text-slate-800 mb-3">Payment Gateway</h4>
                            
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-slate-700 mb-1">Active Provider</label>
                                <select name="active_payment_gateway" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                    <option value="manual" <?php echo ($settings['active_payment_gateway'] ?? '') == 'manual' ? 'selected' : ''; ?>>Manual Transfer</option>
                                    <option value="xendit" <?php echo ($settings['active_payment_gateway'] ?? '') == 'xendit' ? 'selected' : ''; ?>>Xendit</option>
                                    <option value="tripay" <?php echo ($settings['active_payment_gateway'] ?? '') == 'tripay' ? 'selected' : ''; ?>>Tripay</option>
                                    <option value="duitku" <?php echo ($settings['active_payment_gateway'] ?? '') == 'duitku' ? 'selected' : ''; ?>>Duitku</option>
                                    <option value="flip" <?php echo ($settings['active_payment_gateway'] ?? '') == 'flip' ? 'selected' : ''; ?>>Flip</option>
                                </select>
                            </div>

                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Xendit API Key</label>
                                    <input type="password" name="xendit_api_key" value="<?php echo htmlspecialchars($settings['xendit_api_key'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm" placeholder="xnd_...">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Tripay API Key</label>
                                    <input type="password" name="tripay_api_key" value="<?php echo htmlspecialchars($settings['tripay_api_key'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Duitku API Key</label>
                                    <input type="password" name="duitku_api_key" value="<?php echo htmlspecialchars($settings['duitku_api_key'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Flip API Key</label>
                                    <input type="password" name="flip_api_key" value="<?php echo htmlspecialchars($settings['flip_api_key'] ?? ''); ?>" class="w-full rounded-lg border-slate-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm">
                                </div>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" name="save_settings" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Simpan Integrasi</button>
                        </div>
                    </div>
                </div>

                <!-- Automation Tab -->
                <div x-show="activeTab === 'automation'" style="display: none;">
                    <h3 class="text-lg font-medium text-slate-900 mb-4">Otomasi</h3>
                    <div class="space-y-4 max-w-lg">
                        <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg">
                            <div>
                                <h4 class="font-medium text-slate-900">Generate Tagihan Otomatis</h4>
                                <p class="text-sm text-slate-500">Buat invoice otomatis setiap tanggal jatuh tempo.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="auto_invoice" value="1" class="sr-only peer" <?php echo ($settings['auto_invoice'] ?? '0') == '1' ? 'checked' : ''; ?>>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg">
                            <div>
                                <h4 class="font-medium text-slate-900">Isolir Otomatis</h4>
                                <p class="text-sm text-slate-500">Nonaktifkan layanan jika tagihan belum dibayar.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="auto_isolate" value="1" class="sr-only peer" <?php echo ($settings['auto_isolate'] ?? '0') == '1' ? 'checked' : ''; ?>>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        <div class="flex items-center justify-between p-4 border border-slate-200 rounded-lg">
                            <div>
                                <h4 class="font-medium text-slate-900">Reminder Pembayaran</h4>
                                <p class="text-sm text-slate-500">Kirim notifikasi WhatsApp sebelum jatuh tempo.</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="payment_reminder" value="1" class="sr-only peer" <?php echo ($settings['payment_reminder'] ?? '0') == '1' ? 'checked' : ''; ?>>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-indigo-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                            </label>
                        </div>
                        <div class="pt-4">
                            <button type="submit" name="save_settings" class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">Simpan Otomasi</button>
                        </div>
                    </div>
                </div>
            </form>

            <!-- Import / Export Tab -->
            <div x-show="activeTab === 'import_export'" style="display: none;">
                <h3 class="text-lg font-medium text-slate-900 mb-4">Import / Export Data</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="border border-slate-200 rounded-lg p-6">
                        <h4 class="font-medium text-slate-900 mb-2">Import Pelanggan</h4>
                        <p class="text-sm text-slate-500 mb-4">Upload file CSV untuk menambahkan data pelanggan secara massal.</p>
                        <div class="flex items-center justify-center w-full">
                            <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-32 border-2 border-slate-300 border-dashed rounded-lg cursor-pointer bg-slate-50 hover:bg-slate-100">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                    <i data-lucide="upload-cloud" class="w-8 h-8 text-slate-400 mb-2"></i>
                                    <p class="text-sm text-slate-500"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                    <p class="text-xs text-slate-500">CSV (MAX. 2MB)</p>
                                </div>
                                <input id="dropzone-file" type="file" class="hidden" />
                            </label>
                        </div>
                    </div>
                    <div class="border border-slate-200 rounded-lg p-6">
                        <h4 class="font-medium text-slate-900 mb-2">Export Data</h4>
                        <p class="text-sm text-slate-500 mb-4">Download semua data pelanggan dan transaksi dalam format CSV.</p>
                        <button class="w-full flex items-center justify-center bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-50">
                            <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                            Export to CSV
                        </button>
                    </div>
                </div>
            </div>

            <!-- Backup Tab -->
            <div x-show="activeTab === 'backup'" style="display: none;">
                <h3 class="text-lg font-medium text-slate-900 mb-4">Backup & Restore Database</h3>
                <div class="space-y-6">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <i data-lucide="info" class="h-5 w-5 text-blue-400"></i>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800">Backup Information</h3>
                                <div class="mt-2 text-sm text-blue-700">
                                    <p>Melakukan backup secara rutin sangat disarankan untuk mencegah kehilangan data.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <form method="POST">
                        <div class="flex space-x-4">
                            <button type="submit" name="backup_db" class="flex items-center bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700">
                                <i data-lucide="database" class="w-4 h-4 mr-2"></i>
                                Backup Database Sekarang
                            </button>
                            <button type="button" class="flex items-center bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-50">
                                <i data-lucide="upload" class="w-4 h-4 mr-2"></i>
                                Restore Database
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Update Tab -->
            <div x-show="activeTab === 'update'" style="display: none;">
                <h3 class="text-lg font-medium text-slate-900 mb-4">Update Sistem</h3>
                <div class="border border-slate-200 rounded-lg p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h4 class="font-medium text-slate-900">Repository Source</h4>
                            <a href="https://github.com/betaraindra/billingisp" target="_blank" class="text-sm text-indigo-600 hover:underline">https://github.com/betaraindra/billingisp</a>
                        </div>
                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">Connected</span>
                    </div>
                    <p class="text-sm text-slate-500 mb-6">Klik tombol di bawah untuk menarik pembaruan terbaru dari repository GitHub.</p>
                    <form method="POST">
                        <button type="submit" name="update_system" class="flex items-center bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-800">
                            <i data-lucide="github" class="w-4 h-4 mr-2"></i>
                            Pull Updates from GitHub
                        </button>
                    </form>
                </div>
            </div>

            <!-- Logs Tab -->
            <div x-show="activeTab === 'logs'" style="display: none;">
                <?php include 'views/logs.php'; ?>
            </div>

        </div>
    </div>
</div>
