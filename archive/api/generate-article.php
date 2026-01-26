<?php
/**
 * Gemini AI 글 생성 API
 * POST /archive/api/generate-article.php
 * Body: { "keyword": "...", "category": "...", "ratio": 0 }
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

// POST 데이터 받기
$input = json_decode(file_get_contents('php://input'), true);

if (!isset($input['keyword']) || !isset($input['category'])) {
    echo json_encode([
        "success" => false,
        "error" => "keyword와 category가 필요합니다."
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$keyword = $input['keyword'];
$category = $input['category'];
$ratio = $input['ratio'] ?? 0;

// Gemini API 키 (환경변수에서 가져오기)
$gemini_api_key = "AIzaSyAokIXbpair4BoupSzozipNsdgn0PYXeV4";

$article = null;

// Gemini API 사용 가능한 경우
if ($gemini_api_key) {
    $prompt = "당신은 20년차 마케팅 에이전시 본부장이자, 차분하고 사색적인 칼럼니스트입니다.

[페르소나 핵심]
- 이동진 평론가처럼 차분하고 교양있는 말투
- 거만하지 않고, 독자와 함께 생각을 나누는 느낌
- 비유와 은유를 활용해 복잡한 개념을 쉽게 풀어냄
- 결론을 강요하지 않고, 생각할 거리를 던져줌

[말투 스타일]
- 조용하지만 깊이 있는 어조
- '~입니다', '~죠' 같은 부드러운 종결어미
- 질문을 던지며 독자의 사고를 유도
- 은유적 표현 사용 (예: '이건 마치 ~와 같습니다')

[자주 쓰는 표현]: 결국, 본질적으로, 흥미로운 점은, 생각해볼 만한 것은, 다시 말해
[피해야 할 표현]: 뻔한, 당연히, 무조건

다음 트렌드 키워드로 인사이트 칼럼을 작성하세요:
- 키워드: {$keyword}
- 카테고리: {$category}
- 검색 인기도: {$ratio}/100

[글 구조]
1. Opening: 조용한 관찰로 시작. 현상에 대한 담담한 묘사
2. Body: 이 트렌드가 왜 주목받는지 본질적인 이유 분석. 과거 사례와 연결하되 교훈적으로
3. Closing: 섣부른 결론보다는, 독자가 스스로 생각해볼 질문을 던지며 마무리

[출력 규칙]
- 본문 600-800자
- 이모지 사용 금지
- 마크다운 형식

JSON 형식으로만 응답:
{\"title\": \"[인사이트] 제목\", \"summary\": \"요약\", \"content\": \"마크다운 본문\"}";

    $api_url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash-exp:generateContent?key=" . $gemini_api_key;

    $request_body = [
        "contents" => [
            [
                "parts" => [
                    ["text" => $prompt]
                ]
            ]
        ],
        "generationConfig" => [
            "temperature" => 0.7,
            "maxOutputTokens" => 1024
        ]
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request_body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200 && $response) {
        $data = json_decode($response, true);

        if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
            $text = $data['candidates'][0]['content']['parts'][0]['text'];

            // JSON 파싱 시도
            $text = trim($text);
            if (strpos($text, '```') !== false) {
                preg_match('/```(?:json)?\s*(.*?)\s*```/s', $text, $matches);
                if (isset($matches[1])) {
                    $text = trim($matches[1]);
                }
            }

            $article = json_decode($text, true);
        }
    }
}

// Gemini 실패 또는 API 키 없음 → 템플릿 사용
if (!$article || !isset($article['title'])) {
    $article = [
        "title" => "[{$category}] {$keyword} 주간 분석",
        "summary" => "검색 인기도 {$ratio}점 - {$keyword} 키워드의 현황과 전략",
        "content" => "## {$keyword} 검색 트렌드 분석

최근 7일간 '{$keyword}' 키워드가 네이버 검색에서 주목받고 있습니다.

### 현황

**검색 데이터**
- 인기도: {$ratio}/100
- 카테고리: {$category}
- 추이: 상승세

### 분석

이 키워드는 {$category} 분야에서 사용자 수요가 증가하고 있음을 보여줍니다. 특히 주간 검색 패턴에서 일관된 관심도를 유지하고 있어, 지속 가능한 콘텐츠 주제로 적합합니다.

### 전략 제안

**콘텐츠 마케팅**
1. {$keyword} 중심의 고품질 콘텐츠 제작
2. 관련 롱테일 키워드 확보
3. 사용자 검색 의도에 맞춘 정보 제공

**실행 방안**
- 블로그/SNS 게시물 최적화
- 검색엔진 최적화(SEO) 강화
- 정기적인 트렌드 모니터링

### 하이브미디어 서비스

지역 기반 마케팅 전문성을 바탕으로 실질적인 성과를 만들어냅니다.

상담 문의: hivemedia@naver.com"
    ];
}

// 응답
echo json_encode([
    "success" => true,
    "article" => $article,
    "source" => $gemini_api_key ? "gemini" : "template"
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>