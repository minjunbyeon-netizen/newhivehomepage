<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');

// 프로젝트 루트 경로 설정
$base_path = '/01_work/hivemedia_homepage';
?>
<!doctype html>
<html lang="ko" data-theme="light">

<head>
    <meta charset="utf-8">
    <title>하이브미디어 포트폴리오 | 프로젝트 사례</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- SEO Meta Tags -->
    <meta name="description"
        content="하이브미디어 포트폴리오. 부산시, 해운대구청, 부산항만공사 등 다수의 관공서 프로젝트를 성공적으로 수행. SNS 운영, 홍보영상 제작, 온라인 캠페인 사례.">
    <meta name="keywords" content="포트폴리오, 광고대행사실적, SNS관리사례, 홍보영상제작, 관공서마케팅, 부산마케팅사례">
    <meta name="author" content="하이브미디어">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://hivemedia.co.kr/portfolio/">

    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="하이브미디어 포트폴리오 | 관공서 마케팅 프로젝트" />
    <meta property="og:description" content="부산시, 해운대구청, 부산항만공사 등 다수의 관공서 프로젝트 수행 사례" />
    <meta property="og:image" content="https://hivemedia.co.kr/assets/img/orimage.png" />
    <meta property="og:url" content="https://hivemedia.co.kr/portfolio/" />
    <meta property="og:site_name" content="하이브미디어" />
    <meta property="og:locale" content="ko_KR" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="하이브미디어 포트폴리오 | 관공서 마케팅 프로젝트">
    <meta name="twitter:description" content="부산시, 해운대구청, 부산항만공사 등 다수의 관공서 프로젝트 수행 사례">
    <meta name="twitter:image" content="https://hivemedia.co.kr/assets/img/orimage.png">

    <!-- Schema.org CollectionPage + BreadcrumbList -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "CollectionPage",
        "name": "하이브미디어 포트폴리오",
        "description": "부산 관공서 마케팅 전문 광고대행사 하이브미디어의 프로젝트 사례",
        "url": "https://hivemedia.co.kr/portfolio/",
        "isPartOf": {
            "@type": "WebSite",
            "name": "하이브미디어",
            "url": "https://hivemedia.co.kr"
        },
        "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://hivemedia.co.kr/"},
                {"@type": "ListItem", "position": 2, "name": "Portfolio", "item": "https://hivemedia.co.kr/portfolio/"}
            ]
        }
    }
    </script>

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png" />
    <link rel="stylesheet" href="../assets/css/all.css">
    <script src="//code.jquery.com/jquery-latest.min.js"></script>
    <script src="../assets/js/common.js" defer=""></script>
    <script src="../assets/js/components.js" defer=""></script>

    <!-- Google Fonts - Mono -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body,
        .Wrap {
            background: #ffffff !important;
            font-family: 'Space Mono', 'Courier New', monospace;
            color: #1a1a1a;
            line-height: 1.6;
        }

        /* Header Override - Dark */
        .header {
            background: #1a1a1a !important;
        }

        .header .conbox {
            background: #1a1a1a !important;
        }

        .header .logo img {
            filter: brightness(0) invert(1);
        }

        .header .menu-toggle span {
            background: #fff !important;
        }

        /* Main Layout - 20:80 Split */
        .portfolio-main {
            display: flex;
            min-height: 100vh;
            padding-top: 80px;
        }

        /* Left Panel - 20% */
        .left-panel {
            width: 20%;
            padding: 40px 30px 40px 40px;
            position: sticky;
            top: 80px;
            height: calc(100vh - 80px);
            overflow-y: auto;
        }

        .company-name {
            font-size: 48px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -2px;
            line-height: 1;
            margin-bottom: 8px;
        }

        .company-name-sub {
            font-size: 72px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -4px;
            line-height: 0.9;
            margin-bottom: 40px;
        }

        .profile-image {
            width: 80px;
            height: 80px;
            background: #ddd;
            margin-bottom: 30px;
            overflow: hidden;
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            filter: grayscale(100%);
        }

        .intro-text {
            font-family: NotoSansKR-Light;
            font-size: 1.6rem;
            line-height: 1.8;
            color: var(--text-color);
            margin-bottom: 20px;
            max-width: 320px;
        }

        .cta-button {
            display: inline-block;
            padding: 12px 24px;
            border: 1px solid #1a1a1a;
            background: transparent;
            color: #1a1a1a;
            font-family: 'Space Mono', monospace;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 30px;
        }

        .cta-button:hover {
            background: #1a1a1a;
            color: #f5f5f0;
        }

        .left-footer {
            position: relative;
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid #ddd;
        }

        .left-footer a {
            display: block;
            font-size: 11px;
            color: #1a1a1a;
            text-decoration: none;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .left-footer a:hover {
            text-decoration: underline;
        }

        .left-footer .write-link {
            color: #bbb !important;
            font-size: 10px;
        }

        .left-footer .write-link:hover {
            color: #888 !important;
        }

        .copyright {
            margin-top: 20px;
            font-size: 10px;
            color: #888;
        }

        /* Right Panel - 80% */
        .right-panel {
            width: 80%;
            padding: 60px 60px 60px 40px;
            border-left: 1px solid #ddd;
        }

        /* Category Tabs */
        .category-tabs {
            display: flex;
            gap: 20px;
            margin-bottom: 40px;
            padding-bottom: 15px;
            border-bottom: 1px solid #ddd;
            flex-wrap: wrap;
        }

        .category-tab {
            font-size: 11px;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #999;
            cursor: pointer;
            transition: all 0.2s;
            padding: 5px 0;
        }

        .category-tab:hover {
            color: #1a1a1a;
        }

        .category-tab.active {
            color: #1a1a1a;
            font-weight: 700;
        }

        /* Section Style */
        .section-block {
            margin-bottom: 50px;
        }

        .section-title {
            display: inline-block;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 4px 10px;
            background: #1a1a1a;
            color: #f5f5f0;
            margin-bottom: 20px;
        }

        /* Two Column List */
        .two-col-list {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
        }

        .list-item {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition: background 0.2s;
        }

        .list-item:hover {
            background: rgba(0, 0, 0, 0.03);
            padding-left: 10px;
        }

        /* Single Column List with Count */
        .single-col-list .list-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: NotoSansKR-Light;
            font-size: 1.6rem;
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition: all 0.2s;
        }

        .single-col-list .list-row:hover {
            background: rgba(0, 0, 0, 0.03);
            padding-left: 10px;
            margin-left: -10px;
            padding-right: 10px;
            margin-right: -10px;
        }

        .list-row .name {
            flex: 1;
        }

        .list-row .category {
            width: 100px;
            text-align: center;
            color: #888;
        }

        .list-row .count {
            width: 40px;
            text-align: right;
            color: #888;
        }

        /* Project List by Category */
        .project-category-section {
            margin-bottom: 40px;
            display: none;
        }

        .project-category-section.active {
            display: block;
        }

        .category-header {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 10px 0;
            border-bottom: 2px solid #1a1a1a;
            margin-bottom: 10px;
        }

        /* Footer Override - Dark */
        footer,
        .footer {
            background: #1a1a1a !important;
            border-top: 1px solid #333;
            color: #fff;
        }

        .footer a,
        .footer p,
        .footer span {
            color: rgba(255, 255, 255, 0.7) !important;
        }

        .dark_bg {
            display: none;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .portfolio-main {
                flex-direction: column;
            }

            .left-panel,
            .right-panel {
                width: 100%;
                position: relative;
                top: 0;
                height: auto;
            }

            .left-panel {
                padding: 40px 30px;
            }

            .right-panel {
                padding: 40px 30px;
                border-left: none;
                border-top: 1px solid #ddd;
            }

            .left-footer {
                position: relative;
                bottom: 0;
                left: 0;
                margin-top: 40px;
            }

            .company-name {
                font-size: 36px;
            }

            .company-name-sub {
                font-size: 48px;
            }
        }

        @media (max-width: 768px) {
            .two-col-list {
                grid-template-columns: 1fr;
            }

            .category-tabs {
                gap: 10px;
            }

            .category-tab {
                font-size: 10px;
            }
        }

        /* Bento Grid Styles */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(2, 200px);
            gap: 16px;
            margin-bottom: 40px;
        }

        .bento-card {
            position: relative;
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .bento-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .bento-card--large {
            grid-column: span 2;
            grid-row: span 2;
        }

        .bento-card__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0.4;
            transition: opacity 0.3s, transform 0.5s;
        }

        .bento-card:hover .bento-card__bg {
            opacity: 0.6;
            transform: scale(1.05);
        }

        .bento-card__content {
            position: relative;
            z-index: 2;
            height: 100%;
            padding: 24px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .bento-card__icon {
            width: 48px;
            height: 48px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 16px;
        }

        .bento-card__title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bento-card__subtitle {
            font-size: 12px;
            color: #888;
            font-family: NotoSansKR-Light;
        }

        .bento-card__count {
            font-size: 32px;
            font-weight: 700;
            color: #0084ff;
        }

        .bento-card__count span {
            font-size: 14px;
            font-weight: 400;
            color: #888;
        }

        .bento-card--large .bento-card__title {
            font-size: 28px;
        }

        .bento-card--large .bento-card__count {
            font-size: 48px;
        }

        /* Card Color Themes */
        .bento-card--online .bento-card__icon {
            background: rgba(0, 132, 255, 0.1);
            color: #0084ff;
        }

        .bento-card--sns .bento-card__icon {
            background: rgba(225, 48, 108, 0.1);
            color: #E1306C;
        }

        .bento-card--homepage .bento-card__icon {
            background: rgba(26, 26, 26, 0.1);
            color: #1a1a1a;
        }

        .bento-card--video .bento-card__icon {
            background: rgba(255, 0, 0, 0.1);
            color: #FF0000;
        }

        .bento-card--event .bento-card__icon {
            background: rgba(255, 193, 7, 0.1);
            color: #FFC107;
        }

        .bento-card--print .bento-card__icon {
            background: rgba(102, 102, 102, 0.1);
            color: #666;
        }

        .bento-card__projects {
            margin-top: 12px;
            font-size: 11px;
            color: #666;
            line-height: 1.6;
        }

        .bento-card__projects span {
            display: block;
            padding: 4px 0;
            border-bottom: 1px solid #eee;
        }

        /* Hide bento grid when category is selected */
        .bento-grid.hidden {
            display: none;
        }

        .section-block.hidden {
            display: none;
        }

        @media (max-width: 1024px) {
            .bento-grid {
                grid-template-columns: repeat(2, 1fr);
                grid-template-rows: auto;
            }

            .bento-card--large {
                grid-column: span 2;
                grid-row: span 1;
            }
        }

        @media (max-width: 768px) {
            .bento-grid {
                grid-template-columns: 1fr;
            }

            .bento-card--large {
                grid-column: span 1;
            }

            .bento-card {
                min-height: 160px;
            }
        }
    </style>
</head>

<body>
    <!-- Video Intro Overlay -->
    <div id="videoIntro" class="video-intro">
        <video id="introVideo" autoplay muted playsinline>
            <source src="<?php echo $base_path; ?>/assets/img/viedo/3.mp4" type="video/mp4">
        </video>
        <button id="skipBtn" class="skip-btn">SKIP</button>
    </div>

    <style>
        .video-intro {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.5s ease;
        }

        .video-intro.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .video-intro video {
            width: 80%;
            height: auto;
            max-height: 80vh;
            object-fit: contain;
            border-radius: 8px;
        }

        .skip-btn {
            position: absolute;
            bottom: 40px;
            right: 40px;
            padding: 12px 32px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .skip-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            border-color: rgba(255, 255, 255, 0.5);
        }
    </style>

    <script>
        (function () {
            const intro = document.getElementById('videoIntro');
            const video = document.getElementById('introVideo');
            const skipBtn = document.getElementById('skipBtn');

            // Set playback speed to 1.5x
            video.playbackRate = 1.5;

            // Hide intro when video ends
            video.addEventListener('ended', function () {
                intro.classList.add('hidden');
                setTimeout(() => intro.style.display = 'none', 500);
            });

            // Skip button
            skipBtn.addEventListener('click', function () {
                intro.classList.add('hidden');
                setTimeout(() => intro.style.display = 'none', 500);
            });
        })();
    </script>

    <div class="Wrap">
        <div id="header-placeholder"></div>

        <main class="portfolio-main">
            <!-- Left Panel - 40% -->
            <div class="left-panel">
                <h1 class="company-name">HIVE</h1>
                <h1 class="company-name-sub">MEDIA</h1>

                <p class="intro-text">
                    10년간 쌓아온 신뢰와 결과물.
                </p>

                <p class="intro-text">
                    하이브미디어는 부산을 기반으로
                    다양한 기관과 기업의 브랜드 가치를
                    높여왔습니다.
                </p>

                <p class="intro-text">
                    강한 컨셉과 세련된 실행력으로
                    프리미엄 결과물을 만들어갑니다.
                </p>

                <a href="<?php echo $base_path; ?>/contact.html" class="cta-button">문의하기</a>

                <div class="left-footer">
                    <a href="mailto:hivemedia@naver.com">EMAIL</a>
                    <a href="https://blog.naver.com/hivemedia" target="_blank">BLOG</a>
                    <a href="https://www.instagram.com/hivemedia_official" target="_blank">INSTAGRAM</a>
                    <a href="https://www.youtube.com/@hivemedia" target="_blank">YOUTUBE</a>
                    <a href="./write.php" class="write-link">포트폴리오 등록</a>
                    <p class="copyright">© HIVE MEDIA 2025</p>
                </div>
            </div>

            <!-- Right Panel - 60% -->
            <div class="right-panel">
                <!-- Category Tabs -->
                <div class="category-tabs">
                    <span class="category-tab active" data-category="all">All</span>
                    <span class="category-tab" data-category="online_ad">Online AD</span>
                    <span class="category-tab" data-category="sns">SNS</span>
                    <span class="category-tab" data-category="homepage">Homepage</span>
                    <span class="category-tab" data-category="eventpage">Eventpage</span>
                    <span class="category-tab" data-category="video">Video</span>
                    <span class="category-tab" data-category="print">Print</span>
                    <span class="category-tab" data-category="exhibition">Exhibition Art</span>
                </div>

                <!-- Bento Grid - 카테고리별 카드 -->
                <div class="bento-grid" id="bentoGrid">
                    <!-- 온라인 광고 (Large) -->
                    <div class="bento-card bento-card--large bento-card--online" data-category="online_ad">
                        <div class="bento-card__bg" style="background-image: url('./img/online_ad.png');">
                        </div>
                        <div class="bento-card__content">
                            <div>
                                <div class="bento-card__icon">AD</div>
                                <h3 class="bento-card__title">Online AD</h3>
                                <p class="bento-card__subtitle">온라인 광고 · 검색광고 · DA · 리타겟팅</p>
                            </div>
                            <div>
                                <p class="bento-card__count">0 <span>projects</span></p>
                            </div>
                        </div>
                    </div>

                    <!-- SNS 운영 -->
                    <div class="bento-card bento-card--sns" data-category="sns">
                        <div class="bento-card__bg" style="background-image: url('./img/sns.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <div class="bento-card__icon">SNS</div>
                                <h3 class="bento-card__title">SNS</h3>
                                <p class="bento-card__subtitle">채널 운영 · 콘텐츠 제작</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                    </div>

                    <!-- 홈페이지 -->
                    <div class="bento-card bento-card--homepage" data-category="homepage">
                        <div class="bento-card__bg" style="background-image: url('./img/homepage.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <div class="bento-card__icon">WEB</div>
                                <h3 class="bento-card__title">Homepage</h3>
                                <p class="bento-card__subtitle">웹사이트 구축 · 포털</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                    </div>

                    <!-- 영상 제작 -->
                    <div class="bento-card bento-card--video" data-category="video">
                        <div class="bento-card__bg" style="background-image: url('./img/video.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <div class="bento-card__icon">VD</div>
                                <h3 class="bento-card__title">Video</h3>
                                <p class="bento-card__subtitle">홍보영상 · 시네마틱</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                    </div>

                    <!-- 이벤트페이지 -->
                    <div class="bento-card bento-card--event" data-category="eventpage">
                        <div class="bento-card__bg" style="background-image: url('./img/event.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <div class="bento-card__icon">EVT</div>
                                <h3 class="bento-card__title">Event</h3>
                                <p class="bento-card__subtitle">이벤트 · 프로모션</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                    </div>

                    <!-- 인쇄물/전시 -->
                    <div class="bento-card bento-card--print" data-category="print,exhibition">
                        <div class="bento-card__bg" style="background-image: url('./img/print.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <div class="bento-card__icon">P&E</div>
                                <h3 class="bento-card__title">Print & Exhibition</h3>
                                <p class="bento-card__subtitle">인쇄물 · 전시기획</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                    </div>
                </div>

                <!-- All Projects List (initially hidden) -->
                <div class="section-block hidden" id="projectsSection">
                    <span class="section-title">PROJECTS</span>
                    <div class="single-col-list" id="projectsList">
                        <!-- Firebase 승인된 포트폴리오가 여기에 동적으로 추가됩니다 -->
                    </div>
                </div>
            </div>
        </main>

        <div id="footer-placeholder"></div>
    </div>

    <script>
        // Category Tab & Bento Grid Filtering
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.category-tab');
            const bentoGrid = document.getElementById('bentoGrid');
            const projectsSection = document.getElementById('projectsSection');
            const bentoCards = document.querySelectorAll('.bento-card');

            // Show bento grid, hide projects list
            function showBentoGrid() {
                bentoGrid.classList.remove('hidden');
                projectsSection.classList.add('hidden');
            }

            // Show projects list, hide bento grid
            function showProjectsList(category) {
                bentoGrid.classList.add('hidden');
                projectsSection.classList.remove('hidden');

                // Get items dynamically (to include Firebase-loaded items)
                const items = document.querySelectorAll('#projectsList .list-row');

                // Filter items
                items.forEach(item => {
                    const itemCategory = item.dataset.category;
                    const filterCategories = category.split(',');
                    if (category === 'all' || filterCategories.includes(itemCategory)) {
                        item.style.display = 'flex';
                    } else {
                        item.style.display = 'none';
                    }
                });
            }

            // Tab click handler
            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const category = this.dataset.category;

                    if (category === 'all') {
                        showBentoGrid();
                    } else {
                        showProjectsList(category);
                    }
                });
            });

            // Bento card click handler
            bentoCards.forEach(card => {
                card.addEventListener('click', function () {
                    const category = this.dataset.category;

                    // Update tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    const matchingTab = document.querySelector(`.category-tab[data-category="${category.split(',')[0]}"]`);
                    if (matchingTab) matchingTab.classList.add('active');

                    showProjectsList(category);
                });
            });
        });
    </script>

    <!-- Firebase Integration for Dynamic Portfolio -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getFirestore, collection, getDocs, query, where, orderBy } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBeZGgTw8zJoYz26PUfk3xoU-83oMD3v_M",
            authDomain: "hivemedia-archive.firebaseapp.com",
            projectId: "hivemedia-archive",
            storageBucket: "hivemedia-archive.firebasestorage.app",
            messagingSenderId: "105246116532",
            appId: "1:105246116532:web:18aad82490a11b7d4ea5e1"
        };

        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);

        // Category mapping
        const categoryMap = {
            'Online AD': 'online_ad',
            'SNS': 'sns',
            'Homepage': 'homepage',
            'Eventpage': 'eventpage',
            'Video': 'video',
            'Print': 'print',
            'Exhibition Art': 'exhibition'
        };

        // Load approved portfolios
        async function loadApprovedPortfolios() {
            try {
                const q = query(
                    collection(db, 'portfolios'),
                    where('status', '==', 'approved')
                );
                const snapshot = await getDocs(q);

                const projectsList = document.getElementById('projectsList');

                // Add Firebase items to the list
                snapshot.forEach(doc => {
                    const data = doc.data();
                    const categoryKey = categoryMap[data.category] || 'online_ad';

                    const row = document.createElement('div');
                    row.className = 'list-row firebase-item';
                    row.dataset.category = categoryKey;
                    row.innerHTML = `
                        <span class="name">${data.title}</span>
                        <span class="category">${data.category.toUpperCase()}</span>
                    `;

                    // Add to beginning of list
                    projectsList.insertBefore(row, projectsList.firstChild);
                });

                // Update counts on bento cards
                updateBentoCounts(snapshot);

                console.log('Firebase portfolios loaded:', snapshot.size);
            } catch (error) {
                console.error('Error loading portfolios:', error);
            }
        }

        // Update bento card counts
        function updateBentoCounts(snapshot) {
            const counts = {};
            snapshot.forEach(doc => {
                const category = doc.data().category;
                const key = categoryMap[category] || 'online_ad';
                counts[key] = (counts[key] || 0) + 1;
            });

            // Add Firebase counts to existing counts
            document.querySelectorAll('.bento-card').forEach(card => {
                const categories = card.dataset.category.split(',');
                let additionalCount = 0;
                categories.forEach(cat => {
                    additionalCount += counts[cat] || 0;
                });

                if (additionalCount > 0) {
                    const countEl = card.querySelector('.bento-card__count');
                    if (countEl) {
                        const currentText = countEl.textContent;
                        const currentNum = parseInt(currentText) || 0;
                        const newNum = currentNum + additionalCount;
                        countEl.innerHTML = `${newNum} <span>${currentText.includes('projects') ? 'projects' : '건'}</span>`;
                    }
                }
            });
        }

        // Load on page ready
        loadApprovedPortfolios();
    </script>
</body>

</html>