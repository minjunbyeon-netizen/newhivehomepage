<?php
error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', '0');

// 프로젝트 루트 경로 설정
$base_path = '/01_work/hivemedia_homepage';

$articleId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
?>
<!doctype html>
<html lang="ko" data-theme="light">

<head>
    <meta charset="utf-8">
    <title id="metaTitle">하이브미디어 아카이브 | 마케팅 인사이트</title>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge, chrome">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" id="metaDescription" content="하이브미디어 아카이브 - 마케팅 트렌드 및 인사이트">
    <meta name="keywords" id="metaKeywords" content="마케팅, 트렌드, 인사이트">
    <meta property="og:title" id="ogTitle" content="하이브미디어 - ARCHIVE" />
    <meta property="og:description" id="ogDescription" content="하이브미디어 아카이브" />
    <meta property="og:image" content="../assets/img/orimage.png" />

    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon/apple-icon-180x180.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="../assets/img/favicon/favicon-32x32.png" />
    <link rel="stylesheet" href="../assets/css/all.css">
    <script src="//code.jquery.com/jquery-latest.min.js"></script>
    <script src="../assets/js/common.js" defer=""></script>
    <script src="../assets/js/components.js" defer=""></script>

    <!-- Google Fonts -->
    <link rel="preconnect" href="//fonts.googleapis.com">
    <link rel="preconnect" href="//fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="//fonts.googleapis.com/css2?family=Noto+Serif+KR:wght@400;600;700&family=Noto+Sans+KR:wght@400;500;700&display=swap">

    <style>
        /* ===== 미니멀 뉴스 기사 스타일 ===== */
        body,
        .Wrap {
            background: #fff !important;
        }

        .Wrap {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }

        /* Header 스타일 오버라이드 */
        .header {
            background: #1a1a1a !important;
        }

        .header .conbox {
            background: #1a1a1a !important;
        }

        /* 메인 컨테이너 */
        .article-container {
            max-width: 720px;
            margin: 0 auto;
            padding: 60px 24px 120px;
            background: #fff;
        }

        /* 뒤로가기 */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #888;
            font-size: 13px;
            text-decoration: none;
            margin-bottom: 40px;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #0066cc;
        }

        /* 기사 헤더 */
        .article-header {
            margin-bottom: 48px;
            padding-bottom: 32px;
            border-bottom: 1px solid #e0e0e0;
        }

        .article-category {
            display: inline-block;
            font-size: 12px;
            color: #0066cc;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .article-title {
            font-family: 'Noto Serif KR', Georgia, serif;
            font-size: 32px;
            font-weight: 700;
            color: #111;
            line-height: 1.4;
            margin-bottom: 20px;
            letter-spacing: -0.5px;
        }

        @media (max-width: 768px) {
            .article-title {
                font-size: 26px;
            }
        }

        .article-meta {
            display: flex;
            gap: 20px;
            font-size: 13px;
            color: #888;
        }

        .article-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* 썸네일 */
        .article-thumbnail {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 4px;
            margin-bottom: 40px;
        }

        /* ===== 본문 - 뉴스 스타일 ===== */
        .article-content {
            font-family: 'Noto Sans KR', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 17px;
            line-height: 1.9;
            color: #333;
            word-break: keep-all;
        }

        .article-content p {
            margin-bottom: 24px;
        }

        /* 헤딩 */
        .article-content h2 {
            font-family: 'Noto Serif KR', Georgia, serif;
            font-size: 24px;
            font-weight: 700;
            color: #111;
            margin: 48px 0 20px;
            padding-bottom: 12px;
            border-bottom: 2px solid #0066cc;
        }

        .article-content h3 {
            font-size: 20px;
            font-weight: 600;
            color: #222;
            margin: 36px 0 16px;
        }

        .article-content h4 {
            font-size: 18px;
            font-weight: 600;
            color: #333;
            margin: 28px 0 12px;
        }

        /* 이미지 */
        .article-content img {
            max-width: 100%;
            margin: 32px 0;
            border-radius: 4px;
        }

        /* 링크 */
        .article-content a {
            color: #0066cc;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .article-content a:hover {
            color: #004499;
        }

        /* 인용문 */
        .article-content blockquote {
            margin: 32px 0;
            padding: 20px 24px;
            background: #f8f9fa;
            border-left: 4px solid #0066cc;
            font-style: italic;
            color: #555;
        }

        .article-content blockquote p {
            margin-bottom: 0;
        }

        /* 리스트 */
        .article-content ul,
        .article-content ol {
            margin: 24px 0;
            padding-left: 24px;
        }

        .article-content li {
            margin-bottom: 10px;
            line-height: 1.8;
        }

        /* 강조 */
        .article-content strong {
            color: #111;
            font-weight: 600;
        }

        /* 구분선 */
        .article-content hr {
            border: none;
            border-top: 1px solid #e0e0e0;
            margin: 48px 0;
        }

        /* 코드 */
        .article-content code {
            font-family: 'Consolas', 'Monaco', monospace;
            background: #f5f5f5;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 0.9em;
            color: #e83e8c;
        }

        .article-content pre {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
            overflow-x: auto;
            margin: 28px 0;
            border: 1px solid #e0e0e0;
        }

        .article-content pre code {
            background: none;
            padding: 0;
            color: #333;
        }

        /* 테이블 */
        .article-content table {
            width: 100%;
            border-collapse: collapse;
            margin: 28px 0;
            font-size: 15px;
        }

        .article-content th,
        .article-content td {
            padding: 12px 16px;
            border: 1px solid #e0e0e0;
            text-align: left;
        }

        .article-content th {
            background: #f8f9fa;
            font-weight: 600;
            color: #111;
        }

        /* 태그 */
        .article-tags {
            margin-top: 48px;
            padding-top: 24px;
            border-top: 1px solid #e0e0e0;
        }

        .article-tags span {
            display: inline-block;
            background: #f5f5f5;
            color: #666;
            padding: 6px 14px;
            font-size: 13px;
            margin: 4px 4px 4px 0;
            border-radius: 3px;
            transition: all 0.2s;
        }

        .article-tags span:hover {
            background: #0066cc;
            color: #fff;
        }

        /* 로딩 */
        .article-loading {
            text-align: center;
            padding: 100px 20px;
            color: #888;
        }

        .article-loading .spinner {
            width: 32px;
            height: 32px;
            border: 2px solid #e0e0e0;
            border-top: 2px solid #0066cc;
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

        /* 에러 */
        .article-error {
            text-align: center;
            padding: 100px 20px;
            color: #666;
        }

        .article-error h3 {
            font-size: 20px;
            color: #333;
            margin-bottom: 12px;
        }

        /* 이전글/다음글 네비게이션 */
        .article-nav {
            margin-top: 80px;
            padding: 40px 0;
            border-top: 1px solid #e0e0e0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            min-height: 120px;
            /* 공간 확보 */
        }

        .nav-link {
            text-decoration: none;
            display: flex;
            flex-direction: column;
            padding: 20px;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .nav-link:hover {
            background: #f1f3f5;
            transform: translateY(-2px);
        }

        .nav-link.next {
            text-align: right;
            align-items: flex-end;
        }

        .nav-label {
            font-size: 12px;
            color: #888;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .nav-title {
            font-size: 15px;
            color: #333;
            font-weight: 500;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            word-break: keep-all;
        }

        .nav-link:hover .nav-title {
            color: #0066cc;
        }

        @media (max-width: 576px) {
            .article-nav {
                grid-template-columns: 1fr;
            }
        }

        /* Footer 스타일 오버라이드 */
        footer,
        .footer {
            background: #1a1a1a !important;
            border-top: 1px solid #333;
        }

        .dark_bg {
            display: none;
        }
    </style>
</head>

<body>
    <div class="Wrap">
        <div id="header-placeholder"></div>

        <main>
            <div class="article-container">
                <!-- 로딩 -->
                <div class="article-loading" id="articleLoading">
                    <div class="spinner"></div>
                    <p>글을 불러오는 중...</p>
                </div>

                <!-- 에러 -->
                <div class="article-error" id="articleError" style="display:none">
                    <h3>글을 찾을 수 없습니다</h3>
                    <p>요청하신 글이 존재하지 않거나 삭제되었습니다.</p>
                    <br>
                    <a href="<?php echo $base_path; ?>/archive/archive.php" class="back-link">← 아카이브로 돌아가기</a>
                </div>

                <!-- 글 내용 -->
                <article id="articleView" style="display:none">
                    <a href="<?php echo $base_path; ?>/archive/archive.php" class="back-link">← 목록으로</a>

                    <header class="article-header">
                        <span class="article-category" id="articleCategory"></span>
                        <h1 class="article-title" id="articleTitle"></h1>
                        <div class="article-meta">
                            <span id="articleDate"></span>
                        </div>
                    </header>

                    <img class="article-thumbnail" id="articleThumbnail" style="display:none">

                    <div class="article-content" id="articleContent"></div>

                    <div class="article-tags" id="articleTags" style="display:none"></div>

                    <!-- 이전글 / 다음글 네비게이션 -->
                    <nav class="article-nav" id="articleNav" style="display:none">
                        <div id="prevArticle"></div>
                        <div id="nextArticle"></div>
                    </nav>
                </article>
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
        const articleId = "<?php echo $articleId; ?>";

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
                month: 'long',
                day: 'numeric'
            });
        }

        async function fetchArticle() {
            console.log('Fetching article ID:', articleId);
            const loadingEl = document.getElementById('articleLoading');
            const errorEl = document.getElementById('articleError');
            const viewEl = document.getElementById('articleView');

            if (!articleId) {
                loadingEl.style.display = 'none';
                errorEl.style.display = 'block';
                return;
            }

            try {
                const docRef = doc(db, 'archives', articleId);
                const docSnap = await getDoc(docRef);

                if (docSnap.exists()) {
                    const article = docSnap.data();
                    console.log('Article data fetched:', article.title);

                    document.getElementById('articleCategory').textContent = article.category || '기타';
                    document.getElementById('articleTitle').textContent = article.title || '제목 없음';

                    const displayTitle = (article.title || '제목 없음') + ' | HIVEMEDIA Archive';
                    document.title = displayTitle;
                    document.getElementById('ogTitle').content = displayTitle;

                    if (article.seoDescription) {
                        document.getElementById('metaDescription').content = article.seoDescription;
                        document.getElementById('ogDescription').content = article.seoDescription;
                    }

                    // 날짜 선택이 있으면 최우선, 없으면 생성일
                    const displayDate = article.publishedDate ? article.publishedDate : formatDate(article.createdAt);
                    document.getElementById('articleDate').textContent = displayDate;

                    if (article.thumbnail) {
                        const thumbEl = document.getElementById('articleThumbnail');
                        thumbEl.src = article.thumbnail;
                        thumbEl.style.display = 'block';
                    }

                    // 본문 줄바꿈을 문단으로 변환
                    let contentHtml = (article.content || '')
                        .split(/\n\n+/)  // 빈 줄로 문단 구분
                        .filter(p => p.trim())
                        .map(p => `<p>${p.replace(/\n/g, '<br>')}</p>`)
                        .join('');
                    document.getElementById('articleContent').innerHTML = contentHtml;

                    // 태그 처리 (배열 또는 콤마 구분 문자열)
                    const tagsEl = document.getElementById('articleTags');
                    let tagsHtml = '';
                    let metaKeywords = '';

                    if (article.tags) {
                        let tagsArray = [];
                        if (Array.isArray(article.tags)) {
                            tagsArray = article.tags;
                        } else if (typeof article.tags === 'string' && article.tags.trim() !== '') {
                            tagsArray = article.tags.split(',').map(t => t.trim());
                        }

                        if (tagsArray.length > 0) {
                            tagsHtml = tagsArray.map(tag => `<span>#${tag}</span>`).join('');
                            metaKeywords = tagsArray.join(', ');
                            document.getElementById('metaKeywords').content = metaKeywords;
                        }
                    }

                    if (tagsHtml) {
                        tagsEl.innerHTML = tagsHtml;
                        tagsEl.style.display = 'block';
                    } else {
                        tagsEl.style.display = 'none';
                    }

                    // 상세 내용 표시
                    loadingEl.style.display = 'none';
                    viewEl.style.display = 'block';

                    // 이전글/다음글 가져오기
                    fetchPrevNextArticles(article.createdAt);
                } else {
                    console.log('Article not found');
                    loadingEl.style.display = 'none';
                    errorEl.style.display = 'block';
                }
            } catch (error) {
                console.error('Error fetching article:', error);
                loadingEl.style.display = 'none';
                errorEl.style.display = 'block';
            }
        }

        async function fetchPrevNextArticles(currentCreatedAt) {
            const navEl = document.getElementById('articleNav');
            const prevEl = document.getElementById('prevArticle');
            const nextEl = document.getElementById('nextArticle');

            if (!navEl) return;

            // 로직 시작 전 영역을 표시하여 동작 여부 확인
            navEl.style.display = 'grid';
            console.log('fetchPrevNextArticles 시작. createdAt:', currentCreatedAt);

            if (!currentCreatedAt) {
                console.warn('이 문서에 createdAt 필드가 없습니다.');
                prevEl.innerHTML = '<div class="nav-link" style="opacity:0.5; cursor:default;"><span class="nav-label">이전글</span><strong class="nav-title">게시일 정보가 없습니다.</strong></div>';
                nextEl.innerHTML = '<div class="nav-link next" style="opacity:0.5; cursor:default;"><span class="nav-label">다음글</span><strong class="nav-title">게시일 정보가 없습니다.</strong></div>';
                return;
            }

            try {
                // 이전글 쿼리
                const prevQuery = query(
                    collection(db, 'archives'),
                    where('createdAt', '<', currentCreatedAt),
                    orderBy('createdAt', 'desc'),
                    limit(1)
                );

                // 다음글 쿼리
                const nextQuery = query(
                    collection(db, 'archives'),
                    where('createdAt', '>', currentCreatedAt),
                    orderBy('createdAt', 'asc'),
                    limit(1)
                );

                console.log('이전/다음 글 데이터 요청 중...');
                const [prevSnap, nextSnap] = await Promise.all([
                    getDocs(prevQuery),
                    getDocs(nextQuery)
                ]);
                console.log('데이터 수신 완료. 이전:', prevSnap.size, '다음:', nextSnap.size);

                if (!prevSnap.empty) {
                    const d = prevSnap.docs[0];
                    prevEl.innerHTML = `
                        <a href="view.php?id=${d.id}" class="nav-link prev">
                            <span class="nav-label">← 이전글</span>
                            <strong class="nav-title">${d.data().title || '제목 없음'}</strong>
                        </a>`;
                } else {
                    prevEl.innerHTML = `
                        <div class="nav-link" style="opacity:0.5; cursor:default;">
                            <span class="nav-label">← 이전글</span>
                            <strong class="nav-title">이전 글이 없습니다.</strong>
                        </div>`;
                }

                if (!nextSnap.empty) {
                    const d = nextSnap.docs[0];
                    nextEl.innerHTML = `
                        <a href="view.php?id=${d.id}" class="nav-link next">
                            <span class="nav-label">다음글 →</span>
                            <strong class="nav-title">${d.data().title || '제목 없음'}</strong>
                        </a>`;
                } else {
                    nextEl.innerHTML = `
                        <div class="nav-link next" style="opacity:0.5; cursor:default;">
                            <span class="nav-label">다음글 →</span>
                            <strong class="nav-title">다음 글이 없습니다.</strong>
                        </div>`;
                }
            } catch (error) {
                console.error('네비게이션 로드 중 오류 발생:', error);
                // 인덱스 생성 오류 등이 발생할 수 있으므로 사용자에게 알림
                prevEl.innerHTML = `<div class="nav-link" style="color:red; font-size:12px;">목록 로드 오류</div>`;
                if (error.message && error.message.includes('index')) {
                    console.error('Firestore 복합 인덱스가 필요할 수 있습니다. 콘솔 링크를 확인하세요.');
                }
            }
        }

        fetchArticle();
    </script>
</body>

</html>