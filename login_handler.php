<?php
include("sql.inc");
$path = '/';
if ($_SERVER['QUERY_STRING'] == "init") {
  $db->exec('DROP TABLE passwords');
  $db->exec('CREATE TABLE passwords (id INTEGER PRIMARY KEY, password STRING, canadd BOOLEAN, canedit BOOLEAN, candelete BOOLEAN, istim BOOLEAN, entyear INT, entgrade INT)');
  $db->exec('INSERT INTO passwords (id, password, canadd, canedit, candelete, istim) VALUES (NULL, "thisistimw", 1, 1, 1, 1)');
}
if ($_SERVER['QUERY_STRING'] == "logout") {
  if (headers_sent()) {
    trigger_error("Cant change cookies", E_USER_NOTICE);
  }
  //while (isset($_COOKIE['userid'])) {
  setcookie("userid", $_COOKIE['userid'], time() - 3600, $path);
  setcookie("userperms", $_COOKIE['userperms'], time() - 3600, $path);
  if (isset($_COOKIE['tim'])) setcookie("tim", $_COOKIE['tim'], time() - 3600, $path);
  //}
  //header("Location: index.html");
}
else {
$result = $db->querySingle('SELECT password FROM passwords', true);
$passfound = false;
$final_i = 0;
$i = 0;
foreach ($result as $onepass) {
  if ($_POST['password'] == $onepass) {
    $passfound = true;
    $final_i = $i+1;
    break;
  }
  $i++;
}
if (end($result) == $onepass && $passfound == false) {$final_i = $i + 1; $passfound = true;}
if ($passfound == false || $final_i == 0) die("You have entered an invalid password. Please go back and try again. Last ID checked: " . $i);
$user = $db->querySingle('SELECT canadd, canedit, candelete, istim FROM passwords WHERE id='.$final_i, true);
$perms = 0;
if ($user['canadd'] == 1) $perms = 1;
if ($user['canedit'] == 1) $perms = $perms + 2;
if ($user['candelete'] == 1) $perms = $perms + 4;
$time = time() + 3600;
if (headers_sent()) {
  trigger_error("Cant change cookies", E_USER_NOTICE);
}
if ($user['istim'] == 1) {setcookie("tim", "istim", $time, $path);}
setcookie("userperms", $perms, $time, $path);
setcookie("userid", $final_i, $time, $path);
header("Location: index.html"); /* Redirect browser */
exit();
}
?>
<html>
  <head>
    <title>Logging you into the Emerson Nature Center Handbook...</title>
    <script>if (location.search = "logout") {document.cookie = ""; location.pathname = "index.php?done";}</script>
  </head>
  <body>
    Please wait...
  </body>
</html>
