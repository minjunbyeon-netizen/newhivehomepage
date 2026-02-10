<?php
// 간단한 Gemini API 테스트
header('Content-Type: application/json; charset=utf-8');

$api_key = "AIzaSyANkbjijNAgygfxT2UNCu2t4ugIxvH0i4s";
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key=" . $api_key;

$data = [
    "contents" => [["parts" => [["text" => "안녕하세요라고 말해주세요"]]]]
];

$ch = curl_init($url);
curl_setopt_array($ch, [
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => json_encode($data),
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

echo json_encode([
    "curl_error" => $error,
    "http_code" => $httpCode,
    "response" => json_decode($response, true)
], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
?>