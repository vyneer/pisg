<!DOCTYPE html>
<html>
<head>
	<title>PISG Index</title>
	<link rel="stylesheet" type="text/css" href="dark-style.css">
</head>
<body>
<h1 class="center">PISG Channels</h1>
<table>
<tr>
	<th>Channel</th>
	<th>Last updated</th>
	<th>Users</th>
</tr>
<?php

$cache = file_get_contents("index-cache.txt") or die("Cache file not found!");
$channels = explode("\n", $cache);

foreach ($channels as $channel) {
	$data = explode("\001", $channel);
	echo '<tr onclick="document.location = \'' . $data[0] . '\'">';
	echo '<td>' . $data[1] . '</td>';
	echo '<td>' . $data[2] . '</td>';
	echo '<td>' . $data[3] . '</td>';
	echo '</tr>';
}

?>

</table>

<h6 class="center">Index and API coded by OverCoder | Whatever here | All rights reserved</h6>
</body>
</html>