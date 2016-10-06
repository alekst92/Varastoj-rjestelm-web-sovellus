<?php

	//$koko = $_GET['koko'];
	$numero = $_GET['numero'];
	$nimi = $_GET['nimi'];
	$hinta = $_GET['hinta'];
	$yksikko = $_GET['yksikko'];
	
	require_once('config.php');
	require_once('dbopen.php');
	$sql = "SELECT tuoteno FROM tuote WHERE tnimi='".$nimi."'";
	//Suoritetaan SQL-kysely:
	$result1 = mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$tuoteno = mysql_fetch_array($result1);	//$tuoteno[0]

	$tiedot = 
			'
				<tr>
					<th class="tuote_th2">Tuote:</th><th class="tuote_th3">'.$nimi.'</th>
				</tr>
				<tr>
					<th class="tuote_th2">Yksikko:</th><th class="tuote_th3">'.$yksikko.'</th>
				</tr>
				<tr>
					<th class="tuote_th2">Hinta:</th><th class="tuote_th3">'.$hinta.'</th>
				</tr>
			';

	$sql = "SELECT kuva FROM tuote WHERE tuoteno='".$tuoteno[0]."'";
	
	//Suoritetaan SQL-kysely:
	$result1 = mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$kuva = mysql_fetch_array($result1);	//$kuva[0]
	$k = "kuvat/".$kuva[0];	
	echo '
	<html>
		<head>
			<link rel="stylesheet" href="K06.css"></link>
		</head>
		<body>
			<h1 class="tuotteet_h1">Tuotteen tiedot</h1>
			<table class="tuote_table1">
				<tr>
					<th class="tuote_th1"><img src="'.$k.'"></img></th>
					<th>
						<table class="tuote_table2">
						'.$tiedot.'
						</table>
					</th>
				</tr>
			</table>
			<br>
			<a class="index_a" href="tuotteet.php">Palaa</a>
		</body>
	</html>
	';
	require_once('dbclose.php');
?>