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
    
    
    

    
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                Vindimas
            </div>



            <div class="container">
                <div class="row mx-5 mb-5 vh-100 d-flex align-items-center">
                    <div id="tableVindimasContainer"></div>
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