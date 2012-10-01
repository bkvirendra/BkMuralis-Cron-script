<?php

/****************************************

	Authored By: Virendra Rajput
	Twitter : @bkvirendra
	Github : @bkvirendra

	Blog: http://virendra.me

	Authored on 1st Oct, 2012

	Its all yours under Creative Commons License

****************************************/

require "src/facebook.php";
require "murali.php";

$facebook = new Facebook(array(
  'appId'  => '', // my app ID
  'secret' => '',  // my app secret
));

$accessurl = "https://graph.facebook.com/me/accounts&access_token="; // your access token

$accessTokens = file_get_contents($accessurl);

$data = json_decode($accessTokens);
//print_r($tke);
$pages = $data->data;
foreach ( $pages as $page ) {
	$namePage = $page->name;
	if ($namePage == "Brahma Kumaris") { 
		$accessT = $page->access_token;
	} else {

	}
}

$murali = new murali();

$muralis = $murali->enMurali();

$attachment = array(
    'message' => $muralis,
	'access_token' => $accessT
);

$result = $facebook->api('/182929845081087/feed/', 'post', $attachment);

var_dump($result);

?>