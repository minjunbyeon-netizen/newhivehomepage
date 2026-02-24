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
    <title>Portfolio Migration - Hivemedia</title>
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
            background: linear-gradient(135deg, #9c27b0, #673ab7);
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
            border-color: #9c27b0;
            background: #292a2d;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: #9c27b0;
            color: #fff;
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
            background: #7b1fa2;
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
        }

        /* Category Badges */
        .category-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            padding: 16px 20px;
        }

        .badge {
            font-size: 11px;
            padding: 4px 12px;
            border-radius: 4px;
            background: #3c4043;
            color: #9aa0a6;
        }

        /* Progress */
        .progress-bar {
            width: 100%;
            height: 4px;
            background: #3c4043;
            border-radius: 2px;
            overflow: hidden;
            margin: 16px 0;
        }

        .progress-fill {
            height: 100%;
            background: linear-gradient(90deg, #9c27b0, #673ab7);
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-text {
            font-size: 13px;
            color: #9aa0a6;
            margin-bottom: 16px;
        }

        /* Buttons */
        .btn {
            padding: 10px 20px;
            border-radius: 4px;
            font-family: inherit;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s;
            border: none;
        }

        .btn-primary {
            background: #9c27b0;
            color: #fff;
        }

        .btn-primary:hover {
            background: #7b1fa2;
        }

        .btn-danger {
            background: #f28b82;
            color: #202124;
            margin-left: 12px;
        }

        .btn-danger:hover {
            background: #ea8078;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #5f6368;
            color: #e8eaed;
            margin-left: 12px;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        /* Log Area */
        .log-area {
            background: #202124;
            border-radius: 4px;
            padding: 16px;
            max-height: 300px;
            overflow-y: auto;
            font-family: 'Consolas', 'Monaco', monospace;
            font-size: 12px;
            line-height: 1.6;
            margin-top: 16px;
        }

        .log-entry {
            margin-bottom: 4px;
        }

        .log-entry.success {
            color: #81c995;
        }

        .log-entry.error {
            color: #f28b82;
        }

        .log-entry.info {
            color: #8ab4f8;
        }

        .log-entry.warning {
            color: #fdd663;
        }

        /* Table */
        .preview-table {
            width: 100%;
            border-collapse: collapse;
        }

        .preview-table th,
        .preview-table td {
            padding: 10px 16px;
            text-align: left;
            border-bottom: 1px solid #3c4043;
            font-size: 13px;
        }

        .preview-table th {
            background: #202124;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #9aa0a6;
            font-weight: 500;
        }

        /* Drop Zone */
        #dropZone {
            border: 1px dashed #5f6368;
            border-radius: 8px;
            padding: 40px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
            margin-bottom: 16px;
        }

        #dropZone:hover,
        #dropZone.dragover {
            border-color: #9c27b0;
            background: rgba(156, 39, 176, 0.05);
        }

        #dropZone.loaded {
            border-color: #81c995;
            background: rgba(129, 201, 149, 0.05);
        }

        #dropZone p {
            color: #9aa0a6;
            font-size: 14px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
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
            <div class="header-logo">M</div>
            <h1 class="header-title">Migration <span>Tool</span></h1>
        </div>
        <div class="header-links">
            <a href="./portfolio.php" target="_blank">Portfolio</a>
            <a href="./admin.php" target="_blank">Admin</a>
        </div>
    </header>

    <div class="container">
        <!-- Login -->
        <div class="login-screen" id="loginScreen">
            <div class="login-box">
                <h1>Migration Tool</h1>
                <p>포트폴리오 데이터 마이그레이션</p>
                <div class="input-group">
                    <label>ID</label>
                    <input type="text" id="idInput" placeholder="Enter ID"
                        onkeypress="if(event.key==='Enter') document.getElementById('passwordInput').focus()">
                </div>
                <div class="input-group">
                    <label>Password</label>
                    <input type="password" id="passwordInput" placeholder="Enter Password"
                        onkeypress="if(event.key==='Enter') checkPassword()">
                </div>
                <button class="btn-login" onclick="checkPassword()">Login</button>
                <p class="login-error" id="loginError"></p>
            </div>
        </div>

        <!-- Admin Panel -->
        <div class="admin-panel" id="adminPanel">
            <!-- Step 1: Load -->
            <div class="section">
                <div class="section-header">
                    <div class="section-title">Step 1. Load JSON Data</div>
                </div>
                <div style="padding: 20px;">
                    <div id="dropZone">
                        <p>portfolio.json 파일을 드래그하거나 클릭</p>
                        <input type="file" id="jsonFileInput" accept=".json" style="display: none;">
                    </div>
                    <button class="btn btn-outline" onclick="loadFromPath()">Load from Default Path</button>
                </div>
            </div>

            <!-- Step 2: Preview -->
            <div class="section" id="previewPanel" style="display: none;">
                <div class="section-header">
                    <div class="section-title">Step 2. Data Preview</div>
                </div>
                <div class="stats-grid" style="padding: 20px; margin-bottom: 0;">
                    <div class="stat-card">
                        <div class="stat-number" id="totalCount" style="color: #8ab4f8;">0</div>
                        <div class="stat-label">Total Items</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="activeCount" style="color: #81c995;">0</div>
                        <div class="stat-label">Active Items</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-number" id="categoryCount" style="color: #9c27b0;">0</div>
                        <div class="stat-label">Categories</div>
                    </div>
                </div>
                <div class="category-badges" id="categoryBadges"></div>
                <div style="max-height: 200px; overflow-y: auto;">
                    <table class="preview-table" id="previewTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Client</th>
                                <th>Project</th>
                                <th>Category</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>

            <!-- Step 3: Migrate -->
            <div class="section" id="migrationPanel" style="display: none;">
                <div class="section-header">
                    <div class="section-title">Step 3. Migration</div>
                </div>
                <div style="padding: 20px;">
                    <div class="progress-bar">
                        <div class="progress-fill" id="progressFill"></div>
                    </div>
                    <p class="progress-text" id="progressText">Ready</p>
                    <div>
                        <button class="btn btn-primary" id="migrateBtn" onclick="startMigration()">Start
                            Migration</button>
                        <button class="btn btn-danger" id="clearBtn" onclick="clearFirestore()">Clear Existing
                            Data</button>
                    </div>
                    <div class="log-area" id="logArea"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Firebase SDK -->
    <script type="module">
        import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
        import { getFirestore, collection, doc, setDoc, getDocs, deleteDoc } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-firestore.js";

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

        const ADMIN_ID = "<?php echo $adminId; ?>";
        const ADMIN_PASSWORD = "<?php echo $adminPassword; ?>";

        // Valid categories matching hivemedia.co.kr
        const VALID_CATEGORIES = [
            "Online AD", "SNS", "Homepage", "Eventpage",
            "Video", "Print", "Exhibition Art"
        ];

        let portfolioData = [];

        // Clean HTML tags
        function cleanHtml(str) {
            if (!str) return "";
            return str.replace(/<[^>]*>/g, '').trim();
        }

        // Transform portfolio item
        function transformItem(item) {
            const client = item.hiveboad000001 || "";
            if (!client.trim()) return null;

            const projectName = item.hiveboad000031 || client;
            const rawCategory = item.hiveboad000023 || "";
            const category = VALID_CATEGORIES.includes(rawCategory) ? rawCategory : "Online AD";
            const thumbnail = item.hiveboad000011 || "";

            return {
                id: String(item.pk_no),
                client: client.trim(),
                advertiser: client.trim(),
                title: projectName.trim(),
                projectName: projectName.trim(),
                description: cleanHtml(item.hiveboad000007 || ""),
                summary: (item.hiveboad000020 || "").trim(),
                category: category,
                date: item.hiveboad000021 || "",
                createdAt: item.hiveboad000021 ? new Date(item.hiveboad000021) : new Date(),
                thumbnail: thumbnail ? `../assets/uploaded/thumbnail/${thumbnail}` : "",
                thumbnailUrl: thumbnail ? `../assets/uploaded/thumbnail/${thumbnail}` : "",
                imageUrl: thumbnail ? `../assets/uploaded/thumbnail/${thumbnail}` : "",
                subImage1: item.hiveboad000026 ? `../assets/uploaded/thumbnail/${item.hiveboad000026}` : "",
                subImage2: item.hiveboad000029 ? `../assets/uploaded/thumbnail/${item.hiveboad000029}` : "",
                status: "approved",
                isActive: item.hiveboad000017 === "Y",
                approved: true,
                migratedAt: new Date()
            };
        }

        // Log message
        function log(message, type = 'info') {
            const logArea = document.getElementById('logArea');
            const entry = document.createElement('div');
            entry.className = `log-entry ${type}`;
            const time = new Date().toLocaleTimeString();
            entry.textContent = `[${time}] ${message}`;
            logArea.appendChild(entry);
            logArea.scrollTop = logArea.scrollHeight;
        }

        // Check password
        window.checkPassword = function () {
            const id = document.getElementById('idInput').value;
            const pw = document.getElementById('passwordInput').value;

            if (id === ADMIN_ID && pw === ADMIN_PASSWORD) {
                document.getElementById('loginScreen').style.display = 'none';
                document.getElementById('adminPanel').classList.add('active');
            } else {
                document.getElementById('loginError').textContent = 'Invalid ID or Password';
            }
        };

        // Load JSON data
        window.loadJsonData = function (data) {
            try {
                const rows = data.rows || [];
                portfolioData = rows.map(transformItem).filter(item => item !== null);

                // Update UI
                document.getElementById('dropZone').classList.add('loaded');
                document.getElementById('dropZone').innerHTML = `<p>Loaded: ${portfolioData.length} items</p>`;
                document.getElementById('previewPanel').style.display = 'block';
                document.getElementById('migrationPanel').style.display = 'block';

                // Stats
                document.getElementById('totalCount').textContent = portfolioData.length;
                document.getElementById('activeCount').textContent = portfolioData.filter(i => i.isActive).length;

                // Categories
                const categories = {};
                portfolioData.forEach(item => {
                    categories[item.category] = (categories[item.category] || 0) + 1;
                });
                document.getElementById('categoryCount').textContent = Object.keys(categories).length;

                const badgesHtml = Object.entries(categories)
                    .map(([cat, count]) => `<span class="badge">${cat}: ${count}</span>`)
                    .join('');
                document.getElementById('categoryBadges').innerHTML = badgesHtml;

                // Preview table
                const tbody = document.querySelector('#previewTable tbody');
                tbody.innerHTML = portfolioData.slice(0, 8).map(item => `
                    <tr>
                        <td>${item.id}</td>
                        <td>${item.client}</td>
                        <td>${item.projectName}</td>
                        <td>${item.category}</td>
                    </tr>
                `).join('');

                log(`Loaded ${portfolioData.length} portfolio items`, 'success');
            } catch (error) {
                log(`JSON parse error: ${error.message}`, 'error');
            }
        };

        // Load from file path
        window.loadFromPath = async function () {
            try {
                log('Loading from default path...', 'info');
                const response = await fetch('../assets/uploaded/app/portfolio.json');
                if (!response.ok) throw new Error('File not found');
                const data = await response.json();
                window.loadJsonData(data);
            } catch (error) {
                log(`Load failed: ${error.message}`, 'error');
            }
        };

        // Start migration
        window.startMigration = async function () {
            if (portfolioData.length === 0) {
                log('No data to migrate', 'error');
                return;
            }

            const confirmed = confirm(`Migrate ${portfolioData.length} items to Firebase?`);
            if (!confirmed) return;

            document.getElementById('migrateBtn').disabled = true;
            log('Starting migration...', 'info');

            const progressFill = document.getElementById('progressFill');
            const progressText = document.getElementById('progressText');

            let successCount = 0;
            let errorCount = 0;

            for (let i = 0; i < portfolioData.length; i++) {
                const item = portfolioData[i];
                try {
                    await setDoc(doc(db, 'portfolios', item.id), item);
                    successCount++;
                } catch (error) {
                    log(`Failed: ${item.id} - ${error.message}`, 'error');
                    errorCount++;
                }

                const progress = Math.round(((i + 1) / portfolioData.length) * 100);
                progressFill.style.width = `${progress}%`;
                progressText.textContent = `${i + 1} / ${portfolioData.length} (${progress}%)`;

                if ((i + 1) % 50 === 0) {
                    log(`Progress: ${i + 1}/${portfolioData.length}`, 'info');
                }
            }

            log(`Migration complete. Success: ${successCount}, Failed: ${errorCount}`, 'success');
            document.getElementById('migrateBtn').disabled = false;
        };

        // Clear Firestore
        window.clearFirestore = async function () {
            const confirmed = confirm('Delete all existing portfolio data?');
            if (!confirmed) return;

            log('Deleting existing data...', 'warning');

            try {
                const querySnapshot = await getDocs(collection(db, 'portfolios'));
                let deleteCount = 0;

                for (const docSnap of querySnapshot.docs) {
                    await deleteDoc(doc(db, 'portfolios', docSnap.id));
                    deleteCount++;
                }

                log(`Deleted ${deleteCount} documents`, 'success');
            } catch (error) {
                log(`Delete failed: ${error.message}`, 'error');
            }
        };

        // File input handling
        document.getElementById('dropZone').addEventListener('click', () => {
            document.getElementById('jsonFileInput').click();
        });

        document.getElementById('jsonFileInput').addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const data = JSON.parse(e.target.result);
                    window.loadJsonData(data);
                };
                reader.readAsText(file);
            }
        });

        // Drag and drop
        const dropZone = document.getElementById('dropZone');
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('dragover');
        });
        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('dragover');
        });
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const data = JSON.parse(e.target.result);
                    window.loadJsonData(data);
                };
                reader.readAsText(file);
            }
        });
    </script>
</body>

</html>