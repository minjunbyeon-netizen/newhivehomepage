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
    <title>하이브미디어 아카이브 | 마케팅 트렌드 & 인사이트</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <!-- SEO Meta Tags -->
    <meta name="description" content="하이브미디어 아카이브. 마케팅 트렌드, 업계 소식, 디지털 마케팅 인사이트를 정기적으로 업데이트합니다.">
    <meta name="keywords" content="마케팅트렌드, 광고업계소식, 디지털마케팅인사이트, SNS마케팅팁, 부산마케팅뉴스">
    <meta name="author" content="하이브미디어">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="https://hivemedia.co.kr/archive/">

    <!-- Open Graph -->
    <meta property="og:type" content="website" />
    <meta property="og:title" content="하이브미디어 아카이브 | 마케팅 인사이트 & 트렌드" />
    <meta property="og:description" content="마케팅 트렌드, 업계 소식, 디지털 마케팅 인사이트를 정기적으로 업데이트합니다." />
    <meta property="og:image" content="https://hivemedia.co.kr/assets/img/orimage.png" />
    <meta property="og:url" content="https://hivemedia.co.kr/archive/" />
    <meta property="og:site_name" content="하이브미디어" />
    <meta property="og:locale" content="ko_KR" />

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="하이브미디어 아카이브 | 마케팅 인사이트 & 트렌드">
    <meta name="twitter:description" content="마케팅 트렌드, 업계 소식, 디지털 마케팅 인사이트를 정기적으로 업데이트합니다.">
    <meta name="twitter:image" content="https://hivemedia.co.kr/assets/img/orimage.png">

    <!-- Schema.org Blog + BreadcrumbList -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Blog",
        "name": "하이브미디어 아카이브",
        "description": "마케팅 트렌드, 업계 소식, 디지털 마케팅 인사이트",
        "url": "https://hivemedia.co.kr/archive/",
        "publisher": {
            "@type": "Organization",
            "name": "하이브미디어",
            "url": "https://hivemedia.co.kr",
            "logo": {
                "@type": "ImageObject",
                "url": "https://hivemedia.co.kr/assets/img/logo_img_b.png"
            }
        },
        "breadcrumb": {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {"@type": "ListItem", "position": 1, "name": "Home", "item": "https://hivemedia.co.kr/"},
                {"@type": "ListItem", "position": 2, "name": "Archive", "item": "https://hivemedia.co.kr/archive/"}
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
            background: #f5f5f0 !important;
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
        .archive-main {
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

        .page-title {
            font-size: 48px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -2px;
            line-height: 1;
            margin-bottom: 8px;
        }

        .page-title-sub {
            font-size: 72px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -4px;
            line-height: 0.9;
            margin-bottom: 40px;
        }

        .intro-text {
            font-family: NotoSansKR-Light;
            font-size: 1.6rem;
            line-height: 1.8;
            color: var(--text-color);
            margin-bottom: 20px;
            max-width: 320px;
        }

        .stats-box {
            margin-top: 40px;
            padding: 20px 0;
            border-top: 1px solid #ddd;
        }

        .stat-item {
            display: flex;
            justify-content: space-between;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .stat-item .label {
            color: #666;
        }

        .stat-item .value {
            font-weight: 700;
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

        /* Article List */
        .article-list .article-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-family: NotoSansKR-Light;
            font-size: 1.6rem;
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
            cursor: pointer;
            transition: all 0.2s;
        }

        .article-row:hover {
            background: rgba(0, 0, 0, 0.03);
            padding-left: 10px;
            margin-left: -10px;
            padding-right: 10px;
            margin-right: -10px;
        }

        .article-row .title {
            flex: 1;
            font-weight: 400;
            line-height: 1.5;
        }

        .article-row .category {
            width: 120px;
            text-align: center;
            color: #666;
        }

        .article-row .date {
            width: 100px;
            text-align: right;
            color: #888;
        }

        /* Category List */
        .category-list .cat-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-family: NotoSansKR-Light;
            font-size: 1.6rem;
            padding: 12px 0;
            border-bottom: 1px solid #ddd;
        }

        .cat-row .name {
            flex: 1;
        }

        .cat-row .count {
            width: 40px;
            text-align: right;
            color: #888;
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
            .archive-main {
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

            .page-title {
                font-size: 36px;
            }

            .page-title-sub {
                font-size: 48px;
            }
        }

        @media (max-width: 768px) {
            .article-row .category {
                display: none;
            }

            .article-row .date {
                width: 80px;
            }
        }

        /* Loading State */
        .loading-text {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Accordion Bento Grid */
        .accordion-bento-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .accordion-bento-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 200px;
        }

        .accordion-bento-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .accordion-bento-card__header {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 32px 24px;
            cursor: pointer;
            transition: background 0.3s;
            height: 100%;
            min-height: 200px;
            text-align: center;
        }

        .accordion-bento-card__header:hover {
            background: rgba(0, 0, 0, 0.02);
        }

        .accordion-bento-card__left {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
        }

        .accordion-bento-card__icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-bottom: 8px;
        }

        .accordion-bento-card__info h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 4px;
        }

        .accordion-bento-card__info p {
            font-size: 12px;
            color: #888;
            font-family: NotoSansKR-Light;
        }

        .accordion-bento-card__right {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 16px;
        }

        .accordion-bento-card__count {
            font-size: 36px;
            font-weight: 700;
            color: #0084ff;
        }

        .accordion-bento-card__count span {
            font-size: 14px;
            font-weight: 400;
            color: #888;
            margin-left: 4px;
        }

        .accordion-bento-card__toggle {
            display: none;
        }

        .accordion-bento-card__content {
            display: none;
        }

        .accordion-bento-card__articles {
            padding: 0 24px 24px;
            border-top: 1px solid #eee;
        }

        .accordion-article-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 12px 0;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.2s;
        }

        .accordion-article-row:last-child {
            border-bottom: none;
        }

        .accordion-article-row:hover {
            padding-left: 8px;
        }

        .accordion-article-row .title {
            flex: 1;
            font-family: NotoSansKR-Light;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }

        .accordion-article-row .date {
            font-size: 12px;
            color: #999;
            margin-left: 16px;
        }

        .accordion-bento-card__more {
            display: block;
            text-align: center;
            padding: 12px;
            margin-top: 8px;
            background: #f8f8f8;
            border-radius: 8px;
            font-size: 11px;
            font-weight: 600;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-decoration: none;
            transition: all 0.3s;
        }

        .accordion-bento-card__more:hover {
            background: #1a1a1a;
            color: #fff;
        }

        /* Category Color Themes */
        .accordion-bento-card--trend .accordion-bento-card__icon {
            background: rgba(0, 132, 255, 0.1);
            color: #0084ff;
        }

        .accordion-bento-card--trend .accordion-bento-card__count {
            color: #0084ff;
        }

        .accordion-bento-card--news .accordion-bento-card__icon {
            background: rgba(0, 200, 83, 0.1);
            color: #00C853;
        }

        .accordion-bento-card--news .accordion-bento-card__count {
            color: #00C853;
        }

        .accordion-bento-card--behind .accordion-bento-card__icon {
            background: rgba(255, 109, 0, 0.1);
            color: #FF6D00;
        }

        .accordion-bento-card--behind .accordion-bento-card__count {
            color: #FF6D00;
        }

        .accordion-bento-card--insight .accordion-bento-card__icon {
            background: rgba(124, 77, 255, 0.1);
            color: #7C4DFF;
        }

        .accordion-bento-card--insight .accordion-bento-card__count {
            color: #7C4DFF;
        }

        .accordion-bento-card--other .accordion-bento-card__icon {
            background: rgba(102, 102, 102, 0.1);
            color: #666;
        }

        .accordion-bento-card--other .accordion-bento-card__count {
            color: #666;
        }

        /* Responsive for Accordion Bento */
        @media (max-width: 1024px) {
            .accordion-bento-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .accordion-bento-grid {
                grid-template-columns: 1fr;
            }

            .accordion-bento-card {
                min-height: 160px;
            }

            .accordion-bento-card__header {
                padding: 24px 16px;
                min-height: 160px;
            }

            .accordion-bento-card__icon {
                width: 48px;
                height: 48px;
                font-size: 20px;
            }

            .accordion-bento-card__info h3 {
                font-size: 16px;
            }

            .accordion-bento-card__count {
                font-size: 28px;
            }
        }

        /* Article Modal Popup */
        .article-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .article-modal-overlay.active {
            opacity: 1;
            pointer-events: auto;
        }

        .article-modal {
            background: #fff;
            border-radius: 20px;
            max-width: 600px;
            width: 90%;
            max-height: 80vh;
            overflow: hidden;
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .article-modal-overlay.active .article-modal {
            transform: translateY(0);
        }

        .article-modal__header {
            padding: 24px;
            background: #f8f8f8;
            border-bottom: 1px solid #eee;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .article-modal__title {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .article-modal__title-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .article-modal__title h2 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .article-modal__title p {
            font-size: 12px;
            color: #888;
        }

        .article-modal__close {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: #eee;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            transition: all 0.2s;
        }

        .article-modal__close:hover {
            background: #1a1a1a;
            color: #fff;
        }

        .article-modal__content {
            padding: 16px 24px;
            max-height: 60vh;
            overflow-y: auto;
        }

        .article-modal__list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .article-modal__item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
            border-bottom: 1px solid #f0f0f0;
            cursor: pointer;
            transition: all 0.2s;
        }

        .article-modal__item:last-child {
            border-bottom: none;
        }

        .article-modal__item:hover {
            padding-left: 8px;
            background: rgba(0, 132, 255, 0.03);
            margin: 0 -24px;
            padding-right: 32px;
            padding-left: 32px;
        }

        .article-modal__item-title {
            font-family: NotoSansKR-Light;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
            flex: 1;
        }

        .article-modal__item-date {
            font-size: 12px;
            color: #999;
            margin-left: 16px;
            white-space: nowrap;
        }
    </style>
