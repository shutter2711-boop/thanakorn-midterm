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
                    2.2
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">คำนวณผลคูณสะสม</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">คำนวณผลคูณตั้งแต่ 1 ถึง:</label>
                    <input type="number" name="target_num" required min="1" max="20" placeholder="ระบุตัวเลข (แนะนำไม่เกิน 20)"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-fuchsia-500/10 focus:border-fuchsia-500 outline-none transition-all duration-300 text-xl font-bold">
                    <p class="text-[10px] text-gray-400 mt-2 ml-1">* หากตัวเลขมากเกินไป ผลลัพธ์จะแสดงในรูปแบบเลขยกกำลัง (E)</p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" name="process" 
                        class="flex-[2] bg-gradient-to-r from-fuchsia-600 to-purple-600 hover:from-fuchsia-700 hover:to-purple-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-fuchsia-100 transition-all active:scale-95 flex justify-center items-center">
                        คำนวณผลคูณ (Loop)
                    </button>
                    <a href="multiply.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-fuchsia-600 via-purple-600 to-indigo-600 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['process'])) {
                $target = intval($_POST['target_num']);
                $result = 1;
                $steps = [];

                // Logic การวนซ้ำเพื่อหาผลคูณสะสม (Factorial Logic)
                for ($i = 1; $i <= $target; $i++) {
                    $result *= $i;
                    if ($target <= 10) { // เก็บขั้นตอนการคูณถ้าตัวเลขไม่เยอะเกินไป
                        $steps[] = $i;
                    }
                }
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-black italic tracking-widest uppercase">Multiplication</h3>
                        <p class="text-fuchsia-100 text-sm mt-1">ผลคูณสะสม 1 ถึง <?= $target ?></p>
                    </div>

                    <div class="glass-inner rounded-[2rem] p-8 space-y-6 text-gray-800 shadow-2xl">
                        <div class="text-center">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">ผลลัพธ์ (Factorial)</p>
                            <p class="text-4xl font-black text-fuchsia-700 break-words">
                                <?= ($result > 1e15) ? sprintf("%.2e", $result) : number_format($result) ?>
                            </p>
                        </div>
                        
                        <?php if(!empty($steps)): ?>
                        <div class="pt-4 border-t border-fuchsia-100">
                            <p class="text-xs font-bold text-gray-500 mb-2 uppercase italic text-center">สมการที่เกิดขึ้น:</p>
                            <p class="text-center font-mono text-sm text-fuchsia-600">
                                <?= implode(" × ", $steps) ?> = <?= number_format($result) ?>
                            </p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Product<br>Calculation</h3>
                    <p class="text-fuchsia-100 mb-8 font-light leading-relaxed">
                        โปรแกรมจะทำการคูณตัวเลขเพิ่มขึ้นทีละลำดับ (1 * 2 * 3 * ... * n) เพื่อหาผลรวมของผลคูณทั้งหมดในขอบเขตที่กำหนด
                    </p>
                    <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                        <div class="flex items-center space-x-3 text-sm">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                            <span>Operator: ($result *= $i)</span>
                        </div>
                        <div class="mt-2 text-xs opacity-70 font-mono">
                            // Logic: 1x2=2, 2x3=6, 6x4=24...
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