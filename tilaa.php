<?php
	session_start();
	$asnu = $_SESSION['asnu'];
	$asnu = $asnu + 1;
	$huomautus = $_POST["huomautus"];
	$maara = $_POST["maara2"];
	
	$lista = array();
	$lista2 = array();
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
	$a = array();
	$b = array();
	for($i=0;$i<$koko;$i++){
		$nimi = $_POST['tuote'.$i];
		array_push($a,$nimi);
		$maara = $_POST['maara'.$i];
		array_push($b,$maara);
	}
	for($i=0;$i<$koko;$i++){
		if($b[$i] != NULL){
			$m1='<tr>
					<td class="uusi_tilaus_td2"><input type="text" id="myinput" name="tuote'.$i.'" readonly value="'.$lista2[$i].'"></input></td><td class="uusi_tilaus_td2"><input type="text" id="myinput" name="maara'.$i.'" readonly value="'.$b[$i].'"></input></td>
				</tr>';
			$m2= $m2.$m1;
		}
	}
	//lisäys tietokantaan tilaus ja tilausrivi
//////////////////////////////////////////////////////
	$date2 = "'".$date."'";
	$huomautus2 = "'".$huomautus."'";
	$sql = "INSERT INTO tilaus (tilno, asno, tilpvm, tilhuom)
			VALUES ('', ".$asnu.", ".$date2.", ".$huomautus2.")";
	//Suoritetaan SQL-kysely:
	$result1= mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
		
	//$date2 = "'".$date."'";
	//$huomautus2 = "'".$huomautus."'";
	
	$sql = "SELECT tilno FROM tilaus ORDER BY tilno DESC LIMIT 1";
	$result1= mysql_query($sql)
			or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$last = mysql_fetch_array($result1);	//$last[0]
	
	for($i=0 ; $i<$koko ; $i++){
		if($b[$i] != NULL){
			$sql = "INSERT INTO tilausrivi (tilno, tuoteno, maara)
			VALUES (".$last[0].", ".$lista[$i].", ".$b[$i].")";
			$result1= mysql_query($sql)
				or die("Kyselyssä tapahtui virhe.: " . mysql_error());
		}
	}
	
echo '
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body>
		<h1 class="tuotteet_h1">Kiitos tilauksesta</h1>
		<h2 class="tilaukset_h2">Tilauksen tiedot</h2>
		<table>
			<tr>
				<th class="uusi_tilaus_th1">Paivamaara</th><td class="uusi_tilaus_td1"><input type="text" id="myinput" value="'.$date.'"></input></td>
			</tr>
			<tr>
				<th class="uusi_tilaus_th1">Huomautuksia</th><td class="uusi_tilaus_td1"><textarea rows="3" >'.$huomautus.'</textarea></td>
			</tr>
		</table>
		<table class="uusi_tilaus_table1">
			<tr class="uusi_tilaus_tr1">
				<th class="asiakkaat_th1_orange">Tuote</th><th class="asiakkaat_th1_orange">Maara</th>
			</tr>
			'.$m2.'
		</table>
		<br>
		<a class="index_a" href="index.php">Kotisivu</a>
	</body>
</html>
';
require_once('dbclose.php');
?>