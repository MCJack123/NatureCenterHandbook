<?php
include "sql.inc";
if (is_empty($_GET["id"])) header("Location: index.php");
else $db->exec("DELETE * FROM deleted WHERE id=".$_GET["id"]);
header("Location: control_panel.php");
?>
