<?php
$pages = array('game','website','closed');
$page = '';
if (isset($_GET["page"])) {
	if (in_array($_GET["page"],$pages) != false) $page = $_GET["page"];
	else {
		header("Location: http://" . $_SERVER['HTTP_HOST']);
		die();
	}
}
else $page = 'game';
?>
