<html>
<?php
include 'sql.inc';
?>
<head>
<title>The Emerson Nature Center Official Handbook - Home</title>
<link rel="stylesheet" href="page.css" type="text/css">
<iframe src="navigator.php?header=Welcome%20to%20the%20Handbook%21"></iframe>
</head>
<body>
<script>
if(!("<?='hello';?>"=="hello")){
document.write("<font color='red'>PHP is not installed!  That may cause some problems when viewing this site.  Please contact the system administrator of this site.</font>");
}
</script><!--check if php is on the server-->
<p>This is a handbook for students and by students to help eduacate people on the plants found in the Nature Center! There are already many different descriptions here, but if you would like to add your own descriptions, you can submit a request by clicking the "upload" button. Tim will review the entry, and it will be posted as soon as possible (if approved)! Please feel free to explore using the "view" page. </p>
<center><h2><font style="font-family: 'Trebuchet MS'; color: green;">Table of Contents</font></h2></center>
    <ul>
    <?php
$search = " ";
$query = 'SELECT id FROM handbook WHERE title LIKE "%'.$search.'%"OR entry LIKE "%'.$search.'%"';
$results = $db->query($query);
$result = $results->fetchArray(SQLITE3_NUM);
while ($result) {echo '<li><a href="view.php?id='.$result[0].'">' . $db->querySingle("SELECT title FROM handbook WHERE id=" . $result[0]) . '</a></li>'; $result = $results->fetchArray(SQLITE3_NUM);}
    ?>
    </ul>
<?php include 'cp.php'; ?>
</body>
</html>
