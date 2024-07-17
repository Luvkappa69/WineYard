<?php
    session_start();

    if(isset($_SESSION['utilizador'])){ 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'assets/main/docHead.html' ?>
  
  <script src="src/js/contentFunctions/vinhas.js"></script>

</head>

<body>
  <?php include_once 'assets/main/simpleNavBar.php' ?>


  <div class="container my-5">
    <div class="card">
      <div class="card-header">
        Nova Vinha
      </div>
      <div class="mx-5 my-5">
        <form class="row g-3">

          <div class="col-md-3">
            <label for="descricaoVinha" class="form-label">Descrição</label>
            <input type="text" class="form-control" id="descricaoVinha">
          </div>
          <div class="col-md-3">
            <label for="haVinha" class="form-label">ha</label>
            <input type="number" class="form-control" id="haVinha">
          </div>
          <div class="col-md-3">
            <label for="dataPlantacaoVinha" class="form-label">Data Plantação</label>
            <input type="date" class="form-control" id="dataPlantacaoVinha">
          </div>
          <div class="col-md-3">
            <label for="pColheitaVinha" class="form-label">Ano da Primeira Colheita</label>
            <input type="number" class="form-control" id="pColheitaVinha">
          </div>
          <div class="col-md-6">
              <label for="fotoVinha" class="form-label">Foto</label>
              <input type="file" class="form-control" id="fotoVinha">
          </div>
         
         


          <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="regista()">Registar</button>
          </div>
        </form>
      </div>
    </div>

    


</body>
</html>
<?php 
}else{
    echo "sem permissão!";
}

?>