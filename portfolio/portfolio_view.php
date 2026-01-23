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
			--primary-color: #0084ff;
			--text-dark: #1a1a1a;
			--text-light: #666;
			--bg-light: #f8f9fa;
		}

		body,
		.Wrap {
			background: #ffffff !important;
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

		.portfolio-view-container {
			max-width: 1400px;
			margin: 0 auto;
			padding: 120px 40px 100px;
			display: grid;
			grid-template-columns: 350px 1fr;
			gap: 60px;
		}

		/* Project Info Sidebar */
		.project-info-sidebar {
			position: sticky;
			top: 120px;
			height: fit-content;
			max-width: 350px;
			overflow: hidden;
			word-wrap: break-word;
			word-break: keep-all;
		}

		.back-to-list {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			font-size: 13px;
			color: var(--text-light);
			text-decoration: none;
			margin-bottom: 40px;
			transition: color 0.2s;
		}

		.back-to-list:hover {
			color: var(--primary-color);
		}

		.project-category {
			font-family: 'Space Mono', monospace;
			font-size: 12px;
			font-weight: 700;
			color: var(--primary-color);
			text-transform: uppercase;
			letter-spacing: 2px;
			margin-bottom: 16px;
		}

		.project-title {
			font-size: 42px;
			font-weight: 700;
			line-height: 1.2;
			margin-bottom: 30px;
			word-break: keep-all;
		}

		.project-meta-list {
			list-style: none;
			margin-bottom: 40px;
			border-top: 1px solid #eee;
		}

		.meta-item {
			padding: 16px 0;
			border-bottom: 1px solid #eee;
			display: flex;
			flex-direction: column;
			gap: 4px;
		}

		.meta-label {
			font-size: 11px;
			color: #aaa;
			text-transform: uppercase;
			letter-spacing: 1px;
		}

		.meta-value {
			font-size: 15px;
			color: var(--text-dark);
			font-weight: 500;
		}

		.project-description {
			font-size: 16px;
			line-height: 1.8;
			color: var(--text-light);
			white-space: pre-wrap;
			margin-bottom: 40px;
		}

		/* Project Content (Main Body) */
		.project-content {
			min-width: 0;
			overflow: hidden;
		}

		/* Image Slider */
		.project-image-slider {
			width: 100%;
			margin-bottom: 60px;
			border-radius: 12px;
			overflow: hidden;
			box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
		}

		.swiper {
			width: 100%;
			height: 600px;
			border-radius: 12px;
		}

		.swiper-slide {
			display: flex;
			align-items: center;
			justify-content: center;
			background: #f8f9fa;
		}

		.swiper-slide img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
		}

		.swiper-button-next,
		.swiper-button-prev {
			color: #fff;
			background: rgba(0, 0, 0, 0.5);
			width: 50px;
			height: 50px;
			border-radius: 50%;
			transition: all 0.3s ease;
		}

		.swiper-button-next:after,
		.swiper-button-prev:after {
			font-size: 20px;
		}

		.swiper-button-next:hover,
		.swiper-button-prev:hover {
			background: rgba(0, 132, 255, 0.9);
			transform: scale(1.1);
		}

		.swiper-pagination-bullet {
			width: 12px;
			height: 12px;
			background: #fff;
			opacity: 0.7;
			transition: all 0.3s ease;
		}

		.swiper-pagination-bullet-active {
			background: var(--primary-color);
			opacity: 1;
			transform: scale(1.2);
		}

		.project-content-body {
			font-family: 'Noto Sans KR', sans-serif;
			font-size: 16px;
			line-height: 2;
			color: var(--text-dark);
		}

		.project-content-body p {
			margin-bottom: 1.5em;
		}

		.project-content-body h2,
		.project-content-body h3 {
			margin-top: 2em;
			margin-bottom: 1em;
			font-weight: 700;
		}

		.project-content-body ul,
		.project-content-body ol {
			margin-left: 1.5em;
			margin-bottom: 1.5em;
		}

		.project-content-body li {
			margin-bottom: 0.5em;
		}

		.content-loading {
			color: #888;
			font-size: 14px;
		}

		.content-empty {
			color: #aaa;
			font-size: 14px;
			font-style: italic;
		}

		/* Project Gallery (Masonry Layout) */
		.project-gallery {
			min-width: 0;
			overflow: hidden;
			margin-top: 60px;
			padding-top: 40px;
			border-top: 1px solid #eee;
		}

		.gallery-title {
			font-size: 12px;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 2px;
			color: #888;
			margin-bottom: 30px;
		}

		.masonry-grid {
			column-count: 3;
			column-gap: 20px;
		}

		.masonry-item {
			break-inside: avoid;
			margin-bottom: 20px;
			display: inline-block;
			width: 100%;
		}

		.gallery-image {
			width: 100%;
			height: auto;
			border-radius: 8px;
			background: #f5f5f5;
			box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
			transition: transform 0.3s ease, box-shadow 0.3s ease;
			cursor: pointer;
		}

		.gallery-image:hover {
			transform: translateY(-4px);
			box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
		}

		/* Responsive Masonry */
		@media (max-width: 1024px) {
			.masonry-grid {
				column-count: 2;
			}

			.swiper {
				height: 450px;
			}
		}

		@media (max-width: 768px) {
			.masonry-grid {
				column-count: 1;
			}

			.swiper {
				height: 350px;
			}

			.swiper-button-next,
			.swiper-button-prev {
				width: 40px;
				height: 40px;
			}
		}

		/* Navigation */
		.project-navigation {
			grid-column: 1 / -1;
			margin-top: 100px;
			padding-top: 40px;
			border-top: 1px solid #eee;
			display: flex;
			justify-content: space-between;
		}

		.nav-btn {
			text-decoration: none;
			display: flex;
			flex-direction: column;
			gap: 8px;
			max-width: 45%;
		}

		.nav-btn.next {
			text-align: right;
			align-items: flex-end;
		}

		.nav-btn .label {
			font-size: 12px;
			color: #aaa;
			text-transform: uppercase;
			letter-spacing: 1px;
		}

		.nav-btn .title {
			font-size: 18px;
			font-weight: 700;
			color: var(--text-dark);
			transition: color 0.2s;
		}

		.nav-btn:hover .title {
			color: var(--primary-color);
		}

		/* Mobile Responsive */
		@media (max-width: 1024px) {
			.portfolio-view-container {
				grid-template-columns: 1fr;
				padding-top: 100px;
			}

			.project-info-sidebar {
				position: relative;
				top: 0;
			}

			.project-title {
				font-size: 32px;
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
				<aside class="project-info-sidebar">
					<a href="portfolio.php" class="back-to-list">← BACK TO LIST</a>

					<div id="projectCategory" class="project-category">---</div>
					<h1 id="projectTitle" class="project-title">Loading...</h1>

					<div id="projectDescription" class="project-description"></div>

					<div class="project-meta-list">
						<div class="meta-item">
							<span class="meta-label">Client</span>
							<span id="metaClient" class="meta-value">-</span>
						</div>
						<div class="meta-item">
							<span class="meta-label">Collaborated with</span>
							<span id="metaType" class="meta-value">-</span>
						</div>
						<div class="meta-item">
							<span class="meta-label">Release Date</span>
							<span id="metaYear" class="meta-value">-</span>
						</div>
					</div>
				</aside>

				<div id="projectContent" class="project-content">
					<div class="content-loading">Loading content...</div>
				</div>

				<!-- HARDCODED SAMPLE: Masonry Gallery (Remove after testing) -->
				<div id="projectGallery" class="project-gallery">
					<div class="gallery-title">Related Images</div>
					<div class="masonry-grid">
						<div class="masonry-item">
							<img src="https://picsum.photos/400/300" class="gallery-image" alt="Sample 1">
						</div>
						<div class="masonry-item">
							<img src="https://picsum.photos/400/500" class="gallery-image" alt="Sample 2">
						</div>
						<div class="masonry-item">
							<img src="https://picsum.photos/400/350" class="gallery-image" alt="Sample 3">
						</div>
						<div class="masonry-item">
							<img src="https://picsum.photos/400/600" class="gallery-image" alt="Sample 4">
						</div>
						<div class="masonry-item">
							<img src="https://picsum.photos/400/400" class="gallery-image" alt="Sample 5">
						</div>
						<div class="masonry-item">
							<img src="https://picsum.photos/400/450" class="gallery-image" alt="Sample 6">
						</div>
					</div>
				</div>

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

					// Update UI
					document.getElementById('projectTitle').textContent = projectTitle;
					document.getElementById('projectCategory').textContent = category;
					document.getElementById('projectDescription').textContent = description;
					document.getElementById('metaClient').textContent = clientName;
					document.getElementById('metaType').textContent = data.projectType || data.type || '-';
					document.getElementById('metaYear').textContent = year;

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

					// Display main content body
					const contentArea = document.getElementById('projectContent');
					const contentBody = data.content || data.body || data.fullContent || '';

					let contentHTML = '';

					// Add image slider if images exist
					if (sliderImages.length > 0) {
						contentHTML += `
							<div class="project-image-slider">
								<div class="swiper projectSwiper">
									<div class="swiper-wrapper" id="swiperWrapper"></div>
									<div class="swiper-button-next"></div>
									<div class="swiper-button-prev"></div>
									<div class="swiper-pagination"></div>
								</div>
							</div>
						`;
					}

					if (contentBody) {
						// If content is HTML, render it directly; otherwise wrap in paragraphs
						const isHTML = /<[a-z][\s\S]*>/i.test(contentBody);
						if (isHTML) {
							contentHTML += `<div class="project-content-body">${contentBody}</div>`;
						} else {
							// Convert plain text to paragraphs
							const paragraphs = contentBody.split('\n\n').filter(p => p.trim());
							const formattedContent = paragraphs.map(p => `<p>${p.replace(/\n/g, '<br>')}</p>`).join('');
							contentHTML += `<div class="project-content-body">${formattedContent}</div>`;
						}
					} else {
						// If no content, show the description as fallback
						if (description) {
							const paragraphs = description.split('\n\n').filter(p => p.trim());
							const formattedContent = paragraphs.map(p => `<p>${p.replace(/\n/g, '<br>')}</p>`).join('');
							contentHTML += `<div class="project-content-body">${formattedContent}</div>`;
						} else {
							contentHTML += '<div class="content-empty">상세 내용이 없습니다.</div>';
						}
					}

					contentArea.innerHTML = contentHTML;

					// Initialize Swiper after adding slides
					if (sliderImages.length > 0) {
						const swiperWrapper = document.getElementById('swiperWrapper');
						sliderImages.forEach((url, index) => {
							if (url) {
								const slide = document.createElement('div');
								slide.className = 'swiper-slide';
								slide.innerHTML = `<img src="${url}" alt="${clientName} ${projectTitle} - 이미지 ${index + 1}" loading="lazy" />`;
								swiperWrapper.appendChild(slide);
							}
						});

						// Initialize Swiper
						const swiper = new Swiper('.projectSwiper', {
							loop: sliderImages.length > 1,
							autoplay: {
								delay: 5000,
								disableOnInteraction: false,
							},
							pagination: {
								el: '.swiper-pagination',
								clickable: true,
							},
							navigation: {
								nextEl: '.swiper-button-next',
								prevEl: '.swiper-button-prev',
							},
							speed: 800,
							effect: 'slide',
							keyboard: {
								enabled: true,
							},
						});
					}

					// Hide the bottom gallery since we're showing images in slider
					const gallery = document.getElementById('projectGallery');
					gallery.style.display = 'none';

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