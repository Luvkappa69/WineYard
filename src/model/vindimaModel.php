<?php
    require_once 'utilities/connection.php';
    require_once 'utilities/validadores.php';

    class Vindima{

        function regista( $id_vinha, $id_funcionario, $kg, $data,$time, $ano) {
            global $conn;

            $stmt0 = "";
            $stmt0 = $conn->prepare("SELECT * from vinha, ano
                                    where vinha.id= ? and ano.id=?;");
            $stmt0->bind_param("ii", $id_vinha, $ano);
            $stmt0->execute();
            $result0 = $stmt0->get_result();

            if ($result0->num_rows > 0) {
                while ($row0 = $result0->fetch_assoc()) {
                    if ($row0['ano_p_colheita'] >= $row0['descricao']) {
                        //pass
                    }else{
                        echo "vinha -" . $row0['data_plantacao'] . "- teve colheita a " . $row0['ano_p_colheita'] . ". O ano da vindima precisa ser menor";
                        return;
                    }
                }
                $dth = $data. " ".$time.":00";
                $msg = "";
                $stmt = "";
    
                $stmt = $conn->prepare("INSERT INTO vindima (id_vinha, id_funcionario, kg, dth, id_ano) 
                                        VALUES (?,?,?,?,?);");
                $stmt->bind_param("iiisi", $id_vinha, $id_funcionario, $kg, $dth, $ano);
    
                if ($stmt->execute()) {
                    $msg = "Registado com sucesso!";
                } else {
                    $msg = "Erro ao registar: " . $stmt->error;  
                } 
                $stmt->close();
            }

            $stmt0->close();
            $conn->close();
            
        }

        function registaAno($registaAno){
            global $conn;
            $msg = "";
            $stmt = "";

            $stmt = $conn->prepare("INSERT INTO ano (descricao) 
                                    VALUES (?);");
            $stmt->bind_param("i", $registaAno);


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
            $msg = "<table class='table-dark' id='tableVindimas'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>Foto</th>";
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
                                    ano.descricao as anoDesc,
                                    vinha.foto AS foto
                                    from vindima, funcionarios, ano, vinha
                                    where vindima.id_vinha = vinha.id and 
                                    funcionarios.bi = vindima.id_funcionario and
                                    vindima.id_ano = ano.id"); 

        

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";

                    $msg .= "<td><img src=".$row['foto']." class='img-thumbnail img-size'></td>";

                    $msg .= "<th scope='row'>" . $row['vinhaDesc'] . "</th>";
                    $msg .= "<td>" . $row['funNome'] . "</td>";
                    $msg .= "<td>" . $row['kg'] . "</td>";
                    $msg .= "<td>" . $row['dth'] . "</td>";
                    $msg .= "<td>" . $row['anoDesc'] . "</td>";


                    $msg .= "<td><button type='button' class='removeBtn' onclick='remover(" . $row['id'] . ")'><img src='src/img/removeVector.svg' alt='Remove Icon'></button></td>";


                    $msg .= "</tr>";
                } 
            } else {
                $msg .= "<tr>";

                $msg .= "<td>Sem resultados</td>"; 
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
            $row0 ="";
            $row1 ="";

            $msg = "";
            $stmt0 = "";
            $stmt0 = $conn->prepare("SELECT id_funcionario FROM vindima WHERE id = ?");
            $stmt0->bind_param("i", $codigo);
            $stmt0->execute();
            $result0 = $stmt0->get_result();
            if ($result0->num_rows > 0) {
                $row0 = $result0->fetch_assoc();
                $id_funcionario = $row0['id_funcionario'];
            } else {
                $msg = "Nao foi possivel efetuar o pedido 1";
                $stmt0->close();
                return $msg;
            }
            $stmt0->close();

            echo $msg;

            $msg = "";
            $stmt1="";
            $stmt1 = $conn->prepare("SELECT id_estado FROM funcionarios WHERE bi = ?");
            $stmt1->bind_param("i", $id_funcionario);
            $stmt1->execute();
            $result1 = $stmt1->get_result();
            if ($result1->num_rows > 0) {
                $row1 = $result1->fetch_assoc();
                $id_estado = $row1['id_estado'];
            } else {
                $msg = "Nao foi possivel efetuar o pedido 2";
                return $msg;
            }
            $stmt1->close();



            if ($id_estado  == 2){
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
            }else{
                $msg = "O funcionário asssociado tem estado 'Ativo'";
            }
            

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