<?php
session_start();
$_SESSION['active-nav'] = 'og list';

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
      <h1 style = "text-align:center">OG List</h1>
      <p style = "text-align:center">All of these are completions from the classic GDH group, completely seperate from the actual list but serves as motivation for the OGs.<br></a></p>
    </div>

    <!-- scripts to include -->
    <?php
      include "scripts/collapsible-js.php";
      include "scripts/og list-js.php";
      include "scripts/dropdown-js.php";
      include "scripts/videoresize-js.php";
      include "scripts/darkbutton-js.php";
    ?>

  </body>
</html>
