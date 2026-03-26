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

  <link href="CSS/levelcards.css?v=2021-03-23" rel="stylesheet" />
  <link href="CSS/nav.css?v=2021-03-23" rel="stylesheet" />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

  <style>
    .submit-btn {
      display:block;
      margin:20px auto;
      padding:10px 20px;
      font-size:18px;
      cursor:pointer;
    }

    .modal {
      position:fixed;
      top:0; left:0;
      width:100%; height:100%;
      background:rgba(0,0,0,0.7);
      display:none;
      justify-content:center;
      align-items:center;
      z-index:999;
    }

    .modal-content {
      background:white;
      padding:20px;
      border-radius:10px;
      width:350px;
    }

    .modal-content input,
    .modal-content textarea {
      width:100%;
      margin-bottom:10px;
      padding:6px;
    }
  </style>
</head>

<body class="<?php echo $themeClass; ?>">

<?php include "nav.php" ?>

<!-- SUBMIT BUTTON -->
<button id="openSubmit" class="submit-btn">Submit Record</button>

<!-- MODAL -->
<div id="submitModal" class="modal">
  <div class="modal-content">
    <h2>Submit Record</h2>

    <label>Level Name</label>
    <input list="levelList" id="levelName">
    <datalist id="levelList"></datalist>

    <label>Username</label>
    <input list="userList" id="username">
    <datalist id="userList"></datalist>

    <label>Video URL</label>
    <input type="text" id="videoUrl">

    <label>Comments</label>
    <textarea id="comments"></textarea>

    <button id="submitRecord">Submit</button>
    <button onclick="closeModal()">Cancel</button>
  </div>
</div>

<div id="levels-container"> 
  <h1 style="text-align:center">Gamers Dream House List</h1>
  <p style="text-align:center">Credits to LRR and IDL for code usage :3</p>

  <div class="card">
    <button class="collapsible">
      <div class="title">
        <h2 class="date">These are the rules. Please read them. (CLICK)</h2>
      </div>
    </button>
    <div class="content">
      <h1>Rules</h1>
      <ul>
        <li>No cheats (noclip, botting, etc).</li>
        <li>Must have proof unless trusted.</li>
        <li>Max FPS is 360.</li>
      </ul>

      <h1>Standards</h1>
      <ul>
        <li>No layouts</li>
        <li>Insane demon or higher</li>
      </ul>
    </div>
  </div>
</div>

<!-- YOUR ORIGINAL DEMON LIST SCRIPT -->
<script src="JS/demons.js"></script>

<script>
// ===== LOAD LEVEL AUTOFILL =====
fetch("JS/levellist.json")
.then(res => res.json())
.then(data => {
  let list = document.getElementById("levelList");
  data.levels.forEach(level => {
    let option = document.createElement("option");
    option.value = level;
    list.appendChild(option);
  });
});

// ===== LOAD USER AUTOFILL =====
fetch("JS/leaderboard.json")
.then(res => res.json())
.then(data => {
  let list = document.getElementById("userList");
  Object.keys(data).forEach(user => {
    let option = document.createElement("option");
    option.value = user;
    list.appendChild(option);
  });
});

// ===== MODAL =====
document.getElementById("openSubmit").onclick = () => {
  document.getElementById("submitModal").style.display = "flex";
};

function closeModal() {
  document.getElementById("submitModal").style.display = "none";
}

// ===== SUBMIT =====
document.getElementById("submitRecord").onclick = () => {
  const data = {
    level: document.getElementById("levelName").value,
    user: document.getElementById("username").value,
    video: document.getElementById("videoUrl").value,
    comments: document.getElementById("comments").value
  };

  fetch("submit.php", {
    method: "POST",
    headers: {"Content-Type":"application/json"},
    body: JSON.stringify(data)
  })
  .then(res => res.text())
  .then(msg => {
    alert(msg);
    location.reload();
  });
};
</script>

<?php
include "scripts/collapsible-js.php";
include "scripts/collapsiblebig-js.php";
include "scripts/dropdown-js.php";
include "scripts/videoresize-js.php";
include "scripts/darkbutton-js.php";
?>

</body>
</html>