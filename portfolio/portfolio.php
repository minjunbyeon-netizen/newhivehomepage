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

        /* Header Override */
        .header {
            background: #f5f5f0 !important;
        }

        .header .conbox {
            background: #f5f5f0 !important;
        }

        /* Main Layout - 40:60 Split */
        .portfolio-main {
            display: flex;
            min-height: 100vh;
            padding-top: 80px;
        }

        /* Left Panel - 40% */
        .left-panel {
            width: 40%;
            padding: 60px 40px 60px 60px;
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
            font-size: 11px;
            line-height: 1.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            position: absolute;
            bottom: 60px;
            left: 60px;
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

        .copyright {
            margin-top: 20px;
            font-size: 10px;
            color: #888;
        }

        /* Right Panel - 60% */
        .right-panel {
            width: 60%;
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
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 0;
            border-bottom: 1px solid #ddd;
        }

        .list-row .name {
            flex: 1;
        }

        .list-row .award {
            flex: 1;
            text-align: center;
            color: #666;
        }

        .list-row .count {
            width: 40px;
            text-align: right;
            color: #888;
        }

        /* Footer Override */
        footer,
        .footer {
            background: #f5f5f0 !important;
            border-top: 1px solid #ddd;
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
        }

        /* Loading State */
        .loading-text {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>

<body>
    <div class="Wrap">
        <div id="header-placeholder"></div>

        <main class="portfolio-main">
            <!-- Left Panel - 40% -->
            <div class="left-panel">
                <h1 class="company-name">HIVE</h1>
                <h1 class="company-name-sub">MEDIA</h1>

                <div class="profile-image">
                    <img src="../assets/img/logo_img_b.png" alt="Hivemedia Logo">
                </div>

                <p class="intro-text">
                    AS A FULL-SERVICE MARKETING AGENCY WITH A
                    PASSION FOR PUBLIC SECTOR MARKETING,
                    WE BELIEVE IN CREATIVITY TO
                    EMPOWER BRANDS.
                </p>

                <p class="intro-text">
                    OUR GOAL IS TO CONNECT PEOPLE WITH
                    BRANDS AND BUSINESSES THROUGH DESIGN.
                    A COMBINATION OF STRONG CONCEPTS &
                    REFINED EXECUTION TO DELIVER PREMIUM
                    RESULTS.
                </p>

                <p class="intro-text">
                    WITH A SHARP EYE FOR DETAIL, A TYPICAL
                    STRAIGHTFORWARD APPROACH AND
                    ENDLESS AMBITION, WE'VE GAINED
                    EXPERIENCE WORKING FOR AGENCIES &
                    GOVERNMENT OFFICES ACROSS KOREA.
                </p>

                <p class="intro-text">
                    CURRENTLY WE'RE WORKING AS A MARKETING
                    AGENCY BASED IN BUSAN, KOREA
                    SINCE 2015.
                </p>

                <a href="<?php echo $base_path; ?>/contact.html" class="cta-button">LET'S TALK</a>

                <div class="left-footer">
                    <a href="mailto:hivemedia@naver.com">EMAIL</a>
                    <a href="https://blog.naver.com/hivemedia" target="_blank">BLOG</a>
                    <a href="https://www.instagram.com/hivemedia_official" target="_blank">INSTAGRAM</a>
                    <a href="https://www.youtube.com/@hivemedia" target="_blank">YOUTUBE</a>
                    <p class="copyright">© HIVE MEDIA 2025</p>
                </div>
            </div>

            <!-- Right Panel - 60% -->
            <div class="right-panel">
                <!-- Services Section -->
                <div class="section-block">
                    <span class="section-title">SERVICES</span>
                    <div class="two-col-list" id="servicesList">
                        <div class="list-item">SNS MANAGEMENT</div>
                        <div class="list-item">BRAND DESIGN</div>
                        <div class="list-item">CONTENT CREATION</div>
                        <div class="list-item">VIDEO PRODUCTION</div>
                        <div class="list-item">ONLINE MARKETING</div>
                        <div class="list-item">WEB DESIGN</div>
                        <div class="list-item">PROMOTIONAL VIDEO</div>
                        <div class="list-item">MOTION DESIGN</div>
                        <div class="list-item">EXHIBITION BOOTH</div>
                        <div class="list-item">EVENT PLANNING</div>
                    </div>
                </div>

                <!-- Selected Clients Section -->
                <div class="section-block">
                    <span class="section-title">SELECTED CLIENTS</span>
                    <div class="two-col-list" id="clientsList">
                        <div class="list-item loading-text">Loading...</div>
                    </div>
                </div>

                <!-- Projects by Category -->
                <div class="section-block">
                    <span class="section-title">PROJECTS BY CATEGORY</span>
                    <div class="single-col-list" id="categoryList">
                        <div class="list-row loading-text">
                            <span class="name">Loading...</span>
                        </div>
                    </div>
                </div>

                <!-- Recent Projects Section -->
                <div class="section-block">
                    <span class="section-title">RECENT PROJECTS</span>
                    <div class="single-col-list" id="recentProjects">
                        <div class="list-row loading-text">
                            <span class="name">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div id="footer-placeholder"></div>
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

        // 카테고리 한글 매핑
        const categoryNames = {
            'sns': 'SNS',
            'homepage': 'HOMEPAGE',
            'video': 'VIDEO',
            'online_ad': 'ONLINE AD'
        };

        // 포트폴리오 데이터 가져오기
        async function fetchPortfolios() {
            try {
                const portfoliosRef = collection(db, 'portfolios');
                const q = query(portfoliosRef, orderBy('createdAt', 'desc'));
                const querySnapshot = await getDocs(q);

                const portfolios = [];
                querySnapshot.forEach((doc) => {
                    portfolios.push({
                        id: doc.id,
                        ...doc.data()
                    });
                });

                renderClients(portfolios);
                renderCategories(portfolios);
                renderRecentProjects(portfolios);
            } catch (error) {
                console.error('Error fetching portfolios:', error);
                document.getElementById('clientsList').innerHTML = '<div class="list-item">Failed to load</div>';
            }
        }

        // 클라이언트 목록 렌더링
        function renderClients(portfolios) {
            const clientsEl = document.getElementById('clientsList');
            const uniqueClients = [...new Set(portfolios.map(p => p.title).filter(Boolean))];

            if (uniqueClients.length === 0) {
                clientsEl.innerHTML = '<div class="list-item">NO CLIENTS YET</div>';
                return;
            }

            clientsEl.innerHTML = uniqueClients.slice(0, 20).map(client =>
                `<div class="list-item">${client.toUpperCase()}</div>`
            ).join('');
        }

        // 카테고리별 프로젝트 수 렌더링
        function renderCategories(portfolios) {
            const categoryEl = document.getElementById('categoryList');
            const categoryCounts = {};

            portfolios.forEach(p => {
                const cat = p.category || 'other';
                categoryCounts[cat] = (categoryCounts[cat] || 0) + 1;
            });

            const categoryOrder = ['sns', 'homepage', 'video', 'online_ad'];
            let html = '';

            categoryOrder.forEach(cat => {
                const count = categoryCounts[cat] || 0;
                const displayName = categoryNames[cat] || cat.toUpperCase();
                html += `
                    <div class="list-row">
                        <span class="name">${displayName}</span>
                        <span class="award">—</span>
                        <span class="count">X${count}</span>
                    </div>
                `;
            });

            categoryEl.innerHTML = html || '<div class="list-row"><span class="name">NO DATA</span></div>';
        }

        // 최근 프로젝트 렌더링
        function renderRecentProjects(portfolios) {
            const recentEl = document.getElementById('recentProjects');
            const recentItems = portfolios.slice(0, 10);

            if (recentItems.length === 0) {
                recentEl.innerHTML = '<div class="list-row"><span class="name">NO PROJECTS YET</span></div>';
                return;
            }

            recentEl.innerHTML = recentItems.map(p => {
                const cat = categoryNames[p.category] || p.category?.toUpperCase() || 'OTHER';
                return `
                    <div class="list-row">
                        <span class="name">${(p.title || 'UNTITLED').toUpperCase()}</span>
                        <span class="award">${cat}</span>
                        <span class="count"></span>
                    </div>
                `;
            }).join('');
        }

        // 페이지 로드 시 실행
        fetchPortfolios();
    </script>
</body>

</html>