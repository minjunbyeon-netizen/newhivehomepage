<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');

// 프로젝트 루트 경로 설정
$base_path = '/01_work/hivemedia_homepage';

// 포트폴리오 ID (파이어베이스 문서 ID)
$docId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
?>
<!doctype html>
<html lang="ko" data-theme="light">

<head>
	<meta charset="utf-8">
	<title id="pageTitle">하이브미디어 포트폴리오 | 상세 정보</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- SEO Meta Tags (동적 업데이트) -->
	<meta id="metaDescription" name="description" content="하이브미디어 포트폴리오 - 공공기관 마케팅 전문 에이전시" />
	<meta id="metaKeywords" name="keywords" content="하이브미디어, 포트폴리오, 공공기관마케팅, SNS마케팅, 웹개발" />

	<!-- Open Graph (동적 업데이트) -->
	<meta id="ogTitle" property="og:title" content="하이브미디어 포트폴리오" />
	<meta id="ogDescription" property="og:description" content="하이브미디어 포트폴리오 상세 프로젝트 내용" />
	<meta id="ogImage" property="og:image" content="../assets/img/orimage.png" />
	<meta property="og:type" content="article" />
	<meta id="ogUrl" property="og:url" content="" />

	<!-- Twitter Card -->
	<meta name="twitter:card" content="summary_large_image" />
	<meta id="twitterTitle" name="twitter:title" content="하이브미디어 포트폴리오" />
	<meta id="twitterDescription" name="twitter:description" content="하이브미디어 포트폴리오 상세 프로젝트 내용" />

	<!-- Canonical URL -->
	<link id="canonicalUrl" rel="canonical" href="" />

	<link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-icon-180x180.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png" />
	<link rel="stylesheet" href="../assets/css/all.css">

	<!-- Swiper CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<script src="../assets/js/common.js" defer=""></script>
	<script src="../assets/js/components.js" defer=""></script>

	<!-- Swiper JS -->
	<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=Space+Mono:wght@400;700&family=Noto+Sans+KR:wght@300;400;500;700&display=swap"
		rel="stylesheet">

	<style>
		:root {
			--primary-color: #1a1a1a;
			--text-dark: #1a1a1a;
			--text-light: #666;
			--border-color: #e5e5e5;
			--bg-light: #f8f9fa;
		}

		body,
		.Wrap {
			background: #fff !important;
			font-family: 'Noto Sans KR', sans-serif;
			color: var(--text-dark);
		}

		/* Header Overrides */
		.header {
			background: #1a1a1a !important;
		}

		.header .conbox {
			background: #1a1a1a !important;
		}

		/* ========================================
		   Compact Center-Aligned Layout
		======================================== */
		.portfolio-view-container {
			max-width: 800px;
			margin: 0 auto;
			padding: 110px 16px 60px;
			display: flex;
			flex-direction: column;
			align-items: center;
		}

		/* Back Button - Right Aligned, More Visible */
		.back-to-list {
			display: inline-flex;
			align-items: center;
			gap: 6px;
			font-size: 13px;
			font-weight: 600;
			color: #333;
			text-decoration: none;
			margin-bottom: 16px;
			padding: 8px 16px;
			background: #f5f5f5;
			border: 1px solid #ddd;
			border-radius: 6px;
			align-self: flex-end;
			transition: all 0.2s;
		}

		.back-to-list:hover {
			background: #333;
			color: #fff;
			border-color: #333;
		}

		/* Hide original sidebar */
		.project-info-sidebar {
			display: none;
		}

		/* ========================================
		   Campaign Card - Compact Design
		======================================== */
		.campaign-card {
			width: 100%;
			max-width: 700px;
			background: #fff;
			border: 1px solid var(--border-color);
			border-radius: 8px;
			overflow: hidden;
		}

		/* Campaign Header - Compact */
		.campaign-header {
			background: #fff;
			color: var(--text-dark);
			padding: 20px 24px 16px;
			text-align: center;
			border-bottom: 1px solid var(--border-color);
		}

		.campaign-header .campaign-category {
			font-size: 11px;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 1.5px;
			color: var(--text-light);
			margin-bottom: 8px;
		}

		.campaign-header .campaign-title {
			font-size: 24px;
			font-weight: 700;
			line-height: 1.3;
			margin: 0;
			color: var(--text-dark);
		}

		/* Image Section - Compact */
		.campaign-image-section {
			background: #f0f0f0;
			padding: 0;
			position: relative;
		}

		.campaign-image-section .swiper {
			width: 100%;
			height: 350px;
		}

		.campaign-image-section .swiper-slide {
			display: flex;
			align-items: center;
			justify-content: center;
			background: #f0f0f0;
		}

		.campaign-image-section .swiper-slide img {
			width: 100%;
			height: 100%;
			object-fit: contain;
			display: block;
		}

		/* Navigation Arrows - VISIBLE */
		.campaign-image-section .swiper-button-next,
		.campaign-image-section .swiper-button-prev {
			color: #fff !important;
			background: rgba(0, 0, 0, 0.6) !important;
			width: 40px !important;
			height: 40px !important;
			border-radius: 50% !important;
			transition: all 0.2s ease;
			top: 50% !important;
			margin-top: -20px !important;
		}

		.campaign-image-section .swiper-button-next:after,
		.campaign-image-section .swiper-button-prev:after {
			font-size: 16px !important;
			font-weight: bold;
		}

		.campaign-image-section .swiper-button-next:hover,
		.campaign-image-section .swiper-button-prev:hover {
			background: rgba(0, 0, 0, 0.85) !important;
		}

		.campaign-image-section .swiper-button-next {
			right: 12px !important;
		}

		.campaign-image-section .swiper-button-prev {
			left: 12px !important;
		}

		/* Slide Pagination - Compact */
		.swiper-pagination {
			bottom: 12px !important;
		}

		.swiper-pagination-bullet {
			width: 8px;
			height: 8px;
			background: #fff;
			opacity: 0.5;
			margin: 0 4px !important;
			border: 1px solid rgba(0, 0, 0, 0.2);
		}

		.swiper-pagination-bullet-active {
			background: #fff;
			opacity: 1;
		}

		/* Slide Counter Text */
		.slide-counter {
			position: absolute;
			bottom: 10px;
			right: 12px;
			background: rgba(0, 0, 0, 0.6);
			color: #fff;
			padding: 4px 10px;
			border-radius: 12px;
			font-size: 11px;
			font-weight: 500;
			z-index: 10;
		}

		/* Content Section - Compact */
		.campaign-content-section {
			background: #fff;
			padding: 20px;
		}

		.campaign-meta-grid {
			display: grid;
			grid-template-columns: repeat(2, 1fr);
			gap: 10px;
			margin-bottom: 16px;
		}

		.campaign-meta-item {
			background: var(--bg-light);
			padding: 12px 14px;
			border-radius: 6px;
			border: 1px solid var(--border-color);
		}

		.campaign-meta-item .meta-label {
			font-size: 10px;
			color: #999;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			margin-bottom: 4px;
		}

		.campaign-meta-item .meta-value {
			font-size: 13px;
			font-weight: 600;
			color: var(--text-dark);
		}

		.campaign-description {
			background: var(--bg-light);
			padding: 16px;
			border-radius: 6px;
			border: 1px solid var(--border-color);
			font-size: 13px;
			line-height: 1.7;
			color: var(--text-dark);
			white-space: pre-wrap;
		}

		.campaign-description h4 {
			font-size: 10px;
			font-weight: 600;
			color: #999;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			margin-bottom: 8px;
		}

		/* Hide original content area */
		.project-content {
			display: none;
		}

		/* Hide original gallery */
		.project-gallery {
			display: none !important;
		}

		/* Navigation - Compact */
		.project-navigation {
			width: 100%;
			max-width: 700px;
			margin-top: 24px;
			padding-top: 20px;
			border-top: 1px solid #eee;
			display: flex;
			justify-content: space-between;
		}

		.nav-btn {
			text-decoration: none;
			display: flex;
			flex-direction: column;
			gap: 6px;
			max-width: 45%;
		}

		.nav-btn.next {
			text-align: right;
			align-items: flex-end;
		}

		.nav-btn .label {
			font-size: 11px;
			color: #888;
			text-transform: uppercase;
			letter-spacing: 1px;
		}

		.nav-btn .title {
			font-size: 16px;
			font-weight: 600;
			color: var(--text-dark);
			transition: color 0.2s;
		}

		.nav-btn:hover .title {
			color: var(--primary-color);
		}

		/* Mobile Responsive */
		@media (max-width: 768px) {
			.portfolio-view-container {
				padding: 100px 16px 60px;
			}

			.campaign-header {
				padding: 20px 24px;
			}

			.campaign-header .campaign-title {
				font-size: 22px;
			}

			.campaign-image-section .swiper {
				height: 300px;
			}

			.campaign-content-section {
				padding: 24px 20px;
			}

			.campaign-meta-grid {
				grid-template-columns: 1fr;
				gap: 12px;
			}

			.swiper-button-next,
			.swiper-button-prev {
				width: 36px;
				height: 36px;
			}
		}

		/* Loading Overlay */
		#loadingOverlay {
			position: fixed;
			inset: 0;
			background: #fff;
			z-index: 9999;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.spinner {
			width: 40px;
			height: 40px;
			border: 3px solid #f3f3f3;
			border-top: 3px solid var(--primary-color);
			border-radius: 50%;
			animation: spin 1s linear infinite;
		}

		@keyframes spin {
			0% {
				transform: rotate(0deg);
			}

			100% {
				transform: rotate(360deg);
			}
		}
	</style>
