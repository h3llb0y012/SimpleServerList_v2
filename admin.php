<?php

require_once('includes/init.php');

// ako nije ulogovan prikazi login
if(!session::exists('login')) {
	if(isset($_POST['login'])) {
		$user = $_POST['user'];
		$pass = $_POST['pass'];

		if ($func->admin_login($user, $pass)) {
			session::make('login', 1);
			session::flash('msg','Uspesan login');

			header('Location: admin.php');
		}
		else
			session::flash('error','<strong>Pogresan login</strong>');
	}

	$func->display('login');
	exit(); // blokira kod ispod
}

// uzimanje podesavanja iz baze i assign-ovanje
$func->assignVars(array(
			'style' => $func->get_settings('style')->value,
			'steam' => $func->get_settings('steam')->value,
			'preview' => $func->get_settings('preview')->value,
			'rank' => $func->get_settings('rank')->value
));


// logout i settings deo
if(isset($_GET['page'])) {

	if ($_GET['page'] == 'logout')
	{
		session::delete('login');
		header('Location: admin.php');
	}
	else if($_GET['page'] == 'settings')
	{
		if (isset($_POST['save'])) { // prikupljanje podataka iz forme
			$style = $_POST['style'];
			$rank = $_POST['rank'];
			$steam = isset($_POST['steam']);
			$preview = isset($_POST['preview']);

			//updateovanje podesavanja u bazi podataka
			$func->updateSettings($func->get_settings('style')->id, $style);
			$func->updateSettings($func->get_settings('rank')->id, $rank);
			$func->updateSettings($func->get_settings('steam')->id, $steam);
			$func->updateSettings($func->get_settings('preview')->id, $preview);

			header('Location: admin.php?page=settings');
		}
		$func->display('settings');
	}

	exit();
}


// brisanje servera
if (isset($_GET['delete']))
{
	if ($func->delete_server($_GET['delete'])) {
		session::flash('msg', 'Server uspesno obrisan!');
	}
}


// dodavanje servera
if (isset($_POST['dodaj'])) {
	$naziv = $_POST['naziv'];
	$ip = $_POST['ip'];

	$func->add_server($naziv, $ip);
}

$serveri = $func->server_list();

$func->assignVars(array('serveri' => $serveri))->display('admin');

?>