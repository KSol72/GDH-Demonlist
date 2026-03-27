<?php
header('Content-Type: text/plain');

// --- Parse input ---
$input = json_decode(file_get_contents('php://input'), true);
$level = isset($input['level']) ? trim($input['level']) : '';
$user  = isset($input['user'])  ? trim($input['user'])  : '';
$video = isset($input['video']) ? trim($input['video']) : '';

if ($level === '' || $user === '' || $video === '') {
    http_response_code(400);
    echo 'Missing required fields';
    exit;
}

// --- Paths ---
// Write to /tmp (always writable, even on Cloud Run / read-only deployments)
$tmpDir = sys_get_temp_dir() . '/gdh-data';
$srcDir = __DIR__ . '/JS';

if (!is_dir($tmpDir)) {
    mkdir($tmpDir, 0777, true);
}

// Load a JSON file: prefer the tmp (updated) copy, fall back to source
function loadJson($tmpDir, $srcDir, $name) {
    $tmp = "$tmpDir/$name";
    $src = "$srcDir/$name";
    $path = file_exists($tmp) ? $tmp : $src;
    if (!file_exists($path)) return null;
    return json_decode(file_get_contents($path), true);
}

function saveJson($tmpDir, $name, $data) {
    return file_put_contents(
        "$tmpDir/$name",
        json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );
}

// --- Load data ---
$demons      = loadJson($tmpDir, $srcDir, 'demons.json');
$extended    = loadJson($tmpDir, $srcDir, 'extended.json');
$leaderboard = loadJson($tmpDir, $srcDir, 'leaderboard.json');

if ($demons === null || $extended === null || $leaderboard === null) {
    http_response_code(500);
    echo 'JSON files not found';
    exit;
}

// --- Find the level ---
if (isset($demons[$level])) {
    $targetData = $demons;
    $targetFile = 'demons.json';
} elseif (isset($extended[$level])) {
    $targetData = $extended;
    $targetFile = 'extended.json';
} else {
    http_response_code(404);
    echo 'Level not found';
    exit;
}

// --- Check for duplicate ---
foreach ($targetData[$level]['list'] as $entry) {
    if ($entry['name'] === $user) {
        http_response_code(409);
        echo 'Already submitted';
        exit;
    }
}

// --- Add the record ---
$targetData[$level]['list'][] = ['name' => $user, 'link' => $video];

// --- Update leaderboard ---
if (!isset($leaderboard[$user])) {
    $leaderboard[$user] = [
        'nationality' => 'Unknown',
        'levels'      => [],
        'progs'       => ['none']
    ];
}
if (!in_array($level, $leaderboard[$user]['levels'])) {
    $leaderboard[$user]['levels'][] = $level;
}

// --- Save both files ---
$ok1 = saveJson($tmpDir, $targetFile, $targetData);
$ok2 = saveJson($tmpDir, 'leaderboard.json', $leaderboard);

if ($ok1 === false || $ok2 === false) {
    http_response_code(500);
    echo 'Failed to save data';
} else {
    echo 'Submission successful!';
}
?>
