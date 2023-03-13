<?php include 'cachestart.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Users</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
  <link rel="stylesheet" type="text/css" href="css/Users.css?v=4">
  <script language="JavaScript" type="text/javascript" src="js/jquery-2.2.3.min.js">
    $(window).on("load resize ", function () {
      var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
      $('.tbl-header').css({ 'padding-right': scrollWidth });
    }).resize();
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
	</script>
<script>
		$(document).ready(function () {
			function updateManageUsers() {
				$.ajax({
					url: "home_log_up.php",
				}).done(function (data) {
					$('#home_users').html(data);
				}).fail(function (jqXHR, textStatus, errorThrown) {
					console.log("AJAX error:", textStatus, errorThrown);
				});
			}

			updateManageUsers();
			setInterval(updateManageUsers, 5000);
		});
	</script>
</head>

<body>
  <?php include 'header.php'; ?>
  <main>
    <section>
      <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
      </div>
      <!--User table-->
      <h1 style="margin-top: 2rem;" class="slideInDown animated">Here are all School's Registered Students</h1>

      <div class="tbl-header slideInRight animated">
        <table cellpadding="0" cellspacing="0" border="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Matric No</th>
              <th>Gender</th>
              <th>Finger ID</th>
              <th>Date</th>
            </tr>
          </thead>
        </table>
      </div>
      <div class="tbl-content slideInRight animated">
        <table id="home_users" cellpadding="0" cellspacing="0" border="0">
       
        </table>
      </div>
    </section>
  </main>
  <?php include 'footer.php'; ?>
</body>
</html>
<?php include 'cacheend.php'; ?>