<?php
/**
 * Portfolio Data Migration Script
 * Migrates portfolio.json data to Firebase Firestore
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Load Google Cloud Firestore library
require_once __DIR__ . '/../vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

// Firebase configuration
$projectId = 'hivemedia-archive';
$keyFilePath = __DIR__ . '/../firebase-service-account.json'; // You'll need to add this file

// Initialize Firestore
if (!file_exists($keyFilePath)) {
    die("ERROR: firebase-service-account.json not found.\nPlease download it from Firebase Console > Project Settings > Service Accounts > Generate New Private Key\n");
}

$firestore = new FirestoreClient([
    'projectId' => $projectId,
    'keyFilePath' => $keyFilePath
]);

// Load portfolio.json
$jsonPath = __DIR__ . '/../assets/uploaded/app/portfolio.json';
if (!file_exists($jsonPath)) {
    die("ERROR: portfolio.json not found at $jsonPath\n");
}

$jsonData = json_decode(file_get_contents($jsonPath), true);
if (!isset($jsonData['rows'])) {
    die("ERROR: Invalid portfolio.json format\n");
}

$portfolios = $jsonData['rows'];
echo "Found " . count($portfolios) . " portfolio items to migrate.\n\n";

// Category mapping
$categoryMap = [
    'Homepage' => 'Homepage',
    'Video' => 'Video',
    'SNS' => 'SNS',
    'Online AD' => 'Online AD',
    'Eventpage' => 'Eventpage',
    'Print' => 'Print',
    'Exhibition Art' => 'Exhibition Art'
];

$collection = $firestore->collection('portfolios');
$migrated = 0;
$skipped = 0;

foreach ($portfolios as $item) {
    $title = $item['hiveboad000001'] ?? '';
    $category = $item['hiveboad000023'] ?? 'Homepage';

    // Skip if no title
    if (empty($title)) {
        $skipped++;
        continue;
    }

    // Map category
    $mappedCategory = $categoryMap[$category] ?? $category;

    // Prepare image URLs - prepend the base path
    $imageBasePath = 'https://hivemedia.co.kr/files/attach/images/';
    $thumbnailUrl = !empty($item['hiveboad000011']) ? $imageBasePath . $item['hiveboad000011'] : '';
    $mainImageUrl = !empty($item['hiveboad000026']) ? $imageBasePath . $item['hiveboad000026'] : '';
    $detailImageUrl = !empty($item['hiveboad000029']) ? $imageBasePath . $item['hiveboad000029'] : '';

    // Collect additional images
    $images = array_filter([
        $thumbnailUrl,
        $mainImageUrl,
        $detailImageUrl
    ]);

    // Get description and remove HTML tags
    $description = $item['hiveboad000007'] ?? '';
    $description = strip_tags($description);
    if (empty($description)) {
        $description = $item['hiveboad000020'] ?? '';
    }
    if (empty($description)) {
        $description = $item['hiveboad000031'] ?? '';
    }

    // Prepare Firestore document data
    $data = [
        'title' => $title,
        'category' => $mappedCategory,
        'client' => $item['hiveboad000002'] ?? '하이브미디어',
        'advertiser' => $item['hiveboad000031'] ?? $title,
        'description' => $description,
        'thumbnailUrl' => $thumbnailUrl,
        'imageUrl' => $mainImageUrl ?: $thumbnailUrl,
        'images' => $images,
        'date' => $item['hiveboad000021'] ?? date('Y-m-d'),
        'status' => 'approved', // Auto-approve migrated content
        'createdAt' => new \DateTime($item['hiveboad000003'] ?? 'now'),
        'updatedAt' => new \DateTime($item['hiveboad000004'] ?? 'now'),
        'pk_no' => $item['pk_no'] ?? 0,
        'migrated' => true,
        'migrationDate' => new \DateTime()
    ];

    try {
        // Use pk_no as document ID for consistency
        $docId = 'migrated_' . $item['pk_no'];
        $collection->document($docId)->set($data);
        $migrated++;
        echo "✓ Migrated: $title ($mappedCategory)\n";
    } catch (Exception $e) {
        echo "✗ Error migrating $title: " . $e->getMessage() . "\n";
    }
}

echo "\n" . str_repeat('=', 60) . "\n";
echo "Migration Complete!\n";
echo "Migrated: $migrated items\n";
echo "Skipped: $skipped items\n";
echo str_repeat('=', 60) . "\n";