</head>

<body>
	<div id="loadingOverlay">
		<div class="spinner"></div>
	</div>

	<div class="Wrap">
		<div id="header-placeholder"></div>

		<main>
			<div class="portfolio-view-container">
				<a href="portfolio.php?skip=1" class="back-to-list">← BACK TO LIST</a>

				<!-- Campaign Card (New Layout) -->
				<div class="campaign-card" id="campaignCard">
					<!-- Green Header: Campaign Name -->
					<div class="campaign-header">
						<div id="campaignCategory" class="campaign-category">---</div>
						<h1 id="campaignTitle" class="campaign-title">Loading...</h1>
					</div>

					<!-- Image Section: Slider -->
					<div class="campaign-image-section" id="campaignImageSection">
						<div class="swiper projectSwiper">
							<div class="swiper-wrapper" id="swiperWrapper"></div>
							<div class="swiper-button-next"></div>
							<div class="swiper-button-prev"></div>
							<div class="swiper-pagination"></div>
						</div>
						<!-- Slide Counter (1/5 format) -->
						<div class="slide-counter" id="slideCounter" style="display:none;"></div>
					</div>

					<!-- Yellow Section: Content & Meta Info -->
					<div class="campaign-content-section">
						<div class="campaign-meta-grid">
							<div class="campaign-meta-item">
								<div class="meta-label">광고주</div>
								<div id="metaClient" class="meta-value">-</div>
							</div>
							<div class="campaign-meta-item">
								<div class="meta-label">게시기간</div>
								<div id="metaYear" class="meta-value">-</div>
							</div>
							<div class="campaign-meta-item">
								<div class="meta-label">캠페인 유형</div>
								<div id="metaType" class="meta-value">-</div>
							</div>
							<div class="campaign-meta-item">
								<div class="meta-label">카테고리</div>
								<div id="metaCategoryInfo" class="meta-value">-</div>
							</div>
						</div>
						<div class="campaign-description">
							<h4>활동 설명</h4>
							<div id="campaignDescription">-</div>
						</div>
					</div>
				</div>

				<!-- Hidden Original Elements (Keep for JS compatibility) -->
				<aside class="project-info-sidebar" style="display:none;">
					<div id="projectCategory" class="project-category">---</div>
					<h1 id="projectTitle" class="project-title">Loading...</h1>
					<div id="projectDescription" class="project-description"></div>
				</aside>

				<div id="projectContent" class="project-content" style="display:none;"></div>

				<nav class="project-navigation">
					<div id="prevProject"></div>
					<div id="nextProject"></div>
				</nav>
			</div>
		</main>

		<div id="footer-placeholder"></div>
	</div>

	<!-- Firebase SDK -->
	<script type="module">
		import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
		import { getFirestore, doc, getDoc, collection, query, where, orderBy, limit, getDocs } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

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
		const docId = "<?php echo $docId; ?>";

		async function fetchProject() {
			if (!docId) {
				window.location.href = 'portfolio.php';
				return;
			}

			try {
				const docRef = doc(db, 'portfolios', docId);
				const docSnap = await getDoc(docRef);

				if (docSnap.exists()) {
					const data = docSnap.data();

					// SEO: Generate optimized content
					const projectTitle = data.title || 'Untitled Project';
					const clientName = data.client || data.advertiser || '하이브미디어';
					const category = data.category || 'MARKETING';
					const description = data.description || data.content || '';
					const year = data.year || '';

					// SEO: Build keyword-rich descriptions
					const seoTitle = `${projectTitle} | ${clientName} ${category} 프로젝트 | 하이브미디어`;
					const seoDescription = description
						? `${clientName} ${projectTitle} - ${description.substring(0, 120)}... | 하이브미디어 마케팅 전문 에이전시`
						: `${clientName} ${category} 프로젝트 - ${projectTitle} | 하이브미디어 공공기관 마케팅 전문`;
					const seoKeywords = `${clientName}, ${projectTitle}, ${category}, 공공기관마케팅, SNS마케팅, 하이브미디어, 마케팅에이전시`;

					// Update NEW Campaign Card UI
					document.getElementById('campaignTitle').textContent = projectTitle;
					document.getElementById('campaignCategory').textContent = category;
					document.getElementById('campaignDescription').textContent = description || '상세 내용이 없습니다.';
					document.getElementById('metaClient').textContent = clientName;
					document.getElementById('metaType').textContent = data.projectType || data.type || '-';
					document.getElementById('metaYear').textContent = year || '-';
					document.getElementById('metaCategoryInfo').textContent = category;

					// Update OLD UI (for backward compatibility)
					document.getElementById('projectTitle').textContent = projectTitle;
					document.getElementById('projectCategory').textContent = category;
					document.getElementById('projectDescription').textContent = description;

					// SEO: Update Meta Tags
					document.title = seoTitle;
					document.getElementById('pageTitle').textContent = seoTitle;
					document.getElementById('metaDescription').setAttribute('content', seoDescription);
					document.getElementById('metaKeywords').setAttribute('content', seoKeywords);

					// SEO: Update Open Graph Tags
					document.getElementById('ogTitle').setAttribute('content', seoTitle);
					document.getElementById('ogDescription').setAttribute('content', seoDescription);
					document.getElementById('ogUrl').setAttribute('content', window.location.href);

					// SEO: Update Twitter Cards
					document.getElementById('twitterTitle').setAttribute('content', seoTitle);
					document.getElementById('twitterDescription').setAttribute('content', seoDescription);

					// SEO: Update Canonical URL
					document.getElementById('canonicalUrl').setAttribute('href', window.location.href);

					// Collect images for slider
					let sliderImages = [];
					if (data.attachments && Array.isArray(data.attachments)) sliderImages = sliderImages.concat(data.attachments);
					if (data.images && Array.isArray(data.images)) sliderImages = sliderImages.concat(data.images);
					// Also check for thumbnail if no other images
					if (sliderImages.length === 0 && data.thumbnailUrl) {
						sliderImages.push(data.thumbnailUrl);
					}

					// ADD slides to swiper (already in HTML)
					const swiperWrapper = document.getElementById('swiperWrapper');
					if (sliderImages.length > 0) {
						sliderImages.forEach((url, index) => {
							if (url) {
								const slide = document.createElement('div');
								slide.className = 'swiper-slide';
								slide.innerHTML = `<img src="${url}" alt="${clientName} ${projectTitle} - 이미지 ${index + 1}" loading="lazy" />`;
								swiperWrapper.appendChild(slide);
							}
						});

						// Initialize Swiper with slide counter
						const swiper = new Swiper('.projectSwiper', {
							loop: sliderImages.length > 1,
							autoplay: sliderImages.length > 1 ? {
								delay: 5000,
								disableOnInteraction: false,
							} : false,
							pagination: {
								el: '.swiper-pagination',
								clickable: true,
								type: 'bullets',
							},
							navigation: {
								nextEl: '.swiper-button-next',
								prevEl: '.swiper-button-prev',
							},
							speed: 600,
							effect: 'slide',
							keyboard: {
								enabled: true,
							},
							on: {
								init: function () {
									updateSlideCounter(this);
								},
								slideChange: function () {
									updateSlideCounter(this);
								}
							}
						});

						// Slide Counter Update Function
						function updateSlideCounter(swiperInstance) {
							const counterEl = document.getElementById('slideCounter');
							if (counterEl && sliderImages.length > 1) {
								const currentSlide = swiperInstance.realIndex + 1;
								counterEl.textContent = `${currentSlide} / ${sliderImages.length}`;
								counterEl.style.display = 'block';
							}
						}

						// Hide navigation if only 1 image
						if (sliderImages.length <= 1) {
							document.querySelector('.swiper-button-next')?.style.setProperty('display', 'none');
							document.querySelector('.swiper-button-prev')?.style.setProperty('display', 'none');
							document.querySelector('.swiper-pagination')?.style.setProperty('display', 'none');
						}
					} else {
						// Hide image section if no images
						document.getElementById('campaignImageSection').style.display = 'none';
					}


					// SEO: Update OG Image with first image
					if (sliderImages.length > 0) {
						document.getElementById('ogImage').setAttribute('content', sliderImages[0]);
					} else if (data.thumbnailUrl) {
						// If only thumbnail exists, set it for OG
						document.getElementById('ogImage').setAttribute('content', data.thumbnailUrl);
					}

					// SEO: Add Schema.org JSON-LD Structured Data
					const schemaData = {
						"@context": "https://schema.org",
						"@type": "CreativeWork",
						"name": projectTitle,
						"description": seoDescription,
						"author": {
							"@type": "Organization",
							"name": "하이브미디어",
							"url": "https://hivemedia.co.kr"
						},
						"creator": {
							"@type": "Organization",
							"name": clientName
						},
						"datePublished": year || undefined,
						"keywords": seoKeywords,
						"image": sliderImages[0] || undefined,
						"url": window.location.href
					};

					const scriptTag = document.createElement('script');
					scriptTag.type = 'application/ld+json';
					scriptTag.textContent = JSON.stringify(schemaData);
					document.head.appendChild(scriptTag);

					// Fetch Neighbors for navigation
					fetchNeighbors(data.createdAt);
				} else {
					console.log('Project not found');
					window.location.href = 'portfolio.php';
				}
			} catch (error) {
				console.error('Error fetching project:', error);
			} finally {
				document.getElementById('loadingOverlay').style.display = 'none';
			}
		}

		async function fetchNeighbors(currentCreatedAt) {
			const prevEl = document.getElementById('prevProject');
			const nextEl = document.getElementById('nextProject');

			if (!currentCreatedAt) return;

			try {
				// 이전 프로젝트 (현재보다 오래된)
				const prevQuery = query(
					collection(db, 'portfolios'),
					where('status', '==', 'approved'),
					where('createdAt', '<', currentCreatedAt),
					orderBy('createdAt', 'desc'),
					limit(1)
				);

				// 다음 프로젝트 (현재보다 최신인)
				const nextQuery = query(
					collection(db, 'portfolios'),
					where('status', '==', 'approved'),
					where('createdAt', '>', currentCreatedAt),
					orderBy('createdAt', 'asc'),
					limit(1)
				);

				const [prevSnap, nextSnap] = await Promise.all([getDocs(prevQuery), getDocs(nextQuery)]);

				if (!prevSnap.empty) {
					const d = prevSnap.docs[0];
					prevEl.innerHTML = `
						<a href="portfolio_view.php?id=${d.id}" class="nav-btn prev">
							<span class="label">← PREVIOUS</span>
							<span class="title">${d.data().title || 'Untitled'}</span>
						</a>`;
				}

				if (!nextSnap.empty) {
					const d = nextSnap.docs[0];
					nextEl.innerHTML = `
						<a href="portfolio_view.php?id=${d.id}" class="nav-btn next">
							<span class="label">NEXT →</span>
							<span class="title">${d.data().title || 'Untitled'}</span>
						</a>`;
				}
			} catch (error) {
				console.error('Error fetching navigation:', error);
			}
		}

		fetchProject();
	</script>
</body>

</html>