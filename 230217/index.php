<?php
include 'database.php';

if (isset($_POST["url"])) {
	$slug = bin2hex(random_bytes(5));

	$ret = db()->query("INSERT INTO urls(url, slug) VALUES('{$_POST["url"]}','$slug');");
	if($ret !== true){
		die(mysqli_error(db()));
	}

	$host = $_SERVER['HTTP_HOST'];
	$path = dirname($_SERVER['REQUEST_URI']);
	$shortUrl = "http://{$host}{$path}url.php?slug={$slug}";
	// http://localhost:8081/url.php?slug=$slug";
	// http://localhost:8081/dir/url.php?slug=$slug";
}
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Raccourcisseur d'URL</title>
</head>
<body>
	<h1>Réducteur d'URL</h1>
	<form method="POST">
	<label>
		Lien :
		<input type="text" name="url" value="<?= isset($_POST["url"]) ? $_POST["url"] : "" ?>" />
	</label>
	</form>
	<?php if (isset($shortUrl)) { ?>
	<input type="text" value="<?= $shortUrl ?>"/>
	<?php } ?>
</body>
</html>
