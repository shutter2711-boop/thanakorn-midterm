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
                <div class="bg-rose-500 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-rose-200">
                    1.2
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">คำนวณภาษีรถยนต์</h2>
            </div>

            <form method="POST" class="space-y-5">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ขนาด CC ของรถยนต์</label>
                    <input type="number" name="cc" required placeholder="กรอกจำนวน CC"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 outline-none transition-all duration-300">
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ประเภทของรถยนต์</label>
                    <select name="type" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 outline-none transition-all appearance-none cursor-pointer">
                        <option value="private">รถยนต์ส่วนบุคคล</option>
                        <option value="truck">รถกระบะ</option>
                    </select>
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">อายุของรถยนต์ (ปี)</label>
                    <input type="number" name="age" required placeholder="กรอกอายุรถยนต์"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-rose-500/10 focus:border-rose-500 outline-none transition-all duration-300">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" name="calculate" 
                        class="flex-[2] bg-gradient-to-r from-rose-500 to-pink-600 hover:from-rose-600 hover:to-pink-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-rose-100 transition-all active:scale-95 flex justify-center items-center">
                        คำนวณภาษี
                    </button>
                    <a href="tax.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        รีเซ็ต
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-rose-500 via-orange-500 to-amber-500 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['calculate'])) {
                $cc = intval($_POST['cc']);
                $type = $_POST['type'];
                $age = intval($_POST['age']);
                $base_tax = 0;

                // Logic คำนวณตาม CC และประเภท
                if ($type == "private") {
                    if ($cc <= 1500) $base_tax = 500;
                    elseif ($cc <= 2000) $base_tax = 1000;
                    else $base_tax = 1500;
                } else { // รถกระบะ
                    if ($cc <= 1500) $base_tax = 400;
                    elseif ($cc <= 2000) $base_tax = 800;
                    else $base_tax = 1200;
                }

                // Logic ส่วนลดตามอายุรถ
                $discount_percent = 0;
                if ($age > 10) $discount_percent = 20;
                elseif ($age > 5) $discount_percent = 10;

                $discount_amount = ($base_tax * $discount_percent) / 100;
                $final_tax = $base_tax - $discount_amount;
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <h3 class="text-3xl font-black text-center mb-8 italic uppercase tracking-widest">Tax Invoice</h3>
                    <div class="glass-inner rounded-3xl p-6 space-y-4 text-gray-800 shadow-xl">
                        <div class="flex justify-between border-b border-gray-200/50 pb-2">
                            <span class="text-gray-500">ประเภทรถ:</span>
                            <span class="font-bold"><?= ($type == "private" ? "รถส่วนบุคคล" : "รถกระบะ") ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">ภาษีพื้นฐาน:</span>
                            <span class="font-semibold"><?= number_format($base_tax, 2) ?> บาท</span>
                        </div>
                        <div class="flex justify-between text-rose-500">
                            <span class="font-medium">ส่วนลด (<?= $discount_percent ?>%):</span>
                            <span class="font-semibold">- <?= number_format($discount_amount, 2) ?> บาท</span>
                        </div>
                        <div class="pt-4 border-t border-rose-100 text-center">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">ยอดที่ต้องชำระสุทธิ</p>
                            <p class="text-5xl font-black text-rose-600"><?= number_format($final_tax, 2) ?> <span class="text-xl">฿</span></p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic">CAR TAX<br>SYSTEM</h3>
                    <div class="space-y-6 text-sm font-light">
                        <div class="bg-white/10 p-4 rounded-2xl border-l-4 border-white">
                            <p class="font-bold mb-2">เงื่อนไข CC รถยนต์:</p>
                            <ul class="opacity-90 space-y-1">
                                <li>• ส่วนบุคคล: ≤1500 (500.-), ≤2000 (1000.-), >2000 (1500.-)</li>
                                <li>• รถกระบะ: ≤1500 (400.-), ≤2000 (800.-), >2000 (1200.-)</li>
                            </ul>
                        </div>
                        <div class="bg-black/10 p-4 rounded-2xl">
                            <p class="font-bold mb-1">ส่วนลดตามอายุการใช้งาน:</p>
                            <p class="opacity-80">มากกว่า 5 ปี ลด 10% | มากกว่า 10 ปี ลด 20%</p>
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