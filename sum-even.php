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
                <div class="bg-purple-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-purple-200">
                    2.1
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">คำนวณผลรวมเลขคู่</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">คำนวณผลรวมเลขคู่ตั้งแต่ 1 ถึง:</label>
                    <input type="number" name="max_num" required min="1" max="1000" placeholder="ระบุตัวเลข (เช่น 100)"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 outline-none transition-all duration-300 text-xl font-bold">
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" name="process" 
                        class="flex-[2] bg-gradient-to-r from-purple-600 to-fuchsia-600 hover:from-purple-700 hover:to-fuchsia-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-purple-100 transition-all active:scale-95 flex justify-center items-center">
                        เริ่มคำนวณ (Loop)
                    </button>
                    <a href="sum-even.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-purple-600 via-fuchsia-600 to-pink-500 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['process'])) {
                $max = intval($_POST['max_num']);
                $sum = 0;
                $even_numbers = [];

                // Logic การวนซ้ำ (For Loop)
                for ($i = 1; $i <= $max; $i++) {
                    if ($i % 2 == 0) {
                        $sum += $i;
                        if (count($even_numbers) < 10) { // เก็บตัวอย่างแค่ 10 ตัวแรก
                            $even_numbers[] = $i;
                        }
                    }
                }
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-black italic tracking-widest uppercase">Summation</h3>
                        <p class="text-purple-100 text-sm mt-1">ผลรวมเลขคู่ 1 ถึง <?= $max ?></p>
                    </div>

                    <div class="glass-inner rounded-[2rem] p-8 space-y-6 text-gray-800 shadow-2xl">
                        <div class="text-center">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">ผลรวมลัพธ์สุดท้าย</p>
                            <p class="text-5xl font-black text-purple-700"><?= number_format($sum) ?></p>
                        </div>
                        
                        <div class="pt-4 border-t border-purple-100">
                            <p class="text-xs font-bold text-gray-500 mb-2 uppercase italic">ตัวอย่างตัวเลขที่นำมาบวก:</p>
                            <div class="flex flex-wrap gap-2">
                                <?php foreach($even_numbers as $num): ?>
                                    <span class="bg-purple-100 text-purple-600 px-3 py-1 rounded-full text-xs font-bold"><?= $num ?></span>
                                <?php endforeach; ?>
                                <?php if($max > 20) echo '<span class="text-gray-400 text-xs self-center">...</span>'; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Looping<br>Logic 01</h3>
                    <p class="text-purple-100 mb-8 font-light leading-relaxed">
                        โปรแกรมจะทำการวนลูปตรวจสอบตัวเลขตั้งแตลำดับที่ 1 จนถึงค่าที่คุณระบุ เพื่อคัดกรองเฉพาะเลขคู่แล้วนำมาหาผลรวมทั้งหมด
                    </p>
                    <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                        <div class="flex items-center space-x-3 text-sm">
                            <div class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></div>
                            <span>Condition: ($i % 2 == 0)</span>
                        </div>
                        <div class="mt-2 text-xs opacity-70 font-mono">
                            for ($i=1; $i<=$n; $i++) { ... }
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