<?php
$pages = array('game','website');
if (!isset($_GET["page"]) || in_array($_GET["page"],$pages) == false) die();
if (file_exists('./isclosed')) {
	echo 'closed';
	die();
}
function isSurveyGroupOpen($surveyPagePosition) {
	$column = $surveyPagePosition + 1;
	$xml = file_get_contents('https://spreadsheets.google.com/feeds/cells/1cxCYMQik_bZEyYzhTOk_C3A8uEtdfJ4YV87eEgYI5mI/od6/public/values/R1C' . $column);
	if ($xml) {
		if (strpos($xml,">0</content>") == false) return false;
		}
	return true;
}
$position = array_search($_GET["page"],$pages);
$i = 0;
while ($i < count($pages) && isSurveyGroupOpen($position) == false) {
	$position = ($position+1) % count($pages);
	$i++;
}
if ($i == 0) echo 'open';
elseif ($i == count($pages)) { 
	echo 'closed';
}
else echo $pages[$position];

?>