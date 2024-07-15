<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'assets/main/docHead.html' ?>
  
  <script src="src/js/contentFunctions/funcionarios.js"></script>

</head>

<body>
  <?php include_once 'assets/main/simpleNavBar.php' ?>


  <div class="container my-5">
    <div class="card">
      <div class="card-header">
        Novo Funcionário
      </div>
      <div class="mx-5 my-5">
        <form class="row g-3">

          <div class="col-md-3">
            <label for="bi" class="form-label">BI</label>
            <input type="number" class="form-control" id="bi">
          </div>
          <div class="col-md-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" class="form-control" id="nome">
          </div>
          <div class="col-md-3">
            <label for="morada" class="form-label">Morada</label>
            <input type="text" class="form-control" id="morada">
          </div>
          <div class="col-md-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="number" class="form-control" id="telefone">
          </div>
          <div class="col-md-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="col-md-3">
            <label for="salario" class="form-label">Salário</label>
            <input type="number" class="form-control" id="salario">
          </div>
          <div class="col-md-6">
            <label for="id_estado" class="form-label">Estado</label>
            <select class="form-select select2" aria-label="Default select example" id="id_estado"></select>
          </div>
          
         
         


          <div class="col-12">
            <button type="button" class="btn btn-primary" onclick="regista()">Registar</button>
          </div>
        </form>
      </div>
    </div>

    


</body>
</html>