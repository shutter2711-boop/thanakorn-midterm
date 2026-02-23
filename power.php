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
                <div class="bg-fuchsia-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-fuchsia-200">
                    2.6
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">คำนวณเลขยกกำลัง</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ตัวเลขฐาน (Base):</label>
                    <input type="number" name="base" required placeholder="ตัวอย่าง: 2"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-fuchsia-500/10 focus:border-fuchsia-500 outline-none transition-all duration-300 text-xl font-bold">
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">เลขชี้กำลัง (Exponent):</label>
                    <input type="number" name="exp" required min="0" max="50" placeholder="ตัวอย่าง: 10"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-fuchsia-500/10 focus:border-fuchsia-500 outline-none transition-all duration-300 text-xl font-bold">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-2">
                    <button type="submit" name="calculate" 
                        class="flex-[2] bg-gradient-to-r from-fuchsia-600 to-indigo-600 hover:from-fuchsia-700 hover:to-indigo-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-fuchsia-100 transition-all active:scale-95 flex justify-center items-center">
                        คำนวณผลลัพธ์
                    </button>
                    <a href="power.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-fuchsia-600 via-purple-600 to-indigo-700 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['calculate'])) {
                $base = floatval($_POST['base']);
                $exp = intval($_POST['exp']);
                $result = 1;

                // Logic การวนซ้ำเพื่อหาค่าเลขยกกำลัง
                for ($i = 1; $i <= $exp; $i++) {
                    $result *= $base;
                }
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-8">
                        <h3 class="text-3xl font-black italic tracking-widest uppercase">Power Result</h3>
                        <p class="text-fuchsia-100 text-sm mt-1">สมการ: <?= $base ?><sup><?= $exp ?></sup></p>
                    </div>

                    <div class="glass-inner rounded-[2.5rem] p-10 space-y-6 shadow-2xl text-center">
                        <div>
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">ผลลัพธ์สุดท้าย</p>
                            <p class="text-4xl font-black text-fuchsia-700 break-words">
                                <?= (abs($result) > 1e15) ? sprintf("%.2e", $result) : number_format($result, 2) ?>
                            </p>
                        </div>
                        
                        <div class="pt-4 border-t border-fuchsia-100 text-xs text-gray-400 italic">
                            คูณสะสมตัวเลข <?= $base ?> ทั้งหมด <?= $exp ?> รอบ
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Exponent<br>Calculation</h3>
                    <p class="text-fuchsia-100 mb-8 font-light leading-relaxed">
                        โปรแกรมจะใช้คำสั่ง For Loop เพื่อทำการคูณตัวเลขฐานซ้ำไปเรื่อยๆ ตามจำนวนของเลขชี้กำลังที่คุณกำหนด
                    </p>
                    <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                        <div class="flex items-center space-x-3 text-sm">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                            <span class="font-mono text-xs italic">Logic: $result *= $base;</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</body>
</html>