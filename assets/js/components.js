/**
 * Components Loader - Inline Version
 * Header and Footer HTML embedded directly (no fetch needed)
 */

// Get the base path based on current page location
function getBasePath() {
    const scripts = document.querySelectorAll('script[src*="components.js"]');
    for (const script of scripts) {
        const src = script.getAttribute('src');
        const idx = src.indexOf('assets/js/components.js');
        if (idx >= 0) {
            return src.substring(0, idx) || './';
        }
    }
    return './';
}

// Fix paths in HTML string
function fixPaths(html, basePath) {
    return html.replace(/href="\.\/"/g, `href="${basePath}"`)
        .replace(/href="\.\//g, `href="${basePath}`)
        .replace(/src="\.\//g, `src="${basePath}`)
        .replace(/href="portfolio\//g, `href="${basePath}portfolio/`)
        .replace(/href="archive\//g, `href="${basePath}archive/`)
        .replace(/href="service\//g, `href="${basePath}service/`)
        .replace(/href="about\.html"/g, `href="${basePath}about.html"`)
        .replace(/href="contact\.html"/g, `href="${basePath}contact.html"`);
}

// ==================== HEADER HTML ====================
const HEADER_HTML = `
<!-- Header Component -->
<header class="header">
    <div class="conbox">
        <div class="logo"><a href="./"><img src="./assets/img/logo_img.png" alt="하이브미디어 로고"></a></div>
    </div>
    <div class="util-btn">
        <a href="./assets/download/hivemedia_about.pdf" class="btn-brochure" download="하이브미디어_회사소개서.pdf">
            <span>회사소개서</span>
        </a>
        <button type="button" class="btn-nav-open">
            <span><em class="blind">Menu</em></span>
        </button>
    </div>
</header>

<style>
    .header .logo img {
        filter: brightness(0) invert(1);
    }
    .header .btn-nav-open span::before,
    .header .btn-nav-open span::after {
        background: #fff !important;
    }
    .header .slider {
        border-color: rgba(255, 255, 255, 0.5) !important;
    }
    .btn-brochure {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 6px 14px;
        background: #fff;
        color: #111;
        font-size: 12px;
        font-weight: 600;
        font-family: 'Noto Sans KR', sans-serif;
        text-decoration: none;
        border-radius: 15px;
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
        margin-right: 12px;
        white-space: nowrap;
        height: 30px;
        letter-spacing: -0.3px;
    }
    .btn-brochure:hover {
        background: #0084ff;
        color: #fff;
        box-shadow: 0 2px 8px rgba(0, 132, 255, 0.4);
    }
    .btn-brochure span {
        position: relative;
    }
    @media (max-width: 768px) {
        .btn-brochure {
            padding: 5px 10px;
            font-size: 11px;
            margin-right: 8px;
            height: 26px;
        }
    }
    @media (max-width: 480px) {
        .btn-brochure {
            padding: 5px 10px;
        }
    }
    .gnb .nav-sub {
        display: none;
    }
    .nav-wrap .inner {
        display: flex !important;
        flex-direction: row !important;
        justify-content: space-between !important;
        align-items: flex-start !important;
        width: 100% !important;
        max-width: 1600px !important;
        margin: 0 auto !important;
        padding: 120px 80px !important;
        height: 100vh !important;
    }
    .nav-wrap .gnb {
        order: 1 !important;
        width: 60% !important;
    }
    .nav-wrap .gnb .inn {
        min-width: auto !important;
    }
    .nav-wrap .gnb>.inn>ul {
        display: flex !important;
        flex-direction: column !important;
        gap: 0 !important;
    }
    .nav-wrap .gnb>.inn>ul>li {
        margin-bottom: 0 !important;
    }
    .nav-wrap .gnb>.inn>ul>li>a {
        font-size: clamp(48px, 8vw, 90px) !important;
        font-family: 'Poppins', Poppins-Bold, sans-serif !important;
        font-weight: 800 !important;
        color: rgba(255, 255, 255, 0.2) !important;
        line-height: 1.1 !important;
        letter-spacing: -2px !important;
        transition: color 0.3s ease, transform 0.3s ease !important;
        display: inline-block !important;
    }
    .nav-wrap .gnb>.inn>ul>li>a:hover {
        color: #fff !important;
        transform: translateX(10px) !important;
    }
    .nav-wrap .gnb .depth2 {
        display: none !important;
    }
    .nav-wrap .company-info {
        order: 2 !important;
        width: 35% !important;
        display: flex !important;
        flex-direction: column !important;
        align-items: flex-end !important;
        text-align: right !important;
    }
    .nav-wrap .company-info .cpName {
        margin-bottom: 40px !important;
    }
    .nav-wrap .company-info .cpName h2 {
        font-size: 2rem !important;
        color: #fff !important;
    }
    .nav-wrap .company-info .cpName p {
        color: rgba(255, 255, 255, 0.5) !important;
    }
    .nav-wrap .company-info ul li {
        margin-bottom: 8px !important;
        display: flex !important;
        justify-content: flex-end !important;
    }
    .nav-wrap .company-info .copy {
        margin-top: 30px !important;
    }
    .nav-wrap .btn-nav-close {
        position: absolute;
        top: 30px;
        right: 40px;
        width: 40px;
        height: 40px;
        cursor: pointer;
        z-index: 100;
    }
    @media (max-width: 991px) {
        .nav-wrap .inner {
            flex-direction: column !important;
            padding: 100px 30px !important;
            overflow-y: auto !important;
        }
        .nav-wrap .gnb {
            width: 100% !important;
            order: 1 !important;
        }
        .nav-wrap .gnb>.inn>ul>li>a {
            font-size: clamp(36px, 10vw, 60px) !important;
        }
        .nav-wrap .company-info {
            width: 100% !important;
            order: 2 !important;
            align-items: flex-start !important;
            text-align: left !important;
            margin-top: 40px !important;
        }
        .nav-wrap .company-info ul li {
            justify-content: flex-start !important;
        }
    }
</style>

<aside class="nav-wrap">
    <div class="nav-main-content">
        <nav class="gnb nav-left">
            <div class="inn">
                <ul>
                    <li><a href="./" data-menu="home">HOME</a></li>
                    <li><a href="./about.html" data-menu="about">ABOUT</a></li>
                    <li><a href="./service/marketing.html" data-menu="services">SERVICES</a></li>
                    <li><a href="./portfolio/portfolio.php" data-menu="portfolio">PORTFOLIO</a></li>
                    <li><a href="./archive/archive.php" data-menu="archive">ARCHIVE</a></li>
                    <li><a href="./contact.html" data-menu="contact">CONTACT</a></li>
                </ul>
            </div>
        </nav>
        <div class="nav-right">
            <div class="nav-submenu-group" data-for="services">
                <h4>SERVICES</h4>
                <ul>
                    <li><a href="./service/marketing.html">온라인 마케팅</a></li>
                    <li><a href="./service/agency.html">웹에이전시</a></li>
                    <li><a href="./service/video.html">홍보영상</a></li>
                    <li><a href="./service/exhibition.html">전시아트</a></li>
                    <li><a href="./service/ad_strategy.html">광고전략연구소</a></li>
                </ul>
            </div>
            <div class="nav-submenu-group" data-for="portfolio">
                <h4>PORTFOLIO</h4>
                <ul>
                    <li><a href="./portfolio/portfolio.php#online_ad">온라인광고</a></li>
                    <li><a href="./portfolio/portfolio.php#sns">SNS</a></li>
                    <li><a href="./portfolio/portfolio.php#homepage">홈페이지</a></li>
                    <li><a href="./portfolio/portfolio.php#eventpage">이벤트페이지</a></li>
                    <li><a href="./portfolio/portfolio.php#video">영상제작</a></li>
                    <li><a href="./portfolio/portfolio.php#print">인쇄물</a></li>
                    <li><a href="./portfolio/portfolio.php#exhibition">전시아트</a></li>
                </ul>
            </div>
            <div class="nav-submenu-group" data-for="archive">
                <h4>ARCHIVE</h4>
                <ul>
                    <li><a href="./archive/archive.php?cat=trend">TREND</a></li>
                    <li><a href="./archive/archive.php?cat=insight">INSIGHT</a></li>
                    <li><a href="./archive/archive.php?cat=case">CASE STUDY</a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>

<style>
    .nav-wrap {
        display: flex !important;
        flex-direction: column !important;
        justify-content: space-between !important;
    }
    .nav-main-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        max-width: 1600px;
        width: 100%;
        margin: 0 auto;
        padding: 100px 80px 40px;
        flex: 1;
    }
    .nav-left {
        width: 55%;
        order: 2;
        text-align: right;
    }
    .nav-left .inn>ul {
        display: flex;
        flex-direction: column;
        gap: 0;
        align-items: flex-end;
    }
    .nav-left .inn>ul>li>a {
        font-size: clamp(42px, 7vw, 80px) !important;
        font-family: 'Poppins', Poppins-Bold, sans-serif !important;
        font-weight: 800 !important;
        color: rgba(255, 255, 255, 0.15) !important;
        line-height: 1.15 !important;
        letter-spacing: -2px !important;
        transition: all 0.3s ease !important;
        display: inline-block !important;
    }
    .nav-left .inn>ul>li>a:hover {
        color: #fff !important;
        transform: translateX(-15px) !important;
        animation: none !important;
    }
    .nav-left .inn>ul>li>a[data-menu="services"],
    .nav-left .inn>ul>li>a[data-menu="portfolio"] {
        color: rgba(255, 255, 255, 0.9) !important;
        animation: subtleGlow 1.5s ease-in-out infinite;
    }
    .nav-left .inn>ul>li>a[data-menu="services"]:hover,
    .nav-left .inn>ul>li>a[data-menu="portfolio"]:hover {
        animation: none;
        opacity: 1;
        color: #fff !important;
    }
    @keyframes subtleGlow {
        0%, 100% { opacity: 0.4; }
        50% { opacity: 1; }
    }
    .nav-right {
        width: 20%;
        position: relative;
        order: 1;
        height: 100%;
    }
    .nav-submenu-group {
        position: absolute;
        top: 42%;
        left: 50%;
        transform: translate(-50%, -50%);
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
        text-align: center;
        width: 100%;
    }
    .nav-submenu-group.active {
        opacity: 1;
        visibility: visible;
    }
    .nav-submenu-group:last-child {
        border-bottom: none;
    }
    .nav-submenu-group h4 {
        display: none;
    }
    .nav-submenu-group ul {
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-items: center;
    }
    .nav-submenu-group ul li a {
        font-size: 30px !important;
        color: rgba(255, 255, 255, 0.6) !important;
        transition: color 0.2s ease !important;
        font-weight: 500 !important;
        letter-spacing: -0.5px;
    }
    .nav-submenu-group ul li a:hover {
        color: #fff !important;
    }
    .nav-wrap>.inner {
        display: none !important;
    }
    @media (max-width: 991px) {
        .nav-main-content {
            flex-direction: column;
            padding: 80px 30px 30px;
        }
        .nav-left, .nav-right {
            width: 100%;
        }
        .nav-left .inn>ul>li>a {
            font-size: clamp(32px, 10vw, 50px) !important;
        }
        .nav-right {
            margin-top: 30px;
            flex-direction: row;
            flex-wrap: wrap;
            gap: 20px;
        }
        .nav-submenu-group {
            width: calc(50% - 10px);
        }
        .nav-submenu-group ul li a {
            font-size: 22px !important;
        }
    }
</style>
`;

// ==================== FOOTER HTML ====================
const FOOTER_HTML = `
<!-- Footer Component -->
<div class="moveTop">
    <button type="button" class="btn-move-top">
        <img src="./assets/img/top_btn.png" alt="최상단으로 이동">
    </button>
</div>
<footer class="footer">
    <div class="inner">
        <div class="foot-left">
            <div class="footer-logo"><img src="./assets/img/footer_logo.png" alt="하이브미디어 로고"></div>
            <a href="/admin/login.html"
                style="display: block; margin-top: 8px; font-size: 12px; color: #999; text-decoration: none;">관리자페이지</a>
        </div>
        <div class="foot-right company-info">
            <ul>
                <li class="vertical-bar-item">
                    <div class="vertical-bar"></div>
                </li>
                <li class="sns-icons-item">
                    <div class="fsns-icon">
                        <div class="iblog">
                            <a href="https://blog.naver.com/hivemedia_official" target="_blank">
                                <img src="./assets/img/iblog.png">
                            </a>
                        </div>
                        <div class="iinsta">
                            <a href="https://www.instagram.com/hivemedia_official" target="_blank">
                                <img src="./assets/img/iinsta.png">
                            </a>
                        </div>
                        <div class="iyoutube">
                            <a href="https://www.youtube.com/@%ED%95%98%EC%9D%B4%EB%B8%8C%EB%AF%B8%EB%94%94%EC%96%B4"
                                target="_blank">
                                <img src="./assets/img/iyoutube.png">
                            </a>
                        </div>
                    </div>
                </li>
                <li>
                    <span>Fax.</span>
                    <p>070.4850.8223</p>
                </li>
                <li>
                    <span>Tel.</span>
                    <p>070.7728.6334</p>
                </li>
            </ul>
        </div>
    </div>
    <p class="copy">Copyright © 2025 HIVEMEDIA. All rights reserved</p>
</footer>
`;

// Initialize components when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    const basePath = getBasePath();

    // Inject header
    const headerEl = document.getElementById('header-placeholder');
    if (headerEl) {
        headerEl.innerHTML = fixPaths(HEADER_HTML, basePath);
    }

    // Inject footer
    const footerEl = document.getElementById('footer-placeholder');
    if (footerEl) {
        footerEl.innerHTML = fixPaths(FOOTER_HTML, basePath);
    }

    // Re-initialize scripts
    initializeNavigation();
    initializeDarkMode();
    initializeMoveTop();
    initializeSubmenuHover();
});

// Navigation toggle functionality
function initializeNavigation() {
    const navOpenBtn = document.querySelector('.btn-nav-open');
    const navWrap = document.querySelector('.nav-wrap');

    if (navOpenBtn && navWrap) {
        navOpenBtn.addEventListener('click', () => {
            navWrap.classList.toggle('open');
            navOpenBtn.classList.toggle('on');
        });
    }
}

// Dark mode toggle functionality
function initializeDarkMode() {
    const darkModeBtn = document.querySelector('.btn-dark-light');
    const checkbox = document.querySelector('.btn-dark-light .light');

    if (darkModeBtn && checkbox) {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            checkbox.checked = true;
        }

        checkbox.addEventListener('change', () => {
            if (checkbox.checked) {
                document.documentElement.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            } else {
                document.documentElement.setAttribute('data-theme', 'light');
                localStorage.setItem('theme', 'light');
            }
        });
    }
}

// Move to top button functionality
function initializeMoveTop() {
    const moveTopBtn = document.querySelector('.btn-move-top');

    if (moveTopBtn) {
        moveTopBtn.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                moveTopBtn.parentElement.classList.add('show');
            } else {
                moveTopBtn.parentElement.classList.remove('show');
            }
        });
    }
}

// Submenu hover functionality
function initializeSubmenuHover() {
    const menuItems = document.querySelectorAll('.nav-left .inn > ul > li > a[data-menu]');
    const submenuGroups = document.querySelectorAll('.nav-submenu-group[data-for]');

    if (!menuItems.length || !submenuGroups.length) return;

    menuItems.forEach(function (item) {
        const menuKey = item.getAttribute('data-menu');
        const target = document.querySelector('.nav-submenu-group[data-for="' + menuKey + '"]');

        if (target) {
            item.parentElement.addEventListener('mouseenter', function () {
                submenuGroups.forEach(function (g) { g.classList.remove('active'); });
                target.classList.add('active');
            });

            item.parentElement.addEventListener('mouseleave', function () {
                target.classList.remove('active');
            });
        }
    });

    submenuGroups.forEach(function (group) {
        group.addEventListener('mouseenter', function () {
            group.classList.add('active');
        });
        group.addEventListener('mouseleave', function () {
            group.classList.remove('active');
        });
    });
}
