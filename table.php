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
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d8b4fe; border-radius: 10px; }
    </style>
</head>
<body class="bg-transparent p-4 md:p-10">

    <div class="max-w-5xl mx-auto flex flex-col md:flex-row shadow-2xl rounded-[2rem] overflow-hidden border border-white/20">
        
        <div class="w-full md:w-1/2 bg-white/90 p-8 lg:p-12 border-r border-gray-100">
            <div class="flex items-center space-x-3 mb-8">
                <div class="bg-purple-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-purple-200">
                    2.3
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">สูตรคูณอัตโนมัติ</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ต้องการสูตรคูณแม่:</label>
                    <input type="number" name="base_num" required min="1" max="999" placeholder="ตัวอย่าง: 12"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 outline-none transition-all duration-300 text-xl font-bold text-center">
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" name="generate" 
                        class="flex-[2] bg-gradient-to-r from-purple-600 to-indigo-600 hover:from-purple-700 hover:to-indigo-800 text-white font-bold py-4 rounded-2xl shadow-xl shadow-purple-100 transition-all active:scale-95 flex justify-center items-center">
                        สร้างแม่สูตรคูณ
                    </button>
                    <a href="table.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        รีเซ็ต
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-purple-600 via-indigo-600 to-blue-700 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['generate'])) {
                $base = intval($_POST['base_num']);
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-black italic tracking-widest uppercase">Multiplication</h3>
                        <p class="text-purple-100 text-sm mt-1">แม่สูตรคูณคณิตศาสตร์: <?= $base ?></p>
                    </div>

                    <div class="glass-inner rounded-[2rem] p-6 shadow-2xl max-h-[400px] overflow-y-auto custom-scrollbar">
                        <table class="w-full text-gray-800 text-lg">
                            <tbody class="divide-y divide-purple-100">
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                <tr class="hover:bg-purple-50/50 transition">
                                    <td class="py-2 text-right pr-4 font-mono text-gray-400"><?= $base ?></td>
                                    <td class="py-2 text-center text-purple-400">×</td>
                                    <td class="py-2 text-left pl-4 font-mono text-gray-400"><?= $i ?></td>
                                    <td class="py-2 text-center font-bold text-purple-600 group">=</td>
                                    <td class="py-2 text-right font-black text-indigo-700"><?= number_format($base * $i) ?></td>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-center text-[10px] text-white/50 mt-4 uppercase tracking-tighter italic">End of Table</p>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Table<br>Generator</h3>
                    <p class="text-purple-100 mb-8 font-light leading-relaxed">
                        โปรแกรมจะใช้คำสั่ง For Loop เพื่อประมวลผลการคูณตั้งแต่ลำดับที่ 1 ถึง 12 โดยอัตโนมัติ พร้อมแสดงผลลัพธ์ในรูปแบบตารางที่อ่านง่าย
                    </p>
                    <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                        <div class="flex items-center space-x-3 text-sm">
                            <div class="w-2 h-2 bg-pink-400 rounded-full animate-pulse"></div>
                            <span>Logic: $base * $i (1 to 12)</span>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
    </style>
</body>
</html>