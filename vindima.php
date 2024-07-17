<?php
    session_start();

    if(isset($_SESSION['utilizador'])){ 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'assets/main/docHead.html' ?>
  
  <script src="src/js/contentFunctions/vindima.js"></script>

</head>

<body>
  <?php include_once 'assets/main/simpleNavBar.php' ?>
<div class="container">
  <div class="row vh-100 d-flex align-items-center">

    <div class="col-md-6 text-center">
    <div class="card">
      <div class="card-header">
        Nova Vindima
      </div>
      <div class="mx-5 my-5">
        <form class="row g-3">

        <div class="col-md-6">
            <label for="id_vinha" class="form-label">Vinha</label>
            <select class="form-select select2" aria-label="Default select example" id="id_vinha"></select>
        </div>
        <div class="col-md-6">
          <label for="id_funcionario" class="form-label">Funcionário</label>
          <select class="form-select select2" aria-label="Default select example" id="id_funcionario"></select>
        </div>
        <div class="col-md-6">
            <label for="id_ano" class="form-label">Ano</label>
            <select class="form-select select2" aria-label="Default select example" id="id_ano"></select>
        </div>
        <div class="col-md-6">
            <label for="kg" class="form-label">Kg</label>
            <input type="number" class="form-control" id="kg">
        </div>
        <div class="col-md-6">
            <label for="data" class="form-label">Data</label>
            <input type="date" class="form-control" id="data"> 
        </div>
        <div class="col-md-6">
            <label for="tempo" class="form-label">Hora</label>
            <input type="time" class="form-control" id="tempo">
        </div>
         
         


          <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="regista()">Registar</button>
          </div>
        </form>
      </div>
    </div>


    </div>

    <div class="col-md-6 text-center">

    <div class="container my-5 smallOne">
    <div class="card">
      <div class="card-header">
        Novo Ano
      </div>
      <div class=" col-md-6 mx-5 my-5">


            <label for="novoAno" class="form-label center">Ano</label>
            <input type="number" class="form-control center" id="novoAno">


          <div class="col-12">
            <button type="button" class="btn btn-primary center" onclick="registaAno()">Registar</button>
          </div>

      </div>
    </div>
  </div>

    </div>

  </div>

  

</div>




  

 


   

    

    


</body>
</html>
<?php 
}else{
    echo "sem permissão!";
}

?>