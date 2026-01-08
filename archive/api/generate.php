<?php
/**
 * Gemini 글 생성 API 엔드포인트
 * POST로 keyword, category 받아서 Python 스크립트 호출
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// OPTIONS 요청 처리 (CORS preflight)
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// POST 요청만 허용
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'POST 요청만 허용됩니다']);
    exit;
}

// 입력 데이터 파싱
$input = json_decode(file_get_contents('php://input'), true);
$keyword = $input['keyword'] ?? '';
$category = $input['category'] ?? '';

if (empty($keyword) || empty($category)) {
    echo json_encode(['error' => 'keyword와 category가 필요합니다']);
    exit;
}

// Python 스크립트 경로
$scriptPath = __DIR__ . '/../scripts/gemini_generator.py';

// Python 실행 (Windows)
$pythonPath = 'python';  // 또는 'python3' 또는 전체 경로
$command = sprintf(
    '%s "%s" "%s" "%s" 2>&1',
    $pythonPath,
    $scriptPath,
    escapeshellarg($keyword),
    escapeshellarg($category)
);

// 실행
$output = shell_exec($command);

// 결과 반환
if ($output === null) {
    echo json_encode(['error' => 'Python 스크립트 실행 실패']);
} else {
    // JSON 유효성 검사
    $decoded = json_decode($output, true);
    if ($decoded === null) {
        echo json_encode([
            'error' => 'JSON 파싱 실패',
            'raw' => substr($output, 0, 500)
        ]);
    } else {
        echo $output;
    }
}
