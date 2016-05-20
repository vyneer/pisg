<?php

$files = array_diff(scandir('.'), array('..', '.'));
$channels = array();
foreach ($files as $file) {
	if (substr_compare($file, ".html", -5, 5) === 0)
        array_push($channels, $file);
}
$cache = fopen("index-cache.txt", "w");
$cache_data = array();

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
        $cache_data[$name] = array("file" => $channel, "date" => $date, "users" => $usersCount);
}
$cache_data["refresh_date"] = date('l jS \of F Y h:i:s A');
fwrite($cache, json_encode($cache_data));

?>
