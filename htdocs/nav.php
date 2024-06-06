<ul class="nav">
  <li class="redir"><a class="nav-buttons <?php if($_SESSION['active-nav'] == "changelog"){echo 'active-nav-item';}?>" href="https://gdhplatformers.hpsk.me/index.php">Platformers</a></li>
    <li class="redir"><a class="nav-buttons <?php if($_SESSION['active-nav'] == "leaderboard"){echo 'active-nav-item';}?>" href="leaderboard.php">Leaderboard</a></li>
    <li class="redir"><a class="nav-buttons <?php if($_SESSION['active-nav'] == "legacy"){echo 'active-nav-item';}?>" href="legacy.php">Legacy List</a></li>
    <li class="redir"><a class="nav-buttons <?php if($_SESSION['active-nav'] == "extended"){echo 'active-nav-item';}?>" href="extended.php">Extended List</a></li>
    <li class="redir"><a class="nav-buttons <?php if($_SESSION['active-nav'] == "index"){echo 'active-nav-item';}?>" href="index.php">Main List</a></li>
    <li class="titlebox"><a href="homepage.php" class="titlebox-href">GDH: Demonlist</a></li>
    <li>
    <button onclick="dropMenu()" class="dropbtn">Go To...</button>
        <div id="myDropdown" class="dropdown-content">
            <a class="nav-buttons <?php if($_SESSION['active-nav'] == "index"){echo 'active-nav-item';}?>" href="index.php">Main List</a>
            <a class="nav-buttons <?php if($_SESSION['active-nav'] == "extended"){echo 'active-nav-item';}?>" href="extended.php">Extended List</a>
            <a class="nav-buttons <?php if($_SESSION['active-nav'] == "legacy"){echo 'active-nav-item';}?>" href="legacy.php">Legacy List</a>
            <a class="nav-buttons <?php if($_SESSION['active-nav'] == "leaderboard"){echo 'active-nav-item';}?>" href="leaderboard.php">Leaderboard</a>
    <a class="nav-buttons <?php if($_SESSION['active-nav'] == "platformerlist"){echo 'active-nav-item';}?>" href="https://gdhplatformers.hpsk.me/">Platformers</a>
</div>
    </li>
</ul>
