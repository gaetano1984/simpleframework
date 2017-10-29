<?php

	function getenvval($key, $default=null){
		$val = env($key) ? env($key) : $default;
		return $val;
	}

?>