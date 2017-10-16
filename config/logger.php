<?php

	global $config_log;

	$config_log = [
		'general_log' => './storage/logs/general_log_'.date('Ymd'),
		'db_log' => './storage/logs/db_log_'.date('Ymd'),
		'access_error_log' => './storage/logs/access_error_log_'.date('Ymd')
	];

?>