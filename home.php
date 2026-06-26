<?php session_start(); ?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>วิทยาลัยการอาชีพกุมภวาปี</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Prompt', sans-serif; background-color: #f0f4f8; color: #1a1a2e; }

        /* ===== HEADER ===== */
        header { background: #002d4a; color: #fff; position: sticky; top: 0; z-index: 100; box-shadow: 0 2px 12px rgba(0,0,0,0.3); }
        .header-top { max-width: 1280px; margin: auto; padding: 14px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px; }
        .header-brand { display: flex; align-items: center; gap: 16px; }
        .header-brand img { width: 64px; height: 64px; object-fit: contain; }
        .header-brand h1 { font-size: 1.5rem; font-weight: 700; color: #f5c842; line-height: 1.2; }
        .header-brand p { font-size: 0.75rem; color: #c8d8e8; letter-spacing: 0.03em; }
        .header-contact { display: flex; flex-wrap: wrap; gap: 20px; font-size: 0.85rem; color: #c8d8e8; }
        .header-contact a { color: #fff; text-decoration: none; }
        .header-contact a:hover { text-decoration: underline; }
        .header-contact span { display: flex; align-items: center; gap: 8px; }
        .header-contact i { color: #f97316; }

        /* ===== NAVBAR ===== */
        .navbar { background: #ff9800; border-top: 1px solid rgba(0,45,74,0.2); }
        .navbar-inner { max-width: 1280px; margin: auto; display: flex; align-items: stretch; }
        .nav-link, .nav-dropdown > button {
            color: #002d4a; font-weight: 600; font-size: 0.88rem;
            padding: 14px 18px; border: none; background: none; cursor: pointer;
            display: flex; flex-direction: column; align-items: center; justify-content: center;
            white-space: nowrap; transition: background 0.2s; text-decoration: none;
        }
        .nav-link:hover, .nav-dropdown > button:hover { background: rgba(0,0,0,0.1); }
        .nav-link.active, .nav-link-home { background: #002d4a; color: #fff; }
        .nav-link-home:hover { background: #003a5e; }
        .nav-sub { font-size: 0.68rem; opacity: 0.65; font-weight: 400; margin-top: 2px; }

        /* Dropdown */
        .nav-dropdown { position: relative; }
        .dropdown-menu {
            position: absolute; left: 0; top: 100%; min-width: 260px; background: #fff;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15); border-top: 3px solid #002d4a;
            opacity: 0; visibility: hidden; transition: opacity 0.2s, visibility 0.2s;
            z-index: 200;
        }
        .nav-dropdown:hover .dropdown-menu { opacity: 1; visibility: visible; }
        .dropdown-item {
            display: flex; align-items: center; justify-content: space-between; gap: 10px;
            padding: 12px 18px; color: #002d4a; text-decoration: none; font-size: 0.85rem;
            font-weight: 500; border-bottom: 1px dashed #e5e7eb; transition: background 0.15s;
        }
        .dropdown-item:last-child { border-bottom: none; }
        .dropdown-item:hover { background: #fff7ed; }
        .dropdown-item i { color: #002d4a; font-size: 0.9rem; flex-shrink: 0; }

        /* Sub-dropdown (2nd level) */
        .sub-dropdown { position: relative; }
        .sub-dropdown:hover .sub-menu { opacity: 1; visibility: visible; }
        .sub-menu {
            position: absolute; left: 100%; top: 0; min-width: 280px; background: #fff;
            box-shadow: 0 8px 24px rgba(0,0,0,0.15); border-left: 3px solid #ff9800;
            opacity: 0; visibility: hidden; transition: opacity 0.15s, visibility 0.15s;
            z-index: 300;
        }

        /* Register button */
        .nav-register {
            background: linear-gradient(135deg, #c0392b, #e74c3c); color: #fff;
            padding: 14px 20px; font-weight: 700; font-size: 0.85rem;
            display: flex; align-items: center; gap: 8px;
            text-decoration: none; white-space: nowrap; margin-left: auto;
            transition: filter 0.2s;
        }
        .nav-register:hover { filter: brightness(1.15); }

        /* ===== POPUP ===== */
        #popup {
            position: fixed; inset: 0; z-index: 9999;
            background: rgba(0,0,0,0.82); display: flex;
            flex-direction: column; justify-content: center; align-items: center; padding: 20px;
        }
        #popup img { max-width: 100%; max-height: 78vh; object-fit: contain; border: 3px solid #ccc; border-radius: 6px; }
        #popup button {
            margin-top: 18px; background: #002d4a; color: #ccc;
            padding: 10px 32px; border: 1px solid #ccc; border-radius: 6px;
            cursor: pointer; font-family: 'Prompt', sans-serif; font-size: 0.9rem;
            transition: background 0.2s;
        }
        #popup button:hover { background: #003d63; }

        /* ===== SLIDER ===== */
        .slider-wrapper { max-width: 1280px; margin: 24px auto; padding: 0 24px; }
        .slider-container { position: relative; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .slides { display: flex; transition: transform 0.5s ease-in-out; }
        .slides img { width: 100%; flex-shrink: 0; object-fit: cover; max-height: 420px; }
        .slider-btn {
            position: absolute; top: 50%; transform: translateY(-50%);
            background: rgba(0,0,0,0.4); color: #fff; border: none; cursor: pointer;
            padding: 14px 16px; font-size: 1.2rem; transition: background 0.2s; z-index: 10;
        }
        .slider-btn:hover { background: rgba(0,0,0,0.75); }
        .slider-btn.prev { left: 0; border-radius: 0 6px 6px 0; }
        .slider-btn.next { right: 0; border-radius: 6px 0 0 6px; }
        .slider-dots { text-align: center; margin-top: 10px; display: flex; justify-content: center; gap: 8px; }
        .dot { width: 10px; height: 10px; border-radius: 50%; background: #ccc; cursor: pointer; transition: background 0.2s; }
        .dot.active { background: #002d4a; }

        /* ===== QUICK LINKS ===== */
        .quick-links { max-width: 1280px; margin: 20px auto; padding: 0 24px; display: flex; gap: 14px; flex-wrap: wrap; }
        .quick-link-card {
            border: 2px solid #002d4a; border-radius: 8px; overflow: hidden;
            transition: transform 0.2s, box-shadow 0.2s; display: block;
        }
        .quick-link-card:hover { transform: translateY(-4px); box-shadow: 0 8px 20px rgba(0,45,74,0.2); }
        .quick-link-card img { width: 200px; height: 200px; object-fit: cover; display: block; }

        /* ===== ABOUT SECTION ===== */
        .about-section { max-width: 1280px; margin: 28px auto; padding: 0 24px; }
        .about-card {
            background: #fff; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            display: flex; gap: 0; overflow: hidden;
        }
        .about-image { flex: 1; min-height: 360px; position: relative; }
        .about-image img { width: 100%; height: 100%; object-fit: cover; display: block; }
        .about-image-overlay {
            position: absolute; bottom: 0; left: 0; right: 0;
            background: linear-gradient(to top, rgba(0,45,74,0.85), transparent);
            padding: 20px; color: #fff;
        }
        .about-text { flex: 1; padding: 36px; display: flex; flex-direction: column; justify-content: center; background: #002d4a; }
        .about-text h2 { color: #f5c842; font-size: 1.3rem; font-weight: 700; margin-bottom: 20px; line-height: 1.5; }
        .about-text p {
            color: #c8d8e8; font-size: 0.92rem; line-height: 1.9;
            margin-bottom: 16px; text-indent: 2em; text-align: justify;
        }
        .about-text p:last-child { margin-bottom: 0; }

        /* ===== NEWS STRIP ===== */
        .news-strip { background: #002d4a; color: #fff; padding: 10px 0; overflow: hidden; }
        .news-strip-inner { display: flex; align-items: center; max-width: 1280px; margin: auto; padding: 0 24px; gap: 16px; }
        .news-label { background: #f5c842; color: #002d4a; font-weight: 700; font-size: 0.8rem; padding: 4px 12px; border-radius: 4px; white-space: nowrap; }
        .news-ticker { overflow: hidden; flex: 1; }
        .news-ticker-inner { display: flex; animation: ticker 25s linear infinite; gap: 60px; width: max-content; }
        .news-ticker-inner:hover { animation-play-state: paused; }
        .news-ticker-inner span { white-space: nowrap; font-size: 0.88rem; color: #d0e8ff; }
        @keyframes ticker { 0% { transform: translateX(0); } 100% { transform: translateX(-50%); } }

        /* ===== FOOTER ===== */
        footer { background: #002d4a; color: #8aa8c0; text-align: center; padding: 20px 24px; font-size: 0.8rem; margin-top: 40px; border-top: 3px solid #f5c842; }
        footer a { color: #f5c842; text-decoration: none; }
        footer a:hover { text-decoration: underline; }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 900px) {
            .about-card { flex-direction: column; }
            .about-image { min-height: 220px; }
            .quick-link-card img { width: 140px; height: 140px; }
            .navbar-inner { flex-wrap: wrap; }
        }
        @media (max-width: 640px) {
            .header-top { flex-direction: column; align-items: flex-start; }
            .header-brand h1 { font-size: 1.1rem; }
            .slider-wrapper, .quick-links, .about-section { padding: 0 12px; }
            .about-text { padding: 20px; }
        }
    </style>
</head>
<body class="min-h-screen flex flex-col">

    <!-- ===== HEADER ===== -->
    <header class="bg-[#002d4a] text-white w-full shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex flex-col lg:flex-row justify-between items-center gap-6">
            <div class="flex items-center gap-4">
                <img src="images/kpic-logo.png" alt="โลโก้วิทยาลัยการอาชีพกุมภวาปี" class="w-16 h-16 object-contain flex-shrink-0">
                <div>
                    <h1 class="text-2xl font-bold text-yellow-400 tracking-wide leading-tight">วิทยาลัยการอาชีพกุมภวาปี</h1>
                    <p class="text-sm font-semibold tracking-wider text-gray-200">Kumphawapi Industrial and Community Education College</p>
                </div>
            </div>
            <div class="flex flex-wrap items-center gap-6 text-sm">
                <div class="flex items-center gap-2 text-gray-200">
                    <i class="fas fa-phone-alt text-pink-500 text-lg"></i>
                    <span>โทรศัพท์ : <a href="mailto:042-334455" class="text-white hover:underline">042-339744</a></span>
                </div>
                <div class="flex items-center gap-2 text-gray-200">
                    <i class="fas fa-envelope text-pink-500 text-lg"></i>
                    <span>อีเมล์ : <a href="mailto:krucoconut.vecskill@gmail.com" class="text-white hover:underline">krucoconut.vecskill@gmail.com</a></span>
                </div>
            </div>
        </div>

        <!-- ===== NAVIGATION ===== -->
        <div class="w-full bg-[#ff9800] border-t border-[#002d4a]/20 shadow-inner">
            <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-stretch">
                <nav class="flex flex-wrap flex-1 text-sm font-medium">

                    <a href="home.php" class="bg-[#0a2333] text-white px-6 py-4 flex flex-col justify-center items-center hover:bg-[#002d4a] transition min-w-[100px]">
                        <span class="text-base font-bold">หน้าหลัก</span>
                        <span class="text-[10px] opacity-60">Home</span>
                    </a>

                    <!-- เกี่ยวกับเรา -->
                    <div class="relative group">
                        <button class="text-[#002d4a] hover:bg-white/10 px-5 py-4 h-full flex flex-col justify-center items-center transition">
                            <span class="font-bold flex items-center gap-1">เกี่ยวกับเรา <i class="fas fa-chevron-down text-[10px] pt-1 transition-transform group-hover:rotate-180"></i></span>
                            <span class="text-[10px] text-[#002d4a]/70">About Us</span>
                        </button>
                        <div class="absolute left-0 top-full w-96 bg-white shadow-xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50 border-t-2 border-[#002d4a]">
                            <div class="py-1 text-[#002d4a] divide-y divide-gray-200 divide-dashed">
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ข้อมูลสถานศึกษา</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">วิสัยทัศน์และพันธกิจ</span></a>
                                <a href="executive_committee.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">คณะผู้บริหาร</span></a>
                                <a href="2.Educational personnel.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">บุคลากรทางการศึกษา</span></a>
                                <a href="2.Organizational structure.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">โครงสร้างองค์กร</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">แผนปฏิบัติงานประจำปี/สรุปแผนงาน</span></a>
                            </div>
                        </div>
                    </div>

                    <!-- สาขาวิชา -->
                    <div class="relative group">
                        <button class="text-[#002d4a] hover:bg-white/10 px-5 py-4 h-full flex flex-col justify-center items-center transition">
                            <span class="font-bold flex items-center gap-1">สาขาวิชา <i class="fas fa-chevron-down text-[10px] pt-1 transition-transform group-hover:rotate-180"></i></span>
                            <span class="text-[10px] text-[#002d4a]/70">Faculty</span>
                        </button>
                        <div class="absolute left-0 top-full w-80 bg-white shadow-xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50 border-t-2 border-[#002d4a]">
                            <div class="py-1 text-[#002d4a] divide-y divide-gray-100 divide-dashed">
                                <div class="relative [&_>_div]:hover:visible [&_>_div]:hover:opacity-100">
                                    <a href="#" class="flex items-center justify-between px-4 py-3 hover:bg-orange-50 font-medium transition-colors">
                                        <span class="flex items-center gap-2"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i>ประเภทวิชาอุสาหกรรม</span>
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </a>
                                    <div class="absolute left-full top-0 w-96 bg-white shadow-2xl border-l border-gray-100 invisible opacity-0 transition-all duration-150 min-h-full py-1 divide-y divide-gray-100 divide-dashed">
                                        <a href="1.Automotive Mechanics Branch.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชาช่างยนต์</a>
                                        <a href="1.Electric Vehicle Branch.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชายานยนต์ไฟฟ้า</a>
                                        <a href="1.Factory Mechanics Branch.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชาช่างกลโรงงาน</a>
                                        <a href="1.Welding Technology Branch.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชาช่างเชื่อมโลหะ</a>
                                        <a href="1.Electrical Power Engineering Branch.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชาช่างไฟฟ้ากำลัง</a>
                                        <a href="1.Electronics Technician Branch.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชาช่างอิเล็กทรอนิกส์</a>
                                    </div>
                                </div>

                                <div class="relative [&_>_div]:hover:visible [&_>_div]:hover:opacity-100">
                                    <a href="#" class="flex items-center justify-between px-4 py-3 hover:bg-orange-50 font-medium transition-colors">
                                        <span class="flex items-center gap-2"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i>ประเภทวิชาบริหารธุรกิจ</span>
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </a>
                                    <div class="absolute left-full top-0 w-96 bg-white shadow-2xl border-l border-gray-100 invisible opacity-0 transition-all duration-150 min-h-full py-1 divide-y divide-gray-100 divide-dashed">
                                        <a href="1.Marketing Department.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาการตลาด</a>
                                        <a href="1.Accounting.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชาการบัญชี</a>
                                        <a href="1.Department of Foreign Languages.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาวิชาภาษาต่างประเทศบริหารธุรกิจ</a>
                                    </div>
                                </div>

                                <div class="relative [&_>_div]:hover:visible [&_>_div]:hover:opacity-100">
                                    <a href="#" class="flex items-center justify-between px-4 py-3 hover:bg-orange-50 font-medium transition-colors">
                                        <span class="flex items-center gap-2"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i>ประเภทวิชาอุสาหกรรมดิจิทัลและเทคโนโลยีสารสนเทศ</span>
                                        <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                                    </a>
                                    <div class="absolute left-full top-0 w-96 bg-white shadow-2xl border-l border-gray-100 invisible opacity-0 transition-all duration-150 min-h-full py-1 divide-y divide-gray-100 divide-dashed">
                                        <a href="1.Information Technology Department.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาเทคโนโลยีสารสนเทศ</a>
                                        <a href="1.Digital Business Technology Branch.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> สาขาเทคโนโลยีธุรกิจดิจิทัล</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="text-[#002d4a] hover:bg-white/10 px-5 py-4 flex flex-col justify-center items-center transition">
                        <span class="font-bold">หลักสูตร</span>
                        <span class="text-[10px] text-[#002d4a]/70">Course</span>
                    </a>

                   <div class="relative group">
    <button class="text-[#002d4a] hover:bg-white/10 px-5 py-4 h-full flex flex-col justify-center items-center transition">
        <span class="font-bold flex items-center gap-1">หน่วยงาน <i class="fas fa-chevron-down text-[10px] pt-1 transition-transform group-hover:rotate-180"></i></span>
        <span class="text-[10px] text-[#002d4a]/70">Departments</span>
    </button>
    
    <div class="absolute left-0 top-full w-96 bg-white shadow-xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50 border-t-2 border-[#002d4a]">
        <div class="py-1 text-[#002d4a] divide-y divide-gray-200 divide-dashed">
            
            <div class="relative group/sub [&_>_div]:hover:visible [&_>_div]:hover:opacity-100">
                <a href="#" class="flex items-center justify-between px-5 py-3 hover:bg-orange-50 font-medium transition-colors">
                    <span class="flex items-center gap-2"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i>ฝ่ายวิชาการ</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
                <div class="absolute left-full top-0 w-96 bg-white shadow-2xl border-l border-gray-100 invisible opacity-0 transition-all duration-150 min-h-full py-1 divide-y divide-gray-100 divide-dashed">
                    <a href="academic.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานพัฒนาหลักสูตรการเรียนการสอน</a>
                    <a href="measurement_and_evaluation_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานวัดและประเมินผล</a>
                    <a href="bilateral_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานอาชีวศึกษาระบบทวิภาคีและความร่วมมือ</a>
                    <a href="academic_service.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานวิทยบริการและเทคโนโลยี</a>
                    <a href="special_education.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานการศึกษาพิเศษและความเสมอภาคทางการศึกษา</a>
                    <a href="technology_course.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานพัฒนาหลักสูตรสายเทคโนโลยีหรือสายปฏิบัติการ</a>
                </div>
            </div>

            <div class="relative group/sub [&_>_div]:hover:visible [&_>_div]:hover:opacity-100">
                <a href="#" class="flex items-center justify-between px-5 py-3 hover:bg-orange-50 font-medium transition-colors">
                    <span class="flex items-center gap-2"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i>ฝ่ายกิจการนักเรียน นักศึกษา</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
                <div class="absolute left-full top-0 w-96 bg-white shadow-2xl border-l border-gray-100 invisible opacity-0 transition-all duration-150 min-h-full py-1 divide-y divide-gray-100 divide-dashed">
                    <a href="student_activities.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานกิจกรรมนักเรียน นักศึกษา</a>
                    <a href="scout_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานลูกเสือ</a>
                    <a href="military_student_activities.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานนักศึกษาวิชาทหาร</a>
                    <a href="professional_organization_(VPO).php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานองค์การนักวิชาชีพ อวท.</a>
                    <a href="management_and_safety.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานปกครองและความปลอดภัย</a>
                    <a href="guidance_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> ครูที่ปรึกษาและการแนะแนว</a>
                    <a href="student_welfare_services.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานสวัสดิการนักเรียน นักศึกษา</a>
                    <a href="special_projects.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานโครงการพิเศษและการบริการสังคม</a>
                </div>
            </div>

            <div class="relative group/sub [&_>_div]:hover:visible [&_>_div]:hover:opacity-100">
                <a href="#" class="flex items-center justify-between px-5 py-3 hover:bg-orange-50 font-medium transition-colors">
                    <span class="flex items-center gap-2"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i>ฝ่ายยุทธศาสตร์และแผนงาน</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
                <div class="absolute left-full top-0 w-96 bg-white shadow-2xl border-l border-gray-100 invisible opacity-0 transition-all duration-150 min-h-full py-1 divide-y divide-gray-100 divide-dashed">
                    <a href="project_plans_and_budgets.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> แผนงานและงบประมาณ</a>
                    <a href="educational_quality_assurance.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานมาตรฐานและประกันคุณภาพการศึกษา</a>
                    <a href="digital_and_corporate_communications_center.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานศูนย์ดิจิทัลและสื่อสารองค์กร</a>
                    <a href="research_innovation_and_invention_promotion_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานส่งเสริมวิจัย นวัตกรรม และสิ่งประดิษฐ์</a>
                    <a href="business_promotion.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานส่งเสริมธุรกิจและการเป็นผู้ประกอบการ</a>
                    <a href="monitoring_and_evaluation_of_vocational_education.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานติดตามและประเมินผลการอาชีวศึกษา</a>
                </div>
            </div>

            <div class="relative group/sub [&_>_div]:hover:visible [&_>_div]:hover:opacity-100">
                <a href="#" class="flex items-center justify-between px-5 py-3 hover:bg-orange-50 font-medium transition-colors">
                    <span class="flex items-center gap-2"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i>ฝ่ายบริหารทรัพยากร</span>
                    <i class="fas fa-chevron-right text-xs text-gray-400"></i>
                </a>
                <div class="absolute left-full top-0 w-96 bg-white shadow-2xl border-l border-gray-100 invisible opacity-0 transition-all duration-150 min-h-full py-1 divide-y divide-gray-100 divide-dashed">
                    <a href="general_administration_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานบริหารทั่วไป</a>
                    <a href="human_resources_department.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานบริหารและพัฒนาทรัพยากรบุคคล</a>
                    <a href="finance.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานการเงิน</a>
                    <a href="accounting_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานบัญชี</a>
                    <a href="parcel_delivery.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานพัสดุ</a>
                    <a href="building_and_grounds_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานอาคารสถานที่</a>
                    <a href="registration_work.php" class="flex items-center gap-2 px-5 py-3 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-base text-[#002d4a]"></i> งานทะเบียน</a>
                </div>
            </div>

        </div>
    </div>
</div>
                    <!-- ข่าวสาร -->
                    <div class="relative group">
                        <button class="text-[#002d4a] hover:bg-white/10 px-5 py-4 h-full flex flex-col justify-center items-center transition">
                            <span class="font-bold flex items-center gap-1">ข่าวสาร <i class="fas fa-chevron-down text-[10px] pt-1 transition-transform group-hover:rotate-180"></i></span>
                            <span class="text-[10px] text-[#002d4a]/70">News</span>
                        </button>
                        <div class="absolute left-0 top-full w-96 bg-white shadow-xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50 border-t-2 border-[#002d4a]">
                            <div class="py-1 text-[#002d4a] divide-y divide-gray-200 divide-dashed">
                                <a href="5.Press Release.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ข่าวประชาสัมพันธ์</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ข่าวกิจกรรมวิทยาลัย</span></a>
                                <a href="5.Job opening announcement.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ข่าวรับสมัครงาน</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ข่าวจัดซื้อจัดจ้าง</span></a>
                            </div>
                        </div>
                    </div>

                    <!-- บริการ -->
                    <div class="relative group">
                        <button class="text-[#002d4a] hover:bg-white/10 px-5 py-4 h-full flex flex-col justify-center items-center transition">
                            <span class="font-bold flex items-center gap-1">บริการ <i class="fas fa-chevron-down text-[10px] pt-1 transition-transform group-hover:rotate-180"></i></span>
                            <span class="text-[10px] text-[#002d4a]/70">Service</span>
                        </button>
                        <div class="absolute left-0 top-full w-96 bg-white shadow-xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50 border-t-2 border-[#002d4a]">
                            <div class="py-1 text-[#002d4a] divide-y divide-gray-200 divide-dashed">
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ระบบบริหารสถานศึกษา RMS</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ระบบบริหารอาชีวศึกษา STD2018</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ระบบบริหารจัดการงานพัสดุ SPD</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">ระบบห้องสมุดออนไลน์</span></a>
                            </div>
                        </div>
                    </div>

                    <!-- ส่วนเสริม -->
                    <div class="relative group">
                        <button class="text-[#002d4a] hover:bg-white/10 px-5 py-4 h-full flex flex-col justify-center items-center transition">
                            <span class="font-bold flex items-center gap-1">ส่วนเสริม <i class="fas fa-chevron-down text-[10px] pt-1 transition-transform group-hover:rotate-180"></i></span>
                            <span class="text-[10px] text-[#002d4a]/70">Extensions</span>
                        </button>
                        <div class="absolute left-0 top-full w-96 bg-white shadow-xl invisible opacity-0 group-hover:visible group-hover:opacity-100 transition-all duration-200 z-50 border-t-2 border-[#002d4a]">
                            <div class="py-1 text-[#002d4a] divide-y divide-gray-200 divide-dashed">
                                <a href="register.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">สมัครสมาชิก (Member System)</span></a>
                                <a href="login.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">เข้าสู่ระบบ (Login System)</span></a>
                                <a href="#" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">วิดิทัศน์แนะนำวิทยาลัย (VTR)</span></a>
                                <a href="personal_data_protection_policy.php" class="flex items-center gap-3 px-5 py-3.5 hover:bg-orange-50 font-medium transition-colors"><i class="fas fa-arrow-circle-right text-xl text-[#002d4a]"></i><span class="text-sm">นโยบายคุ้มครองข้อมูลส่วนบุคคล</span></a>
                            </div>
                        </div>
                    </div>

                    <a href="ita.php" target="_blank" rel="noopener noreferrer" class="text-[#002d4a] hover:bg-white/10 px-5 py-4 flex flex-col justify-center items-center transition">
                        <span class="font-bold">ITA</span>
                        <span class="text-[10px] text-[#002d4a]/70">KPIC</span>
                    </a>

                    <a href="contact_us.php" class="text-[#002d4a] hover:bg-white/10 px-5 py-4 flex flex-col justify-center items-center transition">
                        <span class="font-bold">ติดต่อเรา</span>
                        <span class="text-[10px] text-[#002d4a]/70">Contact Us</span>
                    </a>
                </nav>

                <a href="https://std2018.vec.go.th/web/" target="_blank" rel="noopener noreferrer"
                   class="bg-gradient-to-r from-red-700 to-red-600 text-white px-6 py-4 flex items-center justify-center gap-2 hover:from-red-800 hover:to-red-700 transition font-bold whitespace-nowrap shadow-inner">
                    <i class="fas fa-graduation-cap text-lg"></i>
                    <span>ลงทะเบียนเรียน/ชำระเงิน</span>
                </a>
            </div>
        </div>
</header>

<!-- ========== POPUP ========== -->
<div id="popup">
    <img src="images/op.jpg" alt="ประกาศ / ข่าวสาร">
    <button onclick="document.getElementById('popup').style.display='none'">
        <i class="fas fa-times" style="margin-right:6px;"></i>ปิดหน้าต่างนี้
    </button>
</div>

<!-- ========== NEWS TICKER ========== -->
<div class="news-strip">
    <div class="news-strip-inner">
        <span class="news-label"><i class="fas fa-bullhorn" style="margin-right:4px;"></i>ข่าวสาร</span>
        <div class="news-ticker">
            <div class="news-ticker-inner">
                <span>📢 ประกาศรับสมัครนักเรียน นักศึกษา ประจำปีการศึกษา 2569</span>
                <span>🏆 วิทยาลัยการอาชีพกุมภวาปี ยินดีต้อนรับนักเรียนใหม่ทุกท่าน</span>
                <span>📅 กำหนดการชำระเงินค่าเล่าเรียน ภาคเรียนที่ 1/2569</span>
                <span>🎓 ขอแสดงความยินดีกับนักศึกษาที่สำเร็จการศึกษาประจำปี 2568</span>
                <!-- duplicate for seamless loop -->
                <span>📢 ประกาศรับสมัครนักเรียน นักศึกษา ประจำปีการศึกษา 2569</span>
                <span>🏆 วิทยาลัยการอาชีพกุมภวาปี ยินดีต้อนรับนักเรียนใหม่ทุกท่าน</span>
                <span>📅 กำหนดการชำระเงินค่าเล่าเรียน ภาคเรียนที่ 1/2569</span>
                <span>🎓 ขอแสดงความยินดีกับนักศึกษาที่สำเร็จการศึกษาประจำปี 2569</span>
            </div>
        </div>
    </div>
</div>

<!-- ========== SLIDER ========== -->
<div class="slider-wrapper">
    <div class="slider-container">
        <div class="slides" id="slides">
            <img src="images2/24.6.69.png" alt="แบนเนอร์ 1">
            <img src="images2/17.6.69.png" alt="แบนเนอร์ 2">
            <img src="images2/ita1.png" alt="แบนเนอร์ 3">
        </div>
        <button class="slider-btn prev" onclick="moveSlide(-1)" aria-label="ก่อนหน้า">&#10094;</button>
        <button class="slider-btn next" onclick="moveSlide(1)" aria-label="ถัดไป">&#10095;</button>
    </div>
    <div class="slider-dots" id="dots"></div>
</div>

<!-- ========== QUICK LINKS ========== -->
 
<div class="quick-links flex flex-wrap justify-center items-center gap-4">
    <a href="https://std2018.vec.go.th/web/" target="_blank" class="quick-link-card block">
        <img src="images2/ST02.png" alt="ระบบบริหารอาชีวศึกษา STD2018" class="mx-auto">
    </a>
    <a href="login.php" target="_blank" class="quick-link-card block">
        <img src="images2/RMS2026.png" alt="ระบบบริหารสถานศึกษา RMS" class="mx-auto">
    </a>
    <a href="ita.php" target="_blank" class="quick-link-card block">
        <img src="images2/ITA2568.png" alt="ITA 2568" class="mx-auto">
    </a>
    <a href="#" target="_blank" class="quick-link-card block">
        <img src="images2/OVT.png" alt="OVT" class="mx-auto">
    </a>
    <a href="https://slfpre-approve.studentloan.or.th/studentloan-portal/" target="_blank" class="quick-link-card block">
        <img src="images2/kys.png" alt="OVT" class="mx-auto">
    </a>
</div>

<!-- ========== ABOUT SECTION ========== -->
<div class="about-section">
    <div class="about-card">
        <div class="about-image">
            <img src="#" alt="วิทยาลัยการอาชีพกุมภวาปี">
            <div class="about-image-overlay">
                <p style="font-size:0.85rem; color:#f5c842; font-weight:600;">📍 วิทยาลัยการอาชีพกุมภวาปี จ.อุดรธานี</p>
            </div>
        </div>
        <div class="about-text">
            <h2>วิทยาลัยการอาชีพกุมภวาปี : เส้นทางสู่การมีงานทำและอนาคตที่มั่นคง</h2>
            <p>วิทยาลัยการอาชีพกุมภวาปี เป็นสถาบันที่มุ่งเน้นการสร้างคนให้มีทักษะตรงกับความต้องการของตลาดแรงงาน ภายใต้แนวคิด "คิดดี มีงานทำ" โดยการเรียนการสอนของที่นี่ไม่ได้จำกัดอยู่แค่การท่องจำทฤษฎีในห้องเรียน แต่เน้นให้นักศึกษาได้ลงมือปฏิบัติจริง ออกไปเผชิญและแก้ปัญหาในสถานประกอบการ เพื่อให้พร้อมสำหรับการทำงานในชีวิตจริง</p>
            <p>จุดเด่นสำคัญของวิทยาลัยคือการมีหลักสูตรที่ตอบโจทย์ทั้งยุคเก่าและยุคใหม่ ครอบคลุมตั้งแต่สายงานอุตสาหกรรม บริหารธุรกิจ ไปจนถึงเทคโนโลยีดิจิทัลและปัญญาประดิษฐ์ (AI) นอกจากนี้ทางวิทยาลัยยังมีระบบทวิภาคีที่เปิดโอกาสให้นักศึกษาได้ทำงานระหว่างเรียน มีรายได้ช่วยแบ่งเบาภาระครอบครัว และมีประสบการณ์ก่อนใคร</p>
            <p>เป้าหมายของวิทยาลัยคือการการันตีว่าทุกคนที่จบออกไปมีงานทำ มีทักษะชีวิตที่ดี และกลายเป็นกำลังสำคัญในการพัฒนาประเทศและชุมชนอย่างยั่งยืน</p>
        </div>
    </div>
</div>

<br>

<div class="p-6">
    <div class="max-w-7xl mx-auto flex flex-col md:flex-row gap-6">
        <div class="w-full md:w-1/4 flex flex-col items-center text-center">
            <div class="bg-gray-200 rounded-3xl overflow-hidden shadow-sm aspect-[3/4] w-full flex items-center justify-center border border-gray-300">
                <img src="images/vichit.png" alt="Profile Image" class="w-full h-full object-cover">
            </div>
            <h2 class="text-2xl font-bold mt-4 text-gray-800">นายวิชิต ธรรมฤทธิ์</h2>
            <p>ผู้อำนวยการวิทยาลัยการอาชีพกุมภวาปี</p>
            
        </div>

        <div class="w-full md:w-3/4 flex flex-col gap-6">
            
            <div class="flex flex-wrap gap-2">
                <button class="bg-[#1e293b] text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-opacity-90">ข่าวประชาสัมพันธ์</button>
                <button class="bg-[#1e293b] text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-opacity-90">ข่าวกิจกรรม</button>
                <button class="bg-[#1e293b] text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-opacity-90">ข่าวสมัครงาน-สมัครเรียน</button>
                <button class="bg-[#1e293b] text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-opacity-90">ข่าวจัดซื้อจัดจ้าง</button>
                <button class="bg-[#1e293b] text-white px-5 py-2 rounded-full text-sm font-medium hover:bg-opacity-90">งบประมาณ (งบทดลอง)</button>
            </div>

            <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 1" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">ต้อนรับผู้เข้าร่วมโครงการขยายเครือข่ายความร่วมมือด้านการจัดการอาชีวศึกษา</h3>
                        <p class="text-xs text-gray-500">วันจันทร์, 22 มิถุนายน 2569 11:25</p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 2" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">โครงการหลักสูตรพัฒนาสมรรถนะครูสายอาชีพไมซ์และการบริการ ตามบทบาทผู้สอนยุคใหม่</h3>
                        <p class="text-xs text-gray-500">วันจันทร์, 22 มิถุนายน 2569 11:22</p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 3" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">ผู้อำนวยการ ให้เกียรติเป็นประธานในพิธีมอบเกียรติบัตรแก่ผู้เข้าร่วมอบรมหลักสูตรระยะสั้น</h3>
                        <p class="text-xs text-gray-500">วันอาทิตย์, 21 มิถุนายน 2569 11:13</p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 4" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">วิทยาลัยอาชีวศึกษาขอนแก่น ได้จัดพิธีไหว้ครูและมอบทุนการศึกษา ประจำปีการศึกษา 2569</h3>
                        <p class="text-xs text-gray-500">วันพฤหัสบดี, 18 มิถุนายน 2569</p>
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-3xl p-6 shadow-sm">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    
                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 1" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">ต้อนรับผู้เข้าร่วมโครงการขยายเครือข่ายความร่วมมือด้านการจัดการอาชีวศึกษา</h3>
                        <p class="text-xs text-gray-500">วันจันทร์, 22 มิถุนายน 2569 11:25</p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 2" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">โครงการหลักสูตรพัฒนาสมรรถนะครูสายอาชีพไมซ์และการบริการ ตามบทบาทผู้สอนยุคใหม่</h3>
                        <p class="text-xs text-gray-500">วันจันทร์, 22 มิถุนายน 2569 11:22</p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 3" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">ผู้อำนวยการ ให้เกียรติเป็นประธานในพิธีมอบเกียรติบัตรแก่ผู้เข้าร่วมอบรมหลักสูตรระยะสั้น</h3>
                        <p class="text-xs text-gray-500">วันอาทิตย์, 21 มิถุนายน 2569 11:13</p>
                    </div>

                    <div class="flex flex-col gap-3">
                        <div class="rounded-xl overflow-hidden aspect-[4/3] bg-gray-100">
                            <img src="https://via.placeholder.com/400x300" alt="News 4" class="w-full h-full object-cover grayscale">
                        </div>
                        <h3 class="font-semibold text-gray-900 line-clamp-3 hover:text-blue-600 cursor-pointer">วิทยาลัยอาชีวศึกษาขอนแก่น ได้จัดพิธีไหว้ครูและมอบทุนการศึกษา ประจำปีการศึกษา 2569</h3>
                        <p class="text-xs text-gray-500">วันพฤหัสบดี, 18 มิถุนายน 2569</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="p-6">

    <div class="max-w-7xl mx-auto py-8">
        
        <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-gray-900 mb-2">วีดีโอแนะนำ</h2>
            <p class="text-lg text-gray-700">วีดีทัศน์เผยแพร่ข้อมูลวิทยาลัยอาชีวศึกษาขอนแก่น</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="flex flex-col gap-3 group cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-gray-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250" alt="Video 1" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all">
                        <svg class="w-14 h-14 text-white opacity-90 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 line-clamp-2 text-[15px] leading-relaxed">มองมุมใหม่ Five Focus ตอน : วิทยาลัยอาชีวศึกษาขอนแก่น</h3>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">📅 08 พฤษภาคม 2026</span>
                    <span class="flex items-center gap-1">👁️ 3 views</span>
                </div>
            </div>

            <div class="flex flex-col gap-3 group cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-gray-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250" alt="Video 2" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all">
                        <svg class="w-14 h-14 text-white opacity-90 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 line-clamp-2 text-[15px] leading-relaxed">สถาบันการอาชีวศึกษาภาคตะวันออกเฉียงเหนือ 3 ตั้งศูนย์วิจัย "AI และอุตสาหกรรมอนาคต" แห่งแรกของไทย</h3>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">📅 17 ตุลาคม 2025</span>
                    <span class="flex items-center gap-1">👁️ 18 views</span>
                </div>
            </div>

            <div class="flex flex-col gap-3 group cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-gray-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250" alt="Video 3" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all">
                        <svg class="w-14 h-14 text-white opacity-90 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 line-clamp-2 text-[15px] leading-relaxed">รำบวงสรวงศาลหลักเมืองขอนแก่น 2566</h3>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">📅 17 ตุลาคม 2025</span>
                    <span class="flex items-center gap-1">👁️ 8 views</span>
                </div>
            </div>

            <div class="flex flex-col gap-3 group cursor-pointer">
                <div class="relative rounded-2xl overflow-hidden aspect-[16/10] bg-gray-100 shadow-sm">
                    <img src="https://via.placeholder.com/400x250" alt="Video 4" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-10 group-hover:bg-opacity-20 transition-all">
                        <svg class="w-14 h-14 text-white opacity-90 group-hover:scale-110 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="font-semibold text-gray-900 line-clamp-2 text-[15px] leading-relaxed">อาชีวะ Proud วิทยาลัยอาชีวศึกษาขอนแก่น</h3>
                <div class="flex items-center gap-4 text-xs text-gray-500">
                    <span class="flex items-center gap-1">📅 17 ตุลาคม 2025</span>
                    <span class="flex items-center gap-1">👁️ 17 views</span>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- ========== FOOTER ========== -->
<footer>
    <p>© <?= date('Y') + 543 ?> สงวนลิขสิทธิ์ | <strong style="color:#f5c842;">วิทยาลัยการอาชีพกุมภวาปี</strong> &nbsp;|&nbsp; <a href="personal_data_protection_policy.php">นโยบายคุ้มครองข้อมูลส่วนบุคคล</a> &nbsp;|&nbsp; <a href="contact_us.php">ติดต่อเรา</a></p>
</footer>

<!-- ========== SCRIPTS ========== -->
<script>
    // --- Slider ---
    let currentIndex = 0;
    const slidesEl = document.getElementById('slides');
    const totalSlides = slidesEl.querySelectorAll('img').length;
    const dotsContainer = document.getElementById('dots');
    let autoTimer;

    // Build dots
    for (let i = 0; i < totalSlides; i++) {
        const dot = document.createElement('div');
        dot.className = 'dot' + (i === 0 ? ' active' : '');
        dot.addEventListener('click', () => goTo(i));
        dotsContainer.appendChild(dot);
    }

    function updateSlider() {
        slidesEl.style.transform = `translateX(-${currentIndex * 100}%)`;
        document.querySelectorAll('.dot').forEach((d, i) => {
            d.classList.toggle('active', i === currentIndex);
        });
    }

    function goTo(index) {
        currentIndex = (index + totalSlides) % totalSlides;
        updateSlider();
    }

    function moveSlide(direction) { goTo(currentIndex + direction); }

    function startAuto() { autoTimer = setInterval(() => moveSlide(1), 7000); }
    function stopAuto() { clearInterval(autoTimer); }

    document.querySelector('.slider-container').addEventListener('mouseenter', stopAuto);
    document.querySelector('.slider-container').addEventListener('mouseleave', startAuto);
    startAuto();
</script>


</body>
</html>