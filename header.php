<?php
// Session is automatically incorporated into each page on the site.
// Start new session.
    ini_set('session.gc_maxlifetime', 60 * 60 * 6);
    session_start();
?>

<html>
  <head>
    <meta content="text/html;charset=utf-8" http-equiv="Content-Type">
    <meta content="utf-8" http-equiv="encoding">
    <link rel="stylesheet" type="text/css" href="/css/header.css">
  </head>

  <nav>
    <a class="logo" href="/">soapbox</a>
	
  <?php
    if (!(isset($_SESSION['logged_in_user']))) {
  ?>
			<ul>
        <li>
          <a class="header" href="signup.php">Register | </a>
          <a class="header" href="login.php">Login</a>
          <a class="header blog-link" href="blog.php">Blog</a>
        </li>
      </ul>

  <?php
		} elseif ($_SESSION['logged_in_user'] == TRUE) {
  ?>
		    <ul>
            <li>
              <a class="header" href="logout.php">Logout</a>
              <a class="header" href="/channel.php"><?php echo $_SESSION['username']; ?></a>
              <a class="header" href="/main.php"> Home</a>
              <a class="header" href="/account_settings.php"> Account Settings</a>
              <a class="header" href="/upload.php"> Upload</a>
              <a class="header blog-link" href="/blog.php"> Blog</a>
              <form action="search.php" method="GET"><input type="text" name="search" placeholder="Find a video..."></form>
            </li>
        </ul>
  <?php
		}
	?>
  </nav>
</html>
