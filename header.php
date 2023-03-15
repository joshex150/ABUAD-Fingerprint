<?php
session_start();

$css_file = 'css/header.css?v=16';

// Check if the user has selected a mode and set the appropriate CSS file
if (isset($_SESSION['mode'])) {
  if ($_SESSION['mode'] == 'light') {
    $css_file = 'css/header-light.css?v=16';
  }
}

// Handle mode selection
if (isset($_GET['mode'])) {
  if ($_GET['mode'] == 'dark') {
    $_SESSION['mode'] = 'dark';
    $css_file = 'css/header.css?v=16';
  } elseif ($_GET['mode'] == 'light') {
    $_SESSION['mode'] = 'light';
    $css_file = 'css/header-light.css?v=16';
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo $css_file; ?>">
</head>

<div class="nav">
  <input type="checkbox" id="nav-check">
  <div class="nav-header">
    <div class="nav-title">
      <a href="/home.php"><img src="images/logo.png" alt="" width="25.8px" height="30px"></a>
    </div>
  </div>
  <span class="username">Hello,
    <?php echo $_COOKIE['username']; ?>
  </span>
  <div class="nav-btn">
    <label for="nav-check">
      <span></span>
      <span></span>
      <span></span>
    </label>
  </div>

  <div class="nav-links">
    <?php

    $ye = '?mode=dark';
    $ey = 'Dark mode<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>';
    if (isset($_SESSION['mode'])) {

      if ($_SESSION['mode'] == 'light') {
        $ye = '?mode=dark';
        $ey = 'Dark mode<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>';
      }
      if ($_SESSION['mode'] == 'dark') {
        $ye = '?mode=light';
        $ey = 'Light mode<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>';
      }
    } else {
      $ye = '?mode=light';
      $ey = 'Light mode<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>';
    }

    if (isset($_GET['mode'])) {
      if ($_GET['mode'] == 'dark') {
        $ye = '?mode=light';
        $ey = 'Light mode<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>';
      } elseif ($_GET['mode'] == 'light') {
        $ye = '?mode=dark';
        $ey = 'Dark mode<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>';
      }
    }
    ?>

    <a class="nav-link" href="home.php">Students</a>
    <a class="nav-link" href="UsersLog.php">Attendance Log</a>
    <?php if ($_COOKIE['username'] == "admin") {
      echo '<a class="nav-link" href="ManageUsers.php">Manage Students</a>';
    } else {

    }
    ?>
    <a class="nav-link" href="logout.php">Logout</a>
    <a class="nav-link" href="<?php echo $ye; ?>"><?php echo $ey; ?></a>
  </div>
</div>

</html>