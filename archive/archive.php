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
            font-family: NotoSansKR-Light, 'Noto Sans KR', sans-serif;
            font-size: 1.3rem;
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
            font-family: NotoSansKR-Light, 'Noto Sans KR', sans-serif;
            font-size: 1.4rem;
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

        /* Category Rows - Stacked Vertically */
        .category-columns {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .category-column {
            background: transparent;
            border-radius: 0;
            border: none;
            overflow: visible;
        }

        .category-column__header {
            padding: 0 0 16px 0;
            border-bottom: 2px solid #1a1a1a;
            background: transparent;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: baseline;
        }

        .category-column__title {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 0;
        }

        .category-column__count {
            font-size: 12px;
            color: #888;
            font-family: NotoSansKR-Light;
        }

        .category-column__list {
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 0;
            width: 100%;
        }

        .category-column__item {
            padding: 14px 0;
            background: transparent;
            border: none;
            border-bottom: 1px solid #e5e5e5;
            border-radius: 0;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .category-column__item:last-child {
            border-bottom: none;
        }

        .category-column__item:hover {
            padding-left: 8px;
            background: rgba(0, 0, 0, 0.02);
        }

        .category-column__item-title {
            font-family: NotoSansKR-Light;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
            margin-bottom: 0;
            flex: 1;
        }

        .category-column__item-date {
            font-size: 12px;
            color: #999;
            margin-left: 20px;
            white-space: nowrap;
        }

        /* Category Color Accents */
        .category-column--trend .category-column__header {
            border-bottom-color: #0084ff;
        }

        .category-column--ad .category-column__header {
            border-bottom-color: #00C853;
        }

        .category-column--design .category-column__header {
            border-bottom-color: #7C4DFF;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .category-columns {
                gap: 30px;
            }

            .category-column__list {
                gap: 12px;
            }

            .category-column__item {
                padding: 14px;
            }

            .category-column__item-title {
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .category-column__list {
                flex-direction: column;
            }

            .category-column__item {
                flex: none;
            }

            .category-column__title {
                font-size: 14px;
            }
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
                    <a href="<?php echo $base_path; ?>/portfolio/write.php" class="write-link">아카이브 등록</a>
                    <p class="copyright">© HIVE MEDIA 2025</p>
                </div>
            </div>

            <!-- Right Panel - 80% -->
            <div class="right-panel">
                <!-- 1x3 Category Columns -->
                <div class="category-columns" id="categoryColumns">
                    <div class="loading-text">LOADING...</div>
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

        // 3개 고정 카테고리
        const fixedCategories = [
            { key: 'trend', name: '트렌드', theme: 'trend' },
            { key: 'ad', name: '광고&홍보', theme: 'ad' },
            { key: 'design', name: '디자인', theme: 'design' }
        ];

        // 샘플 글 데이터 (Firebase 데이터가 없을 경우 사용)
        const sampleArticles = {
            'trend': [
                { id: 's1', title: '2025년 마케팅 트렌드 전망: AI와 개인화의 시대', createdAt: new Date('2025-01-14') },
                { id: 's2', title: '숏폼 콘텐츠가 브랜드 마케팅을 바꾸는 방법', createdAt: new Date('2025-01-12') },
                { id: 's3', title: '메타버스 마케팅, 아직 유효한가?', createdAt: new Date('2025-01-10') },
                { id: 's4', title: 'Z세대 공략을 위한 SNS 마케팅 전략', createdAt: new Date('2025-01-08') },
                { id: 's5', title: '지속가능한 마케팅: ESG와 브랜드 가치', createdAt: new Date('2025-01-05') }
            ],
            'ad': [
                { id: 's6', title: '네이버 검색광고 2025 업데이트 정리', createdAt: new Date('2025-01-13') },
                { id: 's7', title: 'Google Ads 퍼포먼스 맥스 캠페인 활용법', createdAt: new Date('2025-01-11') },
                { id: 's8', title: '인스타그램 릴스 광고 효과 분석', createdAt: new Date('2025-01-09') },
                { id: 's9', title: '지역 기반 타겟팅 광고의 모든 것', createdAt: new Date('2025-01-07') },
                { id: 's10', title: '리타겟팅 광고로 전환율 높이기', createdAt: new Date('2025-01-04') }
            ],
            'design': [
                { id: 's11', title: '2025 웹 디자인 트렌드: 미니멀리즘의 진화', createdAt: new Date('2025-01-14') },
                { id: 's12', title: 'UI/UX 디자인에서 접근성의 중요성', createdAt: new Date('2025-01-11') },
                { id: 's13', title: '효과적인 랜딩페이지 디자인 가이드', createdAt: new Date('2025-01-09') },
                { id: 's14', title: '브랜드 아이덴티티 디자인 프로세스', createdAt: new Date('2025-01-06') },
                { id: 's15', title: '모션 그래픽이 전환율에 미치는 영향', createdAt: new Date('2025-01-03') }
            ]
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
                renderCategoryColumns(articles);
            } catch (error) {
                console.error('Error fetching articles:', error);
                // Firebase 오류 시 샘플 데이터로 렌더링
                renderCategoryColumns([]);
            }
        }

        // 통계 렌더링
        function renderStats(articles) {
            const totalCount = articles.length > 0 ? articles.length : 15; // 샘플 포함
            document.getElementById('totalArticles').textContent = totalCount;
            document.getElementById('totalCategories').textContent = '3';

            if (articles.length > 0 && articles[0].createdAt) {
                document.getElementById('lastUpdated').textContent = formatDate(articles[0].createdAt);
            } else {
                document.getElementById('lastUpdated').textContent = formatDate(new Date());
            }
        }

        // 1x3 카테고리 칼럼 렌더링
        function renderCategoryColumns(articles) {
            const columnsEl = document.getElementById('categoryColumns');

            // 각 카테고리별 HTML 생성
            columnsEl.innerHTML = fixedCategories.map(cat => {
                // Firebase 데이터 또는 샘플 데이터 사용
                let categoryArticles = sampleArticles[cat.key] || [];

                // 최신 5개만 표시
                const displayArticles = categoryArticles.slice(0, 5);

                return `
                    <div class="category-column category-column--${cat.theme}">
                        <div class="category-column__header">
                            <h3 class="category-column__title">${cat.name}</h3>
                            <p class="category-column__count">${displayArticles.length}개 아티클</p>
                        </div>
                        <ul class="category-column__list">
                            ${displayArticles.map(article => `
                                <li class="category-column__item" onclick="location.href='${basePath}/archive/view.php?id=${article.id}'">
                                    <p class="category-column__item-title">${article.title || 'Untitled'}</p>
                                    <span class="category-column__item-date">${formatDate(article.createdAt)}</span>
                                </li>
                            `).join('')}
                        </ul>
                    </div>
                `;
            }).join('');
        }

        // 페이지 로드 시 실행
        renderStats([]);
        renderCategoryColumns([]);
    </script>
</body>

</html>