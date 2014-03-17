<?php

	require 'facebook.php';

	$facebook = new Facebook(array(
	  'appId'  => '334801126584722',
	  'secret' => 'f77f00108d8967a24f560f1fdbf482cc',
	));

	$user = $facebook->getUser();

	// Login or logout url will be needed depending on current user state.
	if ($user) {
		$logoutUrl = $facebook->getLogoutUrl();
		echo '<br>logout-> <a href="' . $logoutUrl . '">logout</a><br>';
	} else {
		$loginUrl = $facebook->getLoginUrl(array(
			'redirect_uri' => 'http://localhost:8080/Projects/face-stats/'
		));
		echo '<br>login-> <a href="' . $loginUrl . '">login</a><br>';
	}
	if ($user) {
		echo '<h1>Logged</h1>';
	}


	$ret = $facebook->api(array(
		'method' => 'fql.query',
		'query' => "SELECT body, created_time, message_id, source FROM message WHERE thread_id = 345709892183065"
	));
	echo '<pre>';
	print_r($ret);
	echo '</pre>';
?>