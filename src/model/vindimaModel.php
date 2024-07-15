<?php
    require_once 'utilities/connection.php';

    class vinha{

        function regista( $id_vinha, $id_funcionario, $kg, $data,$time, $ano) {
            global $conn;

            $dth = $data. " ".$time;
            echo $dth;
            $msg = "";
            $stmt = "";

            $stmt = $conn->prepare("INSERT INTO vindima (id_vinha, id_funcionario, kg, dth, id_estado) 
                                    VALUES (?,?,?,?,?);");
            $stmt->bind_param("iiisi", $id_vinha, $id_funcionario, $kg, $dth, $ano);

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
            $msg = "<table class='table' id='tableVindimas'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>Vinha</th>";
            $msg .= "<th>Funcionário</th>";
            $msg .= "<th>Kg</th>";
            $msg .= "<th>Data/Hora</th>";
            $msg .= "<th>Ano</th>";
          
            $msg .= "<td>Remover</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT vindima.*, 
                                    funcionarios.nome as funNome,
                                    vinha.descricao as vinhaDesc,
                                    ano.descricao as anoDesc
                                    from vindimas, funcionarios, ano
                                    where vindimas.id_vinha = vinha.id
                                    vindima.id_funcionario = funcionario.id
                                    vindima.id_ano = ano.id"); 

        

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";


                    $msg .= "<th scope='row'>" . $row['vinhaDesc'] . "</th>";
                    $msg .= "<td>" . $row['funNome'] . "</td>";
                    $msg .= "<td>" . $row['kg'] . "</td>";
                    $msg .= "<td>" . $row['dth'] . "</td>";
                    $msg .= "<td>" . $row['anoDesc'] . "</td>";


                    $msg .= "<td><button type='button' class='btn btn-danger' onclick='remover(" . $row['id'] . ")'>Remover</button></td>";
                    $msg .= "</tr>";
                } 
            } else {
                $msg .= "<tr>";


                $msg .= "<th scope='row'>Sem resultados</th>";
                $msg .= "<td>Sem resultados</td>";                   
                $msg .= "<td>Sem resultados</td>";                   
                $msg .= "<td>Sem resultados</td>";                   
                $msg .= "<td>Sem resultados</td>";                   
                                                

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
        
            $stmt = $conn->prepare("DELETE FROM vindima
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
        









        








        
       




        function getSelect_vinhas(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";

            $stmt = $conn->prepare("SELECT * FROM vinha;");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row['id'] == 3){
                        
                    }else{
                        $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
                    }
                    
                }
            } else {
                $msg .= "<option value = '-1'>Sem vinhas</option>";
            }
            $stmt->close(); 
            $conn->close();
            
            return $msg;
        }
        function getSelect_funcionarios(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";

            $stmt = $conn->prepare("SELECT * FROM funcionarios;");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row['id_estado'] == 2){
                        //pass
                    }else{
                        $msg .= "<option value = '".$row['bi']."'>".$row['nome']."</option>";
                    }
                    
                }
            } else {
                $msg .= "<option value = '-1'>Sem Funcionários</option>";
            }
            $stmt->close(); 
            $conn->close();
            
            return $msg;
        }
        function getSelect_ano(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";

            $stmt = $conn->prepare("SELECT * FROM ano;");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>";
                }
            } else {
                $msg .= "<option value = '-1'>Sem Estados</option>";
            }
            $stmt->close(); 
            $conn->close();
            
            return $msg;
        }




    }


    
?>