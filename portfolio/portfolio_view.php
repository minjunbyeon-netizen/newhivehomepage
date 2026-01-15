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
	<title>하이브미디어 포트폴리오 | 상세 정보</title>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

	<!-- Open Graph -->
	<meta property="og:title" content="하이브미디어 - PORTFOLIO VIEW" />
	<meta property="og:description" content="하이브미디어 포트폴리오 상세 프로젝트 내용" />
	<meta property="og:image" content="../assets/img/orimage.png" />

	<link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-icon-180x180.png" />
	<link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png" />
	<link rel="stylesheet" href="../assets/css/all.css">
	<script src="//code.jquery.com/jquery-latest.min.js"></script>
	<script src="../assets/js/common.js" defer=""></script>
	<script src="../assets/js/components.js" defer=""></script>

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

		/* Project Content (Gallery) */
		.project-gallery {
			display: flex;
			flex-direction: column;
			gap: 40px;
		}

		.gallery-image {
			width: 100%;
			border-radius: 4px;
			background: #f5f5f5;
			box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
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

				<div id="projectGallery" class="project-gallery">
					<!-- Images will be loaded here -->
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

					// Update UI
					document.getElementById('projectTitle').textContent = data.title || 'Untitled Project';
					document.title = (data.title || 'Untitled Project') + ' | HIVEMEDIA Portfolio';
					document.getElementById('projectCategory').textContent = data.category || 'MARKETING';
					document.getElementById('projectDescription').textContent = data.description || data.content || '';
					document.getElementById('metaClient').textContent = data.client || data.advertiser || '-';
					document.getElementById('metaType').textContent = data.projectType || data.type || '-';
					document.getElementById('metaYear').textContent = data.year || '-';

					// Load Images
					const gallery = document.getElementById('projectGallery');
					let images = [];
					if (data.attachments && Array.isArray(data.attachments)) images = images.concat(data.attachments);
					if (data.images && Array.isArray(data.images)) images = images.concat(data.images);
					if (data.imageUrl && !images.includes(data.imageUrl)) images.unshift(data.imageUrl);

					if (images.length === 0 && data.thumbnailUrl) images.push(data.thumbnailUrl);

					images.forEach(url => {
						if (url) {
							const img = document.createElement('img');
							img.src = url;
							img.className = 'gallery-image';
							img.alt = data.title;
							gallery.appendChild(img);
						}
					});

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