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
    <title>하이브미디어 - PORTFOLIO</title>
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

    <!-- GSAP & ScrollTrigger -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

    <style>
        /* GSAP 애니메이션 초기 상태 */
        .gsap-title {
            opacity: 0;
            transform: translateY(80px);
        }

        .gsap-subtitle {
            opacity: 0;
            transform: translateY(40px);
        }

        .gsap-fade-in {
            opacity: 0;
        }

        .gsap-line {
            transform: scaleX(0);
            transform-origin: left;
        }

        /* 인트로 장식 텍스트 */
        .intro-text {
            position: absolute;
            left: 0;
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 8px;
            text-transform: uppercase;
            color: #fff;
            opacity: 0;
            font-family: 'Georgia', serif;
            font-style: italic;
        }

        .intro-text-top {
            top: -35px;
        }

        .intro-text-bottom {
            bottom: -35px;
        }

        .title-wrapper {
            position: relative;
            display: inline-block;
        }

        /* Dark Theme - 검정 배경 */
        body,
        .Wrap {
            background: #111 !important;
        }

        /* Header 스타일 오버라이드 - 검정 배경 */
        .header {
            background: #111 !important;
        }

        .header .conbox {
            background: #111 !important;
        }

        .header .util-btn {
            background: #111 !important;
        }

        .portfolio-con.portfolio2-con {
            background: #111;
            color: #fff;
            min-height: 100vh;
        }

        .portfolio2-con .sub-top {
            background: #111;
            padding: 120px 5% 80px;
            border-bottom: 1px solid #333;
        }

        .portfolio2-con .sub-top .inner {
            max-width: 1400px;
            margin: 0 auto;
        }

        .portfolio2-con .sub-top .path {
            margin-bottom: 60px;
        }

        .portfolio2-con .sub-top .path ul {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .portfolio2-con .sub-top .path li {
            color: #888;
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .portfolio2-con .sub-top .path img {
            filter: invert(1);
            opacity: 0.5;
            width: 12px;
        }

        .portfolio2-con .sub-text {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 40px;
            width: 100%;
        }

        .portfolio2-con .sub-text .title-wrapper {
            text-align: left;
        }

        .portfolio2-con .sub-text h2.text_ani {
            font-size: 24px;
            font-style: italic;
            font-weight: 300;
            color: #888;
            font-family: Georgia, serif;
            margin-bottom: 10px;
        }

        .portfolio2-con .sub-text h2.text_ani2 {
            font-size: 120px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -6px;
            line-height: 0.9;
            text-transform: uppercase;
        }

        .portfolio2-con .sub-text p {
            font-size: 14px;
            color: #aaa;
            max-width: 300px;
            line-height: 1.8;
            text-align: right;
        }

        .portfolio2-con .btn-inquiry {
            display: none;
        }

        /* 카테고리 탭 */
        .portfolio2-con .conbody {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 5%;
        }

        .portfolio2-con .portfolio-itemTab {
            display: flex;
            gap: 30px;
            margin-bottom: 60px;
            padding-bottom: 20px;
            border-bottom: 1px dashed #333;
            flex-wrap: wrap;
        }

        .portfolio2-con .portfolio-itemTab li {
            list-style: none;
        }

        .portfolio2-con .portfolio-itemTab li a {
            font-size: 13px;
            font-weight: 600;
            color: #aaa;
            text-decoration: none;
            letter-spacing: 1px;
            padding: 8px 0;
            transition: all 0.3s;
        }

        .portfolio2-con .portfolio-itemTab li.active a,
        .portfolio2-con .portfolio-itemTab li:hover a {
            color: #fff;
            border-bottom: 2px solid #fff;
        }

        /* 카테고리 섹션 레이아웃 */
        .category-section {
            margin-bottom: 60px;
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #333;
            position: relative;
        }

        .category-icon {
            font-size: 28px;
        }

        .category-title {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .category-count {
            font-size: 12px;
            color: #888;
            padding: 4px 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
        }

        .category-color-bar {
            position: absolute;
            bottom: -1px;
            left: 0;
            width: 100px;
            height: 3px;
            border-radius: 2px;
        }

        .category-items {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        @media (max-width: 1024px) {
            .category-items {
                grid-template-columns: repeat(2, 1fr);
            }

            @media (max-width: 768px) {
                .portfolio2-list {
                    grid-template-columns: 1fr;
                }

                .portfolio2-con .sub-text h2.text_ani2 {
                    font-size: 48px;
                    letter-spacing: -2px;
                }

                .portfolio2-con .sub-text {
                    flex-direction: column;
                    align-items: flex-start;
                }
            }
        }

        /* 포트폴리오 아이템 */
        .portfolio2-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            aspect-ratio: 4/3;
            background: #222;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
            transition: all 0.3s;
        }

        .portfolio2-item:hover {
            box-shadow: 0 5px 20px rgba(0, 102, 204, 0.2);
            transform: translateY(-3px);
        }

        .portfolio2-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease, filter 0.4s ease;
            filter: grayscale(30%);
        }

        .portfolio2-item:hover img {
            transform: scale(1.05);
            filter: grayscale(0%);
        }

        /* 오버레이 */
        .portfolio2-item .overlay {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding: 30px;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9) 0%, rgba(0, 0, 0, 0) 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .portfolio2-item:hover .overlay {
            opacity: 1;
        }

        .portfolio2-item .overlay .category {
            font-size: 11px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 10px;
            font-weight: 700;
            padding: 6px 12px;
            border-radius: 4px;
            display: inline-block;
            width: fit-content;
        }

        /* 카테고리별 색상 구분 */
        .portfolio2-item[data-category="online_ad"] .overlay .category {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .portfolio2-item[data-category="sns"] .overlay .category {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .portfolio2-item[data-category="homepage"] .overlay .category {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .portfolio2-item[data-category="video"] .overlay .category {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        /* 카테고리 뱃지를 항상 표시 (좌측 상단) */
        .portfolio2-item .category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            font-size: 10px;
            color: #fff;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
            padding: 5px 10px;
            border-radius: 3px;
            z-index: 10;
            opacity: 0.95;
        }

        .portfolio2-item[data-category="online_ad"] .category-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .portfolio2-item[data-category="sns"] .category-badge {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .portfolio2-item[data-category="homepage"] .category-badge {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .portfolio2-item[data-category="video"] .category-badge {
            background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
        }

        .portfolio2-item .overlay h3 {
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .portfolio2-item .overlay p {
            font-size: 13px;
            color: #888;
        }

        /* 기본 썸네일 */
        .default-portfolio-thumb {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #222 0%, #333 100%);
            color: #fff;
            font-size: 48px;
        }

        /* 로딩 */
        .portfolio2-loading {
            text-align: center;
            padding: 100px 20px;
            color: #888;
        }

        .portfolio2-loading .spinner {
            width: 40px;
            height: 40px;
            border: 2px solid #333;
            border-top: 2px solid #fff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* 빈 상태 */
        .portfolio2-empty {
            text-align: center;
            padding: 100px 20px;
            color: #888;
            display: none;
        }

        .portfolio2-empty h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #aaa;
        }

        .dark_bg {
            display: none;
        }

        /* Footer 스타일 오버라이드 */
        footer,
        .footer {
            background: #111 !important;
            border-top: 1px solid #222;
        }

        /* 모달 스타일 */
        .portfolio-modal {
            display: none;
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            background: rgba(0, 0, 0, 0.9) !important;
            z-index: 10000 !important;
            opacity: 0;
            transition: opacity 0.3s ease;
            overflow-y: auto;
        }

        .portfolio-modal.active {
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }

        .modal-content {
            background: #1a1a1a;
            max-width: 900px;
            width: 90%;
            max-height: 90vh;
            border-radius: 12px;
            overflow: hidden;
            transform: scale(0.9);
            transition: transform 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .portfolio-modal.active .modal-content {
            transform: scale(1);
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 24px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            z-index: 10001;
        }

        .modal-close:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: rotate(90deg);
        }

        .modal-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .modal-body {
            padding: 30px;
        }

        .modal-category {
            display: inline-block;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            padding: 6px 14px;
            border-radius: 4px;
            margin-bottom: 15px;
            color: #fff;
        }

        .modal-title {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        .modal-description {
            font-size: 16px;
            color: #aaa;
            line-height: 1.8;
            margin-bottom: 25px;
        }

        .modal-info {
            display: flex;
            gap: 30px;
            padding-top: 20px;
            border-top: 1px solid #333;
        }

        .modal-info-item {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .modal-info-label {
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .modal-info-value {
            font-size: 14px;
            color: #fff;
        }

        @media (max-width: 768px) {
            .modal-image {
                height: 250px;
            }

            .modal-title {
                font-size: 22px;
            }

            .modal-info {
                flex-direction: column;
                gap: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="Wrap">
        <div id="header-placeholder"></div>

        <main class="">
            <div class="portfolio-con portfolio2-con">
                <div class="sub-top">
                    <div class="inner">
                        <div class="path">
                            <ul>
                                <li class="home"><a href="<?php echo $base_path; ?>/"><img
                                            src="<?php echo $base_path; ?>/assets/img/sub/icon_home.png" alt=""></a>
                                </li>
                                <li><img src="<?php echo $base_path; ?>/assets/img/sub/icon_step_arrow.png" alt=""></li>
                            </ul>
                        </div>
                        <div class="sub-text">
                            <div class="title-wrapper">
                                <span class="intro-text intro-text-top">Creative Works</span>
                                <h2 class="text_ani2 gsap-title">Portfolio</h2>
                                <span class="intro-text intro-text-bottom">Since 2015</span>
                            </div>
                            <p class="gsap-subtitle">A collection of our finest work in digital marketing, web
                                development, and creative
                                production.</p>
                        </div>
                        <div class="gsap-line"
                            style="height: 2px; background: linear-gradient(90deg, #fff, transparent); margin-top: 40px;">
                        </div>
                    </div>
                </div>

                <div class="conbody">
                    <!-- 카테고리 탭 -->
                    <ul class="portfolio-itemTab">
                        <li class="filter active" data-filter="all" style="cursor:pointer"><a
                                href="javascript:;">All</a></li>
                        <li class="filter" data-filter="online_ad" style="cursor:pointer"><a href="javascript:;">Online
                                AD</a>
                        </li>
                        <li class="filter" data-filter="sns" style="cursor:pointer"><a href="javascript:;">SNS</a></li>
                        <li class="filter" data-filter="homepage" style="cursor:pointer"><a
                                href="javascript:;">Homepage</a>
                        </li>
                        <li class="filter" data-filter="video" style="cursor:pointer"><a href="javascript:;">Video</a>
                        </li>
                    </ul>

                    <div class="contents">
                        <div class="portfolio-section" style="text-align:left">
                            <div class="row">
                                <!-- 로딩 표시 -->
                                <div class="portfolio2-loading" id="portfolioLoading">
                                    <div class="spinner"></div>
                                    <p>포트폴리오를 불러오는 중...</p>
                                </div>

                                <!-- 빈 상태 메시지 -->
                                <div class="portfolio2-empty" id="portfolioEmpty">
                                    <h3>포트폴리오 준비 중</h3>
                                    <p>곧 새로운 프로젝트가 업데이트 될 예정입니다.</p>
                                </div>

                                <!-- 포트폴리오 리스트 -->
                                <ul class="portfolio2-list" id="portfolioList"></ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 숨겨진 관리자 버튼 -->
            <div style="text-align: center; padding: 60px 0 20px; opacity: 0.15;">
                <a href="<?php echo $base_path; ?>/portfolio/write.php"
                    style="color: #333; font-size: 11px; text-decoration: none;">●</a>
            </div>
        </main>

        <!-- 포트폴리오 상세 모달 -->
        <div class="portfolio-modal" id="portfolioModal">
            <button class="modal-close" onclick="closeModal()">&times;</button>
            <div class="modal-content">
                <img class="modal-image" id="modalImage" src="" alt="">
                <div class="modal-body">
                    <span class="modal-category" id="modalCategory"></span>
                    <h2 class="modal-title" id="modalTitle"></h2>
                    <p class="modal-description" id="modalDescription"></p>
                    <div class="modal-info">
                        <div class="modal-info-item">
                            <span class="modal-info-label">카테고리</span>
                            <span class="modal-info-value" id="modalCategoryInfo"></span>
                        </div>
                        <div class="modal-info-item">
                            <span class="modal-info-label">프로젝트 유형</span>
                            <span class="modal-info-value" id="modalTypeInfo">브랜드 마케팅</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Firebase SDK -->
        <script type="module">
            import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
            import { getFirestore, collection, getDocs, query, orderBy } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

            // Firebase 설정
            const firebaseConfig = {
                apiKey: "AIzaSyBeZGgTw8zJoYz26PUfk3xoU-83oMD3v_M",
                authDomain: "hivemedia-archive.firebaseapp.com",
                projectId: "hivemedia-archive",
                storageBucket: "hivemedia-archive.firebasestorage.app",
                messagingSenderId: "105246116532",
                appId: "1:105246116532:web:18aad82490a11b7d4ea5e1",
                measurementId: "G-1YZDYEPFFN"
            };

            // Firebase 초기화
            const app = initializeApp(firebaseConfig);
            const db = getFirestore(app);

            // 전역 변수
            let allPortfolios = [];

            // 포트폴리오 렌더링 (카테고리별 그룹화)
            function renderPortfolios(portfolios) {
                const listEl = document.getElementById('portfolioList');
                const loadingEl = document.getElementById('portfolioLoading');
                const emptyEl = document.getElementById('portfolioEmpty');

                loadingEl.style.display = 'none';

                if (portfolios.length === 0) {
                    emptyEl.style.display = 'block';
                    listEl.innerHTML = '';
                    return;
                }

                emptyEl.style.display = 'none';

                // 카테고리별 그룹화
                const categoryOrder = ['Online AD', 'SNS', 'Homepage', 'Video'];
                const categoryColors = {
                    'Online AD': 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)',
                    'SNS': 'linear-gradient(135deg, #f093fb 0%, #f5576c 100%)',
                    'Homepage': 'linear-gradient(135deg, #4facfe 0%, #00f2fe 100%)',
                    'Video': 'linear-gradient(135deg, #fa709a 0%, #fee140 100%)'
                };
                const categoryIcons = {
                    'Online AD': '📊',
                    'SNS': '📱',
                    'Homepage': '💻',
                    'Video': '🎬'
                };

                const grouped = {};
                portfolios.forEach(item => {
                    const cat = item.category || '기타';
                    if (!grouped[cat]) grouped[cat] = [];
                    grouped[cat].push(item);
                });

                // 카테고리 순서대로 정렬
                const sortedCategories = Object.keys(grouped).sort((a, b) => {
                    const aIdx = categoryOrder.indexOf(a);
                    const bIdx = categoryOrder.indexOf(b);
                    if (aIdx === -1 && bIdx === -1) return 0;
                    if (aIdx === -1) return 1;
                    if (bIdx === -1) return -1;
                    return aIdx - bIdx;
                });

                listEl.innerHTML = sortedCategories.map(category => {
                    const items = grouped[category];
                    const categoryKey = category.toLowerCase().replace(/\s+/g, '_');
                    const color = categoryColors[category] || '#666';
                    const icon = categoryIcons[category] || '📁';

                    return `
                    <div class="category-section" data-category="${categoryKey}">
                        <div class="category-header">
                            <span class="category-icon">${icon}</span>
                            <h3 class="category-title">${category}</h3>
                            <span class="category-count">${items.length} Projects</span>
                            <span class="category-color-bar" style="background: ${color}"></span>
                        </div>
                        <div class="category-items">
                            ${items.map(item => {
                        const title = item.title || '프로젝트';
                        const description = item.description || '';
                        const thumbnail = item.thumbnail || '';
                        const itemColor = categoryColors[category] || '#666';
                        const escapedData = JSON.stringify({ title, description, thumbnail, category, color: itemColor }).replace(/'/g, "\\'");

                        return `
                                <div class="portfolio2-item" data-category="${categoryKey}" onclick='openModal(${escapedData})'>
                                    ${thumbnail
                                ? `<img src="${thumbnail}" alt="${title}" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">`
                                : ''
                            }
                                    <div class="default-portfolio-thumb" style="${thumbnail ? 'display:none' : ''}">🎨</div>
                                    <div class="overlay">
                                        <h3>${title}</h3>
                                        ${description ? `<p>${description}</p>` : ''}
                                    </div>
                                </div>
                                `;
                    }).join('')}
                        </div>
                    </div>
                    `;
                }).join('');
            }

            // 모달 열기
            window.openModal = function (data) {
                const modal = document.getElementById('portfolioModal');
                const modalImage = document.getElementById('modalImage');
                const modalCategory = document.getElementById('modalCategory');
                const modalTitle = document.getElementById('modalTitle');
                const modalDescription = document.getElementById('modalDescription');
                const modalCategoryInfo = document.getElementById('modalCategoryInfo');

                // 데이터 설정
                modalImage.src = data.thumbnail || '';
                modalImage.style.display = data.thumbnail ? 'block' : 'none';
                modalCategory.textContent = data.category;
                modalCategory.style.background = data.color || '#666';
                modalTitle.textContent = data.title;
                modalDescription.textContent = data.description || '하이브미디어의 크리에이티브 프로젝트입니다.';
                modalCategoryInfo.textContent = data.category;

                // 모달 표시
                modal.style.display = 'flex';
                setTimeout(() => modal.classList.add('active'), 10);
                document.body.style.overflow = 'hidden';
            };

            // 모달 닫기
            window.closeModal = function () {
                const modal = document.getElementById('portfolioModal');
                modal.classList.remove('active');
                setTimeout(() => {
                    modal.style.display = 'none';
                    document.body.style.overflow = '';
                }, 300);
            };

            // 모달 외부 클릭 시 닫기
            document.getElementById('portfolioModal').addEventListener('click', function (e) {
                if (e.target === this) closeModal();
            });

            // ESC 키로 닫기
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') closeModal();
            });

            // Firestore에서 포트폴리오 가져오기
            async function fetchPortfolios() {
                try {
                    // 'portfolios' 컬렉션에서 가져오기 (없으면 예시 데이터 사용)
                    const portfoliosRef = collection(db, 'portfolios');
                    const q = query(portfoliosRef, orderBy('createdAt', 'desc'));
                    const querySnapshot = await getDocs(q);

                    allPortfolios = [];
                    querySnapshot.forEach((doc) => {
                        allPortfolios.push({
                            id: doc.id,
                            ...doc.data()
                        });
                    });

                    // 테스트용: 샘플 데이터 강제 표시 (실제 데이터가 준비되면 이 줄만 삭제)
                    allPortfolios = []; // 강제로 비워서 샘플 표시

                    // 데이터가 없으면 샘플 데이터 표시
                    if (allPortfolios.length === 0) {
                        allPortfolios = [
                            { id: 1, title: '부산시 공공기관 SNS 캠페인', category: 'Online AD', description: '부산시 관광홍보 통합 마케팅', thumbnail: '../assets/img/portfolio/sample_1.png' },
                            { id: 2, title: '해운대 관광 인스타그램 운영', category: 'SNS', description: '월간 콘텐츠 제작 및 커뮤니티 관리', thumbnail: '../assets/img/portfolio/sample_2.png' },
                            { id: 3, title: '부산항만공사 반응형 웹사이트', category: 'Homepage', description: '기업 소개 및 서비스 안내 홈페이지', thumbnail: '../assets/img/portfolio/sample_3.png' },
                            { id: 4, title: '지역 특산물 홍보 영상', category: 'Video', description: '다큐멘터리 스타일 브랜드 필름', thumbnail: '../assets/img/portfolio/sample_4.png' },
                            { id: 5, title: '문화축제 이벤트 페이지', category: 'Homepage', description: '티켓 예매 및 프로그램 안내', thumbnail: '../assets/img/portfolio/sample_5.png' },
                            { id: 6, title: '정부 공모사업 온라인 광고', category: 'Online AD', description: '정책 홍보 배너 및 카드뉴스', thumbnail: '../assets/img/portfolio/sample_6.png' },
                            { id: 7, title: '기업 브랜딩 다큐멘터리', category: 'Video', description: 'CEO 인터뷰 및 기업 역사 영상', thumbnail: '../assets/img/portfolio/sample_7.png' },
                            { id: 8, title: '대중교통 앱 UI/UX 디자인', category: 'Homepage', description: '모바일 앱 사용자 인터페이스', thumbnail: '../assets/img/portfolio/sample_8.png' },
                            { id: 9, title: '환경부 카드뉴스 시리즈', category: 'SNS', description: '친환경 캠페인 인포그래픽', thumbnail: '../assets/img/portfolio/sample_9.png' },
                            { id: 10, title: '박물관 디지털 사이니지', category: 'Online AD', description: '전시 안내 인터랙티브 키오스크', thumbnail: '../assets/img/portfolio/sample_10.png' },
                        ];
                    }

                    renderPortfolios(allPortfolios);
                } catch (error) {
                    console.error('Error fetching portfolios:', error);
                    // 에러 시 샘플 데이터 표시
                    allPortfolios = [
                        { id: 1, title: '부산시 공공기관 SNS 캠페인', category: 'Online AD', description: '부산시 관광홍보 통합 마케팅', thumbnail: '../assets/img/portfolio/sample_1.png' },
                        { id: 2, title: '해운대 관광 인스타그램 운영', category: 'SNS', description: '월간 콘텐츠 제작 및 커뮤니티 관리', thumbnail: '../assets/img/portfolio/sample_2.png' },
                        { id: 3, title: '부산항만공사 반응형 웹사이트', category: 'Homepage', description: '기업 소개 및 서비스 안내 홈페이지', thumbnail: '../assets/img/portfolio/sample_3.png' },
                        { id: 4, title: '지역 특산물 홍보 영상', category: 'Video', description: '다큐멘터리 스타일 브랜드 필름', thumbnail: '../assets/img/portfolio/sample_4.png' },
                        { id: 5, title: '문화축제 이벤트 페이지', category: 'Homepage', description: '티켓 예매 및 프로그램 안내', thumbnail: '../assets/img/portfolio/sample_5.png' },
                        { id: 6, title: '정부 공모사업 온라인 광고', category: 'Online AD', description: '정책 홍보 배너 및 카드뉴스', thumbnail: '../assets/img/portfolio/sample_6.png' },
                        { id: 7, title: '기업 브랜딩 다큐멘터리', category: 'Video', description: 'CEO 인터뷰 및 기업 역사 영상', thumbnail: '../assets/img/portfolio/sample_7.png' },
                        { id: 8, title: '대중교통 앱 UI/UX 디자인', category: 'Homepage', description: '모바일 앱 사용자 인터페이스', thumbnail: '../assets/img/portfolio/sample_8.png' },
                        { id: 9, title: '환경부 카드뉴스 시리즈', category: 'SNS', description: '친환경 캠페인 인포그래픽', thumbnail: '../assets/img/portfolio/sample_9.png' },
                        { id: 10, title: '박물관 디지털 사이니지', category: 'Online AD', description: '전시 안내 인터랙티브 키오스크', thumbnail: '../assets/img/portfolio/sample_10.png' },
                    ];
                    renderPortfolios(allPortfolios);
                }
            }

            // 필터링 함수
            window.filterPortfolios = function (category) {
                if (category === 'all') {
                    renderPortfolios(allPortfolios);
                } else {
                    const filtered = allPortfolios.filter(p => {
                        const cat = (p.category || '').toLowerCase().replace(/\s+/g, '_');
                        return cat === category;
                    });
                    renderPortfolios(filtered);
                }
            };

            // 페이지 로드 시 실행
            fetchPortfolios();
        </script>

        <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(function () {
                // 필터 탭 클릭 시
                $('.portfolio-itemTab .filter').on('click', function () {
                    $('.portfolio-itemTab .filter').removeClass('active');
                    $(this).addClass('active');

                    const category = $(this).data('filter');
                    window.filterPortfolios(category);
                });
            });
        </script>

        <!-- GSAP 애니메이션 초기화 -->
        <script>
            // GSAP & ScrollTrigger 등록
            gsap.registerPlugin(ScrollTrigger);

            // 페이지 로드 후 애니메이션 시작
            window.addEventListener('load', function () {
                // 로딩 완료 후 약간의 딜레이
                setTimeout(initAnimations, 300);
            });

            function initAnimations() {
                // 1. 히어로 타이틀 애니메이션
                const heroTimeline = gsap.timeline();

                heroTimeline
                    // 인트로 텍스트 먼저 등장
                    .to('.intro-text', {
                        opacity: 1,
                        duration: 0.8,
                        stagger: 0.2,
                        ease: 'power2.out'
                    })
                    // 잠시 유지 후 사라짐
                    .to('.intro-text', {
                        opacity: 0,
                        y: -20,
                        duration: 0.6,
                        stagger: 0.1,
                        ease: 'power2.in'
                    }, '+=0.8')
                    // 메인 타이틀 등장
                    .to('.gsap-title', {
                        opacity: 1,
                        y: 0,
                        duration: 1.2,
                        ease: 'power4.out'
                    }, '-=0.3')
                    .to('.gsap-subtitle', {
                        opacity: 1,
                        y: 0,
                        duration: 0.8,
                        ease: 'power3.out'
                    }, '-=0.6')
                    .to('.gsap-line', {
                        scaleX: 1,
                        duration: 1,
                        ease: 'power2.inOut'
                    }, '-=0.4');

                // 2. 카테고리 탭 순차 등장
                gsap.from('.portfolio-itemTab .filter', {
                    opacity: 0,
                    y: 20,
                    duration: 0.5,
                    stagger: 0.1,
                    ease: 'power2.out',
                    scrollTrigger: {
                        trigger: '.portfolio-itemTab',
                        start: 'top 85%'
                    }
                });

                // 3. 포트폴리오 아이템 관찰자 (동적 로드 대응)
                observePortfolioItems();
            }

            // MutationObserver로 동적 로드된 아이템 감지
            function observePortfolioItems() {
                const portfolioList = document.getElementById('portfolioList');

                const observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        if (mutation.addedNodes.length > 0) {
                            animatePortfolioItems();
                        }
                    });
                });

                observer.observe(portfolioList, { childList: true });

                // 이미 로드된 아이템이 있으면 바로 애니메이션
                if (portfolioList.children.length > 0) {
                    animatePortfolioItems();
                }
            }

            // 포트폴리오 카드 애니메이션
            function animatePortfolioItems() {
                const items = document.querySelectorAll('.portfolio2-item');

                // 초기 상태 설정
                gsap.set(items, {
                    opacity: 0,
                    y: 60,
                    scale: 0.9
                });

                // 순차적 등장 애니메이션
                gsap.to(items, {
                    opacity: 1,
                    y: 0,
                    scale: 1,
                    duration: 0.8,
                    stagger: {
                        each: 0.1,
                        grid: [3, 3],
                        from: 'start'
                    },
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: '#portfolioList',
                        start: 'top 80%'
                    }
                });

                // 호버 효과 강화
                items.forEach(item => {
                    item.addEventListener('mouseenter', function () {
                        gsap.to(this, {
                            scale: 1.03,
                            boxShadow: '0 20px 40px rgba(0, 102, 204, 0.25)',
                            duration: 0.4,
                            ease: 'power2.out'
                        });
                        gsap.to(this.querySelector('img'), {
                            scale: 1.1,
                            filter: 'grayscale(0%)',
                            duration: 0.5,
                            ease: 'power2.out'
                        });
                        gsap.to(this.querySelector('.overlay'), {
                            opacity: 1,
                            duration: 0.3
                        });
                    });

                    item.addEventListener('mouseleave', function () {
                        gsap.to(this, {
                            scale: 1,
                            boxShadow: '0 2px 10px rgba(0, 0, 0, 0.1)',
                            duration: 0.4,
                            ease: 'power2.out'
                        });
                        gsap.to(this.querySelector('img'), {
                            scale: 1,
                            filter: 'grayscale(30%)',
                            duration: 0.5,
                            ease: 'power2.out'
                        });
                        gsap.to(this.querySelector('.overlay'), {
                            opacity: 0,
                            duration: 0.3
                        });
                    });
                });
            }

            // 스크롤 시 패럴랙스 효과 (서브탑)
            gsap.to('.sub-top', {
                backgroundPositionY: '30%',
                scrollTrigger: {
                    trigger: '.sub-top',
                    start: 'top top',
                    end: 'bottom top',
                    scrub: 1
                }
            });
        </script>

        <div id="footer-placeholder"></div>
    </div>
</body>

</html>