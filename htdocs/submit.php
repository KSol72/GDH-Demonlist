<?php
$data = json_decode(file_get_contents("php://input"), true);

$level = trim($data["level"]);
$user = trim($data["user"]);
$video = trim($data["video"]);

if(!$level || !$user || !$video){
    echo "Missing fields!";
    exit;
}

$demons = json_decode(file_get_contents("JS/demons.json"), true);
$leaderboard = json_decode(file_get_contents("JS/leaderboard.json"), true);

// VALIDATE LEVEL EXISTS
if(!isset($demons[$level])){
    echo "Level not found!";
    exit;
}

// PREVENT DUPLICATE
foreach($demons[$level]["list"] as $entry){
    if($entry["name"] === $user){
        echo "Already submitted!";
        exit;
    }
}

// ADD TO DEMONS.JSON
$demons[$level]["list"][] = [
    "name" => $user,
    "link" => $video
];

// CREATE USER IF NEEDED
if(!isset($leaderboard[$user])){
    $leaderboard[$user] = [
        "nationality" => "Unknown",
        "levels" => [],
        "progs" => ["none"]
    ];
}

// ADD LEVEL TO USER
if(!in_array($level, $leaderboard[$user]["levels"])){
    $leaderboard[$user]["levels"][] = $level;
}

// SAVE FILES
file_put_contents("JS/demons.json", json_encode($demons, JSON_PRETTY_PRINT));
file_put_contents("JS/leaderboard.json", json_encode($leaderboard, JSON_PRETTY_PRINT));

echo "Submission successful!";
?>