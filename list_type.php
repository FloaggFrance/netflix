<?php
include_once "config.php";

$GetBannerInfoFirstVideo = new Open_API('get.php?item=news');
$informationBanner = $GetBannerInfoFirstVideo->use;
$ListHome = new Open_API('get.php?item=list');
$viewType = "All";
if(isset($_GET['t'])) {

	switch($_GET['t']) {
		case 'film':
			$viewType = 'Film';
			$type = "film";
			break;

		case 'serie':
		case 'video':
			$viewType = 'Serie';
			$type = "serie";
			break;

		default:
			$viewType = 'All';
			$type = "";
			break;
	}


	$ListHome = new Open_API('get.php?item=list&type='.$type);
}

www('list_type', [$informationBanner]);
?>