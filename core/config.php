<?php
$host = "localhost";
$username = "root";
$password = "root";
$dbname = "fb_login";

// FacebookSDKを初期化：Facebook PHP SDK v5.
$fb = new Facebook\Facebook([
	'app_id' => 'XXXXXXXXXXXXXX',
	'app_secret' => 'XXXXXXXXXXXXXX',
	'default_graph_version' => 'v2.3',
	'default_access_token' => isset($_SESSION['facebook_access_token']) ? $_SESSION['facebook_access_token'] : 'APP-ID|APP-SECRET'
]);
