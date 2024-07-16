<?php
    require_once 'utilities/connection.php';

    class vinha{

        function regista( $descricao, $ha, $dataP, $anoC, $foto) {
            global $conn;
            $msg = "";
            $stmt = "";

            $upload = $this -> uploads(
                $foto,                    //Content
                'foto',            //Js into PHP variable name
                "_vinha",                  //Nome do ficheiro
                md5($descricao)                   //Pasta
                );
            $upload = json_decode($upload, TRUE);


            if($upload['flag']){
                $stmt = $conn->prepare("INSERT INTO vinha (descricao, ha, data_plantacao, ano_p_colheita, foto) 
                                        VALUES (?, ?, ?, ?, ?);");
                $stmt->bind_param("sisis", $descricao, $ha, $dataP, $anoC, $upload['target']);
            }else{
                $stmt = $conn->prepare("INSERT INTO vinha (descricao, ha, data_plantacao, ano_p_colheita) 
                                        VALUES (?, ?, ?, ?)");
            
                $stmt->bind_param("sisi", $descricao, $ha, $dataP, $anoC);
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
            $msg = "<table class='table-dark' id='tableVinhas'>";
            $msg .= "<thead>";
            $msg .= "<tr>";
        
            $msg .= "<th>Foto</th>";
            $msg .= "<th>Descricao</th>";
            $msg .= "<th>Ha</th>";
            $msg .= "<th>Data Plantação</th>";
            $msg .= "<th>Ano Primeira colheita</th>";
          
            $msg .= "<td>Remover</td>";
            $msg .= "<td>Editar</td>";
            $msg .= "<td>Add Casta</td>";
        
            $msg .= "</tr>";
            $msg .= "</thead>";
            $msg .= "<tbody>";
        
            $stmt = $conn->prepare("SELECT * from vinha"); 

        

            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $msg .= "<tr>";

                    $msg .= "<td><img src=".$row['foto']." class='img-thumbnail img-size'></td>";
                    $msg .= "<th scope='row'>" . $row['descricao'] . "</th>";
                    $msg .= "<td>" . $row['ha'] . "</td>";
                    $msg .= "<td>" . $row['data_plantacao'] . "</td>";
                    $msg .= "<td>" . $row['ano_p_colheita'] . "</td>";


                    $msg .= "<td><button type='button' class='removeBtn' onclick='remover(" . $row['id'] . ")'><img src='src/img/removeVector.svg' alt='Remove Icon'></button></td>";
                    $msg .= "<td><button type='button' class='editBtn' onclick='edita(" . $row['id'] . ")'><img src='src/img/editVector.svg' alt='Remove Icon'></button></td>";
                    $msg .= "<td><button type='button' class='favBtn' onclick='openCastaModal(" . $row['id'] . ")'><img src='src/img/starVector.svg' alt='Remove Icon'></button></td>";

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
        
            $stmt = $conn->prepare("DELETE FROM vinha
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

            $stmt = $conn->prepare("SELECT * FROM vinha WHERE id = ?");
            $stmt->bind_param("i", $codigo);
            $stmt->execute();
    
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $stmt->close();
            $conn->close();

            return json_encode($row);  
        }
        









        
        function edita( $descricao, $ha, $dataP, $anoC, $foto, 
                        $oldKEY
                        ) {
            global $conn;
            $msg = "";
            $stmt = "";
        
            $upload = $this -> uploads(
                $foto,                    //Content
                'foto',            //Js into PHP variable name
                "_vinha",                  //Nome do ficheiro
                md5($descricao)                   //Pasta
                );
            $upload = json_decode($upload, TRUE);


            if($upload['flag']){
                $stmt = $conn->prepare("UPDATE vinha SET 
                                    descricao = ?,
                                    ha = ?,
                                    data_plantacao = ?,
                                    ano_p_colheita = ?,
                                    foto = ?
                                    WHERE id = ? ;");

                $stmt->bind_param("sisisi", $descricao, $ha, $dataP, $anoC, $upload['target'], $oldKEY);
            
            }else{
                $stmt = $conn->prepare("UPDATE vinha SET 
                                     descricao = ?,
                                    ha = ?,
                                    data_plantacao = ?,
                                    ano_p_colheita = ?
                                    WHERE id = ? ;");
        
    
                $stmt->bind_param("sisii",  $descricao, $ha, $dataP, $anoC, $oldKEY);
            }
        
            $stmt->execute();

            $msg = "Edição efetuada";

            $stmt->close();
            $conn->close();
            return $msg;
        }
      




        function uploads($img, $html_soul, $presetName, $pasta){

            $dir = "../imagens/".$pasta."/";
            $dir1 = "src/imagens/".$pasta."/";
            $flag = false;
            $targetBD = "";
        
            if(!is_dir($dir)){
                if(!mkdir($dir, 0777, TRUE)){
                    die ("Erro não é possivel criar o diretório");
                }
            }
        
            if(array_key_exists($html_soul, $img)){
                if(is_array($img)){
                    if(is_uploaded_file($img[$html_soul]['tmp_name'])){
                        $fonte = $img[$html_soul]['tmp_name'];
                        $ficheiro = $img[$html_soul]['name'];
                        $end = explode(".",$ficheiro);
                        $extensao = end($end);
                
                        $newName =$presetName.date("YmdHis").".".$extensao;
                
                        $target = $dir.$newName;
                        $targetBD = $dir1.$newName;
        
                        $this -> wFicheiro($target, "prato_Upload_logs");
                
                        $flag = move_uploaded_file($fonte, $target);
                        
                    } 
                }
            }
            return (json_encode(array(
                "flag" => $flag,
                "target" => $targetBD
            )));
        }


        function wFicheiro($texto, $filename){
            $file = '../'.$filename.'.txt';
            if (file_exists($file)) {
                $current = file_get_contents($file);
            } else {
                $current = '';
            }
            $current .= $texto."\n";
            file_put_contents($file, $current);
        }












        function addCasta($vinho, $castas) {
            global $conn;
        
            $msg = "";
    
            if (is_string($castas)) {
                $castas = explode(',', $castas);
            }
        
            $stmt = $conn->prepare("INSERT INTO vinhas_castas (id_vinha, id_casta) VALUES (?, ?);");
            $stmt->bind_param("ii", $vinho, $id_casta);
        
            foreach ($castas as $casta) {
                $id_casta = trim($casta);  
                echo $casta;
                $stmt->execute();
                $stmt->reset();
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
                    $msg .= "<option value = '".$row['id']."'>".$row['descricao']."</option>"; 
                }
            } else {
                $msg .= "<option value = '-1'>Sem vinhas</option>";
            }
            $stmt->close(); 
            $conn->close();
            
            return $msg;
        }













        function getlista_castas(){
            global $conn;
            $castas = array();
        
            $stmt = $conn->prepare("SELECT * FROM castas;");
            $stmt->execute();
            $result = $stmt->get_result();
        
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    $castas[] = $row['id'];
                }
            } else {
                $castas[] = "Sem dados para efetuar o pedido";
            }
            $stmt->close(); 
            $conn->close();
        
            return json_encode($castas);
        }
        
















        function getCheckbox_castas(){
            global $conn;
            $msg = "";
            $stmt = "";

            $stmt = $conn->prepare("SELECT * FROM castas;");
            $stmt->execute();
            $result = $stmt->get_result();

            $index=0;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {

                    $msg .= "<div>";
                    $msg .= "<input type='checkbox' class'form-check-input' id='casta" . $row['id'] . "'>  " ;
                    $msg .= "<label class='form-check-label'> " . $row['descricao'] . "</label>"  ;
                    $msg .= "</div>";


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