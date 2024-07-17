<?php
    session_start();

    if(isset($_SESSION['utilizador'])){ 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once 'assets/main/docHead.html' ?>
  
  <script src="src/js/contentFunctions/vinho.js"></script>

</head>

<body>
  <?php include_once 'assets/main/simpleNavBar.php' ?>


  
        <div class="container my-5">
        <div class="card">
            <div class="card-header">
                Vinhos
            </div>



            <div class="container mt-5">
            <div class="row mx-5 mb-5 ">
                <div id="tableVinhosContainer">

                </div>
            </div>
        </div>

        </div>
    </div>


        <?php include_once 'assets/vendasModal.html' ?>


</body>
</html>
<?php 
}else{
    echo "sem permissão!";
}

?>