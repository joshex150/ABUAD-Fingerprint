<?php include 'cachestart.php';
session_start();

$version = time();

$css_url = "css/userslog.css";
$css_url_with_version = $css_url . "?v=" .$version;
$UsersLog_css_file = $css_url_with_version;

$css_url = "css/userslog-light.css";
$css_url_with_version_light = $css_url . "?v=" .$version;
$UsersLog_css_file_light = $css_url_with_version_light;

// Check if the user has selected a mode and set the appropriate CSS file
if (isset($_SESSION['mode'])) {
  if ($_SESSION['mode'] == 'light') {
    $UsersLog_css_file = $UsersLog_css_file_light;
  }
}

// Handle mode selection
if (isset($_GET['mode'])) {
  if ($_GET['mode'] == 'dark') {
    $_SESSION['mode'] = 'dark';
    $UsersLog_css_file = $css_url_with_version;
  } elseif ($_GET['mode'] == 'light') {
    $_SESSION['mode'] = 'light';
    $UsersLog_css_file = $UsersLog_css_file_light;
  }
}
if(!isset($_COOKIE['username'])){
  header("Location: index.php");
  exit();
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Users Logs</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" type="text/css" href="<?php echo $UsersLog_css_file; ?>">
  <link rel="icon" type="image/x-icon" href="images/logo.ico">
  <script language="JavaScript" type="text/javascript" src="js/jquery-2.2.3.min.js">
    $(window).on("load resize ", function () {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({ 'padding-right': scrollWidth });
    }).resize();
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
    crossorigin="anonymous">
    </script>
  <script src="js/jquery-2.2.3.min.js"></script>
  <script src="js/user_log.js"></script>
  <script>
  $(document).ready(function () {
    var previousData = '';
    $.ajax({
      url: "user_log_up.php",
      type: 'POST',
      data: {
        'select_date': 1,
      },
      success: function (data) {
        previousData = data;
        $('#userslog').html(previousData);
      }
    });
    setInterval(function () {
      $.ajax({
        url: "user_log_up.php",
        type: 'POST',
        data: {
          'select_date': 0,
        }
      }).done(function (data) {
        if (data !== previousData) {
          previousData = data;
          $('#userslog').html(previousData);
        }
      });
    }, 5000);
  });
</script>


<body>
  <?php include 'header.php'; ?>
  <main>
    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    <section>
      <!--User table-->
      <h1 style="margin-top: 2rem;" class="slideInDown animated">Here are
        <?php echo $_COOKIE['course']; ?>'s daily Attendance
      </h1>
      <div class="form-style-5 slideInDown animated">
        <form method="POST" action="Export_Excel.php" >
          <input type="date" name="date_sel" id="date_sel" placeholder="dd-mm-yyyy">
          <button type="button" name="user_log" id="user_log">Select Date</button>
        </form>
        <button class="myBtn" id="myBtn">Export to Excel</button>
        <!-- <button type="buttom" name="To_Excel" >Export to Excel</button> -->
      </div>
      <div class="tbl-header slideInRight animated">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>ID | Name</th>
              <th>Matric No.</th>
              <th>Date</th>
              <th>Time In</th>
              <th>Time Out</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tbl-content slideInRight animated">
        <div id="userslog"></div>
      </div>
    </section>
    <?php include 'popup.php'; ?>
  </main>
  <?php include 'footer.php'; ?>
</body>

</html>
<?php include 'cacheend.php'; ?>