<?php
    require_once 'utilities/connection.php';

    class Vinho{

        
        function listaVinho() {
            global $conn;
            $msg = "<table class='table-dark' id='tableVinho'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>Vinho</th>";
            $msg .= "<th>Quantidade de Garrafas</th>";
            $msg .= "<th>Castas</th>";
            $msg .= "<th>Data da Vindima</th>";
            $msg .= "<td>Venda</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT * FROM vindima");
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $stmt_vinhas_castas = $conn->prepare("SELECT id_casta FROM vinhas_castas WHERE id_vinha = ?");
                    $stmt_vinhas_castas->bind_param("i", $row['id_vinha']);
                    $stmt_vinhas_castas->execute();
                    $result_vinhas_castas = $stmt_vinhas_castas->get_result();
        
                    if ($result_vinhas_castas->num_rows > 0) {
                        $stmt_vinha = $conn->prepare("SELECT descricao FROM vinha WHERE id = ?");
                        $stmt_vinha->bind_param("i", $row['id_vinha']);
                        $stmt_vinha->execute();
                        $result_vinha = $stmt_vinha->get_result();
                        $row_vinha = $result_vinha->fetch_assoc();
                        $vinhaDesc = $row_vinha['descricao'];
                        $stmt_vinha->close();
        
                        $garrafaVinho = floor($row['kg'] / 2);
        
                        $castaDesc = '';
                        while ($row_vinhas_castas = $result_vinhas_castas->fetch_assoc()) {
                            $stmt_casta = $conn->prepare("SELECT descricao FROM castas WHERE id = ?");
                            $stmt_casta->bind_param("i", $row_vinhas_castas['id_casta']);
                            $stmt_casta->execute();
                            $result_casta = $stmt_casta->get_result();
                            $row_casta = $result_casta->fetch_assoc();
                            $castaDesc .= $row_casta['descricao'] . ", ";
                            $stmt_casta->close();
                        }
                        $castaDesc = rtrim($castaDesc, ", "); 

                        $msg .= "<tr>";
                        $msg .= "<th scope='row'>" . $vinhaDesc . "</th>";
                        $msg .= "<td>" . $garrafaVinho . "</td>";
                        $msg .= "<td>" . $castaDesc . "</td>";
                        $msg .= "<td>" . $row['dth'] . "</td>";
                        $msg .= "<td><button type='button' class='favBtn' onclick='openVendaModal(" . $row['id'] . ")'><img src='src/img/starVector.svg' alt='Remove Icon'></button></td>";
                        $msg .= "</tr>";
                    }
        
                    $stmt_vinhas_castas->close();
                }
            } else {
                $msg .= "<tr>";
                $msg .= "<th scope='row' colspan='5'>Sem resultados</th>";
                $msg .= "</tr>";
            }
        
            $stmt->close();
            $msg .= "</tbody>";
            $msg .= "</table>";
        
            $conn->close();
        
            return $msg;
        }
        

        function executaVenda($id_vindima, $quantidade){
            global $conn;
            $msg = "";
            $toUpdate='';

            $stmt = $conn->prepare("SELECT * from vindima where id=?");
            $stmt->bind_param("i", $id_vindima); 
            $stmt->execute();
            $result = $stmt->get_result();
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $toUpdate .= $row['kg'];
                }
            } else {
                echo "Falam requisitos para realizar a operação";
                return;
            }
            $stmt->close(); 



            $update = $toUpdate - ($quantidade*2);
            $stmt_update = $conn->prepare("UPDATE vindima SET 
                                    kg = ? 
                                    WHERE id = ?");
            $stmt_update->bind_param("ii",$update,$id_vindima ); 
        
            if ($stmt_update->execute()) {
                $msg = "Estado atualizado com sucesso!";
            } else {
                $msg = "Erro ao atualizar estado: " . $stmt_update->error; 
            }
        
            $stmt_update->close();
            $conn->close();
            return $msg;


        }
        
        
        
        
    }
        
       



        

?>