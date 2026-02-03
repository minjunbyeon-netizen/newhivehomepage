<?php
/**
 * Gemini AI 글 생성 API
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

if (!isset($input['keyword']) || !isset($input['category'])) {
    echo json_encode(["success" => false, "error" => "keyword와 category 필요"], JSON_UNESCAPED_UNICODE);
    exit;
}

$keyword = $input['keyword'];
$category = $input['category'];
$ratio = $input['ratio'] ?? 0;
$issue = $input['issue'] ?? $keyword . ' 마케팅 전략';

$api_key = "AIzaSyAokIXbpair4BoupSzozipNsdgn0PYXeV4";

$prompt = "당신은 20년 경력의 마케팅 전문 칼럼니스트입니다.

[작성 주제]
키워드: {$keyword}
이슈: {$issue}

[스타일 가이드 - 반드시 따라주세요]
아래 예시처럼 깊이 있는 마케팅 칼럼을 작성하세요:

---예시 시작---
경쟁광고와 관련하여 많은 영향을 준 대표적인 책을 꼽아 보라고 하면, 대부분의 광고인들은 주저하지 않고 '포지셔닝'을 이야기 할 것이다. 이론에 대한 공감은 물론, 소개된 사례들이 광고 전략을 수립하고, 광고 제작물을 만드는 업무에 큰 도움을 주었기 때문이다.

잭 트라우트와 알 리스의 [포지셔닝]에 나오는 대표적인 사례는 다음과 같다.

1.아비스의 'No. 2' 캠페인

아비스(Avis), 허츠(Hertz)는 렌터카의 대표 브랜드들이다. 만년 2위인 아비스가 1위인 허츠를 공격하면서 광고 전쟁은 시작된다.

캠페인의 정식 슬로건은 \"We are only No. 2, so we try harder. (우리는 2등 입니다. 그래서 더 열심히 노력합니다)\" 이다.

우리는 2등이라는 메시지에는 절묘한 두 가지 노림 수가 있다.

하나는 쉽게 주목받고 차별화 될 수 있다는 점이다. 꼴등 조차도 일등이라고 우기는 광고판에서, 자신을 2등이라고 말하는 것은 남들과 다르게 보일 뿐만 아니라 관심과 주목의 대상이 될 수 있다.
---예시 끝---

[필수 규칙]
1. 마크다운 문법 절대 사용 금지 (**, ##, ### 등 절대 금지)
2. JSON 형식 금지 - 순수 본문 텍스트만 출력
3. 문단 사이는 빈 줄 하나로 구분
4. 실제 마케팅 사례 2-3개 포함
5. 2000자 이상 작성
6. 칼럼니스트처럼 통찰력 있는 분석
7. 마지막에 자신만의 인사이트나 결론 제시

위 주제로 본문만 작성하세요. 제목이나 요약 없이 본문만 출력하세요.";

$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key=" . $api_key;

$data = [
    "contents" => [["parts" => [["text" => $prompt]]]],
    "generationConfig" => [
        "temperature" => 0.8,
        "maxOutputTokens" => 4096
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
    echo json_encode(["success" => false, "error" => "API 오류: " . ($error ?: "HTTP $httpCode")], JSON_UNESCAPED_UNICODE);
    exit;
}

$result = json_decode($response, true);
$content = $result['candidates'][0]['content']['parts'][0]['text'] ?? '';

if (empty($content)) {
    echo json_encode(["success" => false, "error" => "빈 응답"], JSON_UNESCAPED_UNICODE);
    exit;
}

// 마크다운 잔여물 제거
$content = preg_replace('/^#{1,6}\s+/m', '', $content);
$content = preg_replace('/\*\*([^*]+)\*\*/', '$1', $content);
$content = preg_replace('/\*([^*]+)\*/', '$1', $content);
$content = trim($content);

// 제목과 요약 자동 생성
$title = "{$keyword} 마케팅 인사이트";
$summary = "{$issue}에 대한 심층 분석";

echo json_encode([
    "success" => true,
    "article" => [
        "title" => $title,
        "summary" => $summary,
        "content" => $content
    ],
    "source" => "gemini"
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>