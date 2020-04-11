<?php

$db = "************";
$host = "localhost";
$username = "***********";
$password = "***********";

if(!$connection = @mysql_connect($host,$username,$password))
{
	echo 'Impossibile connettersi a MySql';
	die;
}
if(!@mysql_select_db($db,$connection))
{
	echo "Impossibile selezionare il database ".$db;
	die;
}

?>
