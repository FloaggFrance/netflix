<?php
include 'init.php';

$video = "film";
if(isset($_GET['serie'])) {
	$video = "serie";
}

if(isset($_POST['submit'])) {
	if(
		!empty($_POST['name'])
		&&
		!empty($_POST['banner'])
		&&
		!empty($_POST['jack'])
	) {
		$name = htmlentities($_POST['name']);
		$banner = htmlentities($_POST['banner']);
		$jack = htmlentities($_POST['jack']);

		$data = [
			$banner,
			$jack,
			$name,
			$video
		];

		$add = new sql_prep('prepare',
			"INSERT INTO club(banner, jacket, club_name, club_type, date_) VALUES(?, ?, ?, ?, Now())",
			"ssss",
			$data
		);
	}
}
?>
<?php if($video == 'film') { ?>
<a href="?serie=1">Add Serie</a>
<?php } else { ?>
<a href="?re=s">Add Film</a>
<?php } ?>
<form method="post">
	<div><input type="text" name="banner" placeholder="Banner/poster"></div>
	<div><input type="text" name="jack" placeholder="Jacket"></div>
	<div><input type="text" name="name" placeholder="url file"></div>
	<div><input type="submit" name="submit"></div>
</form>