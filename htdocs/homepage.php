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

    .modal-content input {
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
    <input list="levelList" id="gdh-level" placeholder="Level name..." autocomplete="off">
    <datalist id="levelList"></datalist>

    <label>Username</label>
    <input list="userList" id="gdh-user" placeholder="Your username..." autocomplete="off">
    <datalist id="userList"></datalist>

    <label>Video URL</label>
    <input type="text" id="gdh-video" placeholder="https://youtu.be/...">

    <button id="gdh-submit">Submit</button>
    <button onclick="gdhCloseModal()">Cancel</button>
  </div>
</div>

<!-- MAIN LIST ONLY (NO RULES ANYMORE) -->
<div id="levels-container"></div>

<!-- YOUR ORIGINAL LIST SCRIPT -->
<script src="JS/demons.js"></script>

<script>
// ===== LEVEL AUTOFILL =====
fetch("json-data.php?f=levellist")
  .then(function(r) { return r.json(); })
  .then(function(data) {
    var list = document.getElementById("levelList");
    data.levels.forEach(function(name) {
      var opt = document.createElement("option");
      opt.value = name;
      list.appendChild(opt);
    });
  });

// ===== USER AUTOFILL =====
fetch("json-data.php?f=leaderboard")
  .then(function(r) { return r.json(); })
  .then(function(data) {
    var list = document.getElementById("userList");
    Object.keys(data).forEach(function(name) {
      var opt = document.createElement("option");
      opt.value = name;
      list.appendChild(opt);
    });
  });

// ===== MODAL =====
document.getElementById("openSubmit").onclick = function() {
  document.getElementById("submitModal").style.display = "flex";
};

function gdhCloseModal() {
  document.getElementById("submitModal").style.display = "none";
}

// ===== SUBMIT =====
document.getElementById("gdh-submit").onclick = function() {
  var level = document.getElementById("gdh-level").value.trim();
  var user  = document.getElementById("gdh-user").value.trim();
  var video = document.getElementById("gdh-video").value.trim();

  if (!level || !user || !video) {
    alert("Please fill in all fields.");
    return;
  }

  fetch("submit.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ level: level, user: user, video: video })
  })
  .then(function(r) { return r.text(); })
  .then(function(msg) {
    alert(msg);
    if (msg === "Submission successful!") {
      gdhCloseModal();
      location.reload();
    }
  })
  .catch(function() {
    alert("Network error. Please try again.");
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