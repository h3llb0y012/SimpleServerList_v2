<?php

require_once('includes/init.php');

$style = ($func->get_settings('style')->value == 1) ? 'style-red.css' : 'style-blue.css';
$steam = $func->get_settings('steam')->value;

$serveri = $func->server_list();

$func->assignVars(array(
	'style' => $style,
	'steam' => $steam,
	'serveri' => $serveri,
	'rank' => $func->get_settings('rank')->value
))->display('lista');

?>