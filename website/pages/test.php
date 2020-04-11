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

    <title>Raccolta dati</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="../css/signin.css" rel="stylesheet">
  </head>

  <body class="text-center">
    <form class="form-signin" method="POST" action="../core/inserimento_dati.php">
      <h1 class="h2 font-weight-normal">Ci siamo quasi!</h1>
      <h1 class="h5 mb-5 font-weight-normal">Raccontaci qualcosa di te</h1>
      <div class="form-group">
        <label for="Genere" >Genere</label>
        <select class="form-control form-control-lg" name="Genere" id="Genere">
          <option>Uomo</option>
          <option>Donna</option>
        </select>
      </div>
      <div class="form-group">
  	     <label for="Eta" >Età</label>
  	      <label for="Eta" class="sr-only">Inserisci età</label>
          <input type="number" id="Eta" name="Eta" class="form-control" required autofocus>
      </div>
      <div class="form-group">
        <label for="Daltonismo" >Daltonismo</label>
        <select class="form-control form-control-lg" name="Daltonismo" id="Daltonismo">
          <option>Nessuna</option>
          <option>Protanopia</option> <!--  (insensibilità al rosso) -->
          <option>Deuteranopia</option> <!--  (insensibilità al verde) -->
          <option>Tritanopia</option> <!--  (insensibilità al blu, al violetto e al giallo) -->
        </select>
      </div>
      <input id="consenso" type="checkbox" required>
      <label for="checkbox1">Dichiaro di aver letto le <a href="../pages/condizioni_uso.html" target="_blank">condizioni d'uso</a></label>
      <button class="btn btn-lg btn-primary btn-block mt-5" type="submit">Avanti</button>
    </form>
  </body>
</html>
