<?php
echo'
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body id = "body1">
		<h1 class="tuotteet_h1">Tuote</h1>
		<form id="form1" method="post">
			<table id="table1">
				<tr>
					<th class="poisto_paivitys_lomake_th1">Tuote:</th><td><input type="text" id="myinput" name="nimi" value=""></input></td>
				</tr>
				<tr>
					<th class="poisto_paivitys_lomake_th1">Yksikko:</th><td><input type="text" id="myinput" name="yksikko" value=""></input></td>
				</tr>
				<tr>
					<th class="poisto_paivitys_lomake_th1">Hinta:</th><td><input type="text" id="myinput" name="hinta" value=""></input></td>
				</tr>
				<tr>
					<th class="poisto_paivitys_lomake_th1">Kuva:</th><td><input type="text" id="myinput" name="kuva" value=""></input></td>
				</tr>				
			</table>
			<input name="lisays" value="Lisays" type="submit">
		</form>
		<a class="index_a" href="tuotteet.php">Takaisin tuotteet sivulle</a>
	</body>
</html>
';

if(isset($_POST['lisays'])){
	echo '
		<script>
			var container = document.getElementById("form1")
			var uusi=document.createElement("p");
			uusi.innerHTML = "Tuote on lisatty.";
			container.appendChild(uusi);	
		</script>
	';
	$yksikko = $_POST["yksikko"];
	$yksikko = "'".$yksikko."'";
	$hinta = $_POST["hinta"];
	$hinta = "'".$hinta."'";
	$nimi = $_POST["nimi"];
	$nimi = "'".$nimi."'";
	$kuva = $_POST["kuva"];
	$kuva = "'".$kuva."'";
	require_once('config.php');
	require_once('dbopen.php');
	$sql = "INSERT INTO tuote(tuoteno, yksikko, hinta, tnimi, kuva) VALUES ('',".$yksikko.",".$hinta.",".$nimi.",".$kuva.")";
	
	//Suoritetaan SQL-kysely:
	mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
}
?>