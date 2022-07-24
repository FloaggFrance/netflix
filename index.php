<?php
include_once "config.php";

$GetBannerInfoFirstVideo = new Open_API('get.php?item=news');
$informationBanner = $GetBannerInfoFirstVideo->use;

$ListHome = new Open_API('get.php?item=useTrend');

$ectrait = false;
if($informationBanner->banner_video != null) {
	$ectrait = true;
}
if(isset($_GET['extrait'])) {
	$ectrait = false;
}
$cookHist = false;
if(isset($_COOKIE['json_test'])) {
	if($data = json_decode(html_entity_decode($_COOKIE['json_test']), true)) {
		$cookHist = true;
	}
}

www('home', [$informationBanner]);
?>