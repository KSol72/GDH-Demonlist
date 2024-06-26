<?php
session_start();
$_SESSION['active-nav'] = 'extended';

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
    <meta property="og:title" content="GDH Demonlist">
    <meta property="og:description" content="A demon list with demons.">
    <meta name="author" content="ryan9328">
    <meta name="keywords" content="ryan9328,official,geometry,dash,hardest,extreme,insane,demon,list,demonlist,hardest,levels,gmd,gd,typier,game,top,level,levels,player,players,geometry dash, LRR, 60hz, 60HZ, 75hz, 75HZ, geometry dash 60hz demonlist, GD 60hz list">
    <meta name="description" content="A demon list dedicated to low-refresh-rate (60hz, 75hz, Mobile) Geometry Dash players.">
    <title>GDH: Demonlist</title>
    <link href="CSS/levelcards.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link href="CSS/nav.css?v=2021-03-23" rel="stylesheet" type="text/css" />
    <link href="CSS/list.css?v=2020-10-29" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter|Bitter:light,bold">
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
  </head>
  <body class = "<?php echo $themeClass; ?>">

  <?php include "nav.php" ?>
  
    <div id="levels-container"> 
      <h1 style = "text-align:center">Extended Demons List</h1>
      <p style = "text-align:center">All of these levels are still very hard, but they don't quite make the cut for the Top 75. They still award points, though, and basically function the same way as the Main List.<br> Want to submit a record? Submit it <a href = "https://discord.com/channels/701253096004649091/858490324183023646/858492451073425438" target = "_blank">here!</a></p>
    </div>

    <!-- scripts to include -->
    <?php
      include "scripts/collapsible-js.php";
      include "scripts/extended-js.php";
      include "scripts/dropdown-js.php";
      include "scripts/videoresize-js.php";
      include "scripts/darkbutton-js.php";
    ?>

  </body>
</html>
