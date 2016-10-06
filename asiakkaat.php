<?php
	$lista = array();
	$lista2 = array();
	
	require_once('config.php');
	require_once('dbopen.php');
	// Alustetaan SQL-kysely:
	$query1 = "SELECT * from asiakas ORDER BY animi ASC";
	$query2 = "SELECT COUNT(*) FROM asiakas";

	//Suoritetaan SQL-kysely:
	$result1= mysql_query($query1)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$result2= mysql_query($query2)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	
	$koko = mysql_fetch_row($result2);	// $koko[0] 

	while(($rivi = mysql_fetch_array($result1)) !== FALSE){ 
		$nimi = $rivi[1];
		array_push($lista,$nimi);
		$osoite = $rivi[2];
		array_push($lista2,$osoite);
	}
	
	for($i=0 ; $i<$koko[0] ; $i++){
		$asiakas = '<tr class="tuotteet_tr1">
						<th id="id1" class="asiakkaat_th1"><a class="index_a" href="tilaukset.php?luku='.$i.'&nimi='.$lista[$i].'">'.$lista[$i].'</a></th><td class="tuotteet_td1">'.$lista2[$i].'</td>
					</tr>';
		$asiakkaat = $asiakkaat.$asiakas;
	}

	require_once('dbclose.php');

echo '
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body>
		<h1 class="tuotteet_h1">Asiakkaat</h1>
		<table class="tuotteet_table1">
			<tr>
				<th class="asiakkaat_th1_orange">Asiakas</th><th class="asiakkaat_th1_orange">Osoite</th>
			</tr>
			'.$asiakkaat.'				
		</table>
		<br>
		<a class="index_a" href="index.php">Palaa</a>
	</body>
</html>
';
require_once('dbclose.php');
?>