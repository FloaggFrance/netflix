<?php
include 'init.php';

if(isset($_GET['db']) && isset($_GET['id'])) {
	$db = htmlentities($_GET['db']);
	$id = htmlentities($_GET['id']);

	$getExist = new sql_prep('prepare',
		"SELECT * FROM $db WHERE ID = ?",
		"i",
		[$id]
	);
	$da = $getExist->return_data;
	if($da->num_rows == 1) {
		$get = $da->fetch_assoc();
		if(new sql_prep('prepare',
			"DELETE FROM $db WHERE ID = ?",
			"i",
			[$get['ID']]
		)) {

			echo 'Supression réussit !';
		}
	}
}