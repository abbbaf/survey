<?php
$servers = array("http://my-research.ga");
$mainServerFile = "./mainServer"
$count = count($servers);
$mainServer = file_get_contents($mainServerFile);
$isNewFile = false;
if ($mainServer == false) $isNewFile = file_put_contents($mainServerFile,0);
if ($isNewFile || (!$isNewFile && (time() - filemtime($mainServerFile)) < 300000)) {
	$i = $mainServer;
	do {
		if (file_get_contents($servers[$i] . "/isup") != false) {
			echo $servers[$i] . "/" . STDIN;
			if ($i != $mainServer) file_put_contents($mainServerFile,$i);
			break;
		}
		$i = ($i + 1) % $count;
	} while ($i != $mainServer);
}
echo STDIN;

?>