<?php 
header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-UA-Compatible: ie=7");
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>BeatzKlaud</title>
	<link rel="stylesheet" href="css/error.css?t=<?php echo filemtime(__DIR__ . '/css/error.css'); ?>" />
</head>
<body>
    <h1>Install Flash Player</h1>
    <p>Sorry, to use BeatzKlaud you have to install the Flash player. </p>
    <p><br><a href="https://fpdownload.macromedia.com/pub/flashplayer/latest/help/install_flash_player_ax.exe" target="_blank"><img src="img/get_flash_player.gif" /></a></p>
    <p><br>After installation, restart BeatzKlaud. </p>
	<p><br>If you continue to see this message, contact us at <a href="https://musichq.xyz/">https://musichq.xyz/</a>. </p>
</body>
</html>