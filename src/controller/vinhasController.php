<?php
require_once '../model/vinhasModel.php';


$execute =  new Vinha();

if($_POST['op'] == 1){
    $resultado = $execute -> regista(
                                                $_POST['descricao'], 
                                                $_POST['ha'], 
                                                $_POST['data_plantacao'], 
                                                $_POST['ano_p_colheita'], 
                                                $_FILES
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
else if($_POST['op'] == 4){
    $resultado = $execute -> getDados(
                                    $_POST['id'],                                            
    );
    echo($resultado);
}
else if($_POST['op'] == 5){
    $resultado = $execute -> edita(
                                    $_POST['descricao'], 
                                    $_POST['ha'], 
                                    $_POST['data_plantacao'], 
                                    $_POST['ano_p_colheita'], 
                                    $_FILES,
                                    $_POST['old_key']

    );
    echo($resultado);
}
else if($_POST['op'] == 6){
    $resultado = $execute -> addCasta(
                                    $_POST['addCastaVinha'],                                            
                                    $_POST['addCastaCasta']                                        
    );
    echo($resultado);
}






else if($_POST['op'] == 10){
    $resultado = $execute -> getSelect_vinhas();
    echo($resultado);
}
else if($_POST['op'] == 11){
    $resultado = $execute -> getSelect_castas();
    echo($resultado);
}



?>