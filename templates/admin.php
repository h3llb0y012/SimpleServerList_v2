<?php
	$func = new functions();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Simple Server List</title>

<link href="includes/style/css/transdmin.css" rel="stylesheet" type="text/css" media="screen" />
<!--[if IE 6]><link rel="stylesheet" type="text/css" media="screen" href="includes/style/css/ie6.css" /><![endif]-->
<!--[if IE 7]><link rel="stylesheet" type="text/css" media="screen" href="includes/style/css/ie7.css" /><![endif]-->

<script type="text/javascript" src="includes/style/js/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#dodaj').hide();
    $('#pregled').click(function(){
      $('#dodaj').slideToggle(500);
    });
  });

</script>
<script type="text/javascript" src="includes/style/js/jNice.js"></script>
</head>

<body>
	<div id="wrapper">
    	
    	<h1><a href="#"><span>Simple Server List</span></a></h1>
        
       
        <ul id="mainNav">
        	<li><a href="./admin.php" class="active">Pocetna</a></li>
        	<li><a href="#"id="pregled">Dodaj server</a></li>
			<li><a href="admin.php?page=settings">Podesavanja</a></li>
        	<li class="logout"><a href="./admin.php?page=logout">LOGOUT</a></li>
        </ul>
       
        
        <div id="containerHolder">
			<div id="container">
                <h2><a href="#">POCETNA</a> &raquo; <a href="#" class="active">Pregled dodatih servera</a></h2>
				<div id="main">
				<?php if(session::exists('msg')) echo "<br /><h3><font color='#c66653'>". session::flash('msg') ."</font></h3>"; ?>
					<br />
					<center><table cellpadding="0" cellspacing="0">
						<?php
						
							foreach ($this->get('serveri') as $server) {
								echo '<tr>
						<td>' . $func->escape($server->naziv) . '</td>
						<td>' . $server->ip . '</td>
						<td class="action"><a href="admin.php?delete=' . $server->id . '" class="delete">Izbrisi</a>';
							}
							
						?>

					
					</table></center>

					<form method="post" action="" class="jNice" id="dodaj">
					<h3>Dodaj server na listu</h3>
                    	<fieldset>
                        	<p><label>Naziv servera:</label><input type="text" name="naziv" class="text-long" /></p>
                        	<p><label>IP:</label><input type="text" name="ip" class="text-long" /></p>
                            <input type="submit" name="dodaj" value="Dodaj server" />
                        </fieldset>
                    </form>
					<?php
					
					if ($this->get('preview') == 1)
						echo '<h3>Pregled liste</h3>
						<fieldset>
                        <iframe src="./index.php" style="width:100%;height:100%;"  frameborder="0"></iframe>
                    </fieldset>';
					else
						echo '<br />';
					
					?>
					
				</div>
                
                <div class="clear"></div>
            </div>
        </div>
        
		<p id="footer">Simple Server List. v2 <a href="mailto:mj.hellboy064@gmail.com">h3llb0y</a> & <a href="http://skakac.com/">Dusan Stojadinovic.</a></p>
    </div>
</body>
</html>
					