</head>

<body>
    <div class="Wrap">
        <div id="header-placeholder"></div>

        <main class="archive-main">
            <!-- Left Panel - 40% -->
            <div class="left-panel">
                <h1 class="page-title">NEWS &</h1>
                <h1 class="page-title-sub">ARCHIVE</h1>

                <p class="intro-text">
                    마케팅 업계 최신 뉴스와
                    하이브미디어의 프로젝트 비하인드 스토리.
                </p>

                <p class="intro-text">
                    부산 광고업계의
                    생생한 현장을 전합니다.
                </p>

                <div class="stats-box" id="statsBox">
                    <div class="stat-item">
                        <span class="label">TOTAL ARTICLES</span>
                        <span class="value" id="totalArticles">—</span>
                    </div>
                    <div class="stat-item">
                        <span class="label">CATEGORIES</span>
                        <span class="value" id="totalCategories">—</span>
                    </div>
                    <div class="stat-item">
                        <span class="label">LAST UPDATED</span>
                        <span class="value" id="lastUpdated">—</span>
                    </div>
                </div>

                <a href="<?php echo $base_path; ?>/contact.html" class="cta-button">문의하기</a>

                <div class="left-footer">
                    <a href="mailto:hivemedia@naver.com">EMAIL</a>
                    <a href="https://blog.naver.com/hivemedia" target="_blank">BLOG</a>
                    <a href="https://www.instagram.com/hivemedia_official" target="_blank">INSTAGRAM</a>
                    <a href="<?php echo $base_path; ?>/portfolio/write.php" class="write-link">포트폴리오 등록</a>
                    <p class="copyright">© HIVE MEDIA 2025</p>
                </div>
            </div>

            <!-- Right Panel - 60% -->
            <div class="right-panel">
                <!-- Accordion Bento Grid -->
                <div class="accordion-bento-grid" id="accordionBentoGrid">
                    <div class="loading-text">LOADING...</div>
                </div>
            </div>
        </main>

        <div id="footer-placeholder"></div>
    </div>

    <!-- Article Modal -->
    <div class="article-modal-overlay" id="articleModal" onclick="closeModal(event)">
        <div class="article-modal" onclick="event.stopPropagation()">
            <div class="article-modal__header">
                <div class="article-modal__title">
                    <div class="article-modal__title-icon" id="modalIcon">📁</div>
                    <div>
                        <h2 id="modalCategoryName">카테고리</h2>
                        <p id="modalCategoryDesc">카테고리 설명</p>
                    </div>
                </div>
                <button class="article-modal__close" onclick="closeModal()">&times;</button>
            </div>
            <div class="article-modal__content">
                <ul class="article-modal__list" id="modalArticleList">
                </ul>
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
        const basePath = '<?php echo $base_path; ?>';

        // 카테고리 테마 설정
        const categoryThemes = {
            '마케팅 트렌드': { theme: 'trend', icon: '📈', subtitle: '마케팅 동향 & 전략' },
            '업계 소식': { theme: 'news', icon: '📰', subtitle: '광고업계 뉴스' },
            '프로젝트 비하인드': { theme: 'behind', icon: '🎬', subtitle: '프로젝트 스토리' },
            '디지털 인사이트': { theme: 'insight', icon: '💡', subtitle: '디지털 마케팅 인사이트' },
            'OTHER': { theme: 'other', icon: '📁', subtitle: '기타 콘텐츠' }
        };

        // 날짜 포맷
        function formatDate(timestamp) {
            if (!timestamp) return '—';
            let date;
            if (timestamp.toDate) {
                date = timestamp.toDate();
            } else if (timestamp.seconds) {
                date = new Date(timestamp.seconds * 1000);
            } else {
                date = new Date(timestamp);
            }
            return date.toLocaleDateString('ko-KR', {
                month: '2-digit',
                day: '2-digit'
            }).replace(/\. /g, '.').replace(/\.$/, '');
        }

        // 아티클 데이터 가져오기
        async function fetchArticles() {
            try {
                const articlesRef = collection(db, 'articles');
                const q = query(articlesRef, orderBy('createdAt', 'desc'));
                const querySnapshot = await getDocs(q);

                const articles = [];
                querySnapshot.forEach((doc) => {
                    const data = doc.data();
                    if (!data.status || data.status === 'published') {
                        articles.push({
                            id: doc.id,
                            ...data
                        });
                    }
                });

                renderStats(articles);
                renderAccordionBento(articles);
            } catch (error) {
                console.error('Error fetching articles:', error);
                document.getElementById('accordionBentoGrid').innerHTML = '<div class="loading-text">FAILED TO LOAD</div>';
            }
        }

        // 통계 렌더링
        function renderStats(articles) {
            document.getElementById('totalArticles').textContent = articles.length;

            const categories = [...new Set(articles.map(a => a.category).filter(Boolean))];
            document.getElementById('totalCategories').textContent = categories.length;

            if (articles.length > 0 && articles[0].createdAt) {
                document.getElementById('lastUpdated').textContent = formatDate(articles[0].createdAt);
            }
        }

        // 카테고리별 테마 가져오기
        function getCategoryTheme(category) {
            return categoryThemes[category] || categoryThemes['OTHER'];
        }

        // 전역 변수로 카테고리별 글 저장
        let categoryArticlesMap = {};

        // 아코디언 벤또 그리드 렌더링
        function renderAccordionBento(articles) {
            const gridEl = document.getElementById('accordionBentoGrid');
            
            // 카테고리별로 그룹화
            categoryArticlesMap = {};
            articles.forEach(article => {
                const cat = article.category || 'OTHER';
                if (!categoryArticlesMap[cat]) {
                    categoryArticlesMap[cat] = [];
                }
                categoryArticlesMap[cat].push(article);
            });

            // 글 수 기준으로 정렬
            const sortedCategories = Object.entries(categoryArticlesMap)
                .sort((a, b) => b[1].length - a[1].length);

            if (sortedCategories.length === 0) {
                gridEl.innerHTML = '<div class="loading-text">NO ARTICLES YET</div>';
                return;
            }

            // 벤또 카드 생성 (클릭시 모달 열림)
            gridEl.innerHTML = sortedCategories.map(([category, categoryArticles]) => {
                const theme = getCategoryTheme(category);

                return `
                    <div class="accordion-bento-card accordion-bento-card--${theme.theme}" 
                         data-category="${category}" 
                         onclick="openModal('${category}')">
                        <div class="accordion-bento-card__header">
                            <div class="accordion-bento-card__left">
                                <div class="accordion-bento-card__icon">${theme.icon}</div>
                                <div class="accordion-bento-card__info">
                                    <h3>${category}</h3>
                                    <p>${theme.subtitle}</p>
                                </div>
                            </div>
                            <div class="accordion-bento-card__right">
                                <div class="accordion-bento-card__count">${categoryArticles.length}<span>건</span></div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // 모달 열기
        window.openModal = function(category) {
            const theme = getCategoryTheme(category);
            const articles = categoryArticlesMap[category] || [];
            
            // 모달 헤더 업데이트
            document.getElementById('modalIcon').textContent = theme.icon;
            document.getElementById('modalIcon').style.background = getComputedStyle(
                document.querySelector(`.accordion-bento-card--${theme.theme} .accordion-bento-card__icon`)
            ).background;
            document.getElementById('modalCategoryName').textContent = category;
            document.getElementById('modalCategoryDesc').textContent = `${articles.length}개의 아티클`;
            
            // 글 목록 렌더링
            const listEl = document.getElementById('modalArticleList');
            listEl.innerHTML = articles.map(article => `
                <li class="article-modal__item" onclick="location.href='${basePath}/archive/view.php?id=${article.id}'">
                    <span class="article-modal__item-title">${article.title || 'Untitled'}</span>
                    <span class="article-modal__item-date">${formatDate(article.createdAt)}</span>
                </li>
            `).join('');
            
            // 모달 표시
            document.getElementById('articleModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        };

        // 모달 닫기
        window.closeModal = function(event) {
            if (event && event.target !== event.currentTarget) return;
            document.getElementById('articleModal').classList.remove('active');
            document.body.style.overflow = '';
        };

        // ESC 키로 모달 닫기
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // 페이지 로드 시 실행
        fetchArticles();
    </script>
</body>

</html>