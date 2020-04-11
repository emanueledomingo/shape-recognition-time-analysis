<!DOCTYPE html>
<? session_start(); ?>
<html lang="it" dir="ltr">
  <head>
    <meta charset="utf-8">
     <link rel="stylesheet" type="text/css" href="style.css">
         <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Inizia test</title>
  </head>
  <body>
  	<center><div class="info" id="info">Trova l'immagine </div></center>
   <?
   	if($_SESSION['color'] == 'gray_scale'){
    	echo '<div id="main" class="main" style="background-color: #faebd7">';
    }else{
    	echo '<div id="main" class="main">';
    }
   ?>
      <canvas id="Canvas" class="canvas"></canvas>
      <script src="demo.js"></script>
      <input id="mostra_cronometro" style="text-align:center;" value="00:00:00:0" disabled="disabled" />
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </div>  
    <center><button class="btn btn-primary btn-sm" onclick="main(<? echo $_SESSION['number']; ?>,<? echo $_POST['numberOfShape'];?>,'<? echo $_SESSION['color'];?>');" id="start">START</button></center>
    <center><button class="btn btn-primary btn-sm" onclick="finishTest()" id="finish" style="display: none;">FINISH</button></center>
  </body>
</html>
