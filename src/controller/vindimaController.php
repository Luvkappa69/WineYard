<?php
require_once '../model/vindimaModel.php';


$execute =  new Vindima();

if($_POST['op'] == 1){
    $resultado = $execute -> regista(
                                                $_POST['id_vinha'], 
                                                $_POST['id_funcionario'], 
                                                $_POST['kg'], 
                                                $_POST['data'], 
                                                $_POST['time'], 
                                                $_POST['id_ano']
    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $execute -> lista();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $execute -> remove(
                                                $_POST['id'] ,                                               
    );
    echo($resultado);
}






else if($_POST['op'] == 10){
    $resultado = $execute -> getSelect_vinhas();
    echo($resultado);
}
else if($_POST['op'] == 11){
    $resultado = $execute -> getSelect_funcionarios();
    echo($resultado);
}
else if($_POST['op'] == 12){
    $resultado = $execute -> getSelect_ano();
    echo($resultado);
}else if($_POST['op'] == 20){
    $resultado = $execute -> registaAno($_POST['novoAno']);
    echo($resultado);
}



?>