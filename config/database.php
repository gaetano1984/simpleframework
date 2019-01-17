<?php

	global $config_db;

	$config_db = array(
		'host' => getenv('DBHOST', 'localhost')
		,'username' => getenv('DBUSERNAME')
		,'password' => getenv('DBPASSWORD')
		,'database' => getenv('DBDATABASE')
		,'driver' => getenv('DBDRIVER')
		,'port' => getenv('DBPORT')
	);

?>