<?php

	global $config_log;

	$config_log = [
		'general_log' => getenvval('LOGGER_GEN', '../storage/logs/general_log_'.date('Ymd')),
		'db_log' => getenvval('LOGGER_DB', '../storage/logs/db_log_'.date('Ymd')),
		'access_error_log' => getenvval('LOGGER_ACC_ERR', '../storage/logs/access_error_log_'.date('Ymd'))
	];

?>