<?php
/**
 * 트렌드 조회 API
 * - 네이버 DataLab API 사용
 * 
 * GET /archive/api/get-trends.php
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');

// ============================================================
// 네이버 DataLab API
// ============================================================

function getNaverTrends()
{
    $client_id = "EvH6w6EzcnGPuxS1NbnV";
    $client_secret = "DdcoUaQUy_";

    // 4개 카테고리 키워드 그룹
    $keyword_groups = [
        ["name" => "마케팅전략", "keywords" => ["바이럴마케팅", "인플루언서마케팅", "퍼포먼스마케팅", "브랜딩", "리타겟팅"]],
        ["name" => "콘텐츠마케팅", "keywords" => ["숏폼콘텐츠", "유튜브마케팅", "인스타그램릴스", "틱톡광고", "라이브커머스"]],
        ["name" => "기술트렌드", "keywords" => ["AI마케팅", "챗GPT", "생성형AI", "개인화추천", "데이터분석"]],
        ["name" => "소비자트렌드", "keywords" => ["MZ세대", "친환경소비", "가심비", "갓생", "소확행"]]
    ];

    $end_date = date('Y-m-d');
    $start_date = date('Y-m-d', strtotime('-7 days'));

    $all_trends = [];

    foreach ($keyword_groups as $group) {
        $category_name = $group['name'];
        $keywords = $group['keywords'];

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
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);

        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($http_code == 200 && $response) {
            $data = json_decode($response, true);

            if (isset($data['results']) && count($data['results']) > 0) {
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

                usort($results, function ($a, $b) {
                    return $b['avgRatio'] <=> $a['avgRatio'];
                });

                if (count($results) > 0) {
                    $all_trends[] = [
                        "keyword" => $results[0]['keyword'],
                        "category" => $category_name,
                        "avgRatio" => $results[0]['avgRatio'],
                        "source" => "naver"
                    ];
                }
            }
        }
    }

    if (count($all_trends) > 0) {
        return [
            "success" => true,
            "trends" => $all_trends,
            "source" => "naver_datalab",
            "period" => [
                "startDate" => $start_date,
                "endDate" => $end_date
            ]
        ];
    }

    return null;
}

// ============================================================
// 메인 실행
// ============================================================

$result = getNaverTrends();

if ($result && $result['success']) {
    echo json_encode([
        "success" => true,
        "trends" => $result['trends'],
        "source" => "naver_datalab",
        "fetchedAt" => date('Y-m-d H:i:s'),
        "period" => $result['period'] ?? null
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
} else {
    echo json_encode([
        "success" => false,
        "error" => "네이버 트렌드 데이터를 가져올 수 없습니다."
    ], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
}
?>