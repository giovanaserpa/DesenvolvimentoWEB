<?php
#\n para quebrar linha
echo"giovana";
$nome = "Giovana";
$dia = 21;
$altura = 1.80;
$ativo = true;
$lista = ["php", "mysql", "html"];
echo "\n $nome está no dia $dia na aula de {$lista[0]}.";
$nota = 8.3;
if($nota>=7) {
    echo "Aprovado\n";
}else{
    echo "Reprovado\n";
}
for ($i = 0; $i<3; $i++){
    echo "for: $i\n";
}
?>