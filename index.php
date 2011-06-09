<?php

include_once 'simplehtmldom/simple_html_dom.php';

if (!isset($_POST['submit'])){

?>

<html>
<head>
<title>Getting some shit</title>
</head>
<body>
<div style="width:100%;height:100%;">
<form method="post" action="<?php echo $PHP_SELF;?>" style="position:relative;top:35%;">
<button type="submit" value="submit" name="submit" style="width: 340px;height: 52px;font-size: 36px;position: relative;left: 50%;margin-left: -160px;">GET LIKE A BOSS</button>
</form>
</div>
</body>
</html>



<?php
} else {

	function get_content($url)
	{
	    $ch = curl_init();

	    curl_setopt ($ch, CURLOPT_URL, $url);
	    curl_setopt ($ch, CURLOPT_HEADER, 0);

	    ob_start();

	    curl_exec ($ch);
	    curl_close ($ch);
	    $string = ob_get_contents();

	    ob_end_clean();

	    return $string;     
	}

$url = "http://downloads.khinsider.com/game-soundtracks/album/cowboy-bebop-original-soundtrack-5-music-for-freelance";//url of album on kh
$blah = array(0,2,4,6,8,10,12,14,16,18,20,22,24,26,28);//however many songs there are
foreach ($blah as $value)
	{
		//$html = file_get_html($url);
		$strhtml = get_content($url);
		$html = str_get_html($strhtml);
		//for x in range(13)
		$stuff = $html->find("div#EchoTopic table tbody a",$value);
		$url2 = $stuff->href;
		$strhtml2 = get_content($url2);
		$html2 = str_get_html($strhtml2);
		$stuff2 = $html2->find("div#EchoTopic p",3);
		$stuff4 = $stuff2->find("a",1);
		$url3 = $stuff4 -> href;
		echo $url3;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url3);
		$fp = fopen('filename'.$value.'.mp3', 'w');
		curl_setopt($ch, CURLOPT_FILE, $fp);
		curl_exec ($ch);
		curl_close ($ch);
		fclose($fp);
	}
}
?>


