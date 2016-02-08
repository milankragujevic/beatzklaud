<?php
error_reporting(E_ALL);

header("Expires: Tue, 01 Jan 2000 00:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("X-UA-Compatible: ie=7");
header('Content-Type: text/plain; charset=utf-8');

if(file_exists(realpath(__DIR__ . '/../') . '/NOUPDATE.txt')) { echo '0'; exit; }

$version = '1.0.0';
$latest_version = json_decode(file_get_contents('https://musichq.xyz/app-config/config.json'), true)['version'];

if($version != $latest_version) {
	echo '1';
} else {
	echo '0';
}