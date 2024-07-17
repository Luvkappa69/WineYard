<?php
    session_start();

    if(isset($_SESSION['utilizador'])){ 
        include_once 'assets/main/simpleNavBar.php';
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once 'assets/main/docHead.html' ?>
    <title>PROJECT GENESIS</title>
    <script src="src/js/contentFunctions/login.js"></script>

</head>

<body>


<div class="container mt-5 my-5 col-12">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-3">
                <div class="card">
                    <h5 class="card-header">Registar</h5>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-12">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username">
                            </div>
                            <div class="col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password"> 
                            </div>
        
                            <div class="col-md-12">
                                <label for="tpUser" class="form-label">Tipo Utilizador</label>
                                <select class="form-control select2" id="tpUser">
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label for="foto_perfil" class="form-label">Foto</label>
                                <input type="file" class="form-control" id="foto_perfil">
                            </div>
        
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" onclick="registaUser()">Registar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <h5 class="card-header">Login</h5>
                    <div class="card-body">
                        <form class="row g-3">
                            <div class="col-md-12">
                                <label for="usernameLogin" class="form-label">Username</label>
                                <input type="text" class="form-control" id="usernameLogin">
                            </div>
                            <div class="col-md-12">
                                <label for="passwordLogin" class="form-label">Password</label>
                                <input type="password" class="form-control" id="passwordLogin">
                            </div>
        
                            <div class="col-12">
                                <button type="button" class="btn btn-primary" onclick="login()">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
    </div>
    <div class="container">

        <div class="row vh-100 d-flex align-items-center">

            <div class="col-md-6 text-center">
                <h1>Landing page</h1>



                <button class="removeBtn">
                    <img src="src/img/removeVector.svg" alt="Remove Icon">
                </button>


                <button class="editBtn">
                    <img src="src/img/editVector.svg" alt="Edit Icon">
                </button>


                <button class="favBtn">
                    <img src="src/img/starVector.svg" alt="Favorite Icon">
                </button>

                <button class="logoutBtn">
                    <img src="src/img/logoutVector.svg" alt="Logout Icon">
                </button>







            </div>

            <div class="col-md-6 text-center">
                
                <img src="image.jpg" alt="Project Image" class="img-fluid">
            </div>

        </div>

    </div>
</body>
</html>