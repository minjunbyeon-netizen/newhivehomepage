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
            font-family: NotoSansKR-Light, 'Noto Sans KR', sans-serif;
            font-size: 1.3rem;
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

        /* ========================================
           3D Card Style Bento Grid
        ======================================== */
        .bento-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-template-rows: auto auto;
            gap: 15px;
            /* Slightly tighter gap to fit more */
            margin-bottom: 40px;
        }

        .bento-card {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            box-shadow:
                0 4px 20px rgba(0, 0, 0, 0.06),
                0 0 0 1px rgba(255, 255, 255, 0.8) inset;
            min-height: 192.5px;
            /* Half of large card minus gap */
            backdrop-filter: blur(20px);
        }

        .bento-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow:
                0 30px 60px rgba(0, 0, 0, 0.12),
                0 0 0 1px rgba(255, 255, 255, 0.9) inset;
        }

        .bento-card--large {
            grid-column: span 1;
            grid-row: span 2;
            min-height: 400px;
            /* Slightly reduced height */
        }

        .bento-card__bg {
            position: absolute;
            inset: 0;
            background-size: cover;
            background-position: center;
            opacity: 0;
            transition: opacity 0.3s, transform 0.5s;
        }

        .bento-card:hover .bento-card__bg {
            opacity: 0.15;
            transform: scale(1.1);
        }

        .bento-card__content {
            position: relative;
            z-index: 2;
            height: 100%;
            padding: 28px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* 3D Icon Badge */
        .bento-card__badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
            color: inherit;
        }

        .bento-card__badge::before {
            content: '';
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: currentColor;
        }

        .bento-card__icon {
            width: 64px;
            height: 64px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 16px;
            position: relative;
            transform-style: preserve-3d;
            perspective: 500px;
        }

        /* 3D Icon Floating Effect */
        .bento-card__icon::after {
            content: '';
            position: absolute;
            inset: 0;
            border-radius: inherit;
            background: inherit;
            filter: blur(20px);
            opacity: 0.5;
            transform: translateY(10px) scale(0.9);
            z-index: -1;
        }

        .bento-card__title {
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 24px;
            font-weight: 800;
            color: #1a1a1a;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .bento-card__subtitle {
            font-size: 14px;
            color: #666;
            font-family: 'Noto Sans KR', sans-serif;
            font-weight: 400;
            line-height: 1.5;
        }

        .bento-card__count {
            font-size: 28px;
            font-weight: 700;
            opacity: 0.9;
        }

        .bento-card__count span {
            font-size: 14px;
            font-weight: 400;
            opacity: 0.7;
        }

        /* 3D Illustration Container */
        .bento-card__illustration {
            position: absolute;
            bottom: 20px;
            right: 20px;
            width: 120px;
            height: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 56px;
            transform-style: preserve-3d;
            perspective: 1000px;
            animation: float3d 4s ease-in-out infinite;
            filter: drop-shadow(0 20px 30px rgba(0, 0, 0, 0.15));
        }

        @keyframes float3d {

            0%,
            100% {
                transform: translateY(0) rotateX(5deg) rotateY(-5deg);
            }

            50% {
                transform: translateY(-15px) rotateX(-5deg) rotateY(5deg);
            }
        }

        /* Arrow Button */
        .bento-card__arrow {
            position: absolute;
            bottom: 24px;
            right: 24px;
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            color: #333;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .bento-card:hover .bento-card__arrow {
            background: #fff;
            transform: translateX(5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .bento-card--large .bento-card__title {
            font-size: 28px;
        }

        .bento-card--large .bento-card__illustration {
            width: 160px;
            height: 160px;
            font-size: 80px;
        }

        .bento-card--large .bento-card__count {
            font-size: 36px;
        }

        /* ========================================
           Card Theme Colors - 3D Style
        ======================================== */

        /* Online AD - Soft Gray/White */
        .bento-card--online {
            background: linear-gradient(145deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .bento-card--online .bento-card__icon {
            background: linear-gradient(135deg, #fff 0%, #f1f3f4 100%);
            color: #1a1a1a;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        }

        .bento-card--online .bento-card__badge {
            color: #666;
        }

        .bento-card--online .bento-card__title,
        .bento-card--online .bento-card__count {
            color: #1a1a1a;
        }

        /* SNS - Soft Blue/Purple Gradient */
        .bento-card--sns {
            background: linear-gradient(145deg, #e8f4fd 0%, #dbe9f6 100%);
        }

        .bento-card--sns .bento-card__icon {
            background: linear-gradient(135deg, #4fc3f7 0%, #29b6f6 100%);
            color: #fff;
            box-shadow: 0 8px 24px rgba(79, 195, 247, 0.4);
        }

        .bento-card--sns .bento-card__badge {
            color: #0288d1;
        }

        .bento-card--sns .bento-card__title,
        .bento-card--sns .bento-card__count {
            color: #1a1a1a;
        }

        /* Homepage - Deep Blue/Purple */
        .bento-card--homepage {
            background: linear-gradient(145deg, #5c6bc0 0%, #3949ab 100%);
        }

        .bento-card--homepage .bento-card__icon {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .bento-card--homepage .bento-card__badge {
            color: rgba(255, 255, 255, 0.9);
        }

        .bento-card--homepage .bento-card__title,
        .bento-card--homepage .bento-card__subtitle,
        .bento-card--homepage .bento-card__count {
            color: #fff;
        }

        .bento-card--homepage .bento-card__arrow {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Video - Teal/Green Gradient */
        .bento-card--video {
            background: linear-gradient(145deg, #00897b 0%, #00695c 100%);
        }

        .bento-card--video .bento-card__icon {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: #fff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }

        .bento-card--video .bento-card__badge {
            color: rgba(255, 255, 255, 0.9);
        }

        .bento-card--video .bento-card__title,
        .bento-card--video .bento-card__subtitle,
        .bento-card--video .bento-card__count {
            color: #fff;
        }

        .bento-card--video .bento-card__arrow {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        /* Event - Soft Cream/Peach */
        .bento-card--event {
            background: linear-gradient(145deg, #fff8e1 0%, #ffecb3 100%);
        }

        .bento-card--event .bento-card__icon {
            background: linear-gradient(135deg, #ffca28 0%, #ffa726 100%);
            color: #fff;
            box-shadow: 0 8px 24px rgba(255, 167, 38, 0.4);
        }

        .bento-card--event .bento-card__badge {
            color: #f57c00;
        }

        .bento-card--event .bento-card__title,
        .bento-card--event .bento-card__count {
            color: #1a1a1a;
        }

        /* Print - Soft Gray */
        .bento-card--print {
            background: linear-gradient(145deg, #f5f5f5 0%, #eeeeee 100%);
        }

        .bento-card--print .bento-card__icon {
            background: linear-gradient(135deg, #78909c 0%, #546e7a 100%);
            color: #fff;
            box-shadow: 0 8px 24px rgba(84, 110, 122, 0.4);
        }

        .bento-card--print .bento-card__badge {
            color: #546e7a;
        }

        .bento-card--print .bento-card__title,
        .bento-card--print .bento-card__count {
            color: #1a1a1a;
        }

        /* Exhibition - Purple Gradient */
        .bento-card--exhibition {
            background: linear-gradient(145deg, #f3e5f5 0%, #e1bee7 100%);
        }

        .bento-card--exhibition .bento-card__icon {
            background: linear-gradient(135deg, #ab47bc 0%, #8e24aa 100%);
            color: #fff;
            box-shadow: 0 8px 24px rgba(142, 36, 170, 0.4);
        }

        .bento-card--exhibition .bento-card__badge {
            color: #8e24aa;
        }

        .bento-card--exhibition .bento-card__title,
        .bento-card--exhibition .bento-card__count {
            color: #1a1a1a;
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
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Hide bento grid when category is selected */
        .bento-grid.hidden {
            display: none;
        }

        .section-block.hidden {
            display: none;
        }

        /* ========================================
           Clean Square Grid Styles
        ======================================== */
        .project-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
        }

        .project-card {
            position: relative;
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            background: linear-gradient(145deg, #f8f9fa, #e9ecef);
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            aspect-ratio: 1 / 1;
        }

        .project-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
            z-index: 10;
        }

        .project-card__image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .project-card:hover .project-card__image {
            transform: scale(1.05);
        }

        .project-card__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(180deg,
                    transparent 0%,
                    transparent 40%,
                    rgba(0, 0, 0, 0.7) 100%);
            opacity: 0.6;
            transition: opacity 0.4s ease;
        }

        .project-card:hover .project-card__overlay {
            opacity: 1;
            background: linear-gradient(180deg,
                    rgba(0, 0, 0, 0.2) 0%,
                    rgba(0, 0, 0, 0.4) 40%,
                    rgba(0, 0, 0, 0.85) 100%);
        }

        .project-card__info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 24px;
            color: #fff;
            transform: translateY(10px);
            opacity: 0.9;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .project-card:hover .project-card__info {
            transform: translateY(0);
            opacity: 1;
        }

        .project-card__category {
            display: inline-block;
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            padding: 4px 10px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            margin-bottom: 10px;
            color: #fff;
        }

        .project-card__title {
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
            line-height: 1.3;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .project-card__client {
            font-size: 13px;
            font-weight: 400;
            opacity: 0.85;
            letter-spacing: 0.5px;
        }

        .project-card__placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: #fff;
            font-size: 56px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 3px;
        }

        .project-card__placeholder::after {
            content: attr(data-category);
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 2px;
            opacity: 0.7;
        }

        /* Category Color Themes */
        .project-card[data-category="online_ad"] .project-card__placeholder {
            background: linear-gradient(135deg, #0066ff 0%, #00c6ff 100%);
        }

        .project-card[data-category="sns"] .project-card__placeholder {
            background: linear-gradient(135deg, #E1306C 0%, #F77737 100%);
        }

        .project-card[data-category="homepage"] .project-card__placeholder {
            background: linear-gradient(135deg, #1a1a1a 0%, #434343 100%);
        }

        .project-card[data-category="video"] .project-card__placeholder {
            background: linear-gradient(135deg, #FF0000 0%, #FF5722 100%);
        }

        .project-card[data-category="eventpage"] .project-card__placeholder {
            background: linear-gradient(135deg, #FFC107 0%, #FF9800 100%);
        }

        .project-card[data-category="print"] .project-card__placeholder {
            background: linear-gradient(135deg, #666666 0%, #999999 100%);
        }

        .project-card[data-category="exhibition"] .project-card__placeholder {
            background: linear-gradient(135deg, #9C27B0 0%, #673AB7 100%);
        }

        /* No items message */
        .no-items-message {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            color: #888;
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 16px;
            background: linear-gradient(145deg, #f8f9fa, #ffffff);
            border-radius: 20px;
            border: 1px dashed #ddd;
        }

        /* Responsive */
        @media (max-width: 1200px) {
            .project-grid {
                grid-template-columns: repeat(4, 1fr);
            }
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

            .project-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 10px;
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

            .project-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
            }

            .project-card__title {
                font-size: 12px;
            }

            .project-card__info {
                padding: 10px;
            }

            .project-card__category {
                font-size: 8px;
                padding: 2px 6px;
            }
        }

        @media (max-width: 480px) {
            .project-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 6px;
            }
        }

        /* Note: Card bottom info removed - using overlay info display in masonry grid */

        /* ========================================
           Portfolio Modal Popup
        ======================================== */
        .portfolio-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            z-index: 10000;
            display: none;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .portfolio-modal.active {
            display: flex;
            opacity: 1;
        }

        .portfolio-modal__content {
            background: #fff;
            width: 90%;
            max-width: 900px;
            max-height: 90vh;
            border-radius: 16px;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            transform: scale(0.9) translateY(20px);
            transition: transform 0.3s ease;
        }

        .portfolio-modal.active .portfolio-modal__content {
            transform: scale(1) translateY(0);
        }

        .portfolio-modal__header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 24px;
            border-bottom: 1px solid #eee;
            background: #fafafa;
        }

        .portfolio-modal__title {
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 20px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .portfolio-modal__close {
            width: 40px;
            height: 40px;
            border: none;
            background: #f0f0f0;
            border-radius: 50%;
            cursor: pointer;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s;
        }

        .portfolio-modal__close:hover {
            background: #e0e0e0;
        }

        .portfolio-modal__body {
            padding: 24px;
            overflow-y: auto;
            flex: 1;
        }

        .portfolio-modal__image {
            width: 100%;
            max-height: 400px;
            object-fit: contain;
            border-radius: 8px;
            margin-bottom: 24px;
            background: #f5f5f5;
        }

        .portfolio-modal__meta {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
            margin-bottom: 24px;
            padding: 16px;
            background: #f9f9f9;
            border-radius: 8px;
        }

        .portfolio-modal__meta-item {
            font-family: 'Noto Sans KR', sans-serif;
        }

        .portfolio-modal__meta-label {
            font-size: 12px;
            color: #888;
            margin-bottom: 4px;
        }

        .portfolio-modal__meta-value {
            font-size: 15px;
            font-weight: 600;
            color: #1a1a1a;
        }

        .portfolio-modal__description {
            font-family: 'Noto Sans KR', sans-serif;
            font-size: 15px;
            line-height: 1.8;
            color: #444;
        }

        /* Gallery Styles */
        .portfolio-modal__gallery {
            margin-bottom: 16px;
            border-radius: 12px;
            overflow: hidden;
            background: #f5f5f5;
            min-height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .portfolio-modal__main-image {
            width: 100%;
            max-height: 450px;
            object-fit: contain;
        }

        .portfolio-modal__gallery-placeholder {
            color: #999;
            font-size: 14px;
            text-align: center;
            padding: 40px;
        }

        .portfolio-modal__thumbnails {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
            gap: 8px;
            margin-bottom: 20px;
        }

        .portfolio-modal__thumbnails:empty {
            display: none;
        }

        .portfolio-modal__thumb {
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: border-color 0.2s, transform 0.2s;
        }

        .portfolio-modal__thumb:hover {
            transform: scale(1.05);
        }

        .portfolio-modal__thumb.active {
            border-color: #0084ff;
        }

        .portfolio-modal__thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .portfolio-modal__content {
                width: 95%;
                max-height: 95vh;
            }

            .portfolio-modal__meta {
                grid-template-columns: 1fr;
            }

            .portfolio-modal__header {
                padding: 16px;
            }

            .portfolio-modal__body {
                padding: 16px;
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
            background: #fff;
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
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #1a1a1a;
            font-family: 'Poppins', sans-serif;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .skip-btn:hover {
            background: rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.3);
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
                    <?php /* <a href="./write.php" class="write-link">포트폴리오 등록</a> */ ?>
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
                                <span class="bento-card__badge">온라인 광고</span>
                                <div class="bento-card__icon">📊</div>
                                <h3 class="bento-card__title">온라인 광고<br>캠페인 관리</h3>
                                <p class="bento-card__subtitle">검색광고 · DA · 리타겟팅</p>
                            </div>
                            <div>
                                <p class="bento-card__count">0 <span>projects</span></p>
                            </div>
                        </div>
                        <div class="bento-card__arrow">→</div>
                    </div>

                    <!-- SNS 운영 -->
                    <div class="bento-card bento-card--sns" data-category="sns">
                        <div class="bento-card__bg" style="background-image: url('./img/sns.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <span class="bento-card__badge">SNS 운영</span>
                                <div class="bento-card__icon">📱</div>
                                <h3 class="bento-card__title">SNS 채널<br>운영 관리</h3>
                                <p class="bento-card__subtitle">콘텐츠 제작 · 운영대행</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                        <div class="bento-card__arrow">→</div>
                    </div>

                    <!-- 홈페이지 -->
                    <div class="bento-card bento-card--homepage" data-category="homepage">
                        <div class="bento-card__bg" style="background-image: url('./img/homepage.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <span class="bento-card__badge">웹사이트</span>
                                <div class="bento-card__icon">🌐</div>
                                <h3 class="bento-card__title">홈페이지<br>구축 서비스</h3>
                                <p class="bento-card__subtitle">웹사이트 · 포털 구축</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                        <div class="bento-card__arrow">→</div>
                    </div>

                    <!-- 영상 제작 -->
                    <div class="bento-card bento-card--video" data-category="video">
                        <div class="bento-card__bg" style="background-image: url('./img/video.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <span class="bento-card__badge">영상 제작</span>
                                <div class="bento-card__icon">🎬</div>
                                <h3 class="bento-card__title">홍보영상<br>제작 서비스</h3>
                                <p class="bento-card__subtitle">홍보영상 · 시네마틱</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                        <div class="bento-card__arrow">→</div>
                    </div>

                    <!-- 이벤트페이지 -->
                    <div class="bento-card bento-card--event" data-category="eventpage">
                        <div class="bento-card__bg" style="background-image: url('./img/event.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <span class="bento-card__badge">이벤트 페이지</span>
                                <div class="bento-card__icon">🎉</div>
                                <h3 class="bento-card__title">이벤트<br>프로모션</h3>
                                <p class="bento-card__subtitle">이벤트 · 경품 행사</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                        <div class="bento-card__arrow">→</div>
                    </div>

                    <!-- 인쇄물/전시 -->
                    <div class="bento-card bento-card--print" data-category="print,exhibition">
                        <div class="bento-card__bg" style="background-image: url('./img/print.png');"></div>
                        <div class="bento-card__content">
                            <div>
                                <span class="bento-card__badge">인쇄물 · 전시</span>
                                <div class="bento-card__icon">🖼️</div>
                                <h3 class="bento-card__title">인쇄물 제작<br>전시 기획</h3>
                                <p class="bento-card__subtitle">브로셔 · 리플렛 · 전시</p>
                            </div>
                            <p class="bento-card__count">0 <span>건</span></p>
                        </div>
                        <div class="bento-card__arrow">→</div>
                    </div>
                </div>

                <!-- All Projects Grid (initially hidden) -->
                <div class="section-block hidden" id="projectsSection">
                    <span class="section-title">PROJECTS</span>
                    <div class="project-grid" id="projectsList">
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
                const items = document.querySelectorAll('#projectsList .project-card');

                // Filter items
                items.forEach(item => {
                    const itemCategory = item.dataset.category;
                    const filterCategories = category.split(',');
                    if (category === 'all' || filterCategories.includes(itemCategory)) {
                        item.style.display = 'block';
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

            // URL 해시를 읽어서 해당 탭 활성화
            function activateTabFromHash() {
                let hash = window.location.hash.replace('#', '');
                if (hash && hash !== 'all') {
                    const matchingTab = document.querySelector(`.category-tab[data-category="${hash}"]`);
                    if (matchingTab) {
                        tabs.forEach(t => t.classList.remove('active'));
                        matchingTab.classList.add('active');
                        showProjectsList(hash);

                        // 사이드바 메뉴 닫기
                        const navWrap = document.querySelector('aside.nav-wrap');
                        const navBtn = document.querySelector('.btn-nav-open');
                        if (navWrap && navWrap.classList.contains('open')) {
                            navWrap.classList.remove('open');
                            if (navBtn) navBtn.classList.remove('on');
                        }
                    }
                }
            }

            // 페이지 로드 시 해시 확인
            setTimeout(activateTabFromHash, 100);

            // 해시 변경 감지
            window.addEventListener('hashchange', activateTabFromHash);

            // 사이드바 메뉴 클릭 감지 (같은 페이지에서 해시만 변경될 때)
            document.addEventListener('click', function (e) {
                const link = e.target.closest('a[href*="portfolio.php#"]');
                if (link) {
                    setTimeout(activateTabFromHash, 200);
                }
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
            storageBucket: "hivemedia-archive.appspot.com",
            messagingSenderId: "305221975765",
            appId: "1:305221975765:web:5d6c8b980e47087f941f17"
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

                // Store portfolio data for modal
                window.portfolioData = {};

                // Add Firebase items as image cards
                snapshot.forEach(doc => {
                    const data = doc.data();
                    const docId = doc.id;
                    const categoryKey = categoryMap[data.category] || 'online_ad';
                    // Store data for modal
                    window.portfolioData[docId] = data;

                    const card = document.createElement('div');
                    card.className = 'project-card firebase-item';
                    card.dataset.category = categoryKey;
                    card.dataset.docId = docId;

                    // Get thumbnail or use placeholder
                    const thumbnailUrl = data.thumbnailUrl || data.imageUrl || '';
                    const firstLetter = data.title ? data.title.charAt(0).toUpperCase() : 'P';
                    const client = data.client || data.advertiser || '하이브미디어';
                    const projectName = data.title || '프로젝트';

                    // Create colorful placeholder based on category
                    const colors = {
                        'online_ad': 'linear-gradient(135deg, #0084ff 0%, #00c6ff 100%)',
                        'sns': 'linear-gradient(135deg, #E1306C 0%, #F77737 100%)',
                        'homepage': 'linear-gradient(135deg, #1a1a1a 0%, #434343 100%)',
                        'video': 'linear-gradient(135deg, #FF0000 0%, #FF5722 100%)',
                        'eventpage': 'linear-gradient(135deg, #FFC107 0%, #FF9800 100%)',
                        'print': 'linear-gradient(135deg, #666666 0%, #999999 100%)',
                        'exhibition': 'linear-gradient(135deg, #9C27B0 0%, #673AB7 100%)'
                    };
                    const bgColor = colors[categoryKey] || colors['online_ad'];

                    // Category display name
                    const categoryDisplayNames = {
                        'online_ad': 'Online AD',
                        'sns': 'SNS',
                        'homepage': 'Homepage',
                        'video': 'Video',
                        'eventpage': 'Event',
                        'print': 'Print',
                        'exhibition': 'Exhibition'
                    };
                    const categoryDisplay = categoryDisplayNames[categoryKey] || 'Project';

                    if (thumbnailUrl) {
                        card.innerHTML = `
                            <img class="project-card__image" src="${thumbnailUrl}" alt="${projectName}" loading="lazy" 
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <div class="project-card__placeholder" style="background: ${bgColor}; display: none;" data-category="${categoryDisplay}">${firstLetter}</div>
                            <div class="project-card__overlay"></div>
                            <div class="project-card__info">
                                <span class="project-card__category">${categoryDisplay}</span>
                                <div class="project-card__title">${projectName}</div>
                                <div class="project-card__client">${client}</div>
                            </div>
                        `;
                    } else {
                        card.innerHTML = `
                            <div class="project-card__placeholder" data-category="${categoryDisplay}">${firstLetter}</div>
                            <div class="project-card__overlay"></div>
                            <div class="project-card__info">
                                <span class="project-card__category">${categoryDisplay}</span>
                                <div class="project-card__title">${projectName}</div>
                                <div class="project-card__client">${client}</div>
                            </div>
                        `;
                    }

                    // Add click handler for detail page
                    card.addEventListener('click', () => {
                        window.location.href = `portfolio_view.php?id=${docId}`;
                    });

                    // Add to grid
                    projectsList.appendChild(card);
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