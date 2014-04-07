<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Server List</title>

<link href="includes/style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="./includes/style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="./includes/style/css/ie7.css" /><![endif]-->

<script type="text/javascript" src="includes/style/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#dodaj').hide();
    $('#pregled').click(function(){
      $('#dodaj').toggle('1000');
    });
  });

</script>
<script type="text/javascript" src="includes/style/js/jNice.js"></script>
</head>

<body>
	<div id="wrapper">
    	
    	<h1><a href="#"><span>Simple Server List</span></a></h1>
        
       
        <ul id="mainNav">
        	<li><a href="./admin.php">Pocetna</a></li>
        	<li><a href="admin.php" id="pregled">Dodaj server</a></li>
			<li><a href="admin.php?page=settings" class="active">Podesavanja</a></li>
        	<li class="logout"><a href="./admin.php?logout=true">LOGOUT</a></li>
        </ul>
       
        
        <div id="containerHolder">
			<div id="container">
			<h2><a href="#">PODESAVANJA</a> &raquo; <a href="#" class="active">Podesavanja sajta</a></h2>
			<div id="main">
			<?php if(session::exists('msg')) echo "<br /><h3><font color='#c66653'>". session::flash('msg') ."</font></h3>"; ?>
			
				<form action="" method="POST">
					<h3>Style:</h3><select name="style">
					
					<?php
					
					if ($this->get('style') == 0)
						echo '<option value="0">Blue Style</option>
						<option value="1">Red Style</option>';
					else
						echo '<option value="1">Red Style</option>
						<option value="0">Blue Style</option>';
					
					?>
					
					</select>
					
					<h3>Prikazi rank:</h3>
					<select name="rank">
					<?php

					if($this->get('rank') == 0)
						echo '<option value="0">Balkanski</option>
						<option value="1">Svetski</option>';
					else
						echo '<option value="1">Svetski</option>
						<option value="0">Balkanski</option>';
					?>

					</select>
					<h3>Prikazi steam ikonicu:</h3>
					<input type="checkbox" name="steam" value="1" <?php if ($this->get('steam') == 1) echo 'checked'; ?>/>
					
					<h3 style="cursor: pointer;" title="Pregled liste usporava ucitavanje stranice.">Prikazi pregled liste u admin panelu:</h3>
					<input type="checkbox" name="preview" value="1" <?php if ($this->get('preview') == 1) echo 'checked'; ?>/>
					<br /><br />
					<input type="submit" name="save" value="Save !" />
				</form>
				
				<br />
			</div>
			
			<div class="clear"></div>
		</div>
	</div>
	
	<p id="footer">Simple Server List. v2 <a href="mailto:mj.hellboy064@gmail.com">h3llb0y</a> & <a href="http://skakac.com/">Dusan Stojadinovic.</a></p>
	</div>
</html>
</body>