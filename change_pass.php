<?php include 'cachestart.php';
if (isset($_COOKIE['course'])) {
  header("Location: home.php");
  exit();
}
session_start();

$version = time();

$css_url = "css/omega.css";
$css_url_with_version = $css_url . "?v=" .$version;
$UsersLog_css_file = $css_url_with_version;

$css_url = "css/omega-light.css";
$css_url_with_version_light = $css_url . "?v=" .$version;
$UsersLog_css_file_light = $css_url_with_version_light;

$login_css_file = $UsersLog_css_file;

// Check if the user has selected a mode and set the appropriate CSS file
if (isset($_SESSION['mode'])) {
  if ($_SESSION['mode'] == 'light') {
    $login_css_file = $UsersLog_css_file_light;
  }
}

// Handle mode selection
if (isset($_GET['mode'])) {
  if ($_GET['mode'] == 'dark') {
    $_SESSION['mode'] = 'dark';
    $login_css_file = $UsersLog_css_file;
  } elseif ($_GET['mode'] == 'light') {
    $_SESSION['mode'] = 'light';
    $login_css_file = $UsersLog_css_file_light;
  }
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Change Password</title>
  <link rel="stylesheet" type="text/css" href="<?php echo $login_css_file; ?>" />
  <link rel="icon" type="image/x-icon" href="images/logo.ico">
  <meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=0.5">
</head>

<body>
  <main>
    <section>
      <?php

      $ye = '?mode=dark';
      $ey = '<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>';
      if (isset($_SESSION['mode'])) {

        if ($_SESSION['mode'] == 'light') {
          $ye = '?mode=dark';
          $ey = '<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>';
        }
        if ($_SESSION['mode'] == 'dark') {
          $ye = '?mode=light';
          $ey = '<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>';
        }
      } else {
        $ye = '?mode=light';
        $ey = '<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>';
      }

      if (isset($_GET['mode'])) {
        if ($_GET['mode'] == 'dark') {
          $ye = '?mode=light';
          $ey = '<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="5"></circle><line x1="12" y1="1" x2="12" y2="3"></line><line x1="12" y1="21" x2="12" y2="23"></line><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line><line x1="1" y1="12" x2="3" y2="12"></line><line x1="21" y1="12" x2="23" y2="12"></line><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line></svg>';
        } elseif ($_GET['mode'] == 'light') {
          $ye = '?mode=dark';
          $ey = '<svg stroke="currentColor" style="vertical-align: super;" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4" height="1em" width="1em" xmlns="http://www.w3.org/2000/svg"><path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path></svg>';
        }
      }
      ?>
      <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
      </div>
      <a style="text-decoration: none; position: absolute; right: 10px; top: 10px;" class="mode-index" href="<?php echo $ye; ?>"><?php echo $ey; ?></a>
      <form action="new_pass.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
          <p style="text-align: center" class="error">
            <?php echo $_GET['error']; ?>
          </p>
        <?php } ?>
        <h3>Change password</h3>

        <label for="username">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required="" />
        
        <label for="password">Confirm Password</label>
        <input type="password" placeholder="Confirm Password" id="confpassword" name="confpassword" required="" />

        <button title="" id="change" name="change" type="submit" data-original-title="Click Here to Sign In">
          Change password
        </button>
      </form>
    </section>
  </main>
</body>

</html>
<?php include 'cacheend.php'; ?>