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

        .portfolio-con.archive-con {
            background: #111;
            color: #fff;
            min-height: 100vh;
        }

        .archive-con .sub-top {
            background: #111;
            padding: 120px 5% 80px;
            border-bottom: 1px solid #333;
        }

        .archive-con .sub-top .inner {
            max-width: 1400px;
            margin: 0 auto;
        }

        .archive-con .sub-top .path {
            margin-bottom: 60px;
        }

        .archive-con .sub-top .path ul {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .archive-con .sub-top .path li {
            color: #888;
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .archive-con .sub-top .path img {
            filter: invert(1);
            opacity: 0.5;
            width: 12px;
        }

        .archive-con .sub-text {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 40px;
            width: 100%;
        }

        .archive-con .sub-text .title-wrapper {
            text-align: left;
        }

        .archive-con .sub-text h2.text_ani {
            font-size: 24px;
            font-style: italic;
            font-weight: 300;
            color: #888;
            font-family: Georgia, serif;
            margin-bottom: 10px;
        }

        .archive-con .sub-text h2.text_ani2 {
            font-size: 120px;
            font-weight: 900;
            color: #fff;
            letter-spacing: -6px;
            line-height: 0.9;
            text-transform: uppercase;
        }

        .archive-con .sub-text p {
            font-size: 14px;
            color: #aaa;
            max-width: 300px;
            line-height: 1.8;
            text-align: right;
        }

        .archive-con .btn-inquiry {
            display: none;
        }

        /* 콘텐츠 영역 */
        .archive-con .conbody {
            max-width: 1400px;
            margin: 0 auto;
            padding: 60px 5%;
        }


        .archive-con .contents {
            padding: 0;
        }

        /* ========================================
           매거진 스타일 아카이브 리스트
        ======================================== */
        .archive-list {
            display: flex;
            flex-direction: column;
            gap: 0;
            padding: 0;
            margin: 0;
            list-style: none;
            max-width: 1400px;
        }

        /* 첫 번째 아이템 - Featured (풀와이드) */
        .archive-item:first-child {
            grid-column: 1 / -1;
            display: grid;
            grid-template-columns: 1.2fr 1fr;
            gap: 60px;
            padding: 0 0 60px 0;
            border-bottom: 1px solid #e0e0e0;
            border-top: none;
            align-items: center;
        }

        .archive-item:first-child .img-wrap {
            display: block !important;
            aspect-ratio: 16 / 10;
            overflow: hidden;
            border-radius: 4px;
        }

        .archive-item:first-child .img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .archive-item:first-child:hover .img-wrap img {
            transform: scale(1.03);
        }

        .archive-item:first-child .text-wrap {
            flex-direction: column;
            align-items: flex-start;
            gap: 20px;
        }

        .archive-item:first-child .text-wrap .category {
            font-size: 11px;
            letter-spacing: 3px;
            color: #888;
            font-weight: 500;
            margin-bottom: 10px;
        }

        .archive-item:first-child .text-wrap h3 {
            font-size: 36px;
            font-weight: 600;
            line-height: 1.35;
            letter-spacing: -1px;
            -webkit-line-clamp: 3;
        }

        .archive-item:first-child .text-wrap p {
            display: block !important;
            font-size: 15px;
            color: #888;
            line-height: 1.8;
            margin-top: 10px;
        }

        .archive-item:first-child .text-wrap .date {
            font-size: 13px;
            color: #666;
            margin-top: 20px;
            font-style: italic;
            font-family: Georgia, serif;
        }

        /* 나머지 아이템 - 목록형 스타일 */
        .archive-item {
            background: transparent;
            overflow: hidden;
            cursor: pointer;
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 0;
            padding: 22px 0;
            border: none;
            border-bottom: 1px solid #222;
            transition: all 0.3s ease;
        }

        .archive-item:hover {
            background: rgba(255, 255, 255, 0.03);
            padding-left: 15px;
            margin-left: -15px;
            padding-right: 15px;
            margin-right: -15px;
        }

        .archive-item .img-wrap {
            display: none;
        }

        .archive-item .text-wrap {
            padding: 0;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: flex-start;
            gap: 25px;
            width: 100%;
        }

        .archive-item .text-wrap .category {
            display: inline-block;
            font-size: 11px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-weight: 500;
            min-width: 100px;
            flex-shrink: 0;
        }

        .archive-item .text-wrap h3 {
            font-size: 16px;
            font-weight: 500;
            color: #ccc;
            margin-bottom: 0;
            line-height: 1.5;
            flex: 1;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
            overflow: hidden;
            transition: color 0.2s ease;
        }

        .archive-item:hover .text-wrap h3 {
            color: #fff;
        }

        .archive-item .text-wrap p {
            display: none;
        }

        .archive-item .text-wrap .date {
            font-size: 12px;
            color: #555;
            display: block;
            font-style: italic;
            font-family: Georgia, serif;
            min-width: 100px;
            text-align: right;
            flex-shrink: 0;
        }


        /* 기본 썸네일 - Featured만 표시 */
        .default-thumb {
            display: flex !important;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f5f5f5 0%, #e8e8e8 100%);
            font-size: 48px;
            color: #ccc;
        }


        .archive-item:first-child .default-thumb {
            font-size: 80px;
        }

        @media (max-width: 1024px) {
            .archive-con .sub-text h2.text_ani2 {
                font-size: 72px;
            }

            .archive-list {
                grid-template-columns: repeat(2, 1fr);
                gap: 30px;
            }

            .archive-item:first-child {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .archive-item:first-child .text-wrap h3 {
                font-size: 28px;
            }
        }

        @media (max-width: 768px) {
            .archive-con .sub-text h2.text_ani2 {
                font-size: 48px;
                letter-spacing: -2px;
            }

            .archive-con .sub-text {
                flex-direction: column;
                align-items: flex-start;
            }

            .archive-list {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .archive-item:first-child .text-wrap h3 {
                font-size: 24px;
            }

            .archive-item .text-wrap h3 {
                font-size: 16px;
            }
        }

        /* 로딩 스피너 */
        .archive-loading {
            text-align: center;
            padding: 100px 20px;
            color: #888;
        }

        .archive-loading .spinner {
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

        /* 빈 상태 메시지 */
        .archive-empty {
            text-align: center;
            padding: 100px 20px;
            color: #888;
            display: none;
        }

        .archive-empty h3 {
            font-size: 24px;
            margin-bottom: 15px;
            color: #aaa;
        }

        .archive-empty p {
            font-size: 16px;
        }

        /* 기본 썸네일 - 숨김 */
        .default-thumb {
            display: none;
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
    </style>
</head>

<body>
    <div class="Wrap">
        <div id="header-placeholder"></div>

        <main class="">
            <div class="portfolio-con archive-con">
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
                                <span class="intro-text intro-text-top">Latest Stories</span>
                                <h2 class="text_ani2 gsap-title">Archive</h2>
                                <span class="intro-text intro-text-bottom">News & Insights</span>
                            </div>
                            <p class="gsap-subtitle">Marketing trends, industry news, and valuable insights updated
                                regularly.</p>
                        </div>
                        <div class="gsap-line"
                            style="height: 2px; background: linear-gradient(90deg, #fff, transparent); margin-top: 40px;">
                        </div>
                    </div>
                    <div class="btn-inquiry"><a href="<?php echo $base_path; ?>/inquiry/inquiry.php"><span
                                class="blind">문의</span></a></div>
                </div>

                <div class="conbody">
                    <!-- 카테고리 없음 - 깔끔한 아티클 리스트 -->

                    <div class="contents">
                        <div class="portfolio-section" style="text-align:left">
                            <div class="row">
                                <!-- 로딩 표시 -->
                                <div class="archive-loading" id="archiveLoading">
                                    <div class="spinner"></div>
                                    <p>아카이브를 불러오는 중...</p>
                                </div>

                                <!-- 빈 상태 메시지 -->
                                <div class="archive-empty" id="archiveEmpty">
                                    <h3>아카이브 준비 중</h3>
                                    <p>곧 새로운 콘텐츠가 업데이트 될 예정입니다.</p>
                                </div>

                                <!-- 아카이브 아이템 리스트 -->
                                <ul class="archive-list" id="archiveList"></ul>
                            </div>
                        </div>
                    </div>
                    <div class="dark_bg"></div>
                </div>
            </div>
        </main>

        <!-- Firebase SDK (CDN) -->
        <script type="module">
            import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
            import { getFirestore, collection, getDocs, query, orderBy, where } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

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
            let allArticles = [];

            // 날짜 포맷 함수
            function formatDate(timestamp) {
                if (!timestamp) return '';
                let date;
                if (timestamp.toDate) {
                    date = timestamp.toDate();
                } else if (timestamp.seconds) {
                    date = new Date(timestamp.seconds * 1000);
                } else {
                    date = new Date(timestamp);
                }
                return date.toLocaleDateString('ko-KR', {
                    year: 'numeric',
                    month: '2-digit',
                    day: '2-digit'
                });
            }

            // HTML 태그 제거 함수
            function stripHtml(html) {
                const tmp = document.createElement('div');
                tmp.innerHTML = html;
                return tmp.textContent || tmp.innerText || '';
            }

            // 아티클 렌더링
            function renderArticles(articles) {
                const listEl = document.getElementById('archiveList');
                const loadingEl = document.getElementById('archiveLoading');
                const emptyEl = document.getElementById('archiveEmpty');

                loadingEl.style.display = 'none';

                if (articles.length === 0) {
                    emptyEl.style.display = 'block';
                    listEl.innerHTML = '';
                    return;
                }

                emptyEl.style.display = 'none';

                listEl.innerHTML = articles.map(article => {
                    const title = article.title || '제목 없음';
                    const category = article.category || '기타';
                    const content = stripHtml(article.content || '').substring(0, 100);
                    const date = formatDate(article.createdAt);
                    const thumbnail = article.thumbnail || '';
                    const slug = article.slug || article.id;

                    return `
                <li class="archive-item" data-category="${category}" onclick="location.href='<?php echo $base_path; ?>/archive/view.php?id=${article.id}'">
                    <div class="img-wrap">
                        ${thumbnail
                            ? `<img src="${thumbnail}" alt="${title}" onerror="this.parentElement.innerHTML='<div class=\\'default-thumb\\'>📰</div>'">`
                            : `<div class="default-thumb">📰</div>`
                        }
                    </div>
                    <div class="text-wrap">
                        <span class="category">${category}</span>
                        <h3>${title}</h3>
                        <p>${content}...</p>
                        <span class="date">${date}</span>
                    </div>
                </li>
            `;
                }).join('');
            }

            // Firestore에서 아티클 가져오기
            async function fetchArticles() {
                try {
                    const articlesRef = collection(db, 'articles');
                    const q = query(articlesRef, orderBy('createdAt', 'desc'));
                    const querySnapshot = await getDocs(q);

                    allArticles = [];
                    querySnapshot.forEach((doc) => {
                        allArticles.push({
                            id: doc.id,
                            ...doc.data()
                        });
                    });

                    renderArticles(allArticles);
                } catch (error) {
                    console.error('Error fetching articles:', error);
                    document.getElementById('archiveLoading').innerHTML =
                        '<p style="color: #ff6b6b;">아카이브를 불러오는 데 실패했습니다.</p>';
                }
            }

            // 필터링 함수
            window.filterArticles = function (category) {
                if (category === 'all') {
                    renderArticles(allArticles);
                } else {
                    const filtered = allArticles.filter(a => a.category === category);
                    renderArticles(filtered);
                }
            };

            // 페이지 로드 시 실행
            fetchArticles();
        </script>

        <script src="//code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(function () {
                // 필터 탭 클릭 시
                $('.portfolio-itemTab .filter').on('click', function () {
                    $('.portfolio-itemTab .filter').removeClass('active');
                    $(this).addClass('active');

                    const category = $(this).data('filter');
                    window.filterArticles(category);
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

                // 2. 아카이브 리스트 아이템 애니메이션
                observeArchiveItems();
            }

            // MutationObserver로 동적 로드된 아이템 감지
            function observeArchiveItems() {
                const archiveList = document.getElementById('archiveList');

                const observer = new MutationObserver(function (mutations) {
                    mutations.forEach(function (mutation) {
                        if (mutation.addedNodes.length > 0) {
                            animateArchiveItems();
                        }
                    });
                });

                observer.observe(archiveList, { childList: true });

                // 이미 로드된 아이템이 있으면 바로 애니메이션
                if (archiveList.children.length > 0) {
                    animateArchiveItems();
                }
            }

            // 아카이브 아이템 애니메이션
            function animateArchiveItems() {
                const items = document.querySelectorAll('.archive-item');

                // 초기 상태 설정
                gsap.set(items, {
                    opacity: 0,
                    x: -30
                });

                // 순차적 등장 애니메이션
                gsap.to(items, {
                    opacity: 1,
                    x: 0,
                    duration: 0.6,
                    stagger: 0.08,
                    ease: 'power3.out',
                    scrollTrigger: {
                        trigger: '#archiveList',
                        start: 'top 85%'
                    }
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