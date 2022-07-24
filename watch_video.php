<?php
header("Set-Cookie: key=value; path=/; domain=127.0.0.1; HttpOnly; SameSite=none");
include_once "config.php";

if(isset($_GET['v'])) {
	$video = new Open_API('get.php?item=player-video&video_id='.$_GET['v']);
	$getVideo=$video->use;
}
else
{
	die();
}

$tcode = 0.0;
if(isset($_GET['tcode'])) {
	$tcode = htmlentities($_GET['tcode']);
}

$subLang = "";
if(isset($_GET['lang'])) {
	$subLang = htmlentities($_GET['lang']);
}
$json_data="";
if(isset($_COOKIE['json_test'])) {
	$json_data = $_COOKIE['json_test'];
}
setcookie("json_test", cookEp((string) $_GET['v']), [
	'expires'=>time() + 3600 * 24 * 31, 
	'path'=>"/", 
	'domain'=>"127.0.0.1", 
	'secure'=>false, 
	'HttpOnly'=>true
]);

function cookEp(string $id) {
	global $tcode;
	$data=array();

	if(isset($_COOKIE['json_test']) && $po = json_decode(html_entity_decode($_COOKIE['json_test']), true)) {
		$data = $po;
	}
	if(!isset($data[$id]) && $tcode != "0.0") {
		$data[$id] = $tcode;
		//array_push($data, [$id => $tcode]);
	}
	
	return htmlentities(json_encode($data));
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Qwilfiap</title>
	<link rel="stylesheet" type="text/css" href="<?= __getting__ ?>x-asset.css">
	<link rel="stylesheet" type="text/css" href="<?= __getting__ ?>x-player.css">

	<!-- TWITTER EMDED -->
	<meta property="og:keywords" content="Streaming, Video, Film">
	<meta property="twitter:card" content="summary_large_image" />
	<meta property="og:type" content="Streaming">
    <meta property="og:site_name" content="Qwilfi">
    <meta property="og:title" content="<?= $getVideo->full_name ?>">
    <meta property="og:description" content="De <?= $getVideo->video_name ?>">
    <meta property="og:image" content="<?= $getVideo->poster ?>">
    <meta property="twitter:image" content="<?= $getVideo->poster ?>">
    <!-- END TWITER EMBED -->

    <script>
		const tcode = "<?= $tcode ?>"
		const video_ID = "<?= $_GET['v'] ?>"
	</script>
</head>
<body>
	<article>
		<?php require 'include/player.php'; ?>
	</article>
</body>
</html>