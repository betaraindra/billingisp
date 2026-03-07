<div class="mb-6 flex justify-between items-center">
    <h1 class="text-2xl font-bold text-slate-900">System Logs</h1>
    <button onclick="window.location.reload()" class="bg-white border border-slate-300 text-slate-700 px-4 py-2 rounded-lg hover:bg-slate-50 flex items-center">
        <i data-lucide="refresh-cw" class="w-4 h-4 mr-2"></i>
        Refresh
    </button>
</div>

<div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">IP Address</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
                <?php
                if (isset($conn)) {
                    try {
                        $stmt = $conn->query("SELECT * FROM system_logs ORDER BY created_at DESC LIMIT 100");
                        $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        if (count($logs) > 0) {
                            foreach ($logs as $log) {
                                $badgeColor = 'bg-gray-100 text-gray-800';
                                if (strpos($log['action'], 'LOGIN_SUCCESS') !== false) $badgeColor = 'bg-green-100 text-green-800';
                                if (strpos($log['action'], 'LOGIN_FAILED') !== false) $badgeColor = 'bg-red-100 text-red-800';
                                if (strpos($log['action'], 'DELETE') !== false) $badgeColor = 'bg-red-100 text-red-800';
                                if (strpos($log['action'], 'CREATE') !== false) $badgeColor = 'bg-blue-100 text-blue-800';
                                
                                echo "<tr>";
                                echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-500'>" . $log['created_at'] . "</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900'>" . htmlspecialchars($log['username'] ?? 'System') . "</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap'><span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full {$badgeColor}'>" . htmlspecialchars($log['action']) . "</span></td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-500'>" . htmlspecialchars($log['description']) . "</td>";
                                echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-500'>" . htmlspecialchars($log['ip_address']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5' class='px-6 py-4 text-center text-sm text-slate-500'>No logs found</td></tr>";
                        }
                    } catch(PDOException $e) {
                        echo "<tr><td colspan='5' class='px-6 py-4 text-center text-sm text-red-500'>Error fetching logs</td></tr>";
                    }
                } else {
                    // Mock data for demo
                    $mock_logs = [
                        ['created_at' => date('Y-m-d H:i:s'), 'username' => 'admin', 'action' => 'LOGIN_SUCCESS', 'description' => 'User logged in successfully', 'ip_address' => '127.0.0.1'],
                        ['created_at' => date('Y-m-d H:i:s', strtotime('-1 hour')), 'username' => 'unknown', 'action' => 'LOGIN_FAILED', 'description' => 'Failed login attempt', 'ip_address' => '192.168.1.50'],
                    ];
                    foreach ($mock_logs as $log) {
                        echo "<tr>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-500'>" . $log['created_at'] . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900'>" . htmlspecialchars($log['username']) . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap'><span class='px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800'>" . htmlspecialchars($log['action']) . "</span></td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-500'>" . htmlspecialchars($log['description']) . "</td>";
                        echo "<td class='px-6 py-4 whitespace-nowrap text-sm text-slate-500'>" . htmlspecialchars($log['ip_address']) . "</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
