<?php
/**
 * 네이버 DataLab API - 주간 트렌드 조회
 * GET /archive/api/get-trends.php
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// 네이버 API 인증 정보
$client_id = "EvH6w6EzcnGPuxS1NbnV";
$client_secret = "DdcoUaQUy_";

// 고정 카테고리 키워드 그룹
$keyword_groups = [
    ["name" => "TREND", "keywords" => ["마케팅", "광고", "브랜딩", "트렌드", "숏폼"]],
    ["name" => "INSIGHT", "keywords" => ["AI", "인공지능", "챗GPT", "자동화", "기술"]],
    ["name" => "CASE STUDY", "keywords" => ["부산", "관공서", "성공사례", "지자체", "공공기관"]]
];

// 날짜 계산 (최근 7일)
$end_date = date('Y-m-d');
$start_date = date('Y-m-d', strtotime('-7 days'));

$all_trends = [];

foreach ($keyword_groups as $group) {
    $category_name = $group['name'];
    $keywords = $group['keywords'];

    // 네이버 API 요청 body 구성
    $naver_keyword_groups = [];
    foreach (array_slice($keywords, 0, 5) as $kw) {
        $naver_keyword_groups[] = [
            "groupName" => $kw,
            "keywords" => [$kw]
        ];
    }

    $body = [
        "startDate" => $start_date,
        "endDate" => $end_date,
        "timeUnit" => "date",
        "keywordGroups" => $naver_keyword_groups
    ];

    // cURL로 네이버 API 호출
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://openapi.naver.com/v1/datalab/search");
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "X-Naver-Client-Id: " . $client_id,
        "X-Naver-Client-Secret: " . $client_secret,
        "Content-Type: application/json"
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code == 200 && $response) {
        $data = json_decode($response, true);

        if (isset($data['results']) && count($data['results']) > 0) {
            // 각 키워드의 평균 ratio 계산
            $results = [];
            foreach ($data['results'] as $result) {
                $keyword = $result['title'];
                $ratios = array_column($result['data'], 'ratio');
                $avg_ratio = count($ratios) > 0 ? array_sum($ratios) / count($ratios) : 0;

                $results[] = [
                    "keyword" => $keyword,
                    "avgRatio" => round($avg_ratio, 1),
                    "category" => $category_name
                ];
            }

            // 인기도순 정렬
            usort($results, function ($a, $b) {
                return $b['avgRatio'] <=> $a['avgRatio'];
            });

            // 각 카테고리에서 상위 1개씩
            if (count($results) > 0) {
                $all_trends[] = $results[0];
            }
        }
    }
}

// 응답
if (count($all_trends) > 0) {
    echo json_encode([
        "success" => true,
        "trends" => $all_trends,
        "period" => [
            "startDate" => $start_date,
            "endDate" => $end_date
        ]
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "success" => false,
        "error" => "트렌드 데이터를 가져올 수 없습니다."
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>