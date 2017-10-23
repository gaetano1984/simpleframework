<?php

	global $twig_config;
	$twig_config = [
		'tpl_dir' => env('TPL_DIR') ? env('TPL_DIR') : '../resources/views'
		,'cache_dir' => env('TPL_CACHE_DIR') ? env('TPL_CACHE_DIR') : '../resources/vies/cache'
		,'cache' => false
	];

?>