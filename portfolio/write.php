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
    <title>Content Writer - Hivemedia</title>
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

        .header-back {
            background: transparent;
            border: 1px solid #5f6368;
            color: #9aa0a6;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            cursor: pointer;
            margin-left: auto;
            display: none;
        }

        .header-back:hover {
            background: rgba(255, 255, 255, 0.1);
            color: #e8eaed;
        }

        .header-back.visible {
            display: block;
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

        /* Type Selection */
        .type-selection {
            display: none;
        }

        .type-selection.active {
            display: block;
        }

        .type-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .type-header h1 {
            font-size: 28px;
            font-weight: 400;
            margin-bottom: 8px;
        }

        .type-header p {
            color: #9aa0a6;
            font-size: 14px;
        }

        .type-cards {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 16px;
        }

        .type-card {
            background: #292a2d;
            border: 2px solid #3c4043;
            border-radius: 12px;
            padding: 32px 24px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s;
        }

        .type-card:hover {
            border-color: #8ab4f8;
            transform: translateY(-2px);
        }

        .type-card.portfolio:hover {
            border-color: #8ab4f8;
        }

        .type-card.archive:hover {
            border-color: #FFD93D;
        }

        .type-card-icon {
            width: 64px;
            height: 64px;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
        }

        .type-card.portfolio .type-card-icon {
            background: rgba(138, 180, 248, 0.2);
        }

        .type-card.archive .type-card-icon {
            background: rgba(255, 217, 61, 0.2);
        }

        .type-card h3 {
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 8px;
        }

        .type-card p {
            font-size: 13px;
            color: #9aa0a6;
            line-height: 1.5;
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

        /* Checkbox Group */
        .checkbox-group {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
        }

        .checkbox-item {
            display: flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            background: #202124;
            border: 1px solid #5f6368;
            border-radius: 4px;
            font-size: 13px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .checkbox-item:hover {
            border-color: #8ab4f8;
        }

        .checkbox-item input[type="checkbox"] {
            width: 14px;
            height: 14px;
            cursor: pointer;
        }

        /* Metrics Group */
        .metrics-group {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .metric-row {
            display: flex;
            gap: 8px;
        }

        .metric-type {
            flex: 1;
            min-width: 100px;
        }

        .metric-value {
            flex: 1;
            text-align: right;
        }

        .metric-unit {
            width: 60px;
        }

        .metric-row select,
        .metric-row input {
            padding: 10px 12px;
            background: #202124;
            border: 1px solid #5f6368;
            border-radius: 4px;
            color: #e8eaed;
            font-family: inherit;
            font-size: 13px;
        }

        /* Character Counter */
        .char-counter {
            float: right;
            font-size: 11px;
            color: #9aa0a6;
            font-weight: 400;
        }

        .char-counter.warning {
            color: #f9ab00;
        }

        .char-counter.error {
            color: #f28b82;
        }

        /* Form Hint */
        .form-hint {
            font-size: 12px;
            color: #9aa0a6;
            margin-top: 6px;
        }

        /* Client Input Group */
        .client-input-group {
            display: flex;
            gap: 12px;
            align-items: center;
        }

        .client-input-group input[type="text"] {
            flex: 1;
        }

        .checkbox-inline {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #9aa0a6;
            cursor: pointer;
            white-space: nowrap;
        }

        /* Image Upload */
        .image-upload-group {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .upload-item {
            padding: 16px;
            background: #202124;
            border: 1px dashed #5f6368;
            border-radius: 4px;
        }

        .upload-label {
            display: block;
            font-size: 12px;
            color: #9aa0a6;
            margin-bottom: 8px;
        }

        .upload-item input[type="file"] {
            font-size: 13px;
            color: #e8eaed;
        }

        .upload-item input[type="file"]::file-selector-button {
            padding: 6px 12px;
            background: #3c4043;
            border: none;
            border-radius: 4px;
            color: #e8eaed;
            cursor: pointer;
            margin-right: 10px;
        }

        .upload-item input[type="file"]::file-selector-button:hover {
            background: #5f6368;
        }

        /* Date Range */
        .date-range-group {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .date-range-group input[type="date"] {
            flex: 1;
            padding: 12px 16px;
            background: #202124;
            border: 1px solid #5f6368;
            border-radius: 4px;
            color: #e8eaed;
            font-family: inherit;
            font-size: 14px;
        }

        .date-range-group input[type="date"]:focus {
            outline: none;
            border-color: #8ab4f8;
        }

        .date-separator {
            color: #9aa0a6;
            font-size: 16px;
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
        <h1 class="header-title" id="headerTitle">Content <span>Writer</span></h1>
        <button class="header-back" id="backBtn" onclick="goBackToTypeSelection()">뒤로</button>
    </header>

    <div class="container">
        <!-- Login -->
        <div class="login-screen" id="loginScreen">
            <div class="login-box">
                <h1>로그인</h1>
                <p>콘텐츠 작성을 위해 로그인하세요</p>
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

        <!-- Type Selection -->
        <div class="type-selection" id="typeSelection">
            <div class="type-header">
                <h1>콘텐츠 유형 선택</h1>
                <p>작성할 콘텐츠 유형을 선택하세요</p>
            </div>
            <div class="type-cards">
                <div class="type-card portfolio" onclick="selectType('portfolio')">
                    <div class="type-card-icon">P</div>
                    <h3>포트폴리오</h3>
                    <p>프로젝트 사례 및<br>작업물 등록</p>
                </div>
                <div class="type-card archive" onclick="selectType('archive')">
                    <div class="type-card-icon">A</div>
                    <h3>아카이브</h3>
                    <p>뉴스 및 트렌드<br>아티클 등록</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="write-form" id="writeForm">
            <div class="page-header">
                <h1>새 포트폴리오</h1>
                <p>작성 완료 후 관리자 승인을 거쳐 사이트에 게시됩니다</p>
            </div>

            <div class="form-card">
                <!-- 프로젝트 제목 -->
                <div class="form-group">
                    <label>프로젝트 제목 <span class="required">*</span></label>
                    <input type="text" id="title" placeholder="예: 부산 F45 센텀점 여성 회원 모집 캠페인">
                </div>

                <!-- 카테고리 -->
                <div class="form-group">
                    <label>카테고리 <span class="required">*</span></label>
                    <select id="category">
                        <option value="">카테고리 선택</option>
                        <option value="피트니스/헬스케어">피트니스/헬스케어</option>
                        <option value="뷰티/화장품">뷰티/화장품</option>
                        <option value="공공기관/정부">공공기관/정부</option>
                        <option value="F&B/외식">F&B/외식</option>
                        <option value="교육/학원">교육/학원</option>
                        <option value="기타">기타</option>
                    </select>
                </div>

                <!-- 프로젝트 기간 -->
                <div class="form-group">
                    <label>프로젝트 기간</label>
                    <div class="date-range-group">
                        <input type="date" id="startDate">
                        <span class="date-separator">~</span>
                        <input type="date" id="endDate">
                    </div>
                </div>

                <!-- 사용 플랫폼 (다중 선택) -->
                <div class="form-group">
                    <label>사용 플랫폼 <span class="required">*</span></label>
                    <div class="checkbox-group" id="platforms">
                        <label class="checkbox-item"><input type="checkbox" value="META 광고"> META 광고</label>
                        <label class="checkbox-item"><input type="checkbox" value="네이버 검색광고"> 네이버 검색광고</label>
                        <label class="checkbox-item"><input type="checkbox" value="네이버 파워링크"> 네이버 파워링크</label>
                        <label class="checkbox-item"><input type="checkbox" value="구글 광고"> 구글 광고</label>
                        <label class="checkbox-item"><input type="checkbox" value="카카오 모먼트"> 카카오 모먼트</label>
                        <label class="checkbox-item"><input type="checkbox" value="웹사이트 제작"> 웹사이트 제작</label>
                        <label class="checkbox-item"><input type="checkbox" value="랜딩페이지"> 랜딩페이지</label>
                    </div>
                </div>

                <!-- 핵심 성과 3가지 -->
                <div class="form-group">
                    <label>핵심 성과 (3가지) <span class="required">*</span></label>
                    <div class="metrics-group">
                        <div class="metric-row">
                            <select class="metric-type">
                                <option value="ROAS">ROAS</option>
                                <option value="CPA">CPA</option>
                                <option value="전환율">전환율</option>
                                <option value="클릭률">클릭률</option>
                                <option value="노출수">노출수</option>
                                <option value="매출액">매출액</option>
                                <option value="전환수">전환수</option>
                            </select>
                            <input type="text" class="metric-value" placeholder="320">
                            <select class="metric-unit">
                                <option value="%">%</option>
                                <option value="원">원</option>
                                <option value="건">건</option>
                                <option value="회">회</option>
                            </select>
                        </div>
                        <div class="metric-row">
                            <select class="metric-type">
                                <option value="CPA">CPA</option>
                                <option value="ROAS">ROAS</option>
                                <option value="전환율">전환율</option>
                                <option value="클릭률">클릭률</option>
                                <option value="노출수">노출수</option>
                                <option value="매출액">매출액</option>
                                <option value="전환수">전환수</option>
                            </select>
                            <input type="text" class="metric-value" placeholder="8,500">
                            <select class="metric-unit">
                                <option value="원">원</option>
                                <option value="%">%</option>
                                <option value="건">건</option>
                                <option value="회">회</option>
                            </select>
                        </div>
                        <div class="metric-row">
                            <select class="metric-type">
                                <option value="전환수">전환수</option>
                                <option value="ROAS">ROAS</option>
                                <option value="CPA">CPA</option>
                                <option value="전환율">전환율</option>
                                <option value="클릭률">클릭률</option>
                                <option value="노출수">노출수</option>
                                <option value="매출액">매출액</option>
                            </select>
                            <input type="text" class="metric-value" placeholder="847">
                            <select class="metric-unit">
                                <option value="건">건</option>
                                <option value="%">%</option>
                                <option value="원">원</option>
                                <option value="회">회</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- 프로젝트 요약 -->
                <div class="form-group">
                    <label>프로젝트 요약 <span class="required">*</span> <span class="char-counter"
                            id="summaryCounter">0/300</span></label>
                    <textarea id="content" placeholder="어떤 문제를 어떻게 해결했나요? 핵심 전략과 결과를 간단히 작성하세요. (200~300자)"
                        oninput="updateCharCounter()" maxlength="300"></textarea>
                    <p class="form-hint">200~300자로 핵심 전략과 결과를 작성하세요</p>
                </div>

                <!-- 클라이언트 정보 -->
                <div class="form-group">
                    <label>클라이언트명</label>
                    <input type="text" id="client" placeholder="예: F45 센텀점">
                </div>

                <!-- 지역 -->
                <div class="form-group">
                    <label>지역</label>
                    <select id="region">
                        <option value="">지역 선택</option>
                        <option value="부산">부산</option>
                        <option value="울산">울산</option>
                        <option value="대구">대구</option>
                        <option value="창원">창원</option>
                        <option value="김해">김해</option>
                        <option value="양산">양산</option>
                        <option value="밀양">밀양</option>
                        <option value="경상남도 기타">경상남도 기타</option>
                        <option value="서울">서울</option>
                        <option value="경기">경기</option>
                        <option value="기타">기타</option>
                    </select>
                </div>

                <!-- 이미지 업로드 -->
                <div class="form-group">
                    <label>이미지 업로드</label>
                    <div class="image-upload-group">
                        <div class="upload-item">
                            <label class="upload-label">대표 이미지 <span class="required">*</span></label>
                            <input type="file" id="mainImage" accept="image/*">
                        </div>
                        <div class="upload-item">
                            <label class="upload-label">추가 이미지 (최대 4장)</label>
                            <input type="file" id="additionalImages" accept="image/*" multiple>
                        </div>
                    </div>
                    <p class="form-hint">JPG, PNG 형식 권장. 자동으로 최적화됩니다.</p>
                </div>

                <!-- 작성자 -->
                <div class="form-group">
                    <label>작성자</label>
                    <input type="text" id="author" placeholder="작성자 이름">
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

        <!-- Archive Form -->
        <div class="write-form" id="archiveForm">
            <div class="page-header">
                <h1>새 아카이브 글</h1>
                <p>작성 완료 후 관리자 승인을 거쳐 사이트에 게시됩니다</p>
            </div>

            <div class="form-card">
                <div class="form-group">
                    <label>제목 <span class="required">*</span></label>
                    <input type="text" id="archiveTitle" placeholder="예: 2026년 마케팅 트렌드 분석">
                </div>

                <div class="form-group">
                    <label>카테고리 <span class="required">*</span></label>
                    <select id="archiveCategory">
                        <option value="">카테고리 선택</option>
                        <option value="트렌드">트렌드</option>
                        <option value="광고&홍보">광고&홍보</option>
                        <option value="디자인">디자인</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>요약</label>
                    <input type="text" id="archiveSummary" placeholder="글의 간략한 요약">
                </div>

                <div class="form-group">
                    <label>본문 <span class="required">*</span></label>
                    <textarea id="archiveContent" placeholder="아티클 본문을 작성하세요"></textarea>
                </div>

                <div class="form-actions">
                    <button class="btn btn-primary" id="archiveSubmitBtn" onclick="submitArchive()"
                        style="background: #FFD93D; color: #1a1a1a;">제출</button>
                    <button class="btn btn-secondary" onclick="resetArchiveForm()">초기화</button>
                </div>
            </div>

            <div class="info-card">
                <h3>안내사항</h3>
                <ul>
                    <li>제출된 글은 관리자 승인 후 게시됩니다</li>
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
            <button class="btn btn-secondary" onclick="goBackToTypeSelection()" style="margin-left: 8px;">유형
                선택으로</button>
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
                document.getElementById('typeSelection').classList.add('active');
            } else {
                document.getElementById('loginError').textContent = '아이디 또는 비밀번호가 올바르지 않습니다';
            }
        };

        // 유형 선택
        window.currentType = null;

        window.selectType = function (type) {
            window.currentType = type;
            document.getElementById('typeSelection').classList.remove('active');
            document.getElementById('backBtn').classList.add('visible');

            if (type === 'portfolio') {
                document.getElementById('headerTitle').innerHTML = 'Portfolio <span>Writer</span>';
                document.getElementById('writeForm').classList.add('active');
            } else if (type === 'archive') {
                document.getElementById('headerTitle').innerHTML = 'Archive <span>Writer</span>';
                document.getElementById('archiveForm').classList.add('active');
            }
        };

        window.goBackToTypeSelection = function () {
            document.getElementById('writeForm').classList.remove('active');
            document.getElementById('archiveForm').classList.remove('active');
            document.getElementById('successMessage').classList.remove('active');
            document.getElementById('errorMessage').classList.remove('active');
            document.getElementById('typeSelection').classList.add('active');
            document.getElementById('backBtn').classList.remove('visible');
            document.getElementById('headerTitle').innerHTML = 'Content <span>Writer</span>';
            window.currentType = null;
        };

        window.submitPortfolio = async function () {
            const title = document.getElementById('title').value.trim();
            const category = document.getElementById('category').value;
            const client = document.getElementById('client').value.trim();
            const content = document.getElementById('content').value.trim();
            const region = document.getElementById('region').value;
            const startDate = document.getElementById('startDate').value;
            const endDate = document.getElementById('endDate').value;
            const author = document.getElementById('author').value.trim();

            // 플랫폼 수집
            const platforms = [];
            document.querySelectorAll('#platforms input:checked').forEach(cb => {
                platforms.push(cb.value);
            });

            // 성과 지표 수집
            const metrics = [];
            document.querySelectorAll('.metric-row').forEach(row => {
                const type = row.querySelector('.metric-type').value;
                const value = row.querySelector('.metric-value').value.trim();
                const unit = row.querySelector('.metric-unit').value;
                if (value) {
                    metrics.push({ type, value, unit });
                }
            });

            // 유효성 검사
            if (!title) { alert('프로젝트 제목을 입력하세요.'); return; }
            if (!category) { alert('카테고리를 선택하세요.'); return; }
            if (platforms.length === 0) { alert('사용 플랫폼을 1개 이상 선택하세요.'); return; }
            if (metrics.length === 0) { alert('핵심 성과를 1개 이상 입력하세요.'); return; }
            if (!content) { alert('프로젝트 요약을 입력하세요.'); return; }
            if (content.length < 50) { alert('프로젝트 요약은 최소 50자 이상 작성하세요.'); return; }

            const btn = document.getElementById('submitBtn');
            btn.disabled = true;
            btn.textContent = '제출 중...';

            try {
                await addDoc(collection(db, 'portfolios'), {
                    title,
                    category,
                    projectPeriod: { start: startDate || '', end: endDate || '' },
                    platforms,
                    metrics,
                    content,
                    client: client || '',
                    region: region || '',
                    author: author || '',
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

        // 글자수 카운터
        window.updateCharCounter = function () {
            const content = document.getElementById('content');
            const counter = document.getElementById('summaryCounter');
            const len = content.value.length;
            counter.textContent = len + '/300';

            counter.classList.remove('warning', 'error');
            if (len < 200) {
                counter.classList.add('warning');
            } else if (len >= 300) {
                counter.classList.add('error');
            }
        };

        // 익명 처리 토글
        window.toggleAnonymous = function () {
            const hint = document.getElementById('anonymousHint');
            const isChecked = document.getElementById('clientAnonymous').checked;
            hint.style.display = isChecked ? 'block' : 'none';
        };

        window.resetForm = function () {
            document.getElementById('title').value = '';
            document.getElementById('category').value = '';
            document.getElementById('client').value = '';
            document.getElementById('content').value = '';
            document.getElementById('region').value = '';
            document.getElementById('startDate').value = '';
            document.getElementById('endDate').value = '';
            document.getElementById('author').value = '';
            document.getElementById('summaryCounter').textContent = '0/300';

            // 체크박스 해제
            document.querySelectorAll('#platforms input').forEach(cb => cb.checked = false);

            // 성과 지표 초기화
            document.querySelectorAll('.metric-value').forEach(input => input.value = '');

            // 파일 입력 초기화
            document.getElementById('mainImage').value = '';
            document.getElementById('additionalImages').value = '';
        };

        window.writeAnother = function () {
            resetForm();
            document.getElementById('successMessage').classList.remove('active');
            document.getElementById('writeForm').classList.add('active');
        };

        window.showForm = function () {
            document.getElementById('errorMessage').classList.remove('active');
            if (window.currentType === 'portfolio') {
                document.getElementById('writeForm').classList.add('active');
            } else {
                document.getElementById('archiveForm').classList.add('active');
            }
        };

        // 아카이브 제출
        window.submitArchive = async function () {
            const title = document.getElementById('archiveTitle').value.trim();
            const category = document.getElementById('archiveCategory').value;
            const summary = document.getElementById('archiveSummary').value.trim();
            const content = document.getElementById('archiveContent').value.trim();

            if (!title) { alert('제목을 입력하세요.'); return; }
            if (!category) { alert('카테고리를 선택하세요.'); return; }
            if (!content) { alert('본문을 입력하세요.'); return; }

            const btn = document.getElementById('archiveSubmitBtn');
            btn.disabled = true;
            btn.textContent = '제출 중...';

            try {
                await addDoc(collection(db, 'articles'), {
                    title, category, summary: summary || '', content,
                    status: 'pending',
                    source: 'manual',
                    createdAt: serverTimestamp(),
                    createdBy: 'staff'
                });
                document.getElementById('archiveForm').classList.remove('active');
                document.getElementById('successMessage').classList.add('active');
            } catch (error) {
                document.getElementById('errorText').textContent = error.message;
                document.getElementById('archiveForm').classList.remove('active');
                document.getElementById('errorMessage').classList.add('active');
            }

            btn.disabled = false;
            btn.textContent = '제출';
        };

        window.resetArchiveForm = function () {
            document.getElementById('archiveTitle').value = '';
            document.getElementById('archiveCategory').value = '';
            document.getElementById('archiveSummary').value = '';
            document.getElementById('archiveContent').value = '';
        };
    </script>
</body>

</html>