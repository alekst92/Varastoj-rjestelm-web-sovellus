<?php
	require_once('config.php');
	require_once('dbopen.php');
	$numero = $_GET['numero'];
	$nimi = $_GET['nimi'];
	$hinta = $_GET['hinta'];
	$yksikko = $_GET['yksikko'];

	$sql = "SELECT tuoteno FROM tuote WHERE tnimi='".$nimi."'";
	//Suoritetaan SQL-kysely:
	$result1 = mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$tuoteno = mysql_fetch_array($result1);	//$tuoteno[0]	
	
	$sql = "SELECT kuva FROM tuote WHERE tuoteno='".$tuoteno[0]."'";
	
	//Suoritetaan SQL-kysely:
	$result1 = mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$kuva = mysql_fetch_array($result1);	//$kuva[0]

	
echo '
<html>
	<head>
		<link rel="stylesheet" href="K06.css"></link>
	</head>
	<body id = "body1">
		<h1 id="h1" class="tuotteet_h1">Paivita tai poista tuote</h1>
		<form  id="form1" method="post">
			<table>
				<tr>
					<th class="poisto_paivitys_lomake_th1">Tuote:</th><td><input type="text" id="myinput" name="nimi" value="'.$nimi.'"></input></td>
				</tr>
				<tr>
					<th class="poisto_paivitys_lomake_th1">Yksikko:</th><td><input type="text" id="myinput" name="yksikko" value="'.$yksikko.'"></input></td>
				</tr>
				<tr>
					<th class="poisto_paivitys_lomake_th1">Hinta:</th><td><input type="text" id="myinput" name="hinta" value="'.$hinta.'"></input></td>
				</tr>
				<tr>
					<th class="poisto_paivitys_lomake_th1">Kuva:</th><td><input type="text" id="myinput" name="kuva" value="'.$kuva[0].'"></input></td>
				</tr>				
			</table>
			<input name="poista" value="Poista" type="submit">
			<input name="paivita" value="Paivita" type="submit">
			<br>
			<br>
			<a class="index_a" href="tuotteet.php">Palaa</a>
			
		</form>
	</body>
</html>
';
if(isset($_POST['poista'])){
echo '
<script>
		var parent = document.getElementById("body1");
		var child = document.getElementById("h1");
		parent.removeChild(child);
		
		child = document.getElementById("form1");
		parent.removeChild(child);
		
		var uusi=document.createElement("p");
		uusi.setAttribute("id", "poisto_paivitys_lomake_p1");
		uusi.innerHTML = "Tuote on poistettu";
		document.body.appendChild(uusi);
		
		var uusilinkki=document.createElement("a");
		uusilinkki.setAttribute("class", "index_a");
		uusilinkki.href="tuotteet.php";
		uusilinkki.innerHTML = "Palaa takaisin";
		document.body.appendChild(uusilinkki);
		
</script>
';
	$sql = "SELECT tuoteno FROM tuote WHERE tnimi='".$nimi."'";
	
	//Suoritetaan SQL-kysely:
	$result1 = mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$tuoteno = mysql_fetch_array($result1);	//$tuoteno[0]
	$sql = "DELETE FROM tuote WHERE tuoteno=".$tuoteno[0]."";
	//Suoritetaan SQL-kysely:
	mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());

}
else if(isset($_POST['paivita'])){
echo '
<script>
		var parent = document.getElementById("body1");
		var child = document.getElementById("h1");
		parent.removeChild(child);
		
		child = document.getElementById("form1");
		parent.removeChild(child);
		
		var uusi=document.createElement("p");
		uusi.setAttribute("id", "poisto_paivitys_lomake_p1");
		uusi.innerHTML = "Tuote on paivitetty";
		document.body.appendChild(uusi);
		
		var uusilinkki=document.createElement("a");
		uusilinkki.setAttribute("class", "index_a");
		uusilinkki.href="tuotteet.php";
		uusilinkki.innerHTML = "Palaa takaisin";
		document.body.appendChild(uusilinkki);
		
</script>
';
	$sql = "SELECT tuoteno FROM tuote WHERE tnimi='".$nimi."'";
	
	//Suoritetaan SQL-kysely:
	$result1 = mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
	$tuoteno = mysql_fetch_array($result1);	//$tuoteno[0]
	


	$sql = "UPDATE tuote SET tnimi="."'".$_POST["nimi"]."'"." , yksikko="."'".$_POST["yksikko"]."'"." , hinta="."'".$_POST["hinta"]."'"." , kuva="."'".$_POST["kuva"]."'"."
			WHERE tuoteno=".$tuoteno[0]."";

	//Suoritetaan SQL-kysely:
	$result1= mysql_query($sql)
		or die("Kyselyssä tapahtui virhe.: " . mysql_error());
}

require_once('dbclose.php');
?>