<html>
  <head>
    <title>Emerson School Nature Center Handbook - Tim's Control Panel</title>
    <link rel="stylesheet" href="page.css" type="text/css">
  </head>
  <body>
    <iframe src="navigator.html"></iframe>
    <h1>User Control Panel - Tim only!</h1>
    <?php if (!isset($_COOKIE['tim'])) {
      echo "<p>You are not Tim! Go away! You may not control the users!</p><!--";
    } ?>
    <form action="useraction.php" method="POST">
      <h3>Add new user</h3><br>
      <input type="hidden" name="action" value="adduser">
      <p>
      New password: <input type="text" name="password"><br>
      Can add pages: <input type="checkbox" name="canadd" value="true"><br>
      Can edit pages: <input type="checkbox" name="canedit" value="true"><br>
      Can delete pages: <input type="checkbox" name="candelete" value="true"><br>
      <input type="submit" value="Add User">
      </p>
    </form>
    <?php if (!isset($_COOKIE['tim'])) {
      echo "-->";
    } ?>
  </body>
</html>
