<?php
$config = include('../portfolio/config.php');
$adminId = $config['admin']['id'] ?? 'admin';
$adminPassword = $config['admin']['password'] ?? '1234';
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inquiry Admin - Hivemedia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&family=Noto+Sans+KR:wght@300;400;500;700&display=swap"
        rel="stylesheet">
    <style>
        :root {
            --bg-color: #1a1a1a;
            --card-bg: #2a2a2a;
            --text-primary: #e8eaed;
            --text-secondary: #9aa0a6;
            --accent: #0084ff;
            --danger: #ff6b6b;
            --success: #4ade80;
            --border: #3c4043;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', 'Noto Sans KR', sans-serif;
            background: var(--bg-color);
            color: var(--text-primary);
            min-height: 100vh;
            padding: 40px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        h1 {
            font-size: 28px;
            margin-bottom: 30px;
            color: var(--accent);
        }

        /* Login */
        .login-screen {
            position: fixed;
            inset: 0;
            background: var(--bg-color);
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-box {
            background: var(--card-bg);
            padding: 40px;
            border-radius: 12px;
            border: 1px solid var(--border);
            width: 100%;
            max-width: 400px;
        }

        .login-box h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .input-group {
            margin-bottom: 15px;
        }

        .input-group label {
            display: block;
            font-size: 12px;
            color: var(--text-secondary);
            margin-bottom: 5px;
        }

        .input-group input {
            width: 100%;
            padding: 12px;
            background: var(--bg-color);
            border: 1px solid var(--border);
            border-radius: 6px;
            color: var(--text-primary);
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: var(--accent);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            margin-top: 10px;
        }

        /* Dashboard */
        .stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
            border: 1px solid var(--border);
        }

        .stat-value {
            font-size: 32px;
            font-weight: 700;
            color: var(--accent);
        }

        .stat-label {
            font-size: 12px;
            color: var(--text-secondary);
            text-transform: uppercase;
            margin-top: 5px;
        }

        .inquiry-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .inquiry-item {
            background: var(--card-bg);
            padding: 20px;
            border-radius: 12px;
            border: 1px solid var(--border);
            transition: transform 0.2s;
            cursor: pointer;
        }

        .inquiry-item:hover {
            transform: translateY(-2px);
            border-color: var(--accent);
        }

        .inquiry-item.unread {
            border-left: 4px solid var(--accent);
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .item-title {
            font-weight: 600;
            font-size: 18px;
        }

        .item-date {
            font-size: 12px;
            color: var(--text-secondary);
        }

        .item-meta {
            font-size: 14px;
            color: var(--text-secondary);
            display: flex;
            gap: 15px;
        }

        .badge {
            font-size: 10px;
            padding: 2px 8px;
            border-radius: 4px;
            text-transform: uppercase;
            font-weight: 700;
        }

        .badge-new {
            background: var(--accent);
            color: white;
        }

        /* Modal */
        .modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 100;
            padding: 20px;
        }

        .modal.active {
            display: flex;
        }

        .modal-content {
            background: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            width: 100%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
        }

        .modal-close {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
            color: var(--text-secondary);
        }

        .modal-body {
            margin-top: 20px;
            line-height: 1.6;
        }

        .modal-field {
            margin-bottom: 15px;
        }

        .modal-field label {
            font-size: 12px;
            color: var(--text-secondary);
            display: block;
        }

        .modal-field div {
            font-size: 16px;
            margin-top: 5px;
        }

        .modal-actions {
            margin-top: 30px;
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }

        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-read {
            background: var(--success);
            color: white;
        }
    </style>
</head>

<body>
    <div class="login-screen" id="loginScreen">
        <div class="login-box">
            <h2>문의 관리자 로그인</h2>
            <div class="input-group">
                <label>아이디</label>
                <input type="text" id="adminId">
            </div>
            <div class="input-group">
                <label>비밀번호</label>
                <input type="password" id="adminPw">
            </div>
            <button class="btn-login" onclick="login()">로그인</button>
            <p id="loginError" style="color: var(--danger); font-size: 12px; margin-top: 10px; text-align: center;"></p>
        </div>
    </div>

    <div class="container" id="adminContent" style="display: none;">
        <h1>Inquiry Management</h1>

        <div class="stats">
            <div class="stat-card">
                <div class="stat-value" id="totalCount">0</div>
                <div class="stat-label">Total</div>
            </div>
            <div class="stat-card">
                <div class="stat-value" id="unreadCount" style="color: var(--danger);">0</div>
                <div class="stat-label">Unread</div>
            </div>
        </div>

        <div class="inquiry-list" id="inquiryList">
            <!-- Items injected by JS -->
        </div>
    </div>

    <div class="modal" id="inquiryModal">
        <div class="modal-content">
            <span class="modal-close" onclick="closeModal()">&times;</span>
            <div id="modalContent">
                <!-- Detail injected by JS -->
            </div>
            <div class="modal-actions">
                <button class="btn btn-delete" onclick="deleteInquiry()">삭제</button>
                <button class="btn btn-read" id="markReadBtn" onclick="markAsRead()">읽음 처리</button>
            </div>
        </div>
    </div>

    <script src="../assets/js/firebase-config.js"></script>
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getFirestore, collection, getDocs, doc, updateDoc, deleteDoc, query, orderBy } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);
        let inquiries = [];
        let currentInquiryId = null;

        window.login = () => {
            const id = document.getElementById('adminId').value;
            const pw = document.getElementById('adminPw').value;
            if (id === '<?php echo $adminId; ?>' && pw === '<?php echo $adminPassword; ?>') {
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('adminContent').style.display = 'block';
                loadInquiries();
            } else {
                document.getElementById('loginError').textContent = '인증 실패';
            }
        };

        async function loadInquiries() {
            const q = query(collection(db, 'inquiries'), orderBy('createdAt', 'desc'));
            const snapshot = await getDocs(q);
            inquiries = snapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));
            renderList();
            updateStats();
        }

        function renderList() {
            const list = document.getElementById('inquiryList');
            list.innerHTML = inquiries.map((item, index) => `
                <div class="inquiry-item ${item.status === 'unread' ? 'unread' : ''}" onclick="openInquiry(${index})">
                    <div class="item-header">
                        <div class="item-title">${item.name} / ${item.company || '개인'}</div>
                        <div class="item-date">${item.createdAt?.toDate().toLocaleString() || '-'}</div>
                    </div>
                    <div class="item-meta">
                        <span>📧 ${item.email}</span>
                        <span>📞 ${item.phone}</span>
                        <span>🏷️ ${item.service || '기타'}</span>
                        ${item.status === 'unread' ? '<span class="badge badge-new">New</span>' : ''}
                    </div>
                </div>
            `).join('');
        }

        function updateStats() {
            document.getElementById('totalCount').textContent = inquiries.length;
            document.getElementById('unreadCount').textContent = inquiries.filter(i => i.status === 'unread').length;
        }

        window.openInquiry = (index) => {
            const item = inquiries[index];
            currentInquiryId = item.id;
            const modalBody = document.getElementById('modalContent');
            modalBody.innerHTML = `
                <h2>${item.name} / ${item.company || '개인'}</h2>
                <div class="modal-body">
                    <div class="modal-field"><label>이메일</label><div>${item.email}</div></div>
                    <div class="modal-field"><label>연락처</label><div>${item.phone}</div></div>
                    <div class="modal-field"><label>문의 서비스</label><div>${item.service || '기타'}</div></div>
                    <div class="modal-field"><label>문의 내용</label><div style="white-space: pre-wrap;">${item.message}</div></div>
                </div>
            `;
            document.getElementById('markReadBtn').style.display = item.status === 'unread' ? 'inline-block' : 'none';
            document.getElementById('inquiryModal').classList.add('active');
        };

        window.closeModal = () => document.getElementById('inquiryModal').classList.remove('active');

        window.markAsRead = async () => {
            if (!currentInquiryId) return;
            await updateDoc(doc(db, 'inquiries', currentInquiryId), { status: 'read' });
            closeModal();
            loadInquiries();
        };

        window.deleteInquiry = async () => {
            if (!currentInquiryId || !confirm('삭제하시겠습니까?')) return;
            await deleteDoc(doc(db, 'inquiries', currentInquiryId));
            closeModal();
            loadInquiries();
        };
    </script>
</body>

</html>