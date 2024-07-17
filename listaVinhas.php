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
                Vinhas
            </div>



            <div class="mx-5 my-5">
                <div class="container">
                    <div class="row mx-5 mb-5 ">
                        <div id="tableVinhasContainer"></div>
                    </div>
                </div>
            </div>


        </div>
    </div>




        <?php include_once 'assets/vinhasEditModal.html' ?>
        <?php include_once 'assets/addCastaModal.html' ?>
</body>
</html>
<?php 
}else{
    echo "sem permissão!";
}

?>