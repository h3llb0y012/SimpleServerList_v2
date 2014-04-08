<?php

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id']))
	exit;

$id = $_GET['id'];

require_once('includes/init.php');

if ($db->rowCount("SELECT COUNT(*) FROM `serveri` WHERE `id` = '$id'") == 0)
	exit('<strong>Server nije pronadjen u databazi!</strong>');

$get_server = $db->get('serveri', array('id', '=', $id))->first();
$server = $func->json_decode_bre($func->url_get_contents($get_server->ip));

if ($server['apiError'] == 1)
	exit('<strong>' . $server['errorText'] . '</strong>');


$name = $server['name'];
if (strlen($name) > 40)
	$name = substr($name, 0, 40) . '...';

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
	<head>
		<title><?php echo $func->escape($get_server->naziv); ?></title>
		<style type="text/css">
			body {
				background-color: black;
				width: 500px;
				height: 320px;
				padding: 0px;
				margin: 0px;
				font-family: Trebuchet MS;
				font-size: 15px;
				font-weight: bold;
				color: white;
			}

			.box {
				border: 1px solid white;
				border-top: none;
				border-radius: 8px;
				font-size: 12px;
			}

			.title {
				border-top: 1px solid white;
				border-top-left-radius: 8px;
				border-top-right-radius: 8px;
				color: white;
				background-color: blue;
				text-align: center;
				padding-top: 5px;
				padding-bottom: 5px;
				font-size: 14px;
			}
		</style>
	</head>
	<body>
		<div class="box" style="width:500px;height: 140px;"><div class="title">= Opste informacije =</div>
   			<div style="padding-left: 5px;padding-right: 5px;">
   				Naziv: <?php echo $name; ?><span style="float: right;">Drzava: <?php echo $server['countryname']; ?></span><br />
	   			Igra: <?php echo $server['gamename']; ?><span style="float: right;">Igraca: <?php echo $server['players'] . ' / ' . $server['playersmax']; ?></span><br />
	   			Mod: <?php echo $server['modname']; ?><span style="float: right;">Svetski rank: <?php echo $server['rank']; ?></span><br />
	   			IP Adresa: <?php echo $server['ip']; ?><span style="float: right;">Balkanski rank: <?php echo $server['rank_balcan']; ?></span><br />
	   			Vlasnik: <?php echo $server['ownerusername']; ?><span style="float: right;">Dodao: <?php echo $server['adderusername']; ?></span><br />
	   			Trenutna mapa: <?php echo $server['map']; ?><span style="float: right;">Prethodna mapa: <?php echo $server['lastMap']; ?></span>

   				
   			</div>

   		</div>

   		<br />

   		<div class="box" style="width: 500px;height: 150px;"><div class="title" style="width: 500px;">= Baner =</div>
   			<div>
				<img src="http://banners.gametracker.rs/<?php echo $get_server->ip; ?>/big/red/banner.jpg" />
			</div>
		</div>
   </body>
</html>