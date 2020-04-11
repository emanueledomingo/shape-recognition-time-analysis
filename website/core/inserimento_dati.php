<?
include("../core/funzioni_mysql.php");
session_start();

//POST DATI
$daltonismo = mysql_real_escape_string($_POST['Daltonismo']);
$genere = mysql_real_escape_string($_POST['Genere']);
$eta = mysql_real_escape_string($_POST['Eta']);

//RESTITUZIONE ULTIMO ID DISPONIBILE
$sql_id = "SELECT * FROM `my_progettomultisensory`.`Soggetto` ORDER BY ID_Soggetto DESC LIMIT 1";
$last_id = "";
if($result_id = mysql_query($sql_id)){
  $last_id = mysql_fetch_assoc($result_id);
}

//CREAZIONE RECORD CON ID
$sql_create_id = "INSERT INTO `my_progettomultisensory`.`Soggetto` (`ID_Soggetto`) VALUES (".($last_id['ID_Soggetto']+1).")";

//INSERIMENTO DATI NEL RECORD
$sql = "UPDATE `my_progettomultisensory`.`Soggetto` SET
        `Genere` = '".$genere."',
        `Eta` = ".$eta.",
        `Daltonismo` = '".$daltonismo."' WHERE
        `Soggetto`.`ID_Soggetto` = ".($last_id['ID_Soggetto']+1);

if($result = mysql_query($sql)){
  $_SESSION['id'] = $last_id['ID_Soggetto']+1;
  $_SESSION['daltonismo'] = $daltonismo;
  header('Location: ../pages/info_test.php');
}
?>
