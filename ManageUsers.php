<?php include 'cachestart.php'; ?>
<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: Content-Type");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title>Manage Users</title>
	<link rel="stylesheet" type="text/css" href="css/manageusers.css?v=9">
	<script language="JavaScript" type="text/javascript" src="js/jquery-2.2.3.min.js">
		$(window).on("load resize ", function () {
			var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
			$('.tbl-header').css({ 'padding-right': scrollWidth });
		}).resize();
	</script>
	<script src="https://code.jquery.com/jquery-3.3.1.js"
		integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous">
	</script>
	<script src="js/jquery-2.2.3.min.js"></script>
	<script src="js/manage_users.js"></script>
	<script>
		$(document).ready(function () {
			function updateManageUsers() {
				$.ajax({
					url: "manage_users_up.php",
				}).done(function (data) {
					$('#manage_users').html(data);
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

	<main style="margin-bottom: 20px;">
		<section>
			<div class="background">
				<div class="shape"></div>
				<div class="shape"></div>
			</div>
			<h1 style="margin-top: 2rem;" class="slideInDown animated">Add, update or remove student information</h1>
			<div class="block">
				<div class="form-style-5 slideInDown animated">
					<div class="alert"><label id="alert"></label></div>
					<form>
						<fieldset>
							<legend><span class="number">1</span> User Fingerprint ID:</legend>
							<label>Enter Fingerprint ID between 1 & 127:</label>
							<input type="number" name="fingerid" id="fingerid" placeholder="User Fingerprint ID...">
							<button type="button" name="fingerid_add" class="fingerid_add">Add Fingerprint ID</button>
						</fieldset>
						<fieldset>
							<legend><span class="number">2</span> User Info</legend>
							<input type="text" name="name" id="name" placeholder="User Name...">
							<input type="text" name="number" id="number" placeholder="Matric Number...">
							<input type="email" name="email" id="email" placeholder="User Email...">
						</fieldset>
						<fieldset>
							<legend><span class="number">3</span> Additional Info</legend>
							<label>
								Time In:
								<input type="time" name="timein" id="timein" value="00:00:00">
								<input type="radio" name="gender" class="gender" value="Female">Female
								<input type="radio" name="gender" class="gender" value="Male" checked="checked">Male
							</label>
						</fieldset>
						<button type="button" name="user_add" class="user_add">Add User</button>
						<button type="button" name="user_upd" class="user_upd">Update User</button>
						<!-- <button type="button" name="user_rmo" class="user_rmo">Remove User</button> -->
						<button id="myBtn">Remove User</button>
					</form>

				</div>
				<div class="section">
					<div class="tbl-header slideInRight animated">
						<table cellpadding="0" cellspacing="0" border="0">
							<thead>
								<tr>
									<th>ID</th>
									<th>Name</th>
									<th>Gender</th>
									<th>Matric No</th>
									<th>Date</th>
									<!-- <th>Time in</th> -->
								</tr>
							</thead>
						</table>
					</div>
					<div class="tbl-content slideInRight animated">
						<table cellpadding="0" cellspacing="0" border="0">
							<div id="manage_users"></div>
						</table>
					</div>
				</div>
				<?php include 'popup.php'; ?>
			</div>
		</section>
	</main>
	
</body>
<?php include 'footer.php'; ?>
<script>
	window.onsubmit = function (event) {
		event.preventDefault()
	}
</script>

</html>
<?php include 'cacheend.php'; ?>