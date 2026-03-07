<!-- WhatsApp View -->
<div x-data="{
    status: 'connected',
    qr_code: '',
    messages: [
        { id: 1, to: '081234567890', message: 'Tagihan Internet Anda bulan Oktober sudah terbit.', status: 'sent', time: '10:00' },
        { id: 2, to: '081987654321', message: 'Terima kasih telah melakukan pembayaran.', status: 'delivered', time: '10:05' },
    ]
}">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-slate-900">WhatsApp Gateway</h1>
        <button class="bg-indigo-600 text-white px-4 py-2 rounded-lg hover:bg-indigo-700 flex items-center">
            <i data-lucide="send" class="w-4 h-4 mr-2"></i>
            Send Broadcast
        </button>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <!-- Connection Status -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
            <h3 class="font-bold text-slate-900 mb-4">Device Status</h3>
            <div class="flex items-center justify-center h-40 bg-slate-50 rounded-lg border border-dashed border-slate-300 mb-4">
                <div x-show="status === 'connected'" class="text-center">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-2">
                        <i data-lucide="check-circle" class="w-8 h-8 text-emerald-600"></i>
                    </div>
                    <p class="text-emerald-600 font-medium">Connected</p>
                    <p class="text-xs text-slate-500">+62 812-3456-7890</p>
                </div>
                <div x-show="status === 'disconnected'" class="text-center">
                    <p class="text-slate-400 mb-2">Scan QR Code to Connect</p>
                    <div class="w-32 h-32 bg-slate-200 mx-auto"></div>
                </div>
            </div>
            <button class="w-full bg-slate-100 text-slate-700 py-2 rounded-lg text-sm font-medium hover:bg-slate-200">Reconnect Device</button>
        </div>

        <!-- Message Templates -->
        <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200 col-span-2">
            <h3 class="font-bold text-slate-900 mb-4">Message Templates</h3>
            <div class="space-y-3">
                <div class="p-3 border border-slate-200 rounded-lg hover:bg-slate-50 cursor-pointer">
                    <h4 class="font-medium text-slate-900 text-sm">Invoice Notification</h4>
                    <p class="text-xs text-slate-500 mt-1">Hello {name}, your invoice for {month} is ready. Total: {amount}. Please pay before {due_date}.</p>
                </div>
                <div class="p-3 border border-slate-200 rounded-lg hover:bg-slate-50 cursor-pointer">
                    <h4 class="font-medium text-slate-900 text-sm">Payment Confirmation</h4>
                    <p class="text-xs text-slate-500 mt-1">Thank you {name}, we have received your payment of {amount}. Your service is active.</p>
                </div>
            </div>
        </div>
    </div>
</div>
