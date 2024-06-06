<?php
session_start();
$_SESSION['active-nav'] = 'index';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta property="og:title" content="Gamers Dream House List">
    <meta property="og:description" content="A private server list consisting of Extreme Demons, Insane Demons and Platformer Levels.">
    <title>GDH: Demonlist</title>
  <link href="CSS/levelcards.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link href="CSS/nav.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link href="CSS/list.css?v=2020-10-29" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter|Bitter:light,bold">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
  </head>
  <body>
    <!--<body style="background-color:white;">-->
      
    <?php include "nav.php" ?>

    <!-- <p><a href = "leaderboard.html">Leaderboard page</a></p>
    <p><a href = "Extendedlist.html">Extended page</a></p> -->
    <div id="levels-container"> 
      <h1 style = "text-align:center">Main List</h1>
            <p style = "text-align:center">All of these levels are very hard, and award points for completions!<br> Want to submit a record? Submit it <a href = "https://discord.com/channels/701253096004649091/858490324183023646/858492451073425438" target = "_blank">here!</a></p>
    </div>

    <!-- scripts to include -->
    <?php
      include "scripts/dropdown-js.php";
      include "scripts/demons-js.php";
      include "scripts/collapsible-js.php";
      include "scripts/videoresize-js.php";
      include "scripts/darkbutton-js.php";
    ?>

  </body>
</html>
