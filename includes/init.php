<?php

include('configuration.php');
session_start();

spl_autoload_register(function($class) {
	require_once('' . $class . '.php');
});

function get_cfg($path = null) {
	if ($path) {
		$config = $GLOBALS['config'];
		$path = explode('/', $path);

		foreach ($path as $cfg) {
			if (isset($config[$cfg]))
				$config = $config[$cfg];
		}
		return $config;
	}
	return false;
}

$db = db::getInstance();
$func = new functions();

?>