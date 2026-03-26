<?php
// READ JSON INPUT (this matches your frontend fetch)
$data = json_decode(file_get_contents("php://input"), true);

// GET VALUES SAFELY
$level = isset($data["level"]) ? trim($data["level"]) : "";
$user  = isset($data["user"]) ? trim($data["user"]) : "";
$video = isset($data["video"]) ? trim($data["video"]) : "";

// VALIDATION
if ($level === "" || $user === "" || $video === "") {
    echo "Error: Missing required fields";
    exit;
}

// ✅ CORRECT PATH FOR YOUR PROJECT
$basePath = "/home/coder/GDH-Demonlist/htdocs/JS/";

$demonsFile = $basePath . "demons.json";
$leaderboardFile = $basePath . "leaderboard.json";

// LOAD JSON FILES
$demons = json_decode(file_get_contents($demonsFile), true);
$leaderboard = json_decode(file_get_contents($leaderboardFile), true);

// CHECK LEVEL EXISTS
if (!isset($demons[$level])) {
    echo "Error: Level not found";
    exit;
}

// PREVENT DUPLICATE RECORD
foreach ($demons[$level]["list"] as $entry) {
    if ($entry["name"] === $user) {
        echo "Error: Already submitted";
        exit;
    }
}

// ADD TO DEMONS.JSON
$demons[$level]["list"][] = [
    "name" => $user,
    "link" => $video
];

// CREATE USER IF NOT EXISTS
if (!isset($leaderboard[$user])) {
    $leaderboard[$user] = [
        "nationality" => "Unknown",
        "levels" => [],
        "progs" => ["none"]
    ];
}

// ADD LEVEL TO USER PROFILE
if (!in_array($level, $leaderboard[$user]["levels"])) {
    $leaderboard[$user]["levels"][] = $level;
}

// SAVE FILES
$save1 = file_put_contents($demonsFile, json_encode($demons, JSON_PRETTY_PRINT));
$save2 = file_put_contents($leaderboardFile, json_encode($leaderboard, JSON_PRETTY_PRINT));

// FINAL RESPONSE
if ($save1 === false || $save2 === false) {
    echo "Error: Failed to save data";
} else {
    echo "Submission successful!";
}
?>