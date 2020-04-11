<?
session_start();
$sql = "INSERT INTO `my_progettomultisensory`.`Esperimento` (`Tipo`, `Livello`, `Tempo`, `Forma`, `ID_Soggetto`, `Colore`) 
VALUES ('".$_SESSION['daltonismo']."', '".$_SESSION['x']."', '".$_COOKIE["time"]."', '".$_SESSION['number']."', ".$_SESSION['id'].", '".$_SESSION['color']."')";
echo $sql;
$result = mysql_query($sql);
if($result){
  if($_SESSION['x'] == $_SESSION['z']){
      header('Location: ../fine.php');
  }else{
  	  $_SESSION['x'] = $_SESSION['x'] + $_SESSION['xx']; //figure da indovinare
	  $_SESSION['y'] = $_SESSION['y'] + 10; //barra caricamento
      if($_SESSION['color'] == 'black'){
      	$_SESSION['number'] = rand(1,40);
      }else{
        $_SESSION['number'] = rand(1,80);
           }
      unset($_COOKIE["time"]);
      header('Location: ../info_test.php');
  }
}
?>