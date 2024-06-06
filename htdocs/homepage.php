<?php
session_start();
$_SESSION['active-nav'] = 'homepage';

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
    <title>Gamers Dream House List</title>
    <meta property="og:title" content="Gamers Dream House List">
    <meta property="og:description" content="A private server list consisting of Extreme Demons, Insane Demons and Challenges.">
    <meta name="author" content="ryan9328">
    <meta name="keywords" content="ryan9328,official,geometry,dash,hardest,extreme,insane,demon,list,demonlist,hardest,levels,gmd,gd,typier,game,top,level,levels,player,players,geometry dash, LRR, 60hz, 60HZ, 75hz, 75HZ, geometry dash 60hz demonlist, GD 60hz list">
    <meta name="description" content="A demon list dedicated to low-refresh-rate (60hz, 75hz, Mobile) Geometry Dash players.">
    <link href="CSS/levelcards.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link href="CSS/nav.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter|Bitter:light,bold">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <style>
      p{
        font-weight:normal;
      }
    </style>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
  </head>
  <body>
    
  <?php include "nav.php" ?>
    <!-- <p><a href = "leaderboard.html">Leaderboard page</a></p>
    <p><a href = "Extendedlist.html">Extended page</a></p> -->
    <div id="levels-container"> 
      <h1 style = "text-align:center">Gamers Dream House List</h1>
        <p style = "text-align:center">Credits to LRR and IDL for code usage :3</p>
        <div class = "card">
          <button class = "collapsible">
            <div class = "title">
              <h2 class = "date">These are the rules.  Please read them.</h2>
            </div>
          </button>
          <div class = "content">
            <h1>Rules</h1>
            <ul>
              <li>Do not use any cheats such as Noclip, Speedhack, Hitboxes, Botting software, and whatever that will obviously get you banned from the list.</li>
              <li>Must have proof you beat a level. Unless you are trustworthy or had a List Editor witness it.</li>
              <li>The highest frame rate you can go is 360FPS.</li> </ul> 
            <h1>Standards</h1>
              <ul>
              <li>Unrated levels can get onto the list if it has had effort put into it, or is a known level (e.g Haymaker)</li>
              <li>No undecorated layouts.</li>
              <li>Has to be considered Insane Demon or higher.</li>
            </ul>
            </ul>
          </div>
        </div>
      </div>
            </div>
        </div>
      </div>
    </div>
        </div>
      </div>
    </div>

    <!-- scripts to include -->
    <?php
      include "scripts/collapsible-js.php";
      include "scripts/collapsiblebig-js.php";
      include "scripts/dropdown-js.php";
      include "scripts/videoresize-js.php";
      include "scripts/darkbutton-js.php";
    ?>


  </body>
</html>
