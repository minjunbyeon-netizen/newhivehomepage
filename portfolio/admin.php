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
    <title>Portfolio Admin - Hivemedia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Noto+Sans+KR:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', 'Noto Sans KR', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: #202124;
            color: #e8eaed;
            min-height: 100vh;
        }

        /* Header */
        .header {
            background: #292a2d;
            border-bottom: 1px solid #3c4043;
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-logo {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #f9ab00, #ea4335);
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 14px;
            color: white;
        }

        .header-title {
            font-size: 18px;
            font-weight: 400;
            color: #e8eaed;
        }

        .header-title span {
            color: #9aa0a6;
            font-weight: 300;
        }

        .header-links {
            display: flex;
            gap: 16px;
        }

        .header-links a {
            color: #8ab4f8;
            text-decoration: none;
            font-size: 13px;
        }

        .header-links a:hover {
            text-decoration: underline;
        }

        /* Container */
        .container {
            max-width: 960px;
            margin: 0 auto;
            padding: 32px 24px;
        }

        /* Login */
        .login-screen {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 70vh;
        }

        .login-box {
            background: #292a2d;
            border: 1px solid #3c4043;
            border-radius: 8px;
            padding: 48px 40px;
            width: 100%;
            max-width: 400px;
        }

        .login-box h1 {
            font-size: 24px;
            font-weight: 400;
            margin-bottom: 8px;
            text-align: center;
        }

        .login-box p {
            color: #9aa0a6;
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
            color: #9aa0a6;
            margin-bottom: 8px;
        }

        .input-group input {
            width: 100%;
            padding: 12px 16px;
            background: #202124;
            border: 1px solid #5f6368;
            border-radius: 4px;
            color: #e8eaed;
            font-family: inherit;
            font-size: 14px;
            transition: all 0.2s;
        }

        .input-group input:focus {
            outline: none;
            border-color: #f9ab00;
            background: #292a2d;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #f9ab00;
            color: #202124;
            border: none;
            border-radius: 4px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 24px;
            transition: all 0.2s;
        }

        .btn-login:hover {
            background: #fcc934;
        }

        .login-error {
            color: #f28b82;
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

        /* Stats */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            margin-bottom: 32px;
        }

        .stat-card {
            background: #292a2d;
            border: 1px solid #3c4043;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
        }

        .stat-number {
            font-size: 36px;
            font-weight: 300;
            margin-bottom: 4px;
        }

        .stat-number.pending {
            color: #f28b82;
        }

        .stat-number.approved {
            color: #81c995;
        }

        .stat-number.total {
            color: #8ab4f8;
        }

        .stat-label {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #9aa0a6;
        }

        /* Section */
        .section {
            background: #292a2d;
            border: 1px solid #3c4043;
            border-radius: 8px;
            margin-bottom: 24px;
            overflow: hidden;
        }

        .section.pending {
            border-color: #f28b82;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 20px;
            border-bottom: 1px solid #3c4043;
        }

        .section-title {
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .badge {
            font-size: 10px;
            padding: 3px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: 500;
        }

        .badge-pending {
            background: rgba(242, 139, 130, 0.2);
            color: #f28b82;
        }

        .badge-live {
            background: rgba(129, 201, 149, 0.2);
            color: #81c995;
        }

        .section-actions {
            display: flex;
            gap: 8px;
        }

        /* List */
        .list-item {
            display: flex;
            align-items: center;
            padding: 14px 20px;
            border-bottom: 1px solid #3c4043;
            transition: background 0.15s;
        }

        .list-item:last-child {
            border-bottom: none;
        }

        .list-item:hover {
            background: rgba(255, 255, 255, 0.03);
        }

        .list-item.pending {
            border-left: 3px solid #f28b82;
        }

        .list-info {
            flex: 1;
            min-width: 0;
        }

        .list-title {
            font-size: 14px;
            margin-bottom: 4px;
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .list-title:hover {
            color: #8ab4f8;
        }

        .list-meta {
            font-size: 12px;
            color: #9aa0a6;
        }

        .list-actions {
            display: flex;
            gap: 8px;
            margin-left: 16px;
        }

        .empty-state {
            padding: 40px 20px;
            text-align: center;
            color: #9aa0a6;
            font-size: 13px;
        }

        /* Buttons */
        .btn {
            padding: 8px 16px;
            border-radius: 4px;
            font-family: inherit;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            border: none;
        }

        .btn-sm {
            padding: 6px 12px;
            font-size: 11px;
        }

        .btn-approve {
            background: #81c995;
            color: #202124;
        }

        .btn-approve:hover {
            background: #a8dab5;
        }

        .btn-reject {
            background: #f28b82;
            color: #202124;
        }

        .btn-reject:hover {
            background: #f5a8a2;
        }

        .btn-preview {
            background: #8ab4f8;
            color: #202124;
        }

        .btn-preview:hover {
            background: #aecbfa;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #5f6368;
            color: #e8eaed;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        /* Modal */
        .modal-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .modal-overlay.active {
            display: flex;
        }

        .modal {
            background: #292a2d;
            border: 1px solid #3c4043;
            border-radius: 8px;
            max-width: 640px;
            max-height: 80vh;
            overflow-y: auto;
            width: 90%;
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 20px;
            border-bottom: 1px solid #3c4043;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 500;
        }

        .modal-close {
            background: none;
            border: none;
            color: #9aa0a6;
            font-size: 24px;
            cursor: pointer;
            line-height: 1;
        }

        .modal-close:hover {
            color: #e8eaed;
        }

        .modal-meta {
            padding: 16px 20px;
            background: #202124;
            font-size: 12px;
            color: #9aa0a6;
            display: flex;
            gap: 24px;
        }

        .modal-meta strong {
            color: #e8eaed;
        }

        .modal-body {
            padding: 20px;
            font-size: 14px;
            line-height: 1.7;
            color: #bdc1c6;
            white-space: pre-wrap;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            padding: 16px 20px;
            border-top: 1px solid #3c4043;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .list-actions {
                flex-wrap: wrap;
            }

            .header-links {
                display: none;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-left">
            <div class="header-logo">H</div>
            <h1 class="header-title">Portfolio <span>Admin</span></h1>
        </div>
        <div class="header-links">
            <a href="./portfolio.php" target="_blank">포트폴리오 →</a>
            <a href="./write.php" target="_blank">작성 페이지 →</a>
        </div>
    </header>

    <div class="container">
        <!-- Login -->
        <div class="login-screen" id="loginScreen">
            <div class="login-box">
                <h1>관리자 로그인</h1>
                <p>포트폴리오 승인을 위해 로그인하세요</p>
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
            <!-- Stats -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number pending" id="pendingCount">-</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number approved" id="approvedCount">-</div>
                    <div class="stat-label">Approved</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number total" id="totalCount">-</div>
                    <div class="stat-label">Total</div>
                </div>
            </div>

            <!-- Pending -->
            <div class="section pending" id="pendingSection">
                <div class="section-header">
                    <div class="section-title">
                        승인 대기
                        <span class="badge badge-pending">Review</span>
                    </div>
                    <div class="section-actions">
                        <button class="btn btn-sm btn-approve" onclick="approveAll()">전체 승인</button>
                        <button class="btn btn-sm btn-outline" onclick="rejectAll()">전체 삭제</button>
                    </div>
                </div>
                <div id="pendingList">
                    <div class="empty-state">로딩 중...</div>
                </div>
            </div>

            <!-- Approved -->
            <div class="section">
                <div class="section-header">
                    <div class="section-title">
                        승인 완료
                        <span class="badge badge-live">Live</span>
                    </div>
                </div>
                <div id="approvedList">
                    <div class="empty-state">로딩 중...</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal-overlay" id="previewModal" onclick="closeModalIfOverlay(event)">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title" id="modalTitle">제목</h2>
                <button class="modal-close" onclick="closeModal()">×</button>
            </div>
            <div class="modal-meta">
                <span>카테고리: <strong id="modalCategory">-</strong></span>
                <span>클라이언트: <strong id="modalClient">-</strong></span>
            </div>
            <div class="modal-body" id="modalContent">내용</div>
            <div class="modal-footer">
                <button class="btn btn-reject" onclick="rejectFromModal()">삭제</button>
                <button class="btn btn-approve" id="modalApproveBtn" onclick="approveFromModal()">승인</button>
            </div>
        </div>
    </div>

    <!-- Firebase -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getFirestore, collection, getDocs, updateDoc, deleteDoc, doc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

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

        window.db = db;
        window.collection = collection;
        window.getDocs = getDocs;
        window.updateDoc = updateDoc;
        window.deleteDoc = deleteDoc;
        window.doc = doc;

        const ADMIN_ID = "<?php echo $adminId; ?>";
        const ADMIN_PASSWORD = "<?php echo $adminPassword; ?>";

        window.pendingItems = [];
        window.approvedItems = [];
        window.currentPreviewId = null;
        window.currentPreviewType = null;

        window.checkPassword = function () {
            const id = document.getElementById('idInput').value;
            const pw = document.getElementById('passwordInput').value;

            if (id === ADMIN_ID && pw === ADMIN_PASSWORD) {
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('adminPanel').classList.add('active');
                loadPortfolios();
            } else {
                document.getElementById('loginError').textContent = '아이디 또는 비밀번호가 올바르지 않습니다';
            }
        };

        window.loadPortfolios = async function () {
            try {
                const snapshot = await getDocs(collection(db, 'portfolios'));
                window.pendingItems = [];
                window.approvedItems = [];

                snapshot.forEach(d => {
                    const data = { id: d.id, ...d.data() };
                    if (data.status === 'pending') window.pendingItems.push(data);
                    else if (data.status === 'approved') window.approvedItems.push(data);
                });

                document.getElementById('pendingCount').textContent = window.pendingItems.length;
                document.getElementById('approvedCount').textContent = window.approvedItems.length;
                document.getElementById('totalCount').textContent = window.pendingItems.length + window.approvedItems.length;

                renderPendingList();
                renderApprovedList();

                const section = document.getElementById('pendingSection');
                section.classList.toggle('pending', window.pendingItems.length > 0);
            } catch (e) {
                console.error('Load error:', e);
            }
        };

        function renderPendingList() {
            const el = document.getElementById('pendingList');
            if (window.pendingItems.length === 0) {
                el.innerHTML = '<div class="empty-state">승인 대기 중인 항목이 없습니다</div>';
                return;
            }
            el.innerHTML = window.pendingItems.map((item, i) => `
                <div class="list-item pending">
                    <div class="list-info">
                        <div class="list-title" onclick="openPreview(${i}, 'pending')">${item.title}</div>
                        <div class="list-meta">${item.category}${item.client ? ' • ' + item.client : ''}</div>
                    </div>
                    <div class="list-actions">
                        <button class="btn btn-sm btn-preview" onclick="openPreview(${i}, 'pending')">미리보기</button>
                        <button class="btn btn-sm btn-approve" onclick="approveItem('${item.id}')">승인</button>
                        <button class="btn btn-sm btn-outline" onclick="rejectItem('${item.id}')">삭제</button>
                    </div>
                </div>
            `).join('');
        }

        function renderApprovedList() {
            const el = document.getElementById('approvedList');
            if (window.approvedItems.length === 0) {
                el.innerHTML = '<div class="empty-state">승인된 항목이 없습니다</div>';
                return;
            }
            el.innerHTML = window.approvedItems.slice(0, 10).map((item, i) => `
                <div class="list-item">
                    <div class="list-info">
                        <div class="list-title" onclick="openPreview(${i}, 'approved')">${item.title}</div>
                        <div class="list-meta">${item.category}${item.client ? ' • ' + item.client : ''}</div>
                    </div>
                    <div class="list-actions">
                        <button class="btn btn-sm btn-preview" onclick="openPreview(${i}, 'approved')">보기</button>
                        <button class="btn btn-sm btn-outline" onclick="deleteItem('${item.id}')">삭제</button>
                    </div>
                </div>
            `).join('');
            if (window.approvedItems.length > 10) {
                el.innerHTML += `<div class="empty-state">외 ${window.approvedItems.length - 10}개</div>`;
            }
        }

        window.openPreview = function (i, type) {
            const item = type === 'pending' ? window.pendingItems[i] : window.approvedItems[i];
            if (!item) return;
            window.currentPreviewId = item.id;
            window.currentPreviewType = type;
            document.getElementById('modalTitle').textContent = item.title;
            document.getElementById('modalCategory').textContent = item.category;
            document.getElementById('modalClient').textContent = item.client || '-';
            document.getElementById('modalContent').textContent = item.content;
            document.getElementById('modalApproveBtn').style.display = type === 'approved' ? 'none' : 'inline-flex';
            document.getElementById('previewModal').classList.add('active');
        };

        window.closeModal = function () {
            document.getElementById('previewModal').classList.remove('active');
        };

        window.closeModalIfOverlay = function (e) {
            if (e.target.id === 'previewModal') closeModal();
        };

        window.approveFromModal = async function () {
            if (window.currentPreviewId) {
                await approveItem(window.currentPreviewId);
                closeModal();
            }
        };

        window.rejectFromModal = async function () {
            if (window.currentPreviewId) {
                if (window.currentPreviewType === 'approved') await deleteItem(window.currentPreviewId);
                else await rejectItem(window.currentPreviewId);
                closeModal();
            }
        };

        window.approveItem = async function (id) {
            try {
                await updateDoc(doc(db, 'portfolios', id), { status: 'approved', approvedAt: new Date() });
                loadPortfolios();
            } catch (e) {
                alert('오류: ' + e.message);
            }
        };

        window.rejectItem = async function (id) {
            if (!confirm('삭제하시겠습니까?')) return;
            try {
                await deleteDoc(doc(db, 'portfolios', id));
                loadPortfolios();
            } catch (e) {
                alert('오류: ' + e.message);
            }
        };

        window.deleteItem = window.rejectItem;

        window.approveAll = async function () {
            if (!window.pendingItems.length) return alert('승인할 항목이 없습니다');
            if (!confirm(`${window.pendingItems.length}개를 모두 승인하시겠습니까?`)) return;
            for (const item of window.pendingItems) {
                await updateDoc(doc(db, 'portfolios', item.id), { status: 'approved', approvedAt: new Date() });
            }
            loadPortfolios();
        };

        window.rejectAll = async function () {
            if (!window.pendingItems.length) return;
            if (!confirm(`${window.pendingItems.length}개를 모두 삭제하시겠습니까?`)) return;
            for (const item of window.pendingItems) {
                await deleteDoc(doc(db, 'portfolios', item.id));
            }
            loadPortfolios();
        };
    </script>
</body>

</html>