<?php
// dbopen.php
// Tietokantatyypin testaaminen mahdollistaa myöhemmin
// kätevästi myös muiden tietokantatuotteiden käyttöönotoon
if ($dbtype == "mysql") {
   $conn = mysql_connect($dbhost, $dbuser, $dbpass)
       or die('Ei voida yhdistää: ' . mysql_error());
   mysql_select_db($dbname, $conn);
}
?>