<?php
session_start();
require_once( 'vendor/autoload.php' );
require_once( 'core/config.php' );

// このあたりはFacebookの仕様に沿って書いたものです
// 公式マニュアルは分かりづらいので下記記事がおすすめです。
// http://www.phpgang.com/how-to-login-with-facebook-api-sdk-v5-in-php_2879.html
$helper = $fb->getRedirectLoginHelper();

try {
	$accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
	// When Graph returns an error
	echo 'Graph returned an error: ' . $e->getMessage();
	exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
	// When validation fails or other local issues
	echo 'Facebook SDK returned an error: ' . $e->getMessage();
	exit;
}

if (isset($accessToken)) {
	// Logged in!
	$_SESSION['facebook_access_token'] = (string) $accessToken;
} elseif ($helper->getError()) {
	// The user denied the request
}

header('Location: index.php?=new');