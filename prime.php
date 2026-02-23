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
                <div class="bg-indigo-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-indigo-200">
                    2.7
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">ตรวจสอบจำนวนเฉพาะ</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">กรอกตัวเลขที่ต้องการตรวจสอบ:</label>
                    <input type="number" name="number" required min="1" placeholder="ตัวอย่าง: 17"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300 text-xl font-bold text-center">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="submit" name="check" 
                        class="flex-[2] bg-gradient-to-r from-indigo-600 to-purple-700 hover:from-indigo-700 hover:to-purple-800 text-white font-bold py-4 rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 flex justify-center items-center">
                        ตรวจสอบทันที
                    </button>
                    <a href="prime.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['check'])) {
                $n = intval($_POST['number']);
                $is_prime = true;
                $reason = "";

                if ($n <= 1) {
                    $is_prime = false;
                    $reason = "จำนวนที่น้อยกว่าหรือเท่ากับ 1 ไม่เป็นจำนวนเฉพาะ";
                } else {
                    // Logic การวนซ้ำเพื่อตรวจสอบตัวหาร
                    for ($i = 2; $i <= sqrt($n); $i++) {
                        if ($n % $i == 0) {
                            $is_prime = false;
                            $reason = "$n หารด้วย $i ลงตัว";
                            break;
                        }
                    }
                }

                $bg_res = $is_prime ? "bg-emerald-500" : "bg-rose-500";
                $icon = $is_prime ? "M5 13l4 4L19 7" : "M6 18L18 6M6 6l12 12";
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out] text-center">
                    <div class="mb-6">
                        <h3 class="text-3xl font-black italic tracking-widest uppercase">Prime Status</h3>
                        <p class="text-indigo-100 text-sm mt-1 font-light tracking-wide">Number Checked: <?= $n ?></p>
                    </div>

                    <div class="glass-inner rounded-[2.5rem] p-10 space-y-6 shadow-2xl">
                        <div class="<?= $bg_res ?> w-20 h-20 rounded-full mx-auto flex items-center justify-center text-white shadow-lg transition-all duration-500">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="<?= $icon ?>"></path>
                            </svg>
                        </div>
                        
                        <div>
                            <p class="text-3xl font-black text-gray-800">
                                <?= $is_prime ? "เป็นจำนวนเฉพาะ" : "ไม่เป็นจำนวนเฉพาะ" ?>
                            </p>
                            <?php if(!$is_prime && $reason != ""): ?>
                                <p class="text-rose-500 text-xs mt-2 font-bold uppercase italic"><?= $reason ?></p>
                            <?php endif; ?>
                        </div>

                        <div class="pt-4 border-t border-gray-100 text-[10px] text-gray-400 font-medium uppercase tracking-tighter">
                            Verified by Looping Algorithm
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Prime Number<br>Discovery</h3>
                    <p class="text-indigo-100 mb-8 font-light leading-relaxed">
                        จำนวนเฉพาะคือจำนวนเต็มที่มีตัวประกอบเพียงสองตัว คือ 1 และตัวมันเอง โปรแกรมจะใช้การวนซ้ำตรวจสอบเพื่อหาคำตอบที่แม่นยำ
                    </p>
                    <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                        <div class="flex items-center space-x-3 text-sm">
                            <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                            <span class="font-mono text-xs italic">Logic: if ($n % $i == 0) return false;</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</body>
</html>