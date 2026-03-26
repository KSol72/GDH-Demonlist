<?php
session_start();

// ===== CONFIG (DO NOT TOUCH) =====
$basePath = "/home/coder/GDH-Demonlist/htdocs/JS/";

// ===== FILE PATHS =====
$demonsFile = $basePath . "demons.json";
$leaderboardFile = $basePath . "leaderboard.json";
$levelListFile = $basePath . "levellist.json";

// ===== GET FORM DATA =====
$player = trim($_POST['player'] ?? '');
$level = trim($_POST['level'] ?? '');
$proof = trim($_POST['proof'] ?? '');

// ===== BASIC VALIDATION =====
if ($player === '' || $level === '' || $proof === '') {
    die("❌ Error: Missing required fields.");
}

// ===== LOAD FILES =====
$demonsData = json_decode(file_get_contents($demonsFile), true);
$leaderboardData = json_decode(file_get_contents($leaderboardFile), true);
$levelListData = json_decode(file_get_contents($levelListFile), true);

// ===== VALIDATE JSON =====
if ($demonsData === null || $leaderboardData === null || $levelListData === null) {
    die("❌ Error: Failed to read JSON files.");
}

// ===== CHECK IF LEVEL EXISTS IN levellist.json =====
$validLevel = false;
foreach ($levelListData as $lvl) {
    if (strtolower($lvl['name']) === strtolower($level)) {
        $validLevel = true;
        $level = $lvl['name']; // normalize name
        break;
    }
}

if (!$validLevel) {
    die("❌ Error: Level does not exist in level list.");
}

// ===== ADD TO DEMONS.JSON =====
$levelFound = false;

foreach ($demonsData as &$demon) {
    if (strtolower($demon['name']) === strtolower($level)) {
        $levelFound = true;

        if (!isset($demon['records'])) {
            $demon['records'] = [];
        }

        // Prevent duplicate submission
        foreach ($demon['records'] as $record) {
            if (strtolower($record['user']) === strtolower($player)) {
                die("❌ Error: You already submitted this level.");
            }
        }

        // Add record
        $demon['records'][] = [
            "user" => $player,
            "link" => $proof,
            "percent" => 100
        ];

        break;
    }
}

if (!$levelFound) {
    die("❌ Error: Level not found in demons list.");
}

// ===== UPDATE LEADERBOARD =====
$playerFound = false;

foreach ($leaderboardData as &$user) {
    if (strtolower($user['name']) === strtolower($player)) {
        $playerFound = true;

        if (!isset($user['completions'])) {
            $user['completions'] = [];
        }

        // Prevent duplicate
        if (!in_array($level, $user['completions'])) {
            $user['completions'][] = $level;
        }

        break;
    }
}

// If player doesn't exist → create new
if (!$playerFound) {
    $leaderboardData[] = [
        "name" => $player,
        "completions" => [$level]
    ];
}

// ===== SAVE FILES =====
$demonsResult = file_put_contents($demonsFile, json_encode($demonsData, JSON_PRETTY_PRINT));
$leaderboardResult = file_put_contents($leaderboardFile, json_encode($leaderboardData, JSON_PRETTY_PRINT));

// ===== FINAL RESULT =====
if ($demonsResult === false || $leaderboardResult === false) {
    echo "❌ Error: Failed to save data. Check permissions.";
} else {
    echo "✅ Submission successful!";
}
?>chmod -R 777 /home/coder/GDH-Demonlist/htdocs/JS