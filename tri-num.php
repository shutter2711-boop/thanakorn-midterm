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
        .code-font { font-family: 'Courier New', Courier, monospace; }
    </style>
</head>
<body class="bg-transparent p-4 md:p-10">

    <div class="max-w-5xl mx-auto flex flex-col md:flex-row shadow-2xl rounded-[2rem] overflow-hidden border border-white/20">
        
        <div class="w-full md:w-1/2 bg-white/90 p-8 lg:p-12 border-r border-gray-100">
            <div class="flex items-center space-x-3 mb-8">
                <div class="bg-indigo-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-indigo-200">
                    2.4
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">สร้างสามเหลี่ยมตัวเลข</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">จำนวนแถวที่ต้องการ (1-15):</label>
                    <input type="number" name="rows" required min="1" max="15" placeholder="ตัวอย่าง: 5"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none transition-all duration-300 text-xl font-bold text-center">
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" name="generate" 
                        class="flex-[2] bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-indigo-100 transition-all active:scale-95 flex justify-center items-center">
                        สร้างรูปแบบตัวเลข
                    </button>
                    <a href="tri-num.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        รีเซ็ต
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-indigo-600 via-purple-600 to-pink-500 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['generate'])) {
                $rows = intval($_POST['rows']);
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-black italic tracking-widest uppercase">Number Triangle</h3>
                        <p class="text-indigo-100 text-sm mt-1">จำนวนที่กำหนด: <?= $rows ?> แถว</p>
                    </div>

                    <div class="glass-inner rounded-[2rem] p-8 shadow-2xl text-center">
                        <div class="code-font text-indigo-800 text-xl md:text-2xl font-bold leading-relaxed tracking-widest">
                            <?php
                            // Nested Loop Logic
                            for ($i = 1; $i <= $rows; $i++) {
                                for ($j = 1; $j <= $i; $j++) {
                                    echo $j . " ";
                                }
                                echo "<br>";
                            }
                            ?>
                        </div>
                    </div>
                    <p class="text-center text-[10px] text-white/50 mt-6 uppercase tracking-widest font-bold italic">Generation Complete</p>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Nested Loop<br>Visualization</h3>
                    <p class="text-indigo-100 mb-8 font-light leading-relaxed">
                        โปรแกรมจะใช้ลูปซ้อนลูปเพื่อสร้างโครงสร้างสามเหลี่ยม โดยลูปนอก (Outer Loop) ควบคุมจำนวนแถว และลูปใน (Inner Loop) ควบคุมจำนวนตัวเลขในแต่ละแถว
                    </p>
                    <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                        <div class="flex items-center space-x-3 text-sm">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full animate-pulse"></div>
                            <span class="font-mono">for($i=1; $i<=$rows; $i++)</span>
                        </div>
                        <div class="ml-5 mt-1 flex items-center space-x-3 text-sm opacity-80">
                            <div class="w-1.5 h-1.5 bg-blue-300 rounded-full"></div>
                            <span class="font-mono text-xs">for($j=1; $j<=$i; $j++)</span>
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