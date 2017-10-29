<?php

	global $twig_config;
	$twig_config = [
		'tpl_dir' => getenvval('TPL_DIR', '../resources/views')
		,'cache_dir' => getenvval('TPL_CACHE_DIR', '../resources/views/cache')
		,'cache' => false
	];

?>