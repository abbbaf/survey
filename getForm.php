<?php 
$curl = curl_init();
if (!$curl) die("Failed");
$url = $_GET["url"];
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$headers = getallheaders();
$newHeaders = array();
foreach ($headers as $header => $data) {
	if ($header == "Host") $newHeaders[] = $header . ": " . parse_url($url,PHP_URL_HOST); 
	else $newHeaders[] = $header . ": " . $data;
}
curl_setopt($curl, CURLOPT_HTTPHEADER, $newHeaders);
$result = curl_exec($curl);
curl_close($curl);
if ($result) echo $result;
else echo "No data";
?>