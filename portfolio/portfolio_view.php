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
			--bg-dark: #0a0a0a;
			--text-white: #fff;
			--text-gray: rgba(255, 255, 255, 0.6);
		}

		body,
		.Wrap {
			background: var(--bg-dark) !important;
			font-family: 'Noto Sans KR', sans-serif;
			color: var(--text-white);
		}

		/* Header Overrides */
		.header {
			background: #1a1a1a !important;
		}

		.header .conbox {
			background: #1a1a1a !important;
		}

		/* ========================================
		   Full-Width Minimal Layout
		======================================== */
		.portfolio-view-container {
			width: 100%;
			max-width: 100%;
			margin: 0;
			padding: 0;
			display: flex;
			flex-direction: column;
		}

		/* Back Button - Fixed Top Right */
		.back-to-list {
			position: fixed;
			top: 100px;
			right: 30px;
			z-index: 1000;
			display: inline-flex;
			align-items: center;
			gap: 6px;
			font-size: 12px;
			font-weight: 500;
			color: var(--text-gray);
			text-decoration: none;
			padding: 10px 16px;
			background: rgba(255, 255, 255, 0.1);
			border: 1px solid rgba(255, 255, 255, 0.2);
			border-radius: 30px;
			transition: all 0.3s;
		}

		.back-to-list:hover {
			background: #fff;
			color: #000;
			border-color: #fff;
		}

		/* ========================================
		   Section 1: Hero Intro Section
		======================================== */
		.section-hero {
			min-height: 100vh;
			display: flex;
			flex-direction: column;
			justify-content: center;
			padding: 120px 60px 80px;
			position: relative;
		}

		.hero-category {
			font-size: 14px;
			font-weight: 500;
			text-transform: uppercase;
			letter-spacing: 3px;
			color: var(--text-gray);
			margin-bottom: 30px;
		}

		.hero-title {
			font-size: clamp(48px, 8vw, 120px);
			font-weight: 900;
			line-height: 1.0;
			letter-spacing: -3px;
			margin: 0 0 40px 0;
			color: var(--text-white);
		}

		.hero-meta {
			display: flex;
			gap: 60px;
			margin-bottom: 40px;
		}

		.hero-meta-item {
			display: flex;
			flex-direction: column;
			gap: 8px;
		}

		.hero-meta-label {
			font-size: 11px;
			text-transform: uppercase;
			letter-spacing: 2px;
			color: var(--text-gray);
		}

		.hero-meta-value {
			font-size: 16px;
			font-weight: 600;
			color: var(--text-white);
		}

		.hero-description {
			max-width: 800px;
			font-size: 18px;
			line-height: 1.8;
			color: var(--text-gray);
			margin-top: 20px;
		}

		/* ========================================
		   Section 2, 3, 4: Full-Width Image Sections
		======================================== */
		.section-images {
			width: 100%;
			padding: 0;
		}

		.image-row {
			display: flex;
			width: 100%;
			gap: 4px;
			margin-bottom: 4px;
		}

		.image-row.single {
			height: 100vh;
		}

		.image-row.double {
			height: 70vh;
		}

		.image-row.triple {
			height: 50vh;
		}

		.image-item {
			flex: 1;
			overflow: hidden;
			background: #111;
			position: relative;
		}

		.image-item.large {
			flex: 2;
		}

		.image-item img {
			width: 100%;
			height: 100%;
			object-fit: cover;
			display: block;
			transition: transform 0.6s ease;
		}

		.image-item:hover img {
			transform: scale(1.02);
		}

		/* ========================================
		   Direction / Text Sections Between Images
		======================================== */
		.section-direction {
			width: 100%;
			padding: 100px 60px;
			background: var(--bg-dark);
			color: var(--text-white);
		}

		.direction-inner {
			max-width: 1200px;
			margin: 0 auto;
			display: grid;
			grid-template-columns: 200px 1fr;
			gap: 60px;
		}

		.direction-label {
			font-size: 13px;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 3px;
			color: var(--text-gray);
		}

		.direction-content {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		.direction-main {
			font-size: 16px;
			line-height: 1.8;
			color: var(--text-white);
			margin-bottom: 30px;
		}

		.direction-main strong,
		.direction-main b {
			color: #c4a77d;
			font-weight: 600;
		}

		.direction-list {
			display: flex;
			flex-direction: column;
			gap: 20px;
		}

		.direction-item {
			display: grid;
			grid-template-columns: 30px 1fr;
			gap: 20px;
			font-size: 15px;
			line-height: 1.7;
			color: var(--text-white);
		}

		.direction-item .num {
			font-size: 12px;
			color: var(--text-gray);
		}

		.direction-item strong,
		.direction-item b {
			color: #c4a77d;
			font-weight: 600;
		}

		@media (max-width: 768px) {
			.section-direction {
				padding: 60px 24px;
			}

			.direction-inner {
				grid-template-columns: 1fr;
				gap: 30px;
			}

			.direction-item {
				grid-template-columns: 24px 1fr;
				gap: 12px;
			}
		}

		/* Hide old campaign card */
		.campaign-card,
		.project-info-sidebar,
		.project-content,
		.project-gallery {
			display: none !important;
		}

		/* Navigation - Bottom */
		.project-navigation {
			width: 100%;
			padding: 60px;
			border-top: 1px solid rgba(255, 255, 255, 0.1);
			display: flex;
			justify-content: space-between;
			background: var(--bg-dark);
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
			font-size: 11px;
			color: var(--text-gray);
			text-transform: uppercase;
			letter-spacing: 2px;
		}

		.nav-btn .title {
			font-size: 20px;
			font-weight: 600;
			color: var(--text-white);
			transition: opacity 0.3s;
		}

		.nav-btn:hover .title {
			opacity: 0.7;
		}

		/* Hide loading overlay */
		#loadingOverlay {
			position: fixed;
			inset: 0;
			background: var(--bg-dark);
			z-index: 9999;
			display: flex;
			align-items: center;
			justify-content: center;
		}

		.spinner {
			width: 40px;
			height: 40px;
			border: 2px solid rgba(255, 255, 255, 0.1);
			border-top: 2px solid #fff;
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

		/* Mobile Responsive */
		@media (max-width: 768px) {
			.section-hero {
				padding: 100px 24px 60px;
			}

			.hero-title {
				font-size: 42px;
				letter-spacing: -1px;
			}

			.hero-meta {
				flex-wrap: wrap;
				gap: 30px;
			}

			.hero-description {
				font-size: 15px;
			}

			.back-to-list {
				top: 90px;
				right: 16px;
				font-size: 11px;
				padding: 8px 12px;
			}

			.image-row.single,
			.image-row.double,
			.image-row.triple {
				height: auto;
				flex-direction: column;
			}

			.image-item {
				height: 50vh;
			}

			.project-navigation {
				padding: 40px 24px;
				flex-direction: column;
				gap: 30px;
			}

			.nav-btn {
				max-width: 100%;
			}

			.nav-btn.next {
				text-align: left;
				align-items: flex-start;
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
				<a href="portfolio.php?skip=1" class="back-to-list">← BACK</a>

				<!-- Section 1: Hero Intro -->
				<section class="section-hero" id="sectionHero">
					<div class="hero-category" id="heroCategory">LOADING...</div>
					<h1 class="hero-title" id="heroTitle">Loading...</h1>
					<div class="hero-meta">
						<div class="hero-meta-item">
							<span class="hero-meta-label">Client</span>
							<span class="hero-meta-value" id="metaClient">-</span>
						</div>
						<div class="hero-meta-item">
							<span class="hero-meta-label">Year</span>
							<span class="hero-meta-value" id="metaYear">-</span>
						</div>
						<div class="hero-meta-item">
							<span class="hero-meta-label">Type</span>
							<span class="hero-meta-value" id="metaType">-</span>
						</div>
					</div>
					<p class="hero-description" id="heroDescription"></p>
				</section>

				<!-- Section 2, 3, 4: Full-Width Images -->
				<section class="section-images" id="sectionImages">
					<!-- Images will be dynamically inserted here -->
				</section>

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
				let data;

				// DEMO: Hardcoded data for migrated_103
				if (docId === 'migrated_103') {
					data = {
						title: 'The New Breath of Everyday',
						category: 'BRANDING',
						client: 'UNIX',
						year: '2024',
						projectType: 'Brand Identity',
						description: 'UNIX는 1978년 헤어드라이어를 시작으로, 40여년 동안 끊임없는 노력과 지속적인 혁신을 통해 건강한 아름다움을 선도하는 글로벌 뷰티케어 브랜드입니다.\n\n고객의 신뢰를 바탕으로 튼튼한 기반과 고도화된 기술력을 보유하고 있으며도 흥겨워요 유닉스만을 연결시키면서 비용을 수 있는 양이가 무제한성습니다.\n\n미래에는 단순한 제품이나 서비스를 넘어 유닉스가 추구하는 건강한 아름다움의 의미와 가치를 담아 낼 수 있도록 브랜드의 총체적인 재정립하였습니다.',
						attachments: [
							'https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=1200&h=1600&fit=crop',
							'https://images.unsplash.com/photo-1560066984-138dadb4c035?w=1200&h=800&fit=crop',
							'https://images.unsplash.com/photo-1527799820374-dcf8d9d4a388?w=800&h=1000&fit=crop',
							'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=1200&h=800&fit=crop',
							'https://images.unsplash.com/photo-1522338242042-1a1c1f8f7b96?w=1000&h=1400&fit=crop'
						],
						directions: [
							{
								label: 'DIRECTION',
								main: '실무진과의 인터뷰를 통해 개선 방향을 구체화하는 과정을 거쳤습니다. <strong>소비자·운영·브랜드</strong>의 세 가지 주요 관점에서 개선이 필요하다는 점을 확인하였습니다.<br>이를 바탕으로 디자인 원칙을 정립하였습니다.',
								items: [
									'<strong>쉽고 빠르게</strong> 원하는 제품을 찾을 수 있게 하고 싶어요.',
									'운영적인 측면을 고려한 <strong>체계적인 구조</strong>가 마련되었으면 좋겠어요.',
									'올드한 이미지를 탈피하고 모던한 <strong>브랜드 이미지</strong>를 구축하고 싶어요.'
								]
							}
						],
						createdAt: new Date()
					};
				} else {
					const docRef = doc(db, 'portfolios', docId);
					const docSnap = await getDoc(docRef);
					if (!docSnap.exists()) {
						console.log('Project not found');
						window.location.href = 'portfolio.php';
						return;
					}
					data = docSnap.data();
				}

				if (data) {

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

					// Update NEW Hero Section UI
					document.getElementById('heroTitle').textContent = projectTitle;
					document.getElementById('heroCategory').textContent = category.toUpperCase();
					document.getElementById('heroDescription').textContent = description || '';
					document.getElementById('metaClient').textContent = clientName;
					document.getElementById('metaType').textContent = data.projectType || data.type || '-';
					document.getElementById('metaYear').textContent = year || '-';

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

					// Collect images
					let allImages = [];
					if (data.attachments && Array.isArray(data.attachments)) allImages = allImages.concat(data.attachments);
					if (data.images && Array.isArray(data.images)) allImages = allImages.concat(data.images);
					if (allImages.length === 0 && data.thumbnailUrl) {
						allImages.push(data.thumbnailUrl);
					}

					// Build full-width image sections
					const sectionImages = document.getElementById('sectionImages');
					if (allImages.length > 0) {
						let html = '';
						const total = allImages.length;

						// First image - full width
						html += `<div class="image-row single"><div class="image-item"><img src="${allImages[0]}" alt="${projectTitle}" loading="lazy" /></div></div>`;

						// Add Direction section after first image (if exists)
						if (data.directions && data.directions.length > 0) {
							data.directions.forEach(dir => {
								html += `
								<section class="section-direction">
									<div class="direction-inner">
										<div class="direction-label">${dir.label}</div>
										<div class="direction-content">
											<p class="direction-main">${dir.main}</p>
											<div class="direction-list">
												${dir.items.map((item, idx) => `
													<div class="direction-item">
														<span class="num">${idx + 1}</span>
														<span>${item}</span>
													</div>
												`).join('')}
											</div>
										</div>
									</div>
								</section>`;
							});
						}

						// Remaining images in rows (pairs or singles)
						for (let i = 1; i < total; i += 3) {
							const remaining = total - i;
							if (remaining >= 3) {
								// Three images in a row
								html += `<div class="image-row triple">`;
								html += `<div class="image-item"><img src="${allImages[i]}" alt="${projectTitle}" loading="lazy" /></div>`;
								html += `<div class="image-item"><img src="${allImages[i + 1]}" alt="${projectTitle}" loading="lazy" /></div>`;
								html += `<div class="image-item"><img src="${allImages[i + 2]}" alt="${projectTitle}" loading="lazy" /></div>`;
								html += `</div>`;
							} else if (remaining === 2) {
								html += `<div class="image-row double">`;
								html += `<div class="image-item"><img src="${allImages[i]}" alt="${projectTitle}" loading="lazy" /></div>`;
								html += `<div class="image-item"><img src="${allImages[i + 1]}" alt="${projectTitle}" loading="lazy" /></div>`;
								html += `</div>`;
							} else if (remaining === 1) {
								html += `<div class="image-row single"><div class="image-item"><img src="${allImages[i]}" alt="${projectTitle}" loading="lazy" /></div></div>`;
							}
						}

						sectionImages.innerHTML = html;
					}


					// SEO: Update OG Image with first image
					if (allImages.length > 0) {
						document.getElementById('ogImage').setAttribute('content', allImages[0]);
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
						"image": allImages[0] || undefined,
						"url": window.location.href
					};

					const scriptTag = document.createElement('script');
					scriptTag.type = 'application/ld+json';
					scriptTag.textContent = JSON.stringify(schemaData);
					document.head.appendChild(scriptTag);

					// Fetch Neighbors for navigation (skip for demo)
					if (docId !== 'migrated_103') {
						fetchNeighbors(data.createdAt);
					}
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