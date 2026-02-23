<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Kanit', sans-serif; }
        .glass-inner { 
            background: rgba(255, 255, 255, 0.7); 
            backdrop-filter: blur(12px); 
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-transparent p-4 md:p-10">

    <div class="max-w-5xl mx-auto flex flex-col md:flex-row shadow-2xl rounded-[2rem] overflow-hidden border border-white/20">
        
        <div class="w-full md:w-1/2 bg-white/90 p-8 lg:p-12 border-r border-gray-100">
            <div class="flex items-center space-x-3 mb-8">
                <div class="bg-blue-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-blue-200">
                    1.5
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">ค่าบริการอินเทอร์เน็ต</h2>
            </div>

            <form method="POST" class="space-y-5">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">แพ็กเกจที่ใช้งาน</label>
                    <select name="package" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all appearance-none cursor-pointer">
                        <option value="599">Home Fiber (599.- / เดือน)</option>
                        <option value="899">Pro Gamer (899.- / เดือน)</option>
                        <option value="1299">Ultra Business (1299.- / เดือน)</option>
                    </select>
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">จำนวนเดือนที่สมัคร</label>
                    <input type="number" name="months" required min="1" placeholder="เช่น 6 หรือ 12"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 outline-none transition-all duration-300">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" name="calculate" 
                        class="flex-[2] bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-bold py-4 rounded-2xl shadow-xl shadow-blue-100 transition-all active:scale-95 flex justify-center items-center">
                        คำนวณค่าบริการ
                    </button>
                    <a href="internet.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-600 via-indigo-600 to-purple-700 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['calculate'])) {
                $package_price = floatval($_POST['package']);
                $months = intval($_POST['months']);
                
                $subtotal = $package_price * $months;
                
                // Logic ส่วนลด: สมัคร 12 เดือน ลด 10%
                $discount = ($months >= 12) ? ($subtotal * 0.10) : 0;
                $vat = ($subtotal - $discount) * 0.07;
                $total = ($subtotal - $discount) + $vat;
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <div class="inline-block p-4 bg-white/20 rounded-full mb-3">
                            <svg class="w-8 h-8 text-blue-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold uppercase tracking-widest">Internet Invoice</h3>
                    </div>

                    <div class="glass-inner rounded-3xl p-6 space-y-4 text-gray-800 shadow-xl">
                        <div class="flex justify-between items-center border-b border-blue-50 pb-3 text-sm">
                            <span class="text-gray-500">แพ็กเกจ:</span>
                            <span class="font-bold"><?= number_format($package_price, 0) ?>.- / เดือน</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">ระยะเวลา:</span>
                            <span class="font-semibold"><?= $months ?> เดือน</span>
                        </div>
                        <?php if($discount > 0): ?>
                        <div class="flex justify-between text-blue-600 text-sm font-bold italic">
                            <span>ส่วนลดพิเศษ (12 เดือน+):</span>
                            <span>- <?= number_format($discount, 2) ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">ภาษีมูลค่าเพิ่ม (7%):</span>
                            <span class="font-semibold">+ <?= number_format($vat, 2) ?></span>
                        </div>
                        <div class="pt-4 border-t border-blue-100 text-center">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">ยอดชำระรวมภาษี</p>
                            <p class="text-5xl font-black text-blue-700"><?= number_format($total, 2) ?> <span class="text-xl">฿</span></p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase">Fiber Optic<br>Pricing</h3>
                    <div class="space-y-4">
                        <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                            <h4 class="font-bold mb-3 flex items-center">🌐 Package Options</h4>
                            <ul class="text-sm space-y-2 opacity-90">
                                <li class="flex justify-between"><span>Home Fiber:</span> <span>599.- / mo</span></li>
                                <li class="flex justify-between"><span>Pro Gamer:</span> <span>899.- / mo</span></li>
                                <li class="flex justify-between"><span>Ultra Business:</span> <span>1299.- / mo</span></li>
                            </ul>
                        </div>
                        <div class="p-4 bg-blue-400/20 rounded-2xl border-l-4 border-blue-300">
                            <p class="text-xs font-medium">✨ โปรโมชัน: สมัครสมาชิกต่อเนื่อง 12 เดือนขึ้นไป รับส่วนลดค่าบริการทันที 10% (ก่อนภาษี)</p>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>