<?php
/**
 * AI 이미지 생성 API (Nano Banana Pro)
 * 
 * action=suggest : 글 내용 분석 → 이미지 프롬프트 2~3개 제안
 * action=generate : 프롬프트로 이미지 생성 → base64 반환
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'] ?? '';
$api_key = "AIzaSyANkbjijNAgygfxT2UNCu2t4ugIxvH0i4s";

// ========================================
// ACTION: suggest — 글 분석 → 프롬프트 제안
// ========================================
if ($action === 'suggest') {
    $content = $input['content'] ?? '';
    $title = $input['title'] ?? '';

    if (empty($content)) {
        echo json_encode(["success" => false, "error" => "본문 내용이 필요합니다"], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 본문 앞 1500자만 사용 (토큰 절약)
    $contentSnippet = mb_substr($content, 0, 1500);

    $prompt = "당신은 마케팅 콘텐츠 아트 디렉터입니다.

아래 마케팅 기사 본문을 읽고, 글 사이사이에 삽입하면 좋을 이미지 3장의 프롬프트를 제안해주세요.

[기사 제목] {$title}
[기사 본문 일부]
{$contentSnippet}

[규칙]
1. 각 이미지는 기사의 서로 다른 부분에 어울려야 합니다
2. 프롬프트는 영어로 작성 (이미지 생성 AI용)
3. 한글 설명도 함께 제공
4. 마케팅/비즈니스 콘텐츠에 어울리는 프로페셔널한 스타일
5. 텍스트나 글자가 포함되지 않는 이미지로 제안
6. 사실적인 사진 스타일 또는 깔끔한 일러스트 스타일

반드시 아래 JSON 형식으로만 응답:
{\"prompts\": [
  {\"description\": \"한글 설명\", \"prompt\": \"영문 프롬프트\", \"position\": \"도입부/중간/결론\"},
  {\"description\": \"한글 설명\", \"prompt\": \"영문 프롬프트\", \"position\": \"도입부/중간/결론\"},
  {\"description\": \"한글 설명\", \"prompt\": \"영문 프롬프트\", \"position\": \"도입부/중간/결론\"}
]}";

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $api_key;

    $data = [
        "contents" => [["parts" => [["text" => $prompt]]]],
        "generationConfig" => [
            "temperature" => 0.8,
            "maxOutputTokens" => 1000
        ]
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE),
        CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($error || $httpCode !== 200) {
        echo json_encode(["success" => false, "error" => "프롬프트 제안 API 오류: " . ($error ?: "HTTP $httpCode")], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $result = json_decode($response, true);
    $text = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

    // JSON 추출
    if (preg_match('/\{.*"prompts".*\}/s', $text, $matches)) {
        $parsed = json_decode($matches[0], true);
        if (isset($parsed['prompts'])) {
            echo json_encode(["success" => true, "prompts" => $parsed['prompts']], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            exit;
        }
    }

    echo json_encode(["success" => false, "error" => "프롬프트 파싱 실패", "raw" => $text], JSON_UNESCAPED_UNICODE);
    exit;
}

// ========================================
// ACTION: generate — 이미지 생성 (Nano Banana Pro)
// ========================================
if ($action === 'generate') {
    $imagePrompt = $input['prompt'] ?? '';

    if (empty($imagePrompt)) {
        echo json_encode(["success" => false, "error" => "이미지 프롬프트가 필요합니다"], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash-image:generateContent?key=" . $api_key;

    $data = [
        "contents" => [["parts" => [["text" => $imagePrompt]]]],
        "generationConfig" => [
            "responseModalities" => ["TEXT", "IMAGE"]
        ]
    ];

    $ch = curl_init($url);
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => json_encode($data, JSON_UNESCAPED_UNICODE),
        CURLOPT_HTTPHEADER => ["Content-Type: application/json"],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_TIMEOUT => 120,
        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_SSL_VERIFYHOST => 0
    ]);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($error || $httpCode !== 200) {
        $errDetail = $error ?: "HTTP $httpCode";
        // 응답 본문에서 에러 메시지 추출 시도
        if ($response) {
            $errBody = json_decode($response, true);
            if (isset($errBody['error']['message'])) {
                $errDetail .= " - " . $errBody['error']['message'];
            }
        }
        echo json_encode(["success" => false, "error" => "이미지 생성 API 오류: " . $errDetail], JSON_UNESCAPED_UNICODE);
        exit;
    }

    $result = json_decode($response, true);
    $parts = $result['candidates'][0]['content']['parts'] ?? [];

    $imageData = null;
    $mimeType = 'image/png';

    foreach ($parts as $part) {
        if (isset($part['inlineData'])) {
            $imageData = $part['inlineData']['data'];
            $mimeType = $part['inlineData']['mimeType'] ?? 'image/png';
            break;
        }
    }

    if (!$imageData) {
        echo json_encode(["success" => false, "error" => "이미지가 생성되지 않았습니다"], JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 이미지를 로컬 서버에 저장
    $uploadDir = __DIR__ . '/../../assets/img/ai-generated/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $ext = strpos($mimeType, 'png') !== false ? 'png' : 'jpg';
    $fileName = 'ai_img_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
    $filePath = $uploadDir . $fileName;

    file_put_contents($filePath, base64_decode($imageData));

    // 웹 접근 URL 생성
    $webUrl = '/01_work/hivemedia_homepage/assets/img/ai-generated/' . $fileName;

    echo json_encode([
        "success" => true,
        "image" => [
            "url" => $webUrl,
            "fileName" => $fileName
        ]
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

// 알 수 없는 action
echo json_encode(["success" => false, "error" => "action은 'suggest' 또는 'generate'여야 합니다"], JSON_UNESCAPED_UNICODE);
?>