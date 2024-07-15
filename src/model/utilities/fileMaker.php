<?php

function emiteFatura($clienteFatura,$pedidoID){
    
    global $conn;
    $stmt1 = "";

    //get estado pedido
    $stmt1 = $conn->prepare("SELECT * FROM pedido WHERE id = ?");
    $stmt1->bind_param("i", $pedidoID);
    $stmt1->execute();
    $result = $stmt1->get_result();
    $row1 = $result->fetch_assoc();
    $stmt1->close();


    if ($row1['idEstado'] == 3){
        return "O Pedido já foi finalizado...";
    }
    
    //get mesa
    $stmt3 = "";
    $stmt3 = $conn->prepare("SELECT * FROM mesas WHERE id = ?");
    $stmt3->bind_param("i", $row1['idMesa']);
    $stmt3->execute();
    $result = $stmt3->get_result();
    $row3 = $result->fetch_assoc();
    $stmt3->close();


    //get preco do prato
    $stmt4 = "";
    $stmt4 = $conn->prepare("SELECT 
            pedido.*, 
            pedido.id as pedidoID, 
            cozinha.id as cozinhaID,
            cozinha.idPrato as pratoID,
            mesas.nome as nomeMesa, 
            estadopedido.descricao as descEstado,
            pratos.preco as precoPrato
        FROM 
            pedido, 
            cozinha, 
            mesas, 
            estadopedido,
            pratos
        WHERE 
            pedido.idMesa = mesas.id 
            AND pedido.idEstado = estadopedido.id
            AND cozinha.idPedido = pedido.id
            AND cozinha.idPrato = pratos.id
            AND pedido.id = ?;");
    $stmt4->bind_param("i", $pedidoID);
    $stmt4->execute();
    $result = $stmt4->get_result();
    $row4 = $result->fetch_assoc();
    $stmt4->close();



    


    $content = "*************** FATURA ***************\n";
    $content .= "      Hash sha256 on (pedido:".$row1['id'] . "  - timestamp:". date("YmdHis")."):\n";
    $content .= "         hash -> ". hash('sha256',$row1['id'] . date("YmdHis"))." \n\n";
    $content .= "*************** MESA ***************\n";
    $content .= "                ".$row3['nome'] . "\n\n";
    $content .= "*************** Pedido **************\n";
    $content .= "                ".$row1['id'] . "\n\n";
    $content .= "*************** Preco ***************\n";
    $content .= "                ".$row4['precoPrato'] . "€\n\n";
    $content .= "*************** Nif ***************\n";
    $content .= "                ".$clienteFatura . "\n\n";


    

    $folderName = '../faturas';
    $fileName = md5($row1['id'] . date("YmdHis")) . ".txt";
    $fileRoute = $folderName . '/' . $fileName;
    if (!file_exists($folderName)) {
        if (mkdir($folderName, 0777, true)) {
            echo "Folder Created";
        } else {
            echo "Failed to create folder";
            exit; 
        }
    }
    if (file_put_contents($fileRoute, $content) !== false) {
        echo "Fatura Emitida. ";
    } else {
        echo "Erro na Emissao da Fatura";
        $error = error_get_last();
        echo "Error details: " . $error['message'];
    }

    //UPDATE estado pedido 
    $stmt2 = "";
    $presetEstado= 3;
    $stmt2 = $conn->prepare("UPDATE pedido SET pedido.idEstado = ? WHERE idEstado = ? and pedido.id= ?");
    $stmt2->bind_param("iii",$presetEstado, $row1['idEstado'], $row1['id']);
    $stmt2->execute();
    $stmt2->close();


}
?>