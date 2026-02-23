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
        /* ใช้ font ที่ความกว้างตัวอักษรเท่ากันเพื่อให้พีระมิดไม่เบี้ยว */
        .monospace-font { font-family: 'Courier New', Courier, monospace; white-space: pre; }
    </style>
</head>
<body class="bg-transparent p-4 md:p-10">

    <div class="max-w-5xl mx-auto flex flex-col md:flex-row shadow-2xl rounded-[2rem] overflow-hidden border border-white/20">
        
        <div class="w-full md:w-1/2 bg-white/90 p-8 lg:p-12 border-r border-gray-100">
            <div class="flex items-center space-x-3 mb-8">
                <div class="bg-purple-600 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-purple-200">
                    2.5
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">สร้างรูปดาวพีระมิด</h2>
            </div>

            <form method="POST" class="space-y-6">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ความสูงของพีระมิด (1-20):</label>
                    <input type="number" name="levels" required min="1" max="20" placeholder="ตัวอย่าง: 10"
                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-purple-500/10 focus:border-purple-500 outline-none transition-all duration-300 text-xl font-bold text-center">
                </div>

                <div class="flex flex-col sm:flex-row gap-3">
                    <button type="submit" name="generate" 
                        class="flex-[2] bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-700 hover:to-pink-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-purple-100 transition-all active:scale-95 flex justify-center items-center">
                        สร้างพีระมิด
                    </button>
                    <a href="pyramid.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        ล้างค่า
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-purple-600 via-pink-600 to-rose-500 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['generate'])) {
                $levels = intval($_POST['levels']);
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <h3 class="text-3xl font-black italic tracking-widest uppercase">Star Pyramid</h3>
                        <p class="text-purple-100 text-sm mt-1">ขนาดที่สร้าง: <?= $levels ?> ชั้น</p>
                    </div>

                    <div class="glass-inner rounded-[2rem] p-8 shadow-2xl text-center overflow-x-auto">
                        <div class="monospace-font text-purple-800 text-lg font-bold leading-tight">
                            <?php
                            for ($i = 1; $i <= $levels; $i++) {
                                // ลูปพิมพ์ช่องว่างด้านหน้า
                                for ($j = $i; $j < $levels; $j++) {
                                    echo " ";
                                }
                                // ลูปพิมพ์ดาว
                                for ($k = 1; $k <= (2 * $i - 1); $k++) {
                                    echo "*";
                                }
                                echo "\n"; // ใช้ \n ร่วมกับ white-space: pre
                            }
                            ?>
                        </div>
                    </div>
                    <p class="text-center text-[10px] text-white/50 mt-6 uppercase tracking-widest font-bold italic">Rendered Successfully</p>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic uppercase leading-tight">Pyramid<br>Algorithm</h3>
                    <p class="text-purple-100 mb-8 font-light leading-relaxed">
                        การสร้างพีระมิดใช้เทคนิคการซ้อนลูป 3 ชั้น: ลูปนอกสุดควบคุมชั้น, ลูปที่สองควบคุมช่องว่างด้านหน้า และลูปที่สามควบคุมจำนวนดาวในแต่ละชั้น
                    </p>
                    <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                        <div class="flex items-center space-x-3 text-sm">
                            <div class="w-2 h-2 bg-pink-300 rounded-full animate-pulse"></div>
                            <span class="font-mono text-xs italic">Logic: (2 * $i) - 1 stars per row</span>
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