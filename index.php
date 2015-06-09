<?php
session_start();
?>

<!doctype html>
<html>
	<head>
	<meta charset="utf-8">
	<title>URL Shortener BGM.BZ</title>
	<link rel="stylesheet" href="css/global.css">
	</head>
	<body>
		<div class="container">
			<h1 class="title">Shorten a URL to BGM.BZ.</h1>

			<?php
			if(isset($_SESSION['feedback'])) {
				echo "<p>{$_Session['feedback']}</p>";
				unset($SESSION['feedback']);
			}
			?>

			<form action="shorten.php" method="post">
				<input type="url" name="url" placeholder="Enter a URL here." autocomplete="off">
				<input type="submit" value="Shorten">
			</form>	
	</body>
