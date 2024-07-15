<?php
require_once '../model/modelPedidos.php';
require_once '../model/utilities/getSelect.php';

$execute =  new Pedido();

if($_POST['op'] == 1){
    $resultado = $execute -> regista(
                                                $_POST['idMesa'], 
                                                $_POST['idTipo']
    );
    echo($resultado);
}else if($_POST['op'] == 2){
    $resultado = $execute -> lista();
    echo($resultado);
}else if($_POST['op'] == 3){
    $resultado = $execute -> remove(
                                                $_POST['pedidoID'] ,                                             
                                                $_POST['cozinhaID']                                             
    );
    echo($resultado);
}
else if($_POST['op'] == 4){
    $resultado = $execute -> getDados(
                                    $_POST['pedidoID'], 
                                    $_POST['cozinhaID']                                              
    );
    echo($resultado);
}
else if($_POST['op'] == 5){
    $resultado = $execute -> edita(
                                                $_POST['mesa'], 
                                                $_POST['estado'], 
                                                $_POST['prato'], 
                                                $_POST['old_pedidoID_key'], 
                                                $_POST['old_cozinhaID_key']
    );
    echo($resultado);
}



// get selects
else if($_POST['op'] == 7){
    $resultado = $execute -> getSelect_mesa();
    echo($resultado);
}
else if($_POST['op'] == 8){
    $resultado = $execute -> getSelect_pratos();
    echo($resultado);
}
else if($_POST['op'] == 9){
    $resultado = $execute -> getSelect_estado();
    echo($resultado);
}
else if($_POST['op'] == 10){
    $resultado = $execute -> getSelect_clientes();
    echo($resultado);
}





//adicional requests
else if($_POST['op'] == 11){
    $resultado = $execute -> getFaturaPratoCozinha(
                                                    $_POST['cozinhaID'], 
                                                    $_POST['pedidoID']
                                                );
    echo($resultado);
}
else if($_POST['op'] == 12){
    $resultado = $execute -> emiteFatura(
                                            $_POST['clienteFatura'], 
                                            $_POST['cozinhaID'], 
                                            $_POST['pedidoID'], 
                                            $_POST['preco']
                                        );
    echo($resultado);
}


?>