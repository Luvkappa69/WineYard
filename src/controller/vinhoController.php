<?php
require_once '../model/vinhoModel.php';


$execute =  new Vinho();

if($_POST['op'] == 1){
    $resultado = $execute -> listaVinho();
    echo($resultado);
}


?>