<?php
    require_once 'utilities/connection.php';

    class vinho{

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

            $stmt = $conn->prepare("SELECT 
                                        vindima.*,
                                        vindima.id_vinha AS vinhaDesc,
                                        castas.descricao AS castaDesc
                                    FROM 
                                        vindima, vinha, vinhas_castas, castas
                                    WHERE
                                        vindima.id_vinha = vinha.id and
                                        vinhas_castas.id_vinha = vindima.id_vinha and
                                        vinhas_castas.id_casta = castas.id");
        

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";

                    $msg .= "<th scope='row'>" . $row['vinhaDesc'] . "</th>";

                    $garrafaVinho = $row['kg'] / 2;
                    $msg .= "<td>" . $garrafaVinho . "</td>"; 

                    $msg .= "<td>" . $row['castaDesc'] . "</td>";
                    $msg .= "<td>" . $row['dth'] . "</td>";

                    $msg .= "<td><button type='button' class='favBtn' onclick='openVendaModal(" . $row['id'] . ")'><img src='src/img/starVector.svg' alt='Remove Icon'></button></td>";

                    $msg .= "</tr>";
                } 
            } else {
                $msg .= "<tr>";

                $msg .= "<th scope='row'>Sem resultados</th>";
                $msg .= "<td>Sem resultados</td>";                   
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
    }
        
       



        

?>