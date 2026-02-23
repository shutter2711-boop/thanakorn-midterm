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
                <div class="bg-emerald-500 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-emerald-200">
                    1.4
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">คำนวณค่าแรงรายวัน</h2>
            </div>

            <form method="POST" class="space-y-5">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ชื่อพนักงาน</label>
                    <input type="text" name="emp_name" required placeholder="ระบุชื่อพนักงาน"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all duration-300">
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ประเภทการจ้างงาน</label>
                    <select name="wage_type" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all appearance-none cursor-pointer">
                        <option value="350">แรงงานทั่วไป (350.- / วัน)</option>
                        <option value="500">ช่างเทคนิค (500.- / วัน)</option>
                        <option value="800">ผู้ควบคุมงาน (800.- / วัน)</option>
                    </select>
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">จำนวนวันที่ทำงาน (วัน)</label>
                    <input type="number" name="days" required min="1" max="31" placeholder="เช่น 22"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 outline-none transition-all duration-300">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" name="calculate" 
                        class="flex-[2] bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-emerald-100 transition-all active:scale-95 flex justify-center items-center">
                        คำนวณค่าแรง
                    </button>
                    <a href="wage.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-emerald-500 via-teal-500 to-cyan-600 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['calculate'])) {
                $name = htmlspecialchars($_POST['emp_name']);
                $rate = floatval($_POST['wage_type']);
                $days = intval($_POST['days']);
                
                $total_wage = $rate * $days;
                $bonus = ($days >= 25) ? 1000 : 0; // โบนัสพิเศษขยันทำงาน
                $grand_total = $total_wage + $bonus;
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <div class="inline-block p-4 bg-white/20 rounded-full mb-3">
                            <svg class="w-8 h-8 text-emerald-100" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <h3 class="text-2xl font-bold uppercase tracking-widest">Wage Receipt</h3>
                    </div>

                    <div class="glass-inner rounded-3xl p-6 space-y-4 text-gray-800 shadow-xl">
                        <div class="flex justify-between items-center border-b border-emerald-100 pb-3">
                            <span class="text-gray-500 font-medium">ชื่อพนักงาน:</span>
                            <span class="font-bold text-emerald-700"><?= $name ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">อัตราค่าแรง/วัน:</span>
                            <span class="font-semibold"><?= number_format($rate, 2) ?> บาท</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">จำนวนวันทำงาน:</span>
                            <span class="font-semibold"><?= $days ?> วัน</span>
                        </div>
                        <?php if($bonus > 0): ?>
                        <div class="flex justify-between text-orange-500 font-bold italic">
                            <span>โบนัสขยันทำงาน:</span>
                            <span>+ <?= number_format($bonus, 2) ?> บาท</span>
                        </div>
                        <?php endif; ?>
                        <div class="pt-4 border-t border-emerald-100 text-center">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">ค่าแรงสุทธิที่ได้รับ</p>
                            <p class="text-5xl font-black text-emerald-600"><?= number_format($grand_total, 2) ?> <span class="text-xl">฿</span></p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase">Daily Wage<br>Calculator</h3>
                    <div class="space-y-4">
                        <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                            <h4 class="font-bold mb-3 flex items-center">📌 มาตรฐานการจ่ายค่าแรง</h4>
                            <ul class="text-sm space-y-2 opacity-90">
                                <li class="flex justify-between"><span>แรงงานทั่วไป:</span> <span>350.- / วัน</span></li>
                                <li class="flex justify-between"><span>ช่างเทคนิค:</span> <span>500.- / วัน</span></li>
                                <li class="flex justify-between"><span>ผู้ควบคุมงาน:</span> <span>800.- / วัน</span></li>
                            </ul>
                        </div>
                        <div class="p-4 bg-emerald-400/20 rounded-2xl border-l-4 border-emerald-300">
                            <p class="text-xs font-medium">💡 สิทธิพิเศษ: หากทำงานตั้งแต่ 25 วันขึ้นไปต่อเดือน รับโบนัสพิเศษเพิ่มทันที 1,000 บาท!</p>
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