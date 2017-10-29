<?php

	global $config_db;

	$config_db = [
		'host' => getenvval('DBHOST', 'localhost')
		,'username' => getenvval('DBUSERNAME', 'root')
		,'password' => getenvval('DBPASSWORD', 'root')
		,'database' => getenvval('DBDATABASE', 'test_db')
		,'driver' => getenvval('DBDRIVER', 'mysql')
		,'port' => getenvval('DBPORT', '8889')
	];

?>