<?php
include 'init.php';

$ListClub = new sql_prep(
	'query',
	"SELECT * FROM club ORDER BY ID DESC"
);

$ListClub = $ListClub->return_data;

foreach ($ListClub->fetch_all(MYSQLI_ASSOC) as $key => $value) {
	echo $value['club_name'].' - <b>'.$value['club_type'].'</b><br>';
	echo '<ul>';
	if($value['club_type'] == 'serie') {
		$ListSaison = new sql_prep(
			'prepare',
			"SELECT * FROM saison WHERE club_id = ?",
			'i',
			[$value['ID']]
		);
		$ListSaison = $ListSaison->return_data;
		foreach ($ListSaison as $key => $get) {
			echo '<li>';
			echo $get['name'];
			echo '<ul>';
			$ListVideo = new sql_prep(
				'prepare',
				"SELECT * FROM video WHERE video_type = 'video' AND  club_id = ?",
				'i',
				[$get['ID']]
			);
			$ListVideo = $ListVideo->return_data;
			foreach ($ListVideo as $key => $getListVideo) {
				echo '<li>';
				echo $getListVideo['video_name'];
				echo ' - ';
				echo $getListVideo['video_quality'];
				echo ' - ';
				echo '<a href="delete_video.php?db=video&id='.$getListVideo['ID'].'">';
				echo 'Delete';
				echo '</a>';
				echo '</li>';
			}
			echo '</ul>';
			echo '</li>';
		}
	}
	else {
		$ListVideo = new sql_prep(
			'prepare',
			"SELECT * FROM video WHERE video_type = 'film' AND club_id = ?",
			'i',
			[$value['ID']]
		);
		$ListVideo = $ListVideo->return_data;
		foreach ($ListVideo as $key => $getListVideo) {
			echo '<li>';
			echo $getListVideo['video_name'];
			echo ' - ';
			echo $getListVideo['video_quality'];
			echo ' - ';
			echo '<a href="delete_video.php?db=video&id='.$getListVideo['ID'].'">';
			echo 'Delete';
			echo '</a>';
			echo '</li>';
		}
	}
	echo '</ul>';
}

/*
foreach ($trendsHomePage as $keys => $seVal) {
	$saison = new jaAPI("get.php?item=saison&id=".$seVal->ID);
	$saison = $saison->data;

	echo $seVal->club_name.' - <b>'.$seVal->club_type.'</b><br>';
	if($seVal->club_type == 'serie') {
		echo '<ul>';
		foreach ($saison as $key => $saVal){
			echo '<li>';
			echo $saVal->name;
			echo '<ul>';

			$saison = new jaAPI("get.php?item=episode&id=".$saVal->ID);
			$saison = $saison->data;
			foreach ($saison as $key => $value){
				echo '<li>';
				echo $value->video_name;
				echo ' - ';
				echo $value->video_quality;
				echo ' - ';
				echo '<a href="delete_video.php?id='.$value->ID.'">';
				echo 'Delete';
				echo '</a>';
				echo '</li>';

				// $command = "ffprobe -v error -select_streams v:0 -show_entries stream=width,height -of default=nw=1:nk=1 http://cdn.lifefordream.com/{$value->video_file}";

				// var_dump(new jaAPI("set_data.php?action=edit&id=".$value->ID."&db=video&set=video_quality&value=".exec( $command, $ret )));
			}
			echo '</ul>';
			echo '</li>';
		}
		echo '</ul>';
	}
	if($seVal->club_type == "film") {
		echo '<ul>';
		$film = new jaAPI("get.php?item=film&id=".$seVal->ID);
		$film = $film->data;
		foreach ($film as $key => $value){
				echo '<li>';
				echo $value->video_name;
				echo ' - ';
				echo '<a href="delete_video.php?id='.$value->ID.'">';
				echo 'Delete';
				echo '</a>';
				echo '</li>';

				//var_dump(new jaAPI("set_data.php?action=edit&id=".$value->ID."&db=video&set=video_type&value=video"));
		}
		echo '</ul>';
	}
}*/