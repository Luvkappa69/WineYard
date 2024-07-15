<?php
require_once '../model/funcionariosModel.php';


$execute =  new Funcionario();

if($_POST['op'] == 1){
    $resultado = $execute -> regista(
                                                $_POST['bi'], 
                                                $_POST['nome'], 
                                                $_POST['morada'], 
                                                $_POST['telefone'], 
                                                $_POST['email'], 
                                                $_POST['salario'], 
                                                $_POST['id_estado']
    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $execute -> lista_f();
    echo($resultado);
}



else if($_POST['op'] == 10){
    $resultado = $execute -> getSelect_estado();
    echo($resultado);
}
else if($_POST['op'] == 11){
    $resultado = $execute -> estadoModify( $_POST['bi']);
    echo($resultado);
}



?>