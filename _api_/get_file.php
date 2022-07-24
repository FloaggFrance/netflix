<?php
require "init.php";

$reqVideo = new sql_prep(
	'prepare',
	'SELECT * FROM video WHERE video_file=?',
	"s",
	[$_GET['file']]
);
$reqVideo = $reqVideo->return_data;
if($reqVideo->num_rows == 1) {
	echo json_encode([true]);
	die();
}

echo json_encode([false]);