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
                <div class="bg-violet-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-violet-200">
                    1.6
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">เช็คเลขคู่หรือเลขคี่</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">กรอกตัวเลขที่ต้องการตรวจสอบ</label>
                    <input type="number" name="number" required placeholder="ตัวอย่าง: 42"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-violet-500/10 focus:border-violet-500 outline-none transition-all duration-300 text-xl font-bold text-center">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="submit" name="check" 
                        class="flex-[2] bg-gradient-to-r from-violet-600 to-indigo-700 hover:from-violet-700 hover:to-indigo-800 text-white font-bold py-4 rounded-2xl shadow-xl shadow-violet-100 transition-all active:scale-95 flex justify-center items-center">
                        ตรวจสอบทันที
                    </button>
                    <a href="odd-even.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-violet-600 via-indigo-600 to-blue-700 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['check'])) {
                $num = intval($_POST['number']);
                $is_even = ($num % 2 == 0);
                $result_text = $is_even ? "เลขคู่ (Even Number)" : "เลขคี่ (Odd Number)";
                $bg_result = $is_even ? "bg-emerald-500" : "bg-orange-500";
                $icon = $is_even ? "M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" : "M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z";
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out] text-center">
                    <div class="mb-6">
                        <p class="text-indigo-200 text-sm font-medium mb-1">ผลลัพธ์สำหรับหมายเลข <?= $num ?></p>
                        <h3 class="text-4xl font-black italic tracking-tighter uppercase">Calculation Result</h3>
                    </div>

                    <div class="glass-inner rounded-[2.5rem] p-10 space-y-6 shadow-2xl">
                        <div class="<?= $bg_result ?> w-20 h-20 rounded-full mx-auto flex items-center justify-center text-white shadow-lg transition-colors">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?= $icon ?>"></path>
                            </svg>
                        </div>
                        
                        <div>
                            <p class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">ตัวเลขนี้คือ</p>
                            <p class="text-3xl font-black text-gray-800"><?= $result_text ?></p>
                        </div>

                        <div class="pt-4 border-t border-gray-100 text-xs text-gray-400 italic font-light">
                            Logic: <?= $num ?> mod 2 = <?= $num % 2 ?>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full text-center md:text-left">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Odd or Even<br>Checker</h3>
                    <p class="text-indigo-100 mb-8 font-light leading-relaxed">
                        โปรแกรมตรวจสอบคุณสมบัติของจำนวนเต็ม เพื่อแยกแยะระหว่างเลขคู่และเลขคี่ด้วยตัวดำเนินการทางคณิตศาสตร์ Modulo (%)
                    </p>
                    <div class="inline-flex items-center space-x-2 bg-white/10 px-4 py-2 rounded-full border border-white/20">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-violet-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-violet-500"></span>
                        </span>
                        <span class="text-xs font-medium uppercase tracking-widest">System Ready to Check</span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>