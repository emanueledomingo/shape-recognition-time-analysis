var canvas = document.getElementById('Canvas');
var parent = document.getElementById("main");
var context = canvas.getContext("2d");

canvas.width = parent.offsetWidth;
canvas.height = parent.offsetHeight;
console.log("screen size: " + canvas.width + "x" + canvas.height);
var shapeNumber;
var toFind;
var colorToFind;
var stop = 0;


var Shape = function(index, color) {
  this.Sprite = new Image();
  this.Sprite.src = "./shapes/" + color + "/" + index + ".png";
  this.Width = 32;
  this.Height = 32;
  this.index = index;
  this.color = color;
}
var Shapes = new Array();

var checkFind = function(x, y) {

  for (var i = 0; i < Shapes.length; i++) {
    var temp = Shapes[i];
    if ((temp.index != toFind)) {
      continue;
    }
    if ((Math.abs(temp.XPos - x) < 32) && (Math.abs(temp.YPos - y) < 32)) {
      return true;
    }
  }
}

var mouseClicked = function(mouse) {
  let rect = canvas.getBoundingClientRect();
  let x = mouse.clientX - rect.left;
  let y = mouse.clientY - rect.top;
  console.log("X: " + x + " Y: " + y);
  if (checkFind(x, y)) {
    stopTime();
    showButton();
  }
}

var convertColor = function(number) {
  if (number == 1) return 'black';
  if (number == 2) return 'blue';
  if (number == 3) return 'gray_scale';
  if (number == 4) return 'green';
  if (number == 5) return 'red';
  if (number == 6) return 'yellow';
}

var drawRandomShape = function() {

  var numberTotaleFigure = 40;
  if (colorToFind == 'black') {
    numberTotaleFigure = 40;
  } else {
    numberTotaleFigure = 80;
  }
  for (var i = 0; i < shapeNumber; i++) {
    var index = Math.floor(Math.random() * numberTotaleFigure) + 1;
    var color_rnd = colorToFind;
    var shape = new Shape(index, color_rnd);
    var xPos = Math.floor(Math.random() * (canvas.width - 64));
    var yPos = Math.floor(Math.random() * (canvas.height - 64));

    shape.XPos = xPos + 32;
    shape.YPos = yPos + 32;
    if (Shapes.length > 1) {
      for (var j = 0; j < Shapes.length; j++) {
        var temp = Shapes[j];
        if ((Math.abs(temp.XPos - shape.XPos) < 32) && (Math.abs(temp.YPos - shape.YPos) < 32)) {
          if (Math.abs(temp.XPos - shape.XPos) < 32) {
            if (shape.XPos + 33 >= canvas.width - 64) {
              shape.XPos = 45;
              j = 0;
            } else {
              shape.XPos += 33;
              j = 0;
            }
          }
          if (Math.abs(temp.YPos - shape.YPos) < 32) {
            if (shape.YPos + 33 >= canvas.height - 64) {
              shape.YPos = 45;
              j = 0;
            } else {
              shape.YPos += 33;
              j = 0;
            }
          }
        }
      }
    }
    Shapes.push(shape);
  }
  checkFindElement();
  setTimeout(function() {
    for (var i = 0; i < Shapes.length; i++) {
      var temp = Shapes[i];
      context.drawImage(temp.Sprite, temp.XPos, temp.YPos, temp.Width, temp.Height);
    }
  }, 1000);
}
//funzione che verifica se l'elemento da cercare è tra quelli generati random, se non lo è viene
//sostituito il primo elemento, se invece l'elemento target viene trovato più volte deve essere
//sostituito con uno casuale
var checkFindElement = function() {

  check = false;
  for (var i = 0; i < Shapes.length; i++) {
    var temp = Shapes[i];

    if ((temp.index == toFind)) {
      if (check) {
        if (toFind > 1) {
          var shape = new Shape(1, temp.color);
          shape.XPos = temp.XPos;
          shape.YPos = temp.YPos;
          Shapes[i] = shape;
        } else {
          var shape = new Shape(2, temp.color);
          shape.XPos = temp.XPos;
          shape.YPos = temp.YPos;
          Shapes[i] = shape;
        }
      }
      check = true;
    }
  }
  if (!check) {

    var temp = Shapes[0];

    var shape = new Shape(toFind, colorToFind);
    shape.XPos = temp.XPos;
    shape.YPos = temp.YPos;
    Shapes[0] = shape;

  }
}
var main = function(shapeToFind, numberOfShape, color) {

  toFind = shapeToFind;
  shapeNumber = numberOfShape;

  colorToFind = color;
  drawRandomShape();
  document.getElementById("start").style.visibility = 'hidden';
  setTimeout("startTime()", 1000);
}

canvas.addEventListener("mousedown", mouseClicked, false);

var showButton = function() {
  var button = document.getElementById('finish');
  button.style.display = 'block';
}

var finishTest = function() {

  createCookie("time", visualizzazione, "10");
  window.location.href = '/core/caricamento_dati.php';
}

function createCookie(name, value, days) {
  var expires;

  if (days) {
    var date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    expires = "; expires=" + date.toGMTString();
  } else {
    expires = "";
  }

  document.cookie = escape(name) + "=" +
    escape(value) + expires + "; path=/";
}

//CRONOMETRO
var minuti = 0;
var secondi = 0;
var decimi = 0;
var visualizzazione = "";

var startTime = function() {
  if (stop == 0) {
    decimi += 1;
    if (decimi > 9) {
      decimi = 0;
      secondi += 1;
    }
    if (secondi > 59) {
      secondi = 0;
      minuti += 1;
    }
    if (minuti < 10) {
      visualizzazione = "0" + minuti;
    } else {
      visualizzazione = minuti;
    }
    if (secondi < 10) {
      visualizzazione = visualizzazione + ":0" + secondi;
    } else {
      visualizzazione = visualizzazione + ":" + secondi;
    }
    visualizzazione = visualizzazione + ":" + decimi;
    document.getElementById("mostra_cronometro").value = visualizzazione;
    setTimeout("startTime()", 100);
  }
}

var stopTime = function() {
  stop = 1;
}
