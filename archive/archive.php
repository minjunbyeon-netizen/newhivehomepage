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
    <title>하이브미디어 - ARCHIVE</title>
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

        /* Main Layout - 40:60 Split */
        .archive-main {
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
            font-size: 11px;
            line-height: 1.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        /* Article List */
        .article-list .article-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 0;
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
                    LATEST NEWS, MARKETING TRENDS,
                    AND INDUSTRY INSIGHTS FROM
                    HIVE MEDIA.
                </p>

                <p class="intro-text">
                    WE SHARE OUR KNOWLEDGE AND
                    EXPERIENCE IN DIGITAL MARKETING,
                    SNS MANAGEMENT, AND
                    PUBLIC SECTOR COMMUNICATIONS.
                </p>

                <p class="intro-text">
                    STAY UPDATED WITH THE LATEST
                    DEVELOPMENTS IN THE MARKETING
                    INDUSTRY AND LEARN FROM OUR
                    CASE STUDIES.
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

                <a href="<?php echo $base_path; ?>/contact.html" class="cta-button">CONTACT US</a>

                <div class="left-footer">
                    <a href="mailto:hivemedia@naver.com">EMAIL</a>
                    <a href="https://blog.naver.com/hivemedia" target="_blank">BLOG</a>
                    <a href="https://www.instagram.com/hivemedia_official" target="_blank">INSTAGRAM</a>
                    <p class="copyright">© HIVE MEDIA 2025</p>
                </div>
            </div>

            <!-- Right Panel - 60% -->
            <div class="right-panel">
                <!-- Categories Section -->
                <div class="section-block">
                    <span class="section-title">CATEGORIES</span>
                    <div class="category-list" id="categoryList">
                        <div class="cat-row loading-text">
                            <span class="name">LOADING...</span>
                        </div>
                    </div>
                </div>

                <!-- All Articles Section -->
                <div class="section-block">
                    <span class="section-title">ALL ARTICLES</span>
                    <div class="article-list" id="articleList">
                        <div class="article-row loading-text">
                            <span class="title">LOADING...</span>
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
        const basePath = '<?php echo $base_path; ?>';

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
            return date.toLocaleDateString('en-US', {
                year: '2-digit',
                month: '2-digit',
                day: '2-digit'
            }).replace(/\//g, '.');
        }

        // 아티클 데이터 가져오기
        async function fetchArticles() {
            try {
                const articlesRef = collection(db, 'articles');
                const q = query(articlesRef, orderBy('createdAt', 'desc'));
                const querySnapshot = await getDocs(q);

                const articles = [];
                querySnapshot.forEach((doc) => {
                    articles.push({
                        id: doc.id,
                        ...doc.data()
                    });
                });

                renderStats(articles);
                renderCategories(articles);
                renderArticles(articles);
            } catch (error) {
                console.error('Error fetching articles:', error);
                document.getElementById('articleList').innerHTML = '<div class="article-row"><span class="title">FAILED TO LOAD</span></div>';
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

        // 카테고리 렌더링
        function renderCategories(articles) {
            const categoryEl = document.getElementById('categoryList');
            const categoryCounts = {};

            articles.forEach(a => {
                const cat = a.category || 'OTHER';
                categoryCounts[cat] = (categoryCounts[cat] || 0) + 1;
            });

            const sortedCategories = Object.entries(categoryCounts)
                .sort((a, b) => b[1] - a[1]);

            if (sortedCategories.length === 0) {
                categoryEl.innerHTML = '<div class="cat-row"><span class="name">NO CATEGORIES</span></div>';
                return;
            }

            categoryEl.innerHTML = sortedCategories.map(([cat, count]) => `
                <div class="cat-row">
                    <span class="name">${cat.toUpperCase()}</span>
                    <span class="count">X${count}</span>
                </div>
            `).join('');
        }

        // 아티클 목록 렌더링
        function renderArticles(articles) {
            const articleEl = document.getElementById('articleList');

            if (articles.length === 0) {
                articleEl.innerHTML = '<div class="article-row"><span class="title">NO ARTICLES YET</span></div>';
                return;
            }

            articleEl.innerHTML = articles.map(article => {
                const title = (article.title || 'UNTITLED').toUpperCase();
                const category = (article.category || 'OTHER').toUpperCase();
                const date = formatDate(article.createdAt);

                return `
                    <div class="article-row" onclick="location.href='${basePath}/archive/view.php?id=${article.id}'">
                        <span class="title">${title}</span>
                        <span class="category">${category}</span>
                        <span class="date">${date}</span>
                    </div>
                `;
            }).join('');
        }

        // 페이지 로드 시 실행
        fetchArticles();
    </script>
</body>

</html>