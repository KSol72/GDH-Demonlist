<?php
session_start();
$_SESSION['active-nav'] = 'legacy';

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
    <meta name="author" content="KSol">
    <meta name="keywords" content="gdhdemonlist,official,geometry,dash,hardest,extreme,insane,demon,list,demonlist,hardest,levels,gmd,gd,typier,game,top,level,levels,player,players, 60hz, 60HZ, 75hz, 75HZ,,">
    <meta name="description" content="A demon list dedicated to GDH Members.">
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
      <h1 style = "text-align:center">Legacy List</h1>
      <p style = "text-align:center">Levels that once were hard enough to make the top 200, but have since fallen from grace. We will NOT add new levels to this list but you can still submit records <a href = "https://discord.com/channels/701253096004649091/858490324183023646/858492451073425438" target = "_blank">here.</a> although they wont award any List Points.</p>
    </div>

    <!-- scripts to include -->
    <?php
      include "scripts/collapsible-js.php";
      include "scripts/legacy-js.php";
      include "scripts/dropdown-js.php";
      include "scripts/videoresize-js.php";
      include "scripts/darkbutton-js.php";
    ?>

  </body>
</html>
