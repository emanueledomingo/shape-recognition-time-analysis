<!doctype html>
<html lang="en">
<?
session_start();
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Buffa Salvatore, Domingo Emanuele, Gristina Salvatore">
    <link rel="icon" href="">

    <title>Info Test [ <? echo $_SESSION['y']; ?>- 100%]</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="canvas/demo.php">
          <h1 class="h3 mb-3 font-weight-normal">Inizia Test</h1>
          <p> Per questo livello si richiede di cercare la seguente figura tra <? echo $_SESSION['x']; ?> differenti figure
          <?
          include "funzioni.php";
		  if($_SESSION['color'] == 'vuoto'){
          	$_SESSION['color'] = scelta_colore($_SESSION['daltonismo']);
            if($_SESSION['color'] == 'black'){
            	$_SESSION['number'] = rand(1,40);
            }else{
            	$_SESSION['number'] = rand(1,80);
            }
          }
          echo '<img src="canvas/shapes/'.$_SESSION['color'].'/'.$_SESSION['number'].'.png" alt="figura da cercare" height="64" width="64">';
          //echo $_SESSION['color'];
          ?>
      <input type="hidden" id="numberOfShape" name="numberOfShape" value="<? echo $_SESSION['x']; ?>" readonly><br><br>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Avanti</button> 
<div class="progress">
  <div class="progress-bar progress-bar-striped" role="progressbar" style="width: <? echo $_SESSION['y']; ?>%" aria-valuenow="<? echo $_SESSION['y']; ?>" aria-valuemin="0" aria-valuemax="100"><? echo $_SESSION['y']; ?>%</div>
</div>
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
  </body>
</html>
<?

/*
generazione dei colori mediante numero random:
1. nero
2. blu
3. scala grigio (tutto il test così)
4. verde
5. viola
6. rosso
7. giallo
*/

?>