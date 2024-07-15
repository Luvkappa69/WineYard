<?php
    require_once 'utilities/connection.php';
    require_once 'utilities/imgUploader.php';
    require_once 'utilities/logMaker.php';
    //require_once 'utilities/validadores.php';

    class Prato{

        function regista( $nome, $preco, $idTipo, $foto) {
            global $conn;
            $msg = "";
            $stmt = "";

            $upload = $this -> uploads(
                $foto,                    //Content
                'foto',            //Js into PHP variable name
                "_prato",                  //Nome do ficheiro
                md5($nome)                   //Pasta
                );
            $upload = json_decode($upload, TRUE);


            if($upload['flag']){
                $stmt = $conn->prepare("INSERT INTO pratos (nome, preco, idTipo, foto) 
                                        VALUES (?, ?, ?, ?);");
                $stmt->bind_param("sdis", $nome, $preco, $idTipo, $upload['target']);
            }else{
                $stmt = $conn->prepare("INSERT INTO pratos (nome, preco, idTipo) 
                                        VALUES (?, ?, ?)");
            
                $stmt->bind_param("sii", $nome, $preco, $idTipo);
            }

            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
            } else {
                $msg = "Erro ao registar: " . $stmt->error;  
            } 

            $stmt->close();
            $conn->close();
            return $msg;
        }
        









        
        function lista() {
            global $conn;
            $msg = "<table class='table' id='tablePratos'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>Foto</th>";
            $msg .= "<th>Nome</th>";
            $msg .= "<th>Preço</th>";
            $msg .= "<th>Tipo de Prato</th>";
          
            $msg .= "<td>Remover</td>";
            $msg .= "<td>Editar</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT pratos.*,
                                    tipoprato.descricao AS descPrato
                                    FROM pratos, tipoprato
                                    WHERE pratos.idTipo = tipoprato.id;" 
                                    ); 

        

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";

                    $msg .= "<td><img src=".$row['foto']." class='img-thumbnail img-size'></td>";
                    $msg .= "<th scope='row'>" . $row['nome'] . "</th>";
                    $msg .= "<td>" . $row['preco'] . "€</td>";
                    $msg .= "<td>" . $row['descPrato'] . "</td>";


                    $msg .= "<td><button type='button' class='btn btn-danger' onclick='remover(" . $row['id'] . ")'>Remover</button></td>";
                    $msg .= "<td><button type='button' class='btn btn-primary' onclick='edita(" . $row['id'] . ")'>Editar</button></td>";
                    $msg .= "</tr>";
                } 
            } else {
                $msg .= "<tr>";

                $msg .= "<td>Sem resultados</td>";
                $msg .= "<th scope='row'>Sem resultados</th>";
                $msg .= "<td>Sem resultados</td>";                   
                $msg .= "<td>Sem resultados</td>";                   
                                                

                $msg .= "<td></td>";
                $msg .= "<td></td>";
                $msg .= "</tr>";
            }

            $stmt->close(); 

            $msg .= "</tbody>";
            $msg .= "</table>";

            $conn->close();
        
            return $msg;
        }
        









        
        function remove($codigo) {
            global $conn;
            $msg = "";
            $stmt = "";
        
            $stmt = $conn->prepare("DELETE FROM pratos
                                    WHERE id = ?");
            $stmt->bind_param("i", $codigo); 
        
            if ($stmt->execute()) {
                $msg = "Removido com sucesso!";
            } else {
                $msg = "Erro ao remover: " . $stmt->error; 
            }
        
            $stmt->close();
            $conn->close();
            return $msg;
        }
        









        
        function getDados($codigo) {
            global $conn;

            $stmt = $conn->prepare("SELECT * FROM pratos WHERE id = ?");
            $stmt->bind_param("i", $codigo);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $stmt->close();
            $conn->close();

            return json_encode($row);  
        }
        









        
        function edita( $nome, $preco, $idTipo, $foto, 
                        $oldKEY
                        ) {
            global $conn;
            $msg = "";
            $stmt = "";
        
            $upload = $this -> uploads(
                $foto,                    //Content
                'foto',            //Js into PHP variable name
                "_prato",                  //Nome do ficheiro
                md5($nome)                   //Pasta
                );
            $upload = json_decode($upload, TRUE);


            if($upload['flag']){
                $stmt = $conn->prepare("UPDATE pratos SET 
                                    nome = ?,
                                    preco = ?,
                                    idTipo = ?,
                                    foto = ?
                                    WHERE id = ? ;");

                $stmt->bind_param("siisi", $nome, $preco, $idTipo, $resp['target'], $oldKEY);
            
            }else{
                $stmt = $conn->prepare("UPDATE pratos SET 
                                    nome = ?,
                                    preco = ?,
                                    idTipo = ?
                                    WHERE id = ? ;");
        
    
                $stmt->bind_param("siii",  $nome, $preco, $idTipo, $oldKEY);
            }
        
            $stmt->execute();

            $msg = "Edição efetuada";

            $stmt->close();
            $conn->close();
            return $msg;
        }
      

    }
?>