<?php
require_once '../model/vinhoModel.php';


$execute =  new Vinho();

if($_POST['op'] == 1){
    $resultado = $execute -> listaVinho();
    echo($resultado);
}
elseif($_POST['op'] == 2){
    $resultado = $execute -> executaVenda(
        $_POST['id_vindima'],
        $_POST['quantidade']
    );
    echo($resultado);
}


?>