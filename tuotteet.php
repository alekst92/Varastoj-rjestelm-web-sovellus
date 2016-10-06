<?php
	$lista = array();
	$lista2 = array();
	$lista3 = array();

	require_once('config.php');
	require_once('dbopen.php');
	
	$query2 = "SELECT * FROM tuote ORDER BY tnimi ASC";
	//Suoritetaan SQL-kysely:
	$result2= mysql_query($query2)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());	
	
	while(($rivi = mysql_fetch_array($result2)) !== FALSE){ 
		$hinta = $rivi[2];
		array_push($lista,$hinta);
		$tnimi = $rivi[3];
		array_push($lista2,$tnimi);
		$yksikko = $rivi[1];
		array_push($lista3,$yksikko);
	}

	$koko = count($lista);
	for($i=0;$i<$koko;$i++){
		$tuote='<tr class="tuotteet_tr1">
				<th class="tuotteet_th1"><a class="index_a" href="tuote.php?koko='.$koko.'&numero='.$i.'&nimi='.$lista2[$i].'&hinta='.$lista[$i].'&yksikko='.$lista3[$i].'">'.$lista2[$i].'</a></th>
				<td class="tuotteet_td1">'.$lista[$i].'</td><td class="tuotteet_td1"><a class="index_a" href="poisto_paivitys_lomake.php?nimi='.$lista2[$i].'&hinta='.$lista[$i].'&yksikko='.$lista3[$i].'&numero='.$i.'">Poista/Muokkaa</a></td>
			</tr>';
		$tuotteet= $tuotteet.$tuote;
	}
	
echo '
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body>
		<h1 class="tuotteet_h1">Tuotteet</h1>
		<table class="tuotteet_table1">
			'.$tuotteet.'			
		</table>
		<br>
		<a class="index_a" href="lisays.php">Lisaa uusi tuote</a>
		<br>
		<a class="index_a" href="index.php">Palaa</a>
	</body>
</html>
';
require_once('dbclose.php');
?>