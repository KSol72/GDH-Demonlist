<?php
$data = json_decode(file_get_contents("php://input"), true);

$level = isset($data["level"]) ? trim($data["level"]) : "";
$user  = isset($data["user"]) ? trim($data["user"]) : "";
$video = isset($data["video"]) ? trim($data["video"]) : "";

if ($level === "" || $user === "" || $video === "") {
    echo "Error: Missing required fields";
    exit;
}

/*
THIS IS THE KEY FIX:
We dynamically find the REAL path instead of guessing
*/
$basePath = realpath(__DIR__ . "/JS") . "/";

$demonsFile = $basePath . "demons.json";
$leaderboardFile = $basePath . "leaderboard.json";

// CHECK FILES EXIST
if (!file_exists($demonsFile) || !file_exists($leaderboardFile)) {
    echo "Error: JSON files not found";
    exit;
}

// LOAD DATA
$demons = json_decode(file_get_contents($demonsFile), true);
$leaderboard = json_decode(file_get_contents($leaderboardFile), true);

// VALIDATE LEVEL
if (!isset($demons[$level])) {
    echo "Error: Level not found";
    exit;
}

// PREVENT DUPLICATE
foreach ($demons[$level]["list"] as $entry) {
    if ($entry["name"] === $user) {
        echo "Error: Already submitted";
        exit;
    }
}

// ADD RECORD
$demons[$level]["list"][] = [
    "name" => $user,
    "link" => $video
];

// CREATE USER IF NEEDED
if (!isset($leaderboard[$user])) {
    $leaderboard[$user] = [
        "nationality" => "Unknown",
        "levels" => [],
        "progs" => ["none"]
    ];
}

// ADD LEVEL
if (!in_array($level, $leaderboard[$user]["levels"])) {
    $leaderboard[$user]["levels"][] = $level;
}

// SAVE FILES
$save1 = file_put_contents($demonsFile, json_encode($demons, JSON_PRETTY_PRINT));
$save2 = file_put_contents($leaderboardFile, json_encode($leaderboard, JSON_PRETTY_PRINT));

if ($save1 === false || $save2 === false) {
    echo "Error: Failed to save data";
} else {
    echo "Submission successful!";
}
?>