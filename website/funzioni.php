<?
/*
generazione dei colori mediante numero random:
1. nero
2. blu
3. scala grigio
4. verde
5. rosso
6. giallo
*/
function scelta_colore($daltonismo){

		  while(true){
          	$color = rand(1,6);
            if($daltonismo == 'Nessuna'){
            	return convertiNumero($color);
            }
            if($daltonismo == 'Protanopia'){
            	if($color != 5){
					return convertiNumero($color);
                }
            }
            if($daltonismo == 'Deuteranopia'){
            	if($color != 4){
                	return convertiNumero($color);
                }
            }
            if($daltonismo == 'Tritanopia'){
            	if(($color != 2) && ($color != 6)){
                	return convertiNumero($color);
                }
            }
          }
}

function convertiNumero($num){
if($num == 1) return 'black';
if($num == 2) return 'blue';
if($num == 3) return 'grey_scale';
if($num == 4) return 'green';
if($num == 5) return 'red';
if($num == 6) return 'yellow';
}
?>
