<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
  ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <link rel="stylesheet" type="text/css" href="css/header.css?v=16">
  </head>

  <div class="nav">
  <input type="checkbox" id="nav-check">
  <div class="nav-header">
    <div class="nav-title">
      <img src="images/logo.png" alt="" width="25.8px" height="30px">
    </div>
  </div>
  <span style="color: white; position: absolute; top: 22.5px;">Hello, <?php echo $_SESSION['username']; ?></span>
  <div class="nav-btn">
    <label for="nav-check">
      <span></span>
      <span></span>
      <span></span>
    </label>
  </div>
  
  <div class="nav-links">
    <a class="nav-link" href="home.php">Students</a>
    <a class="nav-link" href="UsersLog.php">Attendance log</a>
    <a class="nav-link" href="ManageUsers.php">Admin</a>
    <a class="nav-link" href="logout.php">Logout</a>
  </div>
</div>

<?php
} else {

  header("Location: index.php");

  exit();

}
?>
</html>