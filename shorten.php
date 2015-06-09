<?php
session_start();
require_once 'classes/shortener.php';

$s = new Shortener;

if(isset($_POST['url'])) {
	$url = $_POST['url'];

	if($code = $s->makeCode($url)) {
		$_SESSION['feedback'] = "Generated! Your short URL is: <a href=\"http://example.com{$code}\">http://example.com{$code}</a>";
	} else {
		// There was a problem
		$_SESSION['feedback'] = "There was a problem. Invalid URL";
	}

}

header('Location: index.php');
