<?php
	$luku = $_GET['luku'];	//tilno
	$lista = array();
	$lista2 = array();
	require_once('config.php');
	require_once('dbopen.php');
	// Alustetaan SQL-kysely:
	$query1 = "SELECT * FROM tilausrivi WHERE tilno=".$luku;
	//Suoritetaan SQL-kysely:
	$result1= mysql_query($query1)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());

	while(($rivi = mysql_fetch_array($result1)) !== FALSE){ 
		$tuoteno = $rivi[1];
		array_push($lista,$tuoteno);
		$maara = $rivi[2];
		array_push($lista2,$maara);
	}
	
	$koko = count($lista);
	$a1 = array();
	$a2 = array();
	for($i=0 ; $i<$koko ; $i++){
		$query2 = "SELECT * FROM tuote WHERE tuoteno=".$lista[$i];
		//Suoritetaan SQL-kysely:
		$result2= mysql_query($query2)
			or die("Kyselyssä tapahtui virhe.: " . mysql_error());	
		
		while(($rivi = mysql_fetch_array($result2)) !== FALSE){ 
			$hinta = $rivi[2];
			array_push($a1,round($hinta,2));
			$tnimi = $rivi[3];
			array_push($a2,$tnimi);
		}
	}
	$a3 = array();
	for($i=0 ; $i<$koko ; $i++){
		$hinta = ($lista2[$i]*$a1[$i]);
		array_push($a3,$hinta);
		$tilaus = '<tr class="tuotteet_tr1">
						<th class="tilaukset_th1">'.$a2[$i].'</th><td class="tilaukset_td1">'.$lista2[$i].'</td><td class="tilaukset_td1">'.number_format((float)$a1[$i], 2, '.', '').'</td><td class="tilaukset_td1">'.number_format((float)$hinta, 2, '.', '').'</td>
				   </tr>';
		$tilauslista = $tilauslista.$tilaus;
	}
	for($i=0;$i<$koko;$i++){
		$kokohinta = $kokohinta + $a3[$i];
	}
	

echo '
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body>
		<h1 class="tuotteet_h1">Tilaus</h1>
		<table class="tilaukset_table1">
			<tr class="tuotteet_tr1">
				<th class="asiakkaat_th1_orange">Tuote</th><th class="asiakkaat_th1_orange">Maara</th><th class="asiakkaat_th1_orange">Hinta</th><th class="asiakkaat_th1_orange">Yhteensa</th>
			</tr>
				'.$tilauslista.'
			<tr class="tilaus_tr2">
				<th></th><td></td><td>Yhteensa:</td><td class="tilaukset_td2">'.number_format((float)$kokohinta, 2, '.', '').'</td>
			</tr>					
		</table>
		<a class="index_a" href="tilaukset.php">Paluu</a>
	</body>
</html>
';
require_once('dbclose.php');
?>