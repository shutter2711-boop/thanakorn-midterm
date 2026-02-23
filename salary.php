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
        .bg-mesh {
            background-color: #ffffff;
            background-image: radial-gradient(at 0% 0%, hsla(253,16%,7%,1) 0, transparent 50%), 
                              radial-gradient(at 50% 0%, hsla(225,39%,30%,1) 0, transparent 50%), 
                              radial-gradient(at 100% 0%, hsla(339,49%,30%,1) 0, transparent 50%);
        }
    </style>
</head>
<body class="bg-transparent p-4 md:p-10">

    <div class="max-w-5xl mx-auto flex flex-col md:flex-row shadow-2xl rounded-[2rem] overflow-hidden border border-white/20">
        
        <div class="w-full md:w-1/2 bg-white/90 p-8 lg:p-12">
            <div class="flex items-center space-x-3 mb-8">
                <div class="bg-indigo-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-indigo-200">
                    1.1
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">คำนวณเงินเดือน</h2>
            </div>

            <form method="POST" class="space-y-5">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1 group-focus-within:text-indigo-600 transition">ชื่อพนักงาน</label>
                    <input type="text" name="name" required placeholder="ระบุชื่อ-นามสกุล"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300">
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1 group-focus-within:text-indigo-600 transition">ชั่วโมงทำงาน</label>
                    <input type="number" name="hours" required placeholder="ตัวอย่าง: 160"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300">
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1 group-focus-within:text-indigo-600 transition">ตำแหน่ง</label>
                    <div class="relative">
                        <select name="position" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all appearance-none cursor-pointer">
                            <option value="100">ปฏิบัติการ (100 บาท/ชม.)</option>
                            <option value="200">หัวหน้างาน (200 บาท/ชม.)</option>
                            <option value="300">ผู้จัดการ (300 บาท/ชม.)</option>
                        </select>
                        <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" name="calculate" 
                        class="flex-[2] bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 flex justify-center items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        คำนวณผลลัพธ์
                    </button>
                    <a href="salary.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        รีเซ็ต
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-indigo-700 via-purple-700 to-pink-600 p-8 lg:p-12 text-white relative flex items-center">
            
            <?php
            if (isset($_POST['calculate'])) {
                $name = htmlspecialchars($_POST['name']);
                $hours = floatval($_POST['hours']);
                $rate = floatval($_POST['position']);
                
                $normal_hours = ($hours > 160) ? 160 : $hours;
                $ot_hours = ($hours > 160) ? ($hours - 160) : 0;
                
                $salary_normal = $normal_hours * $rate;
                $salary_ot = $ot_hours * ($rate * 1.5);
                $total_salary = $salary_normal + $salary_ot;
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-8">
                        <div class="inline-block p-3 bg-white/10 rounded-full mb-3">
                            <svg class="w-8 h-8 text-yellow-300" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        </div>
                        <h3 class="text-3xl font-black italic uppercase tracking-widest">Summary</h3>
                    </div>

                    <div class="glass-inner rounded-3xl p-6 space-y-4 text-gray-800 shadow-xl">
                        <div class="flex justify-between items-center border-b border-gray-200/50 pb-3">
                            <span class="text-gray-500 font-medium">พนักงาน</span>
                            <span class="font-bold text-indigo-700"><?= $name ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">ชั่วโมงปกติ (160)</span>
                            <span class="font-semibold"><?= number_format($salary_normal, 2) ?></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500 font-medium">ค่าล่วงเวลา (OT)</span>
                            <span class="font-semibold text-rose-500">+ <?= number_format($salary_ot, 2) ?></span>
                        </div>
                        <div class="pt-4 border-t border-indigo-100">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest text-center mb-1">Total Net Income</p>
                            <p class="text-4xl font-black text-center text-indigo-800"><?= number_format($total_salary, 2) ?> <span class="text-lg">฿</span></p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 leading-tight italic">PROGRAM<br>CALCULATOR</h3>
                    <p class="text-indigo-100 mb-8 font-light leading-relaxed">
                        ระบบคำนวณรายรับพนักงานตามชั่วโมงการทำงานจริง พร้อมคำนวณเบี้ยเลี้ยงล่วงเวลาอัตโนมัติ 1.5 เท่า
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start space-x-4 bg-white/10 p-4 rounded-2xl hover:bg-white/20 transition cursor-default">
                            <span class="text-2xl">⚡</span>
                            <div>
                                <h4 class="font-bold text-white">เงื่อนไขการทำงาน</h4>
                                <p class="text-xs text-indigo-100 opacity-80 mt-1">ชั่วโมงที่ 161 เป็นต้นไป ระบบจะคำนวณเพิ่มเป็น 1.5 เท่าของอัตราปกติ</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-3 gap-2">
                            <div class="bg-white/10 p-3 rounded-2xl text-center">
                                <p class="text-[10px] font-bold opacity-60 uppercase">Staff</p>
                                <p class="font-bold">100.-</p>
                            </div>
                            <div class="bg-white/10 p-3 rounded-2xl text-center border border-yellow-400/30">
                                <p class="text-[10px] font-bold opacity-60 uppercase">Head</p>
                                <p class="font-bold">200.-</p>
                            </div>
                            <div class="bg-white/10 p-3 rounded-2xl text-center">
                                <p class="text-[10px] font-bold opacity-60 uppercase">Manager</p>
                                <p class="font-bold">300.-</p>
                            </div>
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