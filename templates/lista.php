<?php $func = new functions(); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
   <head>
     <title>Lista</title>
     <link href="includes/style/css/<?php echo $this->get('style'); ?>" rel="stylesheet" type="text/css" />

   </head>
   <body>
   	<div style='height:0px'><br /></div>
	<div style='text-align:center; font-size:11px; font-face:arial;'>
	    <table cellpadding='0' cellspacing='2' style='margin:auto'>
	    	<?php

	    	foreach ($this->get('serveri') as $server) {
	    		$data = $func->url_get_contents($server->ip);
	    		$data = $func->json_decode_bre($data);
	    		$steam = $this->get('steam') ? '<td></td>' : '';

	    		if ($data['apiError'] == 1)
	    			echo '<tr><td><img src="includes/slike/offline.png" height=12px /></td><td></td><td></td><td><span class="naziv">' . $server->naziv . '</span></td>' . $steam . '<td><span class="naziv"><strong>' . $data['errorText'] . '</strong></span></td><td></td><td></td><td></td><td></td></tr>';
	    		else {

	    			$rank = ($this->get('rank') == 1) ? $data['rank'] : $data['rank_balcan'];


	    			echo '<tr>
							<td><a href="http://www.gametracker.rs/server_info/' . $server->ip . '/" target="_blank"><img alt="" src="http://beta.gametracker.rs/assets/favicon.ico" height=16px /></td>
							<td><a href="http://www.gametracker.com/server_info/' .$server->ip . '/" target="_blank"><img alt="" src="includes/slike/gtcom.png" height=16px /></td>
							<td class="mapa">' . $rank . '</td>
							<td title="Konektuj se preko steama!" class="ime">
								<div class="ime2">
									<a href="steam://connect/' . $server->ip . '" target="_blank" class="naziv">' . $server->naziv . '</a>
								</div>
							</td>';

					if ($this->get('steam') == 1)
						echo '<td><a href="steam://connect/' . $server->ip . ' " target="_blank"><img src="includes/slike/steam.png" border="0" title="Steam Konekcija" /></a></td>';

					echo '<td title="Konektuj se preko steama!" class="ip">
								<a href="steam://connect/' . $server->ip . '">' . $server->ip . '</a></td>
								
								<td class="mapa">
									' . $data['map'] . '</td>
								<td class="igraci">
									' . $data['players'] . ' / ' . $data['playersmax'] . '</td>
								<td class="zemlja">
									<img src="http://static.gametracker.rs/flags/'.$data["iso2"].'.png" style="vertical-align:middle; border:none" title="Zemlja '.$data["countryname"].'" /></td>';

					echo "<td class='ip'><a href=\"./server_info.php?id=" . $server->id . "\" onclick=\"javascript:void window.open('./server_info.php?id=" . $server->id . "','1396654994739','width=505,height=320,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');return false;\">Server Info</a></td></tr>";
	    		}
	    	}

	    	?>

	    </table>
	</div>
	</body>
</html>