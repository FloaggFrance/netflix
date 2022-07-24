<?php
include 'init.php';

if(!isset($_GET['id'])) {
	die();
}

$video = $_GET['id'];

if(isset($_POST['submit'])) {
	if(
		!empty($_POST['name'])
	) {
		$name = htmlentities($_POST['name']);

		$data = [
			uniqid(),
			$name,
			$video
		];

		$add = new sql_prep('prepare',
			"INSERT INTO saison(uniq_ID, name, club_id) VALUES(?, ?, ?)",
			"sss",
			$data
		);
	}
}
?>
<form method="post">
	<div><input type="text" name="name" placeholder="name"></div>
	<div><input type="submit" name="submit"></div>
</form>