<?php

	global $config_db;

	$config_db = [
		'host' => env('DBHOST') ? env('DBHOST') : 'localhost'
		,'username' => env('DBUSERNAME') ? env('DBUSERNAME') : 'root'
		,'password' => env('DBPASSWORD') ? env('DBPASSWORD') : 'root'
		,'database' => env('DBDATABASE') ? env('DBDATABASE') : 'test_db'
		,'driver' => env('DBDRIVER') ? env('DBDRIVER') : 'mysql'
		,'port' => env('DBPORT') ? env('DBPORT') : '8889'
	];

?>