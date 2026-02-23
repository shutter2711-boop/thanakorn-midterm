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
                <div class="bg-cyan-500 text-white w-10 h-10 rounded-2xl flex items-center justify-center font-bold shadow-lg shadow-cyan-200">
                    1.3
                </div>
                <h2 class="text-2xl font-extrabold text-gray-800 tracking-tight">คำนวณค่าไฟฟ้า</h2>
            </div>

            <form method="POST" class="space-y-5">
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">ประเภทผู้ใช้ไฟฟ้า</label>
                    <select name="type" class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 outline-none transition-all appearance-none cursor-pointer">
                        <option value="home">บ้านอยู่อาศัย</option>
                        <option value="business">ธุรกิจขนาดเล็ก</option>
                    </select>
                </div>

                <div class="group">
                    <label class="block text-sm font-semibold text-gray-600 mb-2 ml-1">จำนวนหน่วยที่ใช้ (Unit)</label>
                    <input type="number" name="unit" required placeholder="เช่น 250"
                        class="w-full px-5 py-3 rounded-2xl border border-gray-100 bg-gray-50/50 focus:bg-white focus:ring-4 focus:ring-cyan-500/10 focus:border-cyan-500 outline-none transition-all duration-300">
                </div>

                <div class="flex flex-col sm:flex-row gap-3 pt-4">
                    <button type="submit" name="calculate" 
                        class="flex-[2] bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold py-4 rounded-2xl shadow-xl shadow-cyan-100 transition-all active:scale-95 flex justify-center items-center">
                        คำนวณค่าไฟ
                    </button>
                    <a href="elec.php" 
                        class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 font-bold py-4 rounded-2xl transition-all text-center">
                        รีเซ็ต
                    </a>
                </div>
            </form>
        </div>

        <div class="w-full md:w-1/2 bg-gradient-to-br from-cyan-500 via-blue-500 to-indigo-600 p-8 lg:p-12 text-white flex items-center">
            
            <?php
            if (isset($_POST['calculate'])) {
                $unit = floatval($_POST['unit']);
                $type = $_POST['type'];
                $price_per_unit = ($type == "home") ? 3.5 : 4.5;
                $service_fee = ($type == "home") ? 38.22 : 46.16;
                
                $energy_charge = $unit * $price_per_unit;
                $vat = ($energy_charge + $service_fee) * 0.07;
                $total_amount = $energy_charge + $service_fee + $vat;
            ?>
                <div class="w-full animate-[fadeIn_0.5s_ease-out]">
                    <div class="text-center mb-6">
                        <span class="px-4 py-1 bg-white/20 rounded-full text-xs font-bold tracking-widest uppercase">Electricity Bill</span>
                    </div>
                    <div class="glass-inner rounded-3xl p-6 space-y-4 text-gray-800 shadow-xl">
                        <div class="flex justify-between border-b border-gray-200/50 pb-2">
                            <span class="text-gray-500">ประเภท:</span>
                            <span class="font-bold"><?= ($type == "home" ? "บ้านอยู่อาศัย" : "ธุรกิจขนาดเล็ก") ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 font-medium">ค่าพลังงานไฟฟ้า:</span>
                            <span class="font-semibold"><?= number_format($energy_charge, 2) ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500 font-medium">ค่าบริการรายเดือน:</span>
                            <span class="font-semibold"><?= number_format($service_fee, 2) ?></span>
                        </div>
                        <div class="flex justify-between text-blue-600">
                            <span class="font-medium">ภาษีมูลค่าเพิ่ม (7%):</span>
                            <span class="font-semibold">+ <?= number_format($vat, 2) ?></span>
                        </div>
                        <div class="pt-4 border-t border-cyan-100 text-center">
                            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-1">ยอดชำระสุทธิ</p>
                            <p class="text-5xl font-black text-cyan-600"><?= number_format($total_amount, 2) ?> <span class="text-xl">฿</span></p>
                        </div>
                    </div>
                </div>
            <?php } else { ?>
                <div class="w-full">
                    <h3 class="text-3xl font-black mb-6 italic">ELECTRICITY<br>BILLING</h3>
                    <div class="space-y-4">
                        <div class="bg-white/10 p-5 rounded-3xl border border-white/20">
                            <h4 class="font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                อัตราค่าบริการ
                            </h4>
                            <ul class="text-sm space-y-2 opacity-90">
                                <li class="flex justify-between"><span>บ้านอยู่อาศัย:</span> <span>3.50.- / หน่วย</span></li>
                                <li class="flex justify-between"><span>ธุรกิจขนาดเล็ก:</span> <span>4.50.- / หน่วย</span></li>
                            </ul>
                        </div>
                        <p class="text-xs font-light opacity-70 leading-relaxed pl-2">
                            * คำนวณรวมค่าบริการรายเดือนและภาษีมูลค่าเพิ่ม 7% อ้างอิงตามมาตรฐานการไฟฟ้า
                        </p>
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