<?php

$files = array_diff(scandir('.'), array('..', '.'));
$channels = array();
foreach ($files as $file) {
	if (substr_compare($file, ".html", -5, 5) === 0)
		array_push($channels, $file);
}
$cache = fopen("index-cache.txt", "w");

foreach ($channels as $channel) {
	$html = new DOMDocument();
	$html->loadHTML(file_get_contents($channel));

	$name = explode(" @ ", $html->getElementsByTagName("title")->item(0)->textContent)[0];
	$date = "";
	$nicksCount = "";
	$temp = $html->getElementById("pagetitle2");
	if (!is_null($temp))
		$date = explode("on ", $temp->textContent)[1];
	$temp = $html->getElementById("pagetitle3");
	if (!is_null($temp))
		$usersCount = $temp->getElementsByTagName("b")->item(0)->textContent;
	fwrite($cache, $channel . "\001" . $name . "\001" . $date . "\001" . $usersCount . "\n");
}
?>