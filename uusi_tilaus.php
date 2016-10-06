<?php
	$asnu = $_GET['asnu'];	//asnu
	$luku = $_GET['luku'];	//tilno
	$lista = array();
	$lista2 = array();
	session_start();
	$_SESSION['asnu'] = $asnu;
	$_SESSION['luku'] = $luku;	

	require_once('config.php');
	require_once('dbopen.php');
	// Alustetaan SQL-kysely:
	$query1 = "SELECT CURDATE()";
	//Suoritetaan SQL-kysely:
	$result1= mysql_query($query1)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());

	$rivi = mysql_fetch_array($result1);
	$date = $rivi[0];
	$query2 = "SELECT * FROM tuote";
	//Suoritetaan SQL-kysely:
	$result2= mysql_query($query2)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());	
	
	while(($rivi = mysql_fetch_array($result2)) !== FALSE){ 
		$tuoteno = $rivi[0];
		array_push($lista,$tuoteno);
		$tnimi = $rivi[3];
		array_push($lista2,$tnimi);
	}
	$koko = count($lista);
	for($i=0;$i<$koko;$i++){
		$m1='<tr>
				<th class="uusi_tilaus_th2"><input type="text" id="myinput" name="nro'.$i.'" readonly value="'.$lista[$i].'"></input></th><td class="uusi_tilaus_td2"><input type="text" id="myinput" name="tuote'.$i.'" readonly value="'.$lista2[$i].'"></input></td><td class="uusi_tilaus_td2"><input type="text" id="myinput" name="maara'.$i.'"></input></td>
			</tr>';
		$m2= $m2.$m1;
	}
	
	$_SESSION['tuotenumerot'] = $lista;
	
echo '
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body>
		<form method="post" action="tilaa.php">
			<h1 class="tuotteet_h1">Tilaus</h1>
			<table>
				<tr>
					<th class="uusi_tilaus_th1">Paivamaara</th><td class="uusi_tilaus_td1"><input type="text" id="myinput" value="'.$date.'"></input></td>
				</tr>
				<tr>
					<th class="uusi_tilaus_th1">Huomautuksia</th><td class="uusi_tilaus_td1"><textarea rows="3" name="huomautus">-</textarea></td>
				</tr>
			</table>
			<table class="uusi_tilaus_table1" id="tabid1">
				<tr class="uusi_tilaus_tr1">
					<th class="asiakkaat_th1_orange">Tuotenro</th><th class="asiakkaat_th1_orange">Tuote</th><th class="asiakkaat_th1_orange">Maara</th>
				</tr>
				'.$m2.'
			</table>
			<br>
			<input type="submit" name="maara" value="Tilaa">
		</form>
		
	</body>
</html>
';
require_once('dbclose.php');
?>