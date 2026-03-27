<?php
$allowed = ['demons', 'extended', 'leaderboard', 'levellist'];
$file = isset($_GET['f']) ? $_GET['f'] : '';

if (!in_array($file, $allowed, true)) {
    http_response_code(400);
    exit;
}

header('Content-Type: application/json');

$tmpFile = sys_get_temp_dir() . "/gdh-data/$file.json";
$srcFile = __DIR__ . "/JS/$file.json";

// Serve from /tmp (updated) if it exists, otherwise fall back to source
if (file_exists($tmpFile)) {
    readfile($tmpFile);
} else {
    readfile($srcFile);
}
