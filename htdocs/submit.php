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

// --- Config ---
define('GH_REPO',   'KSol72/GDH-Demonlist');
define('GH_BRANCH', 'main');

function getToken() {
    // 1. Environment variable (set in Replit Secrets as GH_TOKEN)
    $env = getenv('GH_TOKEN');
    if ($env) return $env;
    // 2. Read from .git/config remote URL (works in dev)
    $cfg = __DIR__ . '/../.git/config';
    if (file_exists($cfg)) {
        if (preg_match('/https:\/\/[^:]+:([^@]+)@github\.com/', file_get_contents($cfg), $m)) {
            return $m[1];
        }
    }
    return null;
}

// --- GitHub API: GET file (returns ['data'=>decoded_json, 'sha'=>sha]) ---
function ghGet($token, $path) {
    $url = 'https://api.github.com/repos/' . GH_REPO . '/contents/' . rawurlencode($path) . '?ref=' . GH_BRANCH;
    // rawurlencode breaks slashes, rebuild
    $url = 'https://api.github.com/repos/' . GH_REPO . '/contents/' . $path . '?ref=' . GH_BRANCH;
    $ctx = stream_context_create(['http' => [
        'method'        => 'GET',
        'header'        => "Authorization: token $token\r\nUser-Agent: GDH-Demonlist\r\nAccept: application/vnd.github.v3+json\r\n",
        'ignore_errors' => true
    ]]);
    $body = @file_get_contents($url, false, $ctx);
    if (!$body) return null;
    $resp = json_decode($body, true);
    if (!isset($resp['content']) || !isset($resp['sha'])) return null;
    $decoded = json_decode(base64_decode(str_replace("\n", '', $resp['content'])), true);
    if ($decoded === null) return null;
    return ['data' => $decoded, 'sha' => $resp['sha']];
}

// --- GitHub API: PUT file ---
function ghPut($token, $path, array $data, $sha, $message) {
    $url  = 'https://api.github.com/repos/' . GH_REPO . '/contents/' . $path;
    $json = json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    $body = json_encode([
        'message' => $message,
        'content' => base64_encode($json),
        'sha'     => $sha,
        'branch'  => GH_BRANCH
    ]);
    $ctx = stream_context_create(['http' => [
        'method'        => 'PUT',
        'header'        => "Authorization: token $token\r\nUser-Agent: GDH-Demonlist\r\nContent-Type: application/json\r\nAccept: application/vnd.github.v3+json\r\n",
        'content'       => $body,
        'ignore_errors' => true
    ]]);
    $resp = @file_get_contents($url, false, $ctx);
    if (!$resp) return false;
    $decoded = json_decode($resp, true);
    return isset($decoded['commit']); // GitHub returns commit info on success
}

// --- Cache to /tmp so changes show immediately before re-deploy ---
function cacheToTmp($name, array $data) {
    $dir = sys_get_temp_dir() . '/gdh-data';
    if (!is_dir($dir)) @mkdir($dir, 0777, true);
    @file_put_contents("$dir/$name", json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// --- Get token ---
$token = getToken();
if (!$token) {
    http_response_code(500);
    echo 'GitHub token not configured';
    exit;
}

// --- Fetch current JSON from GitHub ---
$demonsGh   = ghGet($token, 'htdocs/JS/demons.json');
$extendedGh = ghGet($token, 'htdocs/JS/extended.json');
$lbGh       = ghGet($token, 'htdocs/JS/leaderboard.json');

if (!$demonsGh || !$extendedGh || !$lbGh) {
    http_response_code(500);
    echo 'Failed to fetch JSON from GitHub';
    exit;
}

$demons      = $demonsGh['data'];
$extended    = $extendedGh['data'];
$leaderboard = $lbGh['data'];

// --- Find which file contains the level ---
if (isset($demons[$level])) {
    $targetData = &$demons;
    $targetPath = 'htdocs/JS/demons.json';
    $targetSha  = $demonsGh['sha'];
    $targetFile = 'demons.json';
} elseif (isset($extended[$level])) {
    $targetData = &$extended;
    $targetPath = 'htdocs/JS/extended.json';
    $targetSha  = $extendedGh['sha'];
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

// --- Apply changes ---
$targetData[$level]['list'][] = ['name' => $user, 'link' => $video];

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

// --- Push both files to GitHub ---
$commitMsg = "Record: $user completed $level";

$ok1 = ghPut($token, $targetPath, $targetData, $targetSha, $commitMsg);
$ok2 = ghPut($token, 'htdocs/JS/leaderboard.json', $leaderboard, $lbGh['sha'], $commitMsg);

if (!$ok1 || !$ok2) {
    http_response_code(500);
    echo 'Failed to push to GitHub';
    exit;
}

// --- Also cache locally so changes appear immediately ---
cacheToTmp($targetFile, $targetData);
cacheToTmp('leaderboard.json', $leaderboard);

echo 'Submission successful!';
?>
