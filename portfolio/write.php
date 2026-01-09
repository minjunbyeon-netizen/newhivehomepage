<?php
$config = include('config.php');
$staffId = $config['staff']['id'];
$staffPassword = $config['staff']['password'];
?>
<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Writer - Hivemedia</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
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
            gap: 12px;
        }

        .header-logo {
            width: 32px;
            height: 32px;
            background: linear-gradient(135deg, #4285f4, #34a853);
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

        /* Container */
        .container {
            max-width: 640px;
            margin: 0 auto;
            padding: 48px 24px;
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
            border-color: #8ab4f8;
            background: #292a2d;
        }

        .input-group input::placeholder {
            color: #5f6368;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #8ab4f8;
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
            background: #aecbfa;
        }

        .login-error {
            color: #f28b82;
            font-size: 13px;
            text-align: center;
            margin-top: 16px;
        }

        /* Form */
        .write-form {
            display: none;
        }

        .write-form.active {
            display: block;
        }

        .page-header {
            margin-bottom: 32px;
            padding-bottom: 16px;
            border-bottom: 1px solid #3c4043;
        }

        .page-header h1 {
            font-size: 28px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .page-header p {
            color: #9aa0a6;
            font-size: 14px;
        }

        .form-card {
            background: #292a2d;
            border: 1px solid #3c4043;
            border-radius: 8px;
            padding: 24px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-group label {
            display: block;
            font-size: 12px;
            font-weight: 500;
            color: #9aa0a6;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-group label .required {
            color: #f28b82;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
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

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #8ab4f8;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #5f6368;
        }

        .form-group select {
            cursor: pointer;
            -webkit-appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%239aa0a6' viewBox='0 0 16 16'%3E%3Cpath d='M8 11L3 6h10l-5 5z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 16px center;
            padding-right: 40px;
        }

        .form-group select option {
            background: #292a2d;
            color: #e8eaed;
        }

        .form-group textarea {
            min-height: 180px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            margin-top: 24px;
            padding-top: 24px;
            border-top: 1px solid #3c4043;
        }

        .btn {
            padding: 10px 24px;
            border-radius: 4px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
        }

        .btn-primary {
            background: #8ab4f8;
            color: #202124;
        }

        .btn-primary:hover {
            background: #aecbfa;
        }

        .btn-primary:disabled {
            background: #5f6368;
            color: #9aa0a6;
            cursor: not-allowed;
        }

        .btn-secondary {
            background: transparent;
            color: #8ab4f8;
            border: 1px solid #5f6368;
        }

        .btn-secondary:hover {
            background: rgba(138, 180, 248, 0.1);
        }

        /* Result */
        .result-message {
            display: none;
            text-align: center;
            padding: 60px 24px;
        }

        .result-message.active {
            display: block;
        }

        .result-icon {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 32px;
        }

        .result-message.success .result-icon {
            background: rgba(129, 201, 149, 0.2);
            color: #81c995;
        }

        .result-message.error .result-icon {
            background: rgba(242, 139, 130, 0.2);
            color: #f28b82;
        }

        .result-message h2 {
            font-size: 24px;
            font-weight: 400;
            margin-bottom: 12px;
        }

        .result-message p {
            color: #9aa0a6;
            font-size: 14px;
            margin-bottom: 32px;
        }

        /* Info */
        .info-card {
            background: #292a2d;
            border: 1px solid #3c4043;
            border-radius: 8px;
            padding: 20px;
            margin-top: 24px;
        }

        .info-card h3 {
            font-size: 12px;
            font-weight: 500;
            color: #9aa0a6;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 12px;
        }

        .info-card ul {
            list-style: none;
        }

        .info-card li {
            font-size: 13px;
            color: #bdc1c6;
            padding: 6px 0;
            display: flex;
            align-items: flex-start;
            gap: 8px;
        }

        .info-card li::before {
            content: "•";
            color: #8ab4f8;
        }
    </style>
</head>

<body>
    <header class="header">
        <div class="header-logo">H</div>
        <h1 class="header-title">Portfolio <span>Writer</span></h1>
    </header>

    <div class="container">
        <!-- Login -->
        <div class="login-screen" id="loginScreen">
            <div class="login-box">
                <h1>로그인</h1>
                <p>포트폴리오 작성을 위해 로그인하세요</p>
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

        <!-- Form -->
        <div class="write-form" id="writeForm">
            <div class="page-header">
                <h1>새 포트폴리오</h1>
                <p>작성 완료 후 관리자 승인을 거쳐 사이트에 게시됩니다</p>
            </div>

            <div class="form-card">
                <div class="form-group">
                    <label>프로젝트 제목 <span class="required">*</span></label>
                    <input type="text" id="title" placeholder="예: 부산시 관광홍보 SNS 캠페인">
                </div>

                <div class="form-group">
                    <label>카테고리 <span class="required">*</span></label>
                    <select id="category">
                        <option value="">카테고리 선택</option>
                        <option value="Online AD">Online AD</option>
                        <option value="SNS">SNS</option>
                        <option value="Homepage">Homepage</option>
                        <option value="Eventpage">Eventpage</option>
                        <option value="Video">Video</option>
                        <option value="Print">Print</option>
                        <option value="Exhibition Art">Exhibition Art</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>클라이언트</label>
                    <input type="text" id="client" placeholder="예: 부산광역시">
                </div>

                <div class="form-group">
                    <label>프로젝트 설명 <span class="required">*</span></label>
                    <textarea id="content" placeholder="프로젝트 개요, 진행 내용, 성과 등을 작성하세요"></textarea>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" id="submitBtn" onclick="submitPortfolio()">제출</button>
                    <button class="btn btn-secondary" onclick="resetForm()">초기화</button>
                </div>
            </div>

            <div class="info-card">
                <h3>안내사항</h3>
                <ul>
                    <li>제출된 포트폴리오는 관리자 승인 후 게시됩니다</li>
                    <li>승인까지 1~2일 정도 소요될 수 있습니다</li>
                    <li>문의: hivemedia@naver.com</li>
                </ul>
            </div>
        </div>

        <!-- Success -->
        <div class="result-message success" id="successMessage">
            <div class="result-icon">✓</div>
            <h2>제출 완료</h2>
            <p>포트폴리오가 성공적으로 제출되었습니다.<br>관리자 승인 후 사이트에 게시됩니다.</p>
            <button class="btn btn-primary" onclick="writeAnother()">추가 작성</button>
        </div>

        <!-- Error -->
        <div class="result-message error" id="errorMessage">
            <div class="result-icon">!</div>
            <h2>제출 실패</h2>
            <p id="errorText">오류가 발생했습니다. 다시 시도해주세요.</p>
            <button class="btn btn-primary" onclick="showForm()">다시 시도</button>
        </div>
    </div>

    <!-- Firebase -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getFirestore, collection, addDoc, serverTimestamp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

        const firebaseConfig = {
            apiKey: "AIzaSyBeZGgTw8zJoYz26PUfk3xoU-83oMD3v_M",
            authDomain: "hivemedia-archive.firebaseapp.com",
            projectId: "hivemedia-archive",
            storageBucket: "hivemedia-archive.firebasestorage.app",
            messagingSenderId: "105246116532",
            appId: "1:105246116532:web:18aad82490a11b7d4ea5e1"
        };

        const app = initializeApp(firebaseConfig);
        const db = getFirestore(app);

        window.db = db;
        window.collection = collection;
        window.addDoc = addDoc;
        window.serverTimestamp = serverTimestamp;

        const STAFF_ID = "<?php echo $staffId; ?>";
        const STAFF_PASSWORD = "<?php echo $staffPassword; ?>";

        window.checkPassword = function () {
            const id = document.getElementById('idInput').value;
            const pw = document.getElementById('passwordInput').value;

            if (id === STAFF_ID && pw === STAFF_PASSWORD) {
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('writeForm').classList.add('active');
            } else {
                document.getElementById('loginError').textContent = '아이디 또는 비밀번호가 올바르지 않습니다';
            }
        };

        window.submitPortfolio = async function () {
            const title = document.getElementById('title').value.trim();
            const category = document.getElementById('category').value;
            const client = document.getElementById('client').value.trim();
            const content = document.getElementById('content').value.trim();

            if (!title) { alert('프로젝트 제목을 입력하세요.'); return; }
            if (!category) { alert('카테고리를 선택하세요.'); return; }
            if (!content) { alert('프로젝트 설명을 입력하세요.'); return; }

            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.textContent = '제출 중...';

            try {
                await addDoc(collection(db, 'portfolios'), {
                    title, category, client: client || '', content,
                    status: 'pending',
                    createdAt: serverTimestamp(),
                    createdBy: 'staff'
                });
                document.getElementById('writeForm').classList.remove('active');
                document.getElementById('successMessage').classList.add('active');
            } catch (error) {
                document.getElementById('errorText').textContent = error.message;
                document.getElementById('writeForm').classList.remove('active');
                document.getElementById('errorMessage').classList.add('active');
            }

            btn.disabled = false;
            btn.textContent = '제출';
        };

        window.resetForm = function () {
            document.getElementById('title').value = '';
            document.getElementById('category').value = '';
            document.getElementById('client').value = '';
            document.getElementById('content').value = '';
        };

        window.writeAnother = function () {
            resetForm();
            document.getElementById('successMessage').classList.remove('active');
            document.getElementById('writeForm').classList.add('active');
        };

        window.showForm = function () {
            document.getElementById('errorMessage').classList.remove('active');
            document.getElementById('writeForm').classList.add('active');
        };
    </script>
</body>

</html>