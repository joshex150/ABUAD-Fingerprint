<?php include 'cachestart.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <title>Login</title>
  <link rel="stylesheet" type="text/css" href="css/omega.css?v=2" />
</head>

<body>
  <main>
    <section>
      <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
      </div>
      <form action="login.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
          <p style="text-align: center" class="error">
            <?php echo $_GET['error']; ?>
          </p>
        <?php } ?>
        <h3>Login Here</h3>

        <label for="username">Username</label>
        <input placeholder="Email or Phone" type="text" id="username" name="username" required="" />

        <label for="password">Password</label>
        <input type="password" placeholder="Password" id="password" name="password" required="" />

        <button title="" id="signin" name="login" type="submit" data-original-title="Click Here to Sign In">
          Log In
        </button>
      </form>
    </section>
  </main>
</body>

</html>
<?php include 'cacheend.php'; ?>