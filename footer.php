<?php
$footer_css_file = 'css/footer.css?v=4';

// Check if the user has selected a mode and set the appropriate CSS file
if (isset($_SESSION['mode'])) {
  if ($_SESSION['mode'] == 'light') {
    $footer_css_file = 'css/footer-light.css?v=16';
  }
}

// Handle mode selection
if (isset($_GET['mode'])) {
  if ($_GET['mode'] == 'dark') {
    $_SESSION['mode'] = 'dark';
    $footer_css_file = 'css/footer.css?v=4';
  } elseif ($_GET['mode'] == 'light') {
    $_SESSION['mode'] = 'light';
    $footer_css_file = 'css/footer-light.css?v=16';
  }
}
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="<?php echo $footer_css_file; ?>">
</head>
<body>
    <footer class="footer">
        <div class="footer__addr">
            <h2>Contact</h2>
            <address>
                Afe Babalola University, Ado-Ekiti, Ekiti State.<br><br>
                <span style="color: white;">Email Us</span><br><br>
                <a style="color:#999999; text-decoration: none;" href="mailto:Joshex150@gmail.com">Joshex150@gmail.com</a>
            </address>
        </div>
        <ul class="footer__nav">
            <li class="nav__item">
                <h2 class="nav__title">Media</h2>
                <ul class="nav__ul">
                    <li>
                        <a href="#">Online</a>
                    </li>
                    <li>
                        <a href="#">Print</a>
                    </li>
                    <li>
                        <a href="#">Alternative Ads</a>
                    </li>
                </ul>
            </li>
            <li class="nav__item nav__item--extra">
                <h2 class="nav__title">Technology</h2>
                <ul class="nav__ul">
                    <li>
                        <a href="#">Automation</a>
                    </li>
                    <li>
                        <a href="#">Artificial Intelligence</a>
                    </li>
                    <li>
                        <a href="#">IoT</a>
                    </li>
                </ul>
            </li>
            <li class="nav__item">
                <h2 class="nav__title">Legal</h2>
                <ul class="nav__ul">
                    <li>
                        <a href="#">Privacy Policy</a>
                    </li>
                    <li>
                        <a href="#">Terms of Use</a>
                    </li>
                    <li>
                        <a href="#">Sitemap</a>
                    </li>
                </ul>
            </li>
        </ul>
        <div class="legal">
            <p>&copy; 2023. All rights reserved.</p>
            <div class="legal__links">
                <span>Made by Joshua</span>
            </div>
        </div>
    </footer>
</body>
</html>