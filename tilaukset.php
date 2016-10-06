<?php
	$luku = $_GET['luku'];	//asnu
	$nimi = $_GET['nimi'];	//firmannimi
	$lista = array();
	$lista2 = array();
	$lista3 = array();
	require_once('config.php');
	require_once('dbopen.php');
	// Alustetaan SQL-kysely:
	$query1 = "SELECT * FROM tilaus WHERE asno=".($luku+1);
	//Suoritetaan SQL-kysely:
	$result1= mysql_query($query1)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());

	while(($rivi = mysql_fetch_array($result1)) !== FALSE){ 
		$tilpvm = $rivi[2];
		array_push($lista,$tilpvm);
		$huom = $rivi[3];
		array_push($lista2,$huom);
		$tilno = $rivi[0];
		array_push($lista3,$tilno);
	}
	$koko = count($lista);
	
	for($i=0 ; $i<$koko ; $i++){
		$tilaus = '<tr class="tuotteet_tr1">
						<th class="tilaukset_th1"><a class="index_a" href="tilaus.php?luku='.$lista3[$i].'">'.$lista[$i].'</a></th><td class="tilaukset_td1">'.$lista2[$i].'</td>
				  </tr>';
		$tilaukset = $tilaukset.$tilaus;
	}

echo '
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body>
		<h1 class="tuotteet_h1">Asiakkaan tilaukset</h1>
		<h2 class="tilaukset_h2">'.$nimi.'</h2>
		<table class="tilaukset_table1">
			<tr class="tuotteet_tr1">
				<th class="asiakkaat_th1_orange">Paivamaara</th><th class="asiakkaat_th1_orange">Huomautuksia</th>
			</tr>
			'.$tilaukset.'
		</table>
		<hr id="hr1">
		<a class="index_a" href="uusi_tilaus.php?asnu='.$luku.'">Uusi tilaus</a>
		<br>
		<a class="index_a" href="asiakkaat.php">Paluu</a>
	</body>
</html>
';
require_once('dbclose.php');
?>