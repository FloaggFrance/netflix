<?php
include_once "../config.php";
include_once '../_api_/init.php';

if(!isset($_COOKIE['user_ID_to_connect'])) {
	header('Location: /');
}