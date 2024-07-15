<?php

function getSelect_tipoPrato(){
    global $conn;
    $msg = "<option value = '-1'>Escolha uma opção</option>";
    $stmt = "";

    $stmt = $conn->prepare("SELECT * FROM tipoprato;");
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
        }
    } else {
        $msg .= "<option value = '-1'>Sem Tipos de Prato</option>";
    }

    $stmt->close(); 
    $conn->close();
    return $msg;
}

?>