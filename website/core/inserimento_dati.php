<?

include("funzioni_mysql.php");
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
//echo "Ultimo ID disponibile: ".$last_id['ID_Soggetto']." <br>";
}else{
//echo "errore durante ricezione id record <br> sql: ".$sql_id." <br>";
}
//CREAZIONE RECORD CON ID
$sql_create_id = "INSERT INTO `my_progettomultisensory`.`Soggetto` (`ID_Soggetto`) VALUES (".($last_id['ID_Soggetto']+1).")";
if($result_create_id = mysql_query($sql_create_id)){
//echo "record creato con ID:".($last_id['ID_Soggetto']+1). "<br>";
}else{
//echo "errore durante creazione id record <br> sql: ".$sql_create_id." <br>";
}
//INSERIMENTO DATI NEL RECORD
$sql = "UPDATE `my_progettomultisensory`.`Soggetto` SET 
`Genere` = '".$genere."',
`Eta` = ".$eta.", 
`Daltonismo` = '".$daltonismo."' WHERE
`Soggetto`.`ID_Soggetto` = ".($last_id['ID_Soggetto']+1);
if($result = mysql_query($sql)){
$_SESSION['id'] = $last_id['ID_Soggetto']+1;
$_SESSION['daltonismo'] = $daltonismo;
//echo "SESSIONE: ". $_SESSION['id']. "<br>";
header('Location: info_test.php');
}else{
//echo "errore durante inserimento dati ".$sql."<br>";
}
?>