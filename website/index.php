<!doctype html>
<?
session_start();
		  //Impostazioni
          $_SESSION['x'] = 45; //numero forme attuali
          $_SESSION['y'] = 10; //percentuale barra caricamento
          $_SESSION['z'] = 90; //numero forme finali
          $_SESSION['xx'] = 5; //intervallo di incremento delle forme
          //range va da 45 a 90 
          $_SESSION['number'] = 0;
          $_SESSION['color'] = 'vuoto';
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Buffa Salvatore, Domingo Emanuele, Gristina Salvatore">
    <link rel="icon" href="">

    <title>Pagina iniziale</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="inserimento_dati.php">
          <h1 class="h3 mb-3 font-weight-normal">Riguardo il progetto</h1>
  <p>  Per avere maggiori informazioni sulle finalità del progetto <a href="info_progetto.html" target="_blank">clicca qui</a>
      <h1 class="h3 mb-3 font-weight-normal">Informazioni</h1>
        <div class="form-group">
    <label for="Genere" >Genere</label>
    <select class="form-control form-control-lg" name="Genere" id="Genere">
      <option>Uomo</option>
      <option>Donna</option>
    </select>
  </div>
  	  <label for="Eta" >Età</label>
  	  <label for="Eta" class="sr-only">Inserisci età</label>
      <input type="number" id="Eta" name="Eta" class="form-control" required autofocus>
  <div class="form-group">
    <label for="Daltonismo" >Daltonismo</label>
    <select class="form-control form-control-lg" name="Daltonismo" id="Daltonismo">
      <option>Nessuna</option>
      <option>Protanopia</option> <!--  (insensibilità al rosso) -->
      <option>Deuteranopia</option> <!--  (insensibilità al verde) -->
      <option>Tritanopia</option> <!--  (insensibilità al blu, al violetto e al giallo) -->
    </select>
  </div>
      <!--
      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>  
      </div>
      -->
      <input id="consenso" type="checkbox" required>
      <label for="checkbox1">Dichiaro di aver letto le <a href="info_progetto.html" target="_blank">condizioni d'uso</a></label>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Avanti</button>
      <p class="mt-5 mb-3 text-muted">&copy; 2020-2021</p>
    </form>
  </body>
</html>
