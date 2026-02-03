<?php
/**
 * 네이버 API 테스트 스크립트
 */

$client_id = "EvH6w6EzcnGPuxS1NbnV";
$client_secret = "DdcoUaQUy_";

$end_date = date('Y-m-d');
$start_date = date('Y-m-d', strtotime('-7 days'));

$body = json_encode([
    "startDate" => $start_date,
    "endDate" => $end_date,
    "timeUnit" => "date",
    "keywordGroups" => [
        ["groupName" => "AI", "keywords" => ["AI"]]
    ]
]);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://openapi.naver.com/v1/datalab/search");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    "X-Naver-Client-Id: " . $client_id,
    "X-Naver-Client-Secret: " . $client_secret,
    "Content-Type: application/json"
]);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);

$response = curl_exec($ch);
$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

echo "=== Naver DataLab API Test ===\n\n";
echo "Date Range: $start_date ~ $end_date\n";
echo "HTTP Code: $http_code\n";
if ($error) {
    echo "CURL Error: $error\n";
}
echo "\n=== Response ===\n";
echo $response . "\n";

// Parse check
if ($http_code == 200) {
    $data = json_decode($response, true);
    if (isset($data['results'])) {
        echo "\n✅ API 작동 정상!\n";
    } elseif (isset($data['errorCode'])) {
        echo "\n❌ API 오류: " . $data['errorMessage'] . "\n";
    }
} else {
    echo "\n❌ HTTP 오류 발생\n";
}
?>