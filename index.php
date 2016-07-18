<?php
session_start();

// composerで生成されたオートロドファイル読み込み
require_once( 'vendor/autoload.php' );

// DBと接続
require_once( 'dbconnect.php' );

// Facebookログインしたユーザー情報をDBに保存するPHPスクリプト
require_once( 'checkuser.php' );

// 訪問者がすでにFacebookログインしているかどうかを確認
if (isset($_SESSION['facebook_access_token'])) {

	// このあたりはFacebookディベロッパーマニュアルをほぼコピペしただけです
	// 参考： https://developers.facebook.com/docs/php/gettingstarted
	$response = $fb->get('/me');
	$user = $response->getGraphObject();

	// 下記のような感じで情報を取り出せます。
	$fid = $user['id']; // ID
	$fname = $user['name']; // 名前
	$femail = $user['email'];// Email
	$fphoto = "http://graph.facebook.com/" . $user['id'] . "/picture?type=large"; // 顔写真のURL

	echo $fid;
	echo $fname;

	// ログイン済み、かつ新規ユーザーの場合は、DBに会員情報を保存する関数読み込み
	checkuser($fid, $fname, $femail, $fphoto, $mysqli); ?>

	<p>ログインしました</p>
	<a href="logout.php">ログアウトはこちら</a>

<?php } else {
	// ログインしていないユーザーには、Facebookログインリンクを表示する
	// このあたりはFacebookディベロッパーマニュアルをほぼコピペしただけです
	$helper = $fb->getRedirectLoginHelper();
	$permissions = ['email', 'user_likes'];

	// 下記のURL部分を環境にあわせて変更してください
	$loginUrl = $helper->getLoginUrl('ここにURLを記入/login-callback.php', $permissions);
	echo '<a href="' . $loginUrl . '">Facebookでログインする</a>';
}

