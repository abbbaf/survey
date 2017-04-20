<?php
require_once 'getpage.php';
function outputHTML($text) {
	$find = array('/^/i','/$/i',"/\r\n\r\n/i","/\r\n/i",'/$/i');
	$replace = array('<p>','</p>','</p><p>','<br />','</p>');
	return preg_replace($find,$replace,$text);
}
if ($page == 'closed') { ?>
	<!DOCTYPE html>
	<html lang="heb">
	<head>
    <meta charset="utf-8">
	</head>
	<body dir="rtl">
	<h1>המחקר הסתיים, תודה.</h1>
	</body>
	</html>
<?php
	die();
}
$maxTime = 60000;
$displayAdAfter = 10000;
$displayAdDuration = 10000;
$duration = isset($_GET["settime"]) ? $_GET["settime"] : $maxTime;
$showAd = true;

$iframeURL = "";
$text = "";
$flash = false;
$ad = isset($_COOKIE["a"]) ? "https://s3.postimg.io/69t9jx9ub/image.jpg" : "http://img.mako.co.il/2016/08/15/Banner_last-call_960x48_02.jpg";

if ($page == "game") {
    $iframeURL = "http://www.vins.co.il/uploads/gamesswf/Diff.swf";
    $text = '<p>&#1492;&#1502;&#1495;&#1511;&#1512; &#1499;&#1493;&#1500;&#1500; &#1513;&#1504;&#1497; &#1513;&#1500;&#1489;&#1497;&#1501;: &#1489;&#1513;&#1500;&#1489; &#1492;&#1512;&#1488;&#1513;&#1493;&#1503; &#1506;&#1500;&#1497;&#1497;&#1498; &#1500;&#1513;&#1495;&#1511; &#1489;&#1502;&#1513;&#1495;&#1511; "&#1502;&#1510;&#1488; &#1488;&#1514; &#1492;&#1492;&#1489;&#1491;&#1500;&#1497;&#1501;" &#1500;&#1502;&#1513;&#1498; &#1491;&#1511;&#1492;.  &#1489;&#1514;&#1493;&#1501; &#1492;&#1491;&#1511;&#1492; &#1497;&#1493;&#1508;&#1497;&#1506; &#1489;&#1488;&#1493;&#1508;&#1503; &#1488;&#1493;&#1496;&#1493;&#1502;&#1496;&#1497; &#1492;&#1513;&#1488;&#1500;&#1493;&#1503; &#1492;&#1502;&#1493;&#1504;&#1492; 10 &#1513;&#1488;&#1500;&#1493;&#1514; &#1511;&#1510;&#1512;&#1493;&#1514;.</p><p>&#1514;&#1493;&#1491;&#1492; &#1506;&#1489;&#1493;&#1512; &#1513;&#1497;&#1514;&#1493;&#1507; &#1492;&#1508;&#1506;&#1493;&#1500;&#1492;</p><button type="button" onclick="start();" id="button">&#1500;&#1502;&#1513;&#1495;&#1511;</button>';
    $flash = true;
}
else {
    $iframeURL = "http://www.food-photography.co.il";
    $text = '<p>המחקר כולל שני שלבים:</p>
<p style="margin-right:10%">בשלב הראשון עלייך לנווט באתר הנוכחי למשך דקה. (האתר הוא חלק מהמחקר)</p>
<p style="margin-right:10%">בתום הדקה יופיע באופן אוטומטי שאלון המונה 10 שאלות קצרות</p>
<button type="button" onclick="start();" id="button">הבנתי, ברצוני להתחיל</button>';
}
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html lang="heb">
<head>
    <meta charset="utf-8">
    <?php if ($flash) { ?>
        <script>
			function stopLoading() {
				window.stop(); //works in all browsers but IE
                if ($.browser.msie) {document.execCommand("Stop");} //works in IE,
			}
			var flash = ((typeof navigator.plugins !== "undefined" && typeof navigator.plugins["Shockwave Flash"] === "object") || (window.ActiveXObject && (new ActiveXObject("ShockwaveFlash.ShockwaveFlash")) !== false));
            if (!flash) {
				userAgent = navigator.userAgent;
                document.write("<h1>דרוש תמיכה בפלאש</h1>");
				if (userAgent.indexOf("Android") != -1) document.write('<h1><a href="market://details?id=com.cloudmosa.puffinFree">Puffin</a> - דפדפן התומך בפלאש למשתמשי אנדרואיד</h1>');
                stopLoading();
            }
        </script>
    <?php } ?>
    <style>
        p {
            margin-left:2%;
            margin-right:2%;
            font-size:150%;
			font-family:arial;
        }
		#button {
			margin-right:20%;
			margin-bottom:5%;
			font-size:150%;
			font-family:arial;
		}
        #intro {
            display:block;
            position:absolute;
            width:50%;
			margin: 5% 18% auto auto;
            background-color:white;
            border-style:solid;
            border-width:2%;
			overflow:auto;
			z-index: 1;
        }
		#ad {
			position:absolute; 
			display:none; 
			width:50%; 
			margin-right:19.5%; 
		}
		#container {
			position:fixed; 
			width:100%; 
			height:100%;
		}
		#frame {
			width:100%; 
			height:100%; 
			display:block;
		}
		body {
			zoom: 1;
			font-size:14px;
		}
    </style>

