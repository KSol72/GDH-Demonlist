<?php
session_start();
$_SESSION['active-nav'] = 'leaderboard';

$themeClass = '';
if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] == 'dark') {
  $themeClass = 'dark-theme';
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta property="og:title" content="Gamers Dream House List">
    <meta property="og:description" content="A private server list consisting of Extreme Demons, Insane Demons and Challenges.">
    <meta name="author" content="ryan9328">
    <meta name="keywords" content="ryan9328,official,geometry,dash,hardest,extreme,insane,demon,list,demonlist,hardest,levels,gmd,gd,typier,game,top,level,levels,player,players,geometry dash, LRR, 60hz, 60HZ, 75hz, 75HZ, geometry dash 60hz demonlist, GD 60hz list">
    <meta name="description" content="A demon list with insane demons instead of extreme demons."">
    <title>GDH: Leaderboard</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <link href="CSS/levelcards.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link href="CSS/nav.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link href="CSS/leaderboard.css?v=2021-04-17" rel="stylesheet" type="text/css" />
    <link href="CSS/playercards.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter|Bitter:light,bold">
   <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
  </head>
  <body>
    
  <?php include "nav.php" ?>
  
    <div id="leaderboard" style = "text-align:center"> 
      <h1>Points Leaderboard</h1>
      <p>Click on a player's name to view their records.</p>
    </div>

    <!-- scripts to include -->
    <?php
      include "scripts/leaderboardcalc-js.php";
      include "scripts/dropdown-js.php";
    ?>

  </body>
</html>
