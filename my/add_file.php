<?php
include_once "init.php";

if(!isset($_GET['club_id'])) {
	die();
}
/*
 *
 * Club
 *
 *
 */
$api = new sql_prep('prepare',
	"SELECT * FROM club WHERE ID = ? ORDER BY id DESC",
	"s",
	[$_GET['club_id']]
);
if($api->return_data->num_rows == 0) {
	echo 'Echec de recuperration du club';
	die();
}
$club = $api->return_data->fetch_assoc();
$club_id=$club['ID'];
$club_type="film";
if($club['club_type'] == "serie"){
	/*
	 *
	 * Saison, si c'est une serie
	 *
	 *
	 */
	$reqSaison = new sql_prep('prepare',
		"SELECT * FROM saison WHERE club_id = ? ORDER BY id ASC",
		"s",
		[$club_id]
	);
	if($reqSaison->return_data->num_rows == 0) {
		echo 'Echec de recuperration des saison';
		die();
	}
	$saison = $reqSaison->return_data->fetch_all(MYSQLI_ASSOC);
	$club_id=$saison[0]['ID'];
	$club_type="video";
}
/*
 *
 * Video
 *
 *
 */
echo $club_id;
$reqVideo = new sql_prep('prepare',
	"SELECT * FROM video WHERE club_id = ? AND video_type = '$club_type' ORDER BY id DESC",
	"s",
	[$club_id]
);
if($reqVideo->return_data->num_rows == 0) {
	echo 'Echec de recuperration des video';
	die();
}
$video = $reqVideo->return_data->fetch_all(MYSQLI_ASSOC);




$ideo = new sql_prep('query',
	"SELECT * FROM club ORDER BY id DESC"
);
$a = $ideo->return_data->fetch_all(MYSQLI_ASSOC);

if(isset($_POST['submit'])) {
	if(
		!empty($_POST['name'])
		&&
		!empty($_POST['file'])
	) {
		$uniqid = uniqid();
		$name = htmlentities($_POST['name']);
		$desc = "null";
		$file = htmlentities($_POST['file']);
		$clubid=$club_id;

		if(!empty($_POST['club']))
			$clubid = htmlentities($_POST['club']);

		$data = [
			$uniqid,
			$clubid,
			$name,
			$desc,
			$file,
			$club_type
		];

		$add = new sql_prep('prepare',
			"INSERT INTO video(uniq_ID, club_id, video_name, video_desc, video_file, video_type, date_) VALUES(?, ?, ?, ?, ?, ?, Now())",
			"ssssss",
			$data
		);
	}
}
?>
Ajouté à <?= $club['club_name'] ?>
<form method="post">
<table>
	<tr>
		<td><input type="text" name="name"></td>
		<td><input type="text" name="file"></td>
		<td>
			<select name="club">
				<?php
				foreach ($saison as $key => $value) {
				?>
				<option value="<?= $value['ID'] ?>"><?= $value['name'] ?></option>
				<?php
				}
				?>
			</select>
		</td>
		<td><input type="submit" name="submit"></td>
	</tr>
</table>
</form>
<table>
<?php
foreach ($video as $key => $value) {
?>
<tr>
	<td><?= $club['club_name'] ?></td>
	<td><?= $value['video_name'] ?></td>
	<?php if(isset($saison)) { ?>
	<td><?= $saison[0]['name'] ?></td>
	<?php } ?>
</tr>
<?php } ?>
</table>