</head>
<body dir="rtl">
<div id="container">
    <iframe id="frame" src="<?php echo $iframeURL ?>"></iframe>
</div>
<div id="ad">
    <img src="<?php echo $ad; ?>" height="50" width="830">
</div>
<div id="intro">
    <p>שלום רב, שמי אסף, ואני סטודנט לתואר ראשון בכלכלה באוניברסיטה הפתוחה. לצורך סיום התואר עליי לערוך מחקר הכולל שאלון קצר. השאלון הינו אנונימי לחלוטין וכל הפרטים ישמשו רק לצרכים סטטיסטיים ולא לשם זיהוי. בכל מקרה, יש באפשרותך להפסיק את מילוי השאלון ולצאת מהאתר בכל שלב. השאלון מיועד לבני 18 ומעלה בלבד. אני מודה לך על השתתפותך ועל עזרתך.</p>
    <?php if ($page == "website") { 
	echo outputHTML(
<<<EOT
	המחקר כולל שני שלבים:

		• בשלב הראשון עלייך לנווט באתר הנוכחי למשך דקה. (האתר הוא חלק מהמחקר)

		• בתום הדקה יופיע באופן אוטומטי שאלון המונה 10 שאלות קצרות
EOT
	);
	} 
	else {
		echo outputHTML(
<<<EOT
		המחקר כולל שני שלבים: בשלב הראשון עלייך לשחק במשחק "מצא את ההבדלים" למשך דקה. בתום הדקה יופיע באופן אוטומטי השאלון המונה 10 שאלות קצרות.
		תודה עבור שיתוף הפעולה
EOT
	);
	}
	?>
	<button type="button" onclick="start();" id="button"><?php echo $page == "game" ? 'למשחק' : 'הבנתי, ברצוני להתחיל'  ?></button>  
	<script> var time = new Date().getTime(); </script>
</div>
	<script type="text/javascript">
		if (screen.width < screen.height) { 
			document.body.style.fontSize = "20px";
			document.getElementById("intro").style.width = "70%";
		}
		function start() {
			time = new Date().getTime() - time;
			<?php 
				if (!isset($_COOKIE["start"])) echo "setCookieStart();"; 	
				else {
					$duration = ($result = $maxTime - (time() - $_COOKIE["start"])*1000) > 0 ? $result : 0;
					if (($maxTime - $duration) > $displayAdAfter) $showAd = false;
				}
				if ($showAd) echo "showAd();"; 	
			?>
			document.getElementById("intro").style.display="none";
			setTimeout(function() { moveToQuestionnaire(); },<?php echo $duration ?>);
			
		}
		function showAd() {
			setTimeout(function(){ document.getElementById("ad").style.display="block"; hideAd(); }, <?php echo $displayAdAfter; ?>);
		}
		function hideAd() {
			setTimeout(function(){ document.getElementById("ad").style.display="none"; },  <?php echo $displayAdDuration; ?>);
		}
		function moveToQuestionnaire() {
			window.location.href = "/form.php?t=" + time ;
		}
		function setCookieStart() {
			var d = new Date();
			d.setTime(d.getTime() + 120000);
			var expires = "expires="+ d.toUTCString();
			document.cookie = "start=<?php echo time(); ?>; " + expires;
		} 
		<?php if (isset($_COOKIE["start"])) echo "start();"; ?>
		http = new XMLHttpRequest();
		http.open("GET","isopen.php?page=<?php echo $page; ?>",true);
		http.send();	
		http.onreadystatechange = function () {
        if (http.readyState == 4 && http.status == 200 && http.responseText != 'open') 
			window.location.href = "/index.php?page=" + http.responseText;
            stopLoading();
		};
	</script>
</body>
</html>
