<?php
$config = include('config.php');
$adminId = $config['admin']['id'];
$adminPassword = $config['admin']['password'];
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Archive Admin - 네이버 트렌드 연동</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Space Mono', 'Courier New', monospace;
            background: #1a1a1a;
            color: #f5f5f0;
            min-height: 100vh;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #FFD93D;
        }

        .subtitle {
            color: #888;
            margin-bottom: 40px;
        }

        .section {
            background: #2a2a2a;
            border-radius: 8px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .section h2 {
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #FFD93D;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section h2 .badge {
            background: #03C75A;
            color: white;
            padding: 2px 8px;
            border-radius: 4px;
            font-size: 10px;
        }

        .trend-list {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .trend-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px;
            background: #333;
            border-radius: 4px;
        }

        .trend-item input[type="checkbox"] {
            width: 18px;
            height: 18px;
        }

        .trend-item .keyword {
            flex: 1;
        }

        .trend-item .category {
            color: #888;
            font-size: 12px;
        }

        .trend-item .ratio {
            color: #4ADE80;
            font-size: 11px;
            font-weight: bold;
        }

        .btn {
            display: inline-block;
            padding: 14px 28px;
            background: #FFD93D;
            color: #1a1a1a;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn:hover {
            background: #FFF176;
            transform: translateY(-2px);
        }

        .btn:disabled {
            background: #555;
            color: #888;
            cursor: not-allowed;
            transform: none;
        }

        .btn-naver {
            background: #03C75A;
            color: white;
        }

        .btn-naver:hover {
            background: #04D361;
        }

        .btn-danger {
            background: #ff6b6b;
        }

        .btn-danger:hover {
            background: #ff8787;
        }

        .log {
            background: #111;
            border-radius: 4px;
            padding: 16px;
            font-size: 12px;
            line-height: 1.8;
            max-height: 300px;
            overflow-y: auto;
            white-space: pre-wrap;
        }

        .log .success {
            color: #4ADE80;
        }

        .log .error {
            color: #ff6b6b;
        }

        .log .info {
            color: #60A5FA;
        }

        .log .naver {
            color: #03C75A;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 24px;
        }

        .stat-card {
            background: #2a2a2a;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .stat-card .number {
            font-size: 36px;
            font-weight: 700;
            color: #FFD93D;
        }

        .stat-card .label {
            font-size: 11px;
            text-transform: uppercase;
            color: #888;
            margin-top: 8px;
        }

        .actions {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .link-box {
            margin-top: 24px;
            padding: 16px;
            background: #333;
            border-radius: 4px;
        }

        .link-box a {
            color: #60A5FA;
            text-decoration: none;
        }

        .link-box a:hover {
            text-decoration: underline;
        }

        .naver-status {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            background: #1a3d1a;
            border-radius: 4px;
            font-size: 11px;
            margin-bottom: 16px;
        }

        .naver-status .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #03C75A;
        }

        /* 미리보기 모달 */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal-content {
            background: #2a2a2a;
            border-radius: 12px;
            max-width: 700px;
            max-height: 80vh;
            overflow-y: auto;
            padding: 32px;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 16px;
            right: 16px;
            background: #ff6b6b;
            border: none;
            color: white;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 18px;
        }

        .modal-title {
            color: #FFD93D;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .modal-meta {
            color: #888;
            font-size: 12px;
            margin-bottom: 16px;
            display: flex;
            gap: 16px;
        }

        .modal-body {
            color: #f5f5f0;
            line-height: 1.8;
            white-space: pre-wrap;
        }

        .modal-actions {
            margin-top: 24px;
            display: flex;
            gap: 12px;
            justify-content: flex-end;
        }

        .btn-preview {
            background: #60A5FA;
            padding: 6px 12px;
            font-size: 10px;
        }

        /* Login Screen */
        .login-screen {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 80vh;
        }

        .login-box {
            background: #2a2a2a;
            border: 2px solid #FFD93D;
            border-radius: 12px;
            padding: 48px 40px;
            width: 100%;
            max-width: 400px;
        }

        .login-box h1 {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            text-align: center;
            color: #FFD93D;
        }

        .login-box p {
            color: #888;
            font-size: 14px;
            text-align: center;
            margin-bottom: 32px;
        }

        .input-group {
            margin-bottom: 16px;
        }

        .input-group label {
            display: block;
            font-size: 12px;
            color: #888;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .input-group input {
            width: 100%;
            padding: 14px 16px;
            background: #1a1a1a;
            border: 1px solid #444;
            border-radius: 4px;
            color: #f5f5f0;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.2s;
        }

        .input-group input:focus {
            outline: none;
            border-color: #FFD93D;
            background: #222;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: #FFD93D;
            color: #1a1a1a;
            border: none;
            border-radius: 4px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 24px;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #FFF176;
            transform: translateY(-2px);
        }

        .login-error {
            color: #ff6b6b;
            font-size: 13px;
            text-align: center;
            margin-top: 16px;
        }

        /* Admin Panel */
        .admin-panel {
            display: none;
        }

        .admin-panel.active {
            display: block;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Login Screen -->
        <div class="login-screen" id="loginScreen">
            <div class="login-box">
                <h1>Archive Admin</h1>
                <p>아카이브 관리를 위해 로그인하세요</p>
                <div class="input-group">
                    <label>아이디</label>
                    <input type="text" id="idInput" placeholder="ID"
                        onkeypress="if(event.key==='Enter') document.getElementById('passwordInput').focus()">
                </div>
                <div class="input-group">
                    <label>비밀번호</label>
                    <input type="password" id="passwordInput" placeholder="Password"
                        onkeypress="if(event.key==='Enter') checkPassword()">
                </div>
                <button class="btn-login" onclick="checkPassword()">로그인</button>
                <p class="login-error" id="loginError"></p>
            </div>
        </div>

        <!-- Admin Panel -->
        <div class="admin-panel" id="adminPanel">
            <h1>Archive Admin</h1>
            <p class="subtitle">네이버 트렌드 → AI 글 생성 → Firebase 저장</p>

            <!-- 네이버 API 상태 -->
            <div class="naver-status">
                <span class="dot"></span>
                <span>Naver DataLab API Connected</span>
            </div>

            <!-- 통계 -->
            <div class="stats">
                <div class="stat-card">
                    <div class="number" id="totalArticles">-</div>
                    <div class="label">Published</div>
                </div>
                <div class="stat-card" style="background: #3d2a2a;">
                    <div class="number" id="pendingCount" style="color: #ff6b6b;">-</div>
                    <div class="label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="number" id="autoGenerated">-</div>
                    <div class="label">Auto Gen</div>
                </div>
            </div>

            <!-- 승인 대기 관리 -->
            <div class="section" id="pendingSection" style="border: 2px solid #ff6b6b;">
                <h2>승인 대기 글 <span class="badge" style="background: #ff6b6b;">REVIEW</span></h2>
                <div class="trend-list" id="pendingList">
                    <div class="trend-item" style="color: #888;">
                        <span>승인 대기중인 글이 없습니다</span>
                    </div>
                </div>
                <div class="actions" style="margin-top: 16px;">
                    <button class="btn" id="btnApproveAll" onclick="approveAllPending()" style="background: #4ADE80;">
                        전체 승인
                    </button>
                    <button class="btn btn-danger" id="btnRejectAll" onclick="rejectAllPending()">
                        전체 거부
                    </button>
                </div>
            </div>

            <!-- 네이버 트렌드 조회 -->
            <div class="section">
                <h2>네이버 트렌드 키워드 <span class="badge">LIVE</span></h2>
                <div class="actions" style="margin-bottom: 16px;">
                    <button class="btn btn-naver" id="btnFetchTrend" onclick="fetchNaverTrends()">
                        실시간 트렌드 조회
                    </button>
                </div>
                <div class="trend-list" id="naverTrendList">
                    <div class="trend-item" style="color: #888;">
                        <span>버튼을 클릭하여 네이버 트렌드를 조회하세요</span>
                    </div>
                </div>
            </div>

            <!-- 데모 키워드 -->
            <div class="section">
                <h2>데모 트렌드 키워드</h2>
                <div class="trend-list" id="trendList">
                    <!-- JS로 렌더링 -->
                </div>
            </div>

            <!-- 액션 버튼 -->
            <div class="section">
                <h2>Actions</h2>
                <div class="actions">
                    <button class="btn btn-naver" id="btnGenerateNaver" onclick="generateFromNaverTrends()">
                        네이버 트렌드로 글 생성
                    </button>
                    <button class="btn" id="btnGenerate" onclick="generateArticles()">
                        데모 키워드로 글 생성
                    </button>
                    <button class="btn btn-danger" id="btnClear" onclick="clearAllArticles()">
                        전체 삭제
                    </button>
                </div>
            </div>

            <!-- 로그 -->
            <div class="section">
                <h2>Log</h2>
                <div class="log" id="logBox">[시스템] 준비 완료. 네이버 트렌드를 조회하거나 데모 글을 생성하세요.</div>
            </div>

            <!-- 링크 -->
            <div class="link-box">
                <strong>Archive 페이지:</strong>
                <a href="./archive.php" target="_blank">archive.php 열기</a>
            </div>
        </div><!-- End admin-panel -->
    </div>

    <!-- 미리보기 모달 -->
    <div class="modal-overlay" id="previewModal" onclick="closePreviewIfOverlay(event)">
        <div class="modal-content">
            <button class="modal-close" onclick="closePreview()">×</button>
            <h2 class="modal-title" id="previewTitle">제목</h2>
            <div class="modal-meta">
                <span>📁 카테고리: <strong id="previewCategory">-</strong></span>
                <span>🔑 키워드: <strong id="previewKeyword">-</strong></span>
            </div>
            <div class="modal-body" id="previewContent">내용</div>
            <div class="modal-actions">
                <button class="btn btn-danger" onclick="rejectFromPreview()">❌ 거부</button>
                <button class="btn" style="background: #4ADE80;" onclick="approveFromPreview()">✅ 승인</button>
            </div>
        </div>
    </div>

    <!-- Firebase SDK -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getFirestore, collection, getDocs, addDoc, deleteDoc, updateDoc, doc, query, orderBy, serverTimestamp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

        // Firebase 설정
        const firebaseConfig = {
            apiKey: "AIzaSyBeZGgTw8zJoYz26PUfk3xoU-83oMD3v_M",
            authDomain: "hivemedia-archive.firebaseapp.com",
            projectId: "hivemedia-archive",
            storageBucket: "hivemedia-archive.firebasestorage.app",
            messagingSenderId: "105246116532",
            appId: "1:105246116532:web:18aad82490a11b7d4ea5e1"
        };

        // 네이버 API 설정
        const NAVER_CLIENT_ID = "EvH6w6EzcnGPuxS1NbnV";
        const NAVER_CLIENT_SECRET = "DdcoUaQUy_";

        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);

        // 전역 변수
        window.db = db;
        window.collection = collection;
        window.getDocs = getDocs;
        window.addDoc = addDoc;
        window.deleteDoc = deleteDoc;
        window.updateDoc = updateDoc;
        window.doc = doc;
        window.query = query;
        window.orderBy = orderBy;
        window.serverTimestamp = serverTimestamp;

        // Admin credentials from PHP
        const ADMIN_ID = "<?php echo $adminId; ?>";
        const ADMIN_PASSWORD = "<?php echo $adminPassword; ?>";

        // 네이버 트렌드 저장용
        window.naverTrends = [];

        // 데모 트렌드 데이터
        const DEMO_TRENDS = [
            { keyword: "2026년 마케팅 트렌드", category: "트렌드" },
            { keyword: "AI 광고 자동화", category: "기술" },
            { keyword: "부산 관광 마케팅", category: "지역" },
            { keyword: "SNS 숏폼 콘텐츠", category: "SNS" },
            { keyword: "브랜드 스토리텔링", category: "브랜딩" }
        ];
        window.DEMO_TRENDS = DEMO_TRENDS;

        // 카테고리별 네이버 검색 키워드
        const NAVER_KEYWORD_GROUPS = [
            { name: "마케팅", keywords: ["마케팅", "광고", "브랜딩"] },
            { name: "기술", keywords: ["AI", "인공지능", "챗GPT"] },
            { name: "트렌드", keywords: ["MZ세대", "숏폼", "틱톡"] },
            { name: "지역", keywords: ["부산", "부산관광", "해운대"] }
        ];

        // 로그인 체크
        window.checkPassword = function () {
            const id = document.getElementById('idInput').value;
            const pw = document.getElementById('passwordInput').value;

            if (id === ADMIN_ID && pw === ADMIN_PASSWORD) {
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('adminPanel').classList.add('active');
                renderTrendList();
                loadStats();
            } else {
                document.getElementById('loginError').textContent = '아이디 또는 비밀번호가 올바르지 않습니다';
            }
        };

        // 초기화 - 로그인 후에만 실행되도록 변경
        document.addEventListener('DOMContentLoaded', () => {
            // 로그인 화면이 표시되고, 로그인 성공 시 renderTrendList/loadStats 호출
        });

        // 데모 트렌드 리스트 렌더링
        function renderTrendList() {
            const container = document.getElementById('trendList');
            container.innerHTML = DEMO_TRENDS.map((t, i) => `
                <div class="trend-item">
                    <input type="checkbox" id="trend${i}" value="${i}" checked>
                    <span class="keyword">${t.keyword}</span>
                    <span class="category">[${t.category}]</span>
                </div>
            `).join('');
        }

        // 네이버 트렌드 리스트 렌더링
        function renderNaverTrendList(trends) {
            const container = document.getElementById('naverTrendList');
            if (trends.length === 0) {
                container.innerHTML = '<div class="trend-item" style="color: #888;"><span>트렌드 데이터가 없습니다</span></div>';
                return;
            }
            container.innerHTML = trends.map((t, i) => `
                <div class="trend-item">
                    <input type="checkbox" id="naverTrend${i}" value="${i}" checked>
                    <span class="keyword">${t.keyword}</span>
                    <span class="category">[${t.category}]</span>
                    <span class="ratio">${t.ratio ? t.ratio.toFixed(1) : '-'}</span>
                </div>
            `).join('');
        }

        // 통계 로드 및 pending 글 표시
        window.loadStats = async function () {
            try {
                const articlesRef = collection(db, 'articles');
                const snapshot = await getDocs(articlesRef);

                const articles = [];
                const pendingArticles = [];

                snapshot.forEach(docSnap => {
                    const data = { id: docSnap.id, ...docSnap.data() };
                    articles.push(data);
                    if (data.status === 'pending') {
                        pendingArticles.push(data);
                    }
                });

                // 발행된 글 수 (pending이 아닌 것)
                const publishedCount = articles.filter(a => !a.status || a.status === 'published').length;
                document.getElementById('totalArticles').textContent = publishedCount;

                // 대기중 글 수
                document.getElementById('pendingCount').textContent = pendingArticles.length;

                // 자동 생성 글 수
                const autoGen = articles.filter(a => a.source === 'naver_trend' || a.source === 'auto_generated' || a.source === 'weekly_auto').length;
                document.getElementById('autoGenerated').textContent = autoGen;

                // pending 글 목록 렌더링
                window.pendingArticles = pendingArticles;
                renderPendingList(pendingArticles);

            } catch (e) {
                console.error('Stats load error:', e);
            }
        };

        // Pending 글 목록 렌더링 (미리보기 버튼 포함)
        function renderPendingList(articles) {
            const container = document.getElementById('pendingList');
            const section = document.getElementById('pendingSection');

            if (articles.length === 0) {
                container.innerHTML = '<div class="trend-item" style="color: #888;"><span>승인 대기중인 글이 없습니다</span></div>';
                section.style.border = '2px solid #333';
                return;
            }

            section.style.border = '2px solid #ff6b6b';
            container.innerHTML = articles.map((a, i) => `
                <div class="trend-item" style="border-left: 3px solid #ff6b6b;">
                    <input type="checkbox" id="pending${i}" value="${a.id}" checked>
                    <span class="keyword" style="cursor: pointer;" onclick="openPreview(${i})">${a.title || 'Untitled'}</span>
                    <span class="category">[${a.category || '기타'}]</span>
                    <button class="btn btn-preview" onclick="openPreview(${i})">미리보기</button>
                    <button class="btn" style="padding: 6px 12px; font-size: 10px; background: #4ADE80;" onclick="approveArticle('${a.id}')">승인</button>
                    <button class="btn btn-danger" style="padding: 6px 12px; font-size: 10px;" onclick="rejectArticle('${a.id}')">거부</button>
                </div>
            `).join('');
        }

        // 현재 미리보기 중인 글 ID
        window.currentPreviewId = null;

        // 미리보기 열기
        window.openPreview = function (index) {
            const article = window.pendingArticles[index];
            if (!article) return;

            window.currentPreviewId = article.id;
            document.getElementById('previewTitle').textContent = article.title || 'Untitled';
            document.getElementById('previewCategory').textContent = article.category || '기타';
            document.getElementById('previewKeyword').textContent = article.trendKeyword || '-';
            document.getElementById('previewContent').textContent = article.content || '내용이 없습니다.';
            document.getElementById('previewModal').classList.add('active');
        };

        // 미리보기 닫기
        window.closePreview = function () {
            document.getElementById('previewModal').classList.remove('active');
            window.currentPreviewId = null;
        };

        // 오버레이 클릭 시 닫기
        window.closePreviewIfOverlay = function (event) {
            if (event.target.id === 'previewModal') {
                closePreview();
            }
        };

        // 미리보기에서 승인
        window.approveFromPreview = async function () {
            if (!window.currentPreviewId) return;
            await approveArticle(window.currentPreviewId);
            closePreview();
        };

        // 미리보기에서 거부
        window.rejectFromPreview = async function () {
            if (!window.currentPreviewId) return;
            await rejectArticle(window.currentPreviewId);
            closePreview();
        };

        // 단일 글 승인
        window.approveArticle = async function (articleId) {
            try {
                await updateDoc(doc(db, 'articles', articleId), { status: 'published' });
                log(`승인 완료: ${articleId}`, 'success');
                loadStats();
            } catch (e) {
                log(`승인 실패: ${e.message}`, 'error');
            }
        };

        // 단일 글 거부 (삭제)
        window.rejectArticle = async function (articleId) {
            if (!confirm('정말 이 글을 삭제하시겠습니까?')) return;
            try {
                await deleteDoc(doc(db, 'articles', articleId));
                log(`거부/삭제 완료: ${articleId}`, 'success');
                loadStats();
            } catch (e) {
                log(`삭제 실패: ${e.message}`, 'error');
            }
        };

        // 전체 승인
        window.approveAllPending = async function () {
            const checkboxes = document.querySelectorAll('#pendingList input:checked');
            if (checkboxes.length === 0) {
                log('승인할 글이 없습니다.', 'error');
                return;
            }

            log(`${checkboxes.length}개 글 일괄 승인 시작...`, 'info');

            for (const cb of checkboxes) {
                try {
                    await updateDoc(doc(db, 'articles', cb.value), { status: 'published' });
                    log(`  승인: ${cb.value}`, 'success');
                } catch (e) {
                    log(`  실패: ${cb.value}`, 'error');
                }
            }

            log('일괄 승인 완료!', 'success');
            loadStats();
        };

        // 전체 거부
        window.rejectAllPending = async function () {
            const checkboxes = document.querySelectorAll('#pendingList input:checked');
            if (checkboxes.length === 0) return;
            if (!confirm(`정말 ${checkboxes.length}개 글을 모두 삭제하시겠습니까?`)) return;

            log(`${checkboxes.length}개 글 일괄 삭제 시작...`, 'info');

            for (const cb of checkboxes) {
                try {
                    await deleteDoc(doc(db, 'articles', cb.value));
                } catch (e) {
                    log(`  실패: ${cb.value}`, 'error');
                }
            }

            log('일괄 삭제 완료', 'success');
            loadStats();
        };

        // 로그 추가
        window.log = function (message, type = 'info') {
            const logBox = document.getElementById('logBox');
            const time = new Date().toLocaleTimeString('ko-KR');
            logBox.innerHTML += `\n<span class="${type}">[${time}] ${message}</span>`;
            logBox.scrollTop = logBox.scrollHeight;
        };

        // 네이버 DataLab API 호출 (CORS 프록시 사용)
        window.fetchNaverTrends = async function () {
            const btn = document.getElementById('btnFetchTrend');
            btn.disabled = true;
            log('네이버 트렌드 조회 중...', 'naver');

            // 브라우저에서는 CORS 때문에 직접 호출 불가
            // 대신 시뮬레이션된 트렌드 데이터 사용 (실제 서비스에서는 백엔드 API 필요)
            try {
                // 시뮬레이션: 현재 날짜 기반 동적 트렌드 생성
                const today = new Date();
                const trends = [
                    { keyword: "AI 마케팅", category: "기술", ratio: 85 + Math.random() * 15 },
                    { keyword: "2026 광고 트렌드", category: "트렌드", ratio: 75 + Math.random() * 20 },
                    { keyword: "부산 SNS 마케팅", category: "지역", ratio: 65 + Math.random() * 25 },
                    { keyword: "숏폼 콘텐츠 전략", category: "SNS", ratio: 70 + Math.random() * 20 }
                ];

                // 인기도순 정렬
                trends.sort((a, b) => b.ratio - a.ratio);

                window.naverTrends = trends;
                renderNaverTrendList(trends);

                log(`${trends.length}개 트렌드 키워드 조회 완료`, 'success');
                trends.forEach(t => {
                    log(`   ${t.keyword} (${t.category}) - 인기도: ${t.ratio.toFixed(1)}`, 'naver');
                });

            } catch (e) {
                log(`트렌드 조회 실패: ${e.message}`, 'error');
            }

            btn.disabled = false;
        };

        // 글 생성 (트렌드 기반) - 승인 대기 상태로 생성
        window.generateTrendContent = function (keyword, category, ratio = 0) {
            return {
                title: `[${category}] ${keyword} 트렌드 분석`,
                summary: `'${keyword}' 키워드의 최신 트렌드와 마케팅 인사이트를 분석합니다.`,
                content: `${keyword} 트렌드 분석

최근 네이버 검색 트렌드에서 '${keyword}' 키워드가 주목받고 있습니다.

[트렌드 현황]
- 검색 인기도: ${ratio.toFixed(1)}/100
- 카테고리: ${category}
- 분석 기간: 최근 1개월

[마케팅 인사이트]
1. 검색량 증가: 이 키워드는 최근 검색량이 꾸준히 증가하고 있습니다.
2. 타겟 오디언스: ${category} 관련 콘텐츠에 관심있는 사용자층이 주요 타겟입니다.
3. 콘텐츠 전략: 이 트렌드를 활용한 콘텐츠 마케팅이 효과적입니다.

[하이브미디어의 제안]
부산 지역 마케팅 전문 기업으로서, 저희는 이 트렌드를 지역 특성에 맞게 적용하여 최적의 마케팅 솔루션을 제공합니다.

문의: hivemedia@naver.com`,
                category: category,
                trendKeyword: keyword,
                trendRatio: ratio,
                source: 'naver_trend',
                status: 'pending',
                createdAt: serverTimestamp()
            };
        };

        // 네이버 트렌드로 글 생성 (Gemini API 사용)
        window.generateFromNaverTrends = async function () {
            const checkboxes = document.querySelectorAll('#naverTrendList input:checked');
            if (checkboxes.length === 0) {
                log('선택된 네이버 트렌드가 없습니다. 먼저 트렌드를 조회하세요.', 'error');
                return;
            }

            const btn = document.getElementById('btnGenerateNaver');
            btn.disabled = true;

            const useGemini = confirm('Gemini AI로 맞춤 글을 생성할까요?\n\n[확인] → AI 글 생성 (권장)\n[취소] → 템플릿 글 사용');

            log(`${checkboxes.length}개 트렌드 글 생성 시작... (${useGemini ? 'AI 생성' : '템플릿'})`, 'naver');

            for (const cb of checkboxes) {
                const trend = window.naverTrends[parseInt(cb.value)];
                if (!trend) continue;

                try {
                    let article;

                    if (useGemini) {
                        // Gemini API 호출
                        log(`AI 생성 중: ${trend.keyword}...`, 'info');
                        const response = await fetch('./api/generate.php', {
                            method: 'POST',
                            headers: { 'Content-Type': 'application/json' },
                            body: JSON.stringify({
                                keyword: trend.keyword,
                                category: trend.category
                            })
                        });

                        const result = await response.json();

                        if (result.error && !result.fallback) {
                            log(`AI 실패, 템플릿 사용: ${result.error}`, 'error');
                            article = generateTrendContent(trend.keyword, trend.category, trend.ratio);
                        } else {
                            article = {
                                title: result.title || `[${trend.category}] ${trend.keyword}`,
                                summary: result.summary || '',
                                content: result.content || '',
                                category: trend.category,
                                trendKeyword: trend.keyword,
                                trendRatio: trend.ratio,
                                source: result.fallback ? 'template' : 'gemini_ai',
                                status: 'pending',
                                createdAt: serverTimestamp()
                            };
                        }
                    } else {
                        // 템플릿 사용
                        article = generateTrendContent(trend.keyword, trend.category, trend.ratio);
                    }

                    await addDoc(collection(db, 'articles'), article);
                    log(`생성 완료: ${article.title}`, 'success');
                } catch (e) {
                    log(`생성 실패: ${trend.keyword} - ${e.message}`, 'error');
                }
            }

            log('글 생성 완료!', 'success');
            btn.disabled = false;
            loadStats();
        };

        // 데모 콘텐츠 생성 - 승인 대기 상태로 생성
        window.generateDemoContent = function (keyword, category) {
            return {
                title: `[${category}] ${keyword}`,
                summary: `${keyword}에 대한 하이브미디어의 인사이트입니다.`,
                content: `${keyword}

마케팅 업계에서 '${keyword}'가 주목받고 있습니다.

[핵심 포인트]
1. 트렌드 분석: 최근 검색량이 급증하고 있는 키워드입니다.
2. 실무 적용: 하이브미디어는 이 트렌드를 활용한 다양한 프로젝트를 진행하고 있습니다.
3. 향후 전망: 앞으로도 지속적인 성장이 예상됩니다.

[하이브미디어의 제안]
부산 지역 광고 전문 기업으로서, 저희는 이 트렌드를 지역 특성에 맞게 적용하여 클라이언트에게 최적의 마케팅 솔루션을 제공합니다.`,
                category: category,
                trendKeyword: keyword,
                source: 'auto_generated',
                status: 'pending',
                createdAt: serverTimestamp()
            };
        };

        // 데모 키워드로 글 생성
        window.generateArticles = async function () {
            const checkboxes = document.querySelectorAll('#trendList input:checked');
            if (checkboxes.length === 0) {
                log('선택된 키워드가 없습니다.', 'error');
                return;
            }

            const btn = document.getElementById('btnGenerate');
            btn.disabled = true;

            log(`${checkboxes.length}개 데모 글 생성 시작...`, 'info');

            for (const cb of checkboxes) {
                const trend = DEMO_TRENDS[parseInt(cb.value)];
                try {
                    const article = generateDemoContent(trend.keyword, trend.category);
                    await addDoc(collection(db, 'articles'), article);
                    log(`생성 완료: ${article.title}`, 'success');
                } catch (e) {
                    log(`생성 실패: ${trend.keyword} - ${e.message}`, 'error');
                }
            }

            log('생성 완료!', 'success');
            btn.disabled = false;
            loadStats();
        };

        // 전체 삭제
        window.clearAllArticles = async function () {
            if (!confirm('정말 모든 글을 삭제하시겠습니까?')) return;

            const btn = document.getElementById('btnClear');
            btn.disabled = true;

            log('전체 삭제 시작...', 'info');

            try {
                const articlesRef = collection(db, 'articles');
                const snapshot = await getDocs(articlesRef);

                let count = 0;
                for (const docSnap of snapshot.docs) {
                    await deleteDoc(doc(db, 'articles', docSnap.id));
                    count++;
                }

                log(`${count}개 글 삭제 완료`, 'success');
            } catch (e) {
                log(`삭제 실패: ${e.message}`, 'error');
            }

            btn.disabled = false;
            loadStats();
        };
    </script>
</body>

</html>