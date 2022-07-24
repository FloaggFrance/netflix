<?php
define("DIRROOT", '/');
define("DIRCLASS", dirname(__FILE__) . '/include/');
define('__getting__', DIRROOT.'getting/');

//define('API', "http://127.0.0.1/video/_api_/");
define('API', "http://qwilfiapp.com/_api_/");

require_once DIRCLASS . 'class.api.php';

function www($str, $data = array()) {
	extract($data);
	global $_GET;

	if(!isset($_GET['api'])) {
		include_once 'getting/w-header.php';
		include_once "getting/page/{$str}.php";
	}

	if(isset($_GET['s'])) {
		require 'include/club.php';
	}

	if(!isset($_GET['api'])) {
		include_once 'getting/w-footer.php';
	}
}