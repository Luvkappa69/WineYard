<?php
    require_once 'utilities/connection.php';

    class Funcionario{

        function regista( $bi, $nome, $morada, $telefone, $email, $salario, $is_estado) {
            global $conn;
            $msg = "";
            $stmt = "";

            $stmt = $conn->prepare("INSERT INTO funcionarios (bi, nome, morada, telefone,email,salario, id_estado) 
                                    VALUES (?,?,?,?,?,?,?);");
            $stmt->bind_param("issisdi", $bi, $nome, $morada, $telefone, $email, $salario, $is_estado);


            if ($stmt->execute()) {
                $msg = "Registado com sucesso!";
            } else {
                $msg = "Erro ao registar: " . $stmt->error;  
            } 

            $stmt->close();
            $conn->close();
            return $msg;
        }
        

        
        function lista_f() {
            global $conn;
            $msg = "<table class='table-dark' id='tableFuncionarios'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>BI</th>";
            $msg .= "<th>Nome</th>";
            $msg .= "<th>Morada</th>";
            $msg .= "<th>Telefone</th>";
            $msg .= "<th>Email</th>";
            $msg .= "<th>Salário</th>";
            $msg .= "<th>Estado</th>";
          

            $msg .= "<td>Alterar Estado</td>";

        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT funcionarios.*, estado_funcionario.descr as descr
                                        from funcionarios, estado_funcionario
                                        where funcionarios.id_estado = estado_funcionario.id"); 

        

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {

                    if($row['descr'] == "Ativo"){
                        //pass
                    }else{
                        $msg .= "<tr>";

                        $msg .= "<th scope='row'>" . $row['bi'] . "</th>";
                        $msg .= "<td>" . $row['nome'] . "</td>";
                        $msg .= "<td>" . $row['morada'] . "</td>";
                        $msg .= "<td>" . $row['telefone'] . "</td>";
                        $msg .= "<td>" . $row['email'] . "</td>";
                        $msg .= "<td>" . $row['salario'] . "</td>";
                        $msg .= "<td>" . $row['descr'] . "</td>";
    
                        $msg .= "<td><button type='button' class='btn btn-primary' onclick='estadoModify(" . $row['bi'] . ")'>Altera Estado</button></td>";
                        $msg .= "</tr>";
                    }
                    
                } 
            } else {
                $msg .= "<tr>";


                $msg .= "<th scope='row'>Sem resultados</th>";
                $msg .= "<td>Sem resultados</td>";                   
                $msg .= "<td>Sem resultados</td>";                   
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
        



        
        

        function getSelect_estado(){
            global $conn;
            $msg = "<option value = '-1'>Escolha uma opção</option>";
            $stmt = "";

            $stmt = $conn->prepare("SELECT * FROM estado_funcionario;");
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    if ($row['id'] == 3){
                        
                    }else{
                        $msg .= "<option value = '".$row['id']."'>".$row['descr']."</option>";
                    }
                    
                }
            } else {
                $msg .= "<option value = '-1'>Sem Estados</option>";
            }
            $stmt->close(); 
            $conn->close();
            
            return $msg;
        }

        function estadoModify($key){
            global $conn;
            $msg = "";
            $stmt = "";
            
            $estado =1;
            $stmt = $conn->prepare("UPDATE funcionarios SET 
                                    id_estado = ? 
                                    WHERE bi = ?");
            $stmt->bind_param("ii", $estado,$key); 
        
            if ($stmt->execute()) {
                $msg = "Estado atualizado com sucesso!";
            } else {
                $msg = "Erro ao atualizar estado: " . $stmt->error; 
            }
        
            $stmt->close();
            $conn->close();
            return $msg;


        }
    }


    
?>