<?php
require_once 'getpage.php';
if (isset($_GET["t"]) && is_numeric($t = $_GET["t"]) && strlen($t) < 10) file_put_contents('../files/time',date("H:i:s    j/m/Y") . " : " . $_GET["t"] . "\n",FILE_APPEND);
$url = ($page == "game") ? "https://docs.google.com/forms/d/e/1FAIpQLScb5vmaLZvwMJqzSuMAh395DxJ4fjUEmsGuzZqnZhzodNUraQ/viewform?embedded=true" : "https://docs.google.com/forms/d/e/1FAIpQLSfLQjWRADGK-7lSuclDHlsxmgMNAW0m4hP3zn8eA6nNX4V1Yw/viewform?embedded=true";
setcookie("a","true",time()+60*60*24,"/"); 
setcookie("start","remove",1,"/");
header("Location: " . $url);
?>