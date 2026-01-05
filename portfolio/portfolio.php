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
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 0;
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

            .category-tabs {
                gap: 10px;
            }

            .category-tab {
                font-size: 10px;
            }
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

                <!-- All Projects List -->
                <div class="section-block">
                    <span class="section-title">PROJECTS</span>
                    <div class="single-col-list" id="projectsList">
                        <!-- Online AD Projects -->
                        <div class="list-row" data-category="online_ad">
                            <span class="name">부산시 관광홍보 네이버 SA 캠페인</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">해운대구 축제 구글 DA 프로모션</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">부산항만공사 항만투어 검색광고</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">경남도청 관광지원 카카오모먼트</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">김해시 농산물직거래 페이스북 광고</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">울산시 에코투어 인스타그램 광고</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">창원시 스마트시티 유튜브 프리롤</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">진주시 한옥마을 네이버 GFA</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">통영시 루지월드 리타겟팅 캠페인</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">거제시 해양레저 퍼포먼스 마케팅</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">사천시 항공우주박물관 DA 캠페인</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">밀양시 아리랑축제 SA 프로모션</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">양산시 워터파크 앱설치 캠페인</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">함안군 강주마을 버즈마케팅</span>
                            <span class="category">ONLINE AD</span>
                        </div>
                        <div class="list-row" data-category="online_ad">
                            <span class="name">합천군 황매산 철쭉제 온라인광고</span>
                            <span class="category">ONLINE AD</span>
                        </div>

                        <!-- SNS Projects -->
                        <div class="list-row" data-category="sns">
                            <span class="name">부산시 공식 인스타그램 운영</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">해운대구청 페이스북 콘텐츠</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">부산항만공사 유튜브 채널</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">부산문화재단 SNS 통합운영</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">기장군 관광 인스타그램</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">동래구청 SNS 카드뉴스 제작</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">수영구 라이프스타일 인스타</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">남구 갈맷길 페이스북 운영</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">북구청 젊은북구 SNS 브랜딩</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">사하구 낙동강 트위터 운영</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">연제구 온천천 인스타 콘텐츠</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">금정구 범어사 유튜브 시리즈</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">영도구 태종대 틱톡 챌린지</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">중구 광복동 스토리 콘텐츠</span>
                            <span class="category">SNS</span>
                        </div>
                        <div class="list-row" data-category="sns">
                            <span class="name">서구 송도 릴스 마케팅</span>
                            <span class="category">SNS</span>
                        </div>

                        <!-- Homepage Projects -->
                        <div class="list-row" data-category="homepage">
                            <span class="name">부산시 공식 홈페이지 리뉴얼</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">해운대구 관광포털 구축</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">부산항만공사 기업사이트</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">부산문화재단 웹사이트 개편</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">기장군 워터파크 예약시스템</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">동래온천축제 마이크로사이트</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">수영팔도시장 온라인몰</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">남구 갈맷길 트레킹앱 웹뷰</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">북구 구포시장 반응형 웹</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">사하구 다대포 해변 랜딩페이지</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">연제구 공공시설 예약포털</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">금정구 등산로 정보사이트</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">영도구 조선해양 산업관 웹</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">중구 국제시장 아카이브</span>
                            <span class="category">HOMEPAGE</span>
                        </div>
                        <div class="list-row" data-category="homepage">
                            <span class="name">서구 송도케이블카 티켓예매</span>
                            <span class="category">HOMEPAGE</span>
                        </div>

                        <!-- Eventpage Projects -->
                        <div class="list-row" data-category="eventpage">
                            <span class="name">부산불꽃축제 이벤트페이지</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">해운대모래축제 프로모션</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">자갈치축제 온라인응모</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">기장멸치축제 경품이벤트</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">동래읍성축제 SNS챌린지</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">수영전통민속예술축제 참여형</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">부산국제영화제 팬미팅</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">원아시아페스티벌 투표</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">부산락페스티벌 티켓추첨</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">크리스마스트리축제 포토존</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">부산바다축제 스탬프투어</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">낙동강하구 철새축제 퀴즈</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">감천문화마을 워크숍 신청</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">태종대 수국축제 인증이벤트</span>
                            <span class="category">EVENTPAGE</span>
                        </div>
                        <div class="list-row" data-category="eventpage">
                            <span class="name">광안리불꽃놀이 사전예약</span>
                            <span class="category">EVENTPAGE</span>
                        </div>

                        <!-- Video Projects -->
                        <div class="list-row" data-category="video">
                            <span class="name">부산시 홍보영상 "다이나믹부산"</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">해운대구 드론촬영 시네마틱</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">부산항만공사 물류허브 PR</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">부산문화재단 아티스트 다큐</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">기장군 일출 타임랩스</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">동래구 역사탐방 VR 360</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">수영구 민락수변공원 스케치</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">남구 이기대 트레킹 VLOG</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">북구 화명생태공원 자연다큐</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">사하구 을숙도 철새 영상</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">연제구 온천천 야경 시네마틱</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">금정구 범어사 사계절 영상</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">영도구 깡깡이마을 인터뷰</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">중구 40계단 스토리텔링</span>
                            <span class="category">VIDEO</span>
                        </div>
                        <div class="list-row" data-category="video">
                            <span class="name">서구 암남공원 모션그래픽</span>
                            <span class="category">VIDEO</span>
                        </div>

                        <!-- Print Projects -->
                        <div class="list-row" data-category="print">
                            <span class="name">부산시 관광가이드북 디자인</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">해운대구 축제 포스터</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">부산항만공사 연간보고서</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">부산문화재단 전시도록</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">기장군 특산물 브로슈어</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">동래구 역사문화 리플렛</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">수영구 맛집지도 인쇄물</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">남구 갈맷길 안내판</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">북구 구포시장 카탈로그</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">사하구 감천마을 엽서세트</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">연제구 공공시설 이용안내</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">금정구 금정산 등산지도</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">영도구 태종대 팸플릿</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">중구 국제시장 쇼핑가이드</span>
                            <span class="category">PRINT</span>
                        </div>
                        <div class="list-row" data-category="print">
                            <span class="name">서구 송도 관광 배너</span>
                            <span class="category">PRINT</span>
                        </div>

                        <!-- Exhibition Art Projects -->
                        <div class="list-row" data-category="exhibition">
                            <span class="name">부산시 박람회 메인부스</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">해운대구 관광전시회 부스</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">부산항만공사 해양엑스포</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">부산문화재단 아트페어 부스</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">기장군 농수산물 전시부스</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">동래구 역사관 상설전시</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">수영구 수산물박람회 연출</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">남구 UN평화공원 기획전시</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">북구 구포국수축제 체험존</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">사하구 국제전시회 한국관</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">연제구 스마트시티 전시관</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">금정구 산림박람회 부스</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">영도구 조선해양전시관</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">중구 근대역사관 미디어아트</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                        <div class="list-row" data-category="exhibition">
                            <span class="name">서구 송도해변 포토존 설치</span>
                            <span class="category">EXHIBITION</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <div id="footer-placeholder"></div>
    </div>

    <script>
        // Category Tab Filtering
        document.addEventListener('DOMContentLoaded', function () {
            const tabs = document.querySelectorAll('.category-tab');
            const items = document.querySelectorAll('#projectsList .list-row');

            tabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    // Update active tab
                    tabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');

                    const category = this.dataset.category;

                    // Filter items
                    items.forEach(item => {
                        if (category === 'all' || item.dataset.category === category) {
                            item.style.display = 'flex';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });
        });
    </script>
</body>

</html>