<?php
//file: view/users/login.php

class Login{
    function __construct(){	
        $this->render();
    }


    function render(){ ?>
        
        <!DOCTYPE html>
            <html lang="es">
                <head>
                    <title>Login</title>
                    <link rel="shortcut icon" href="../img/favicon.png"/>
                    <meta charset="utf-8"/>

                    <!-- Fonts -->
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
                    <link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">

                    <!-- Bootstrap JavaScript -->
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                        crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
                        crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
                        crossorigin="anonymous"></script>
                    
                    <!-- Our CSS -->
                    <link rel="stylesheet" href="../css/style.css">
                </head>

                <body>

                <div class="container">
                    <div class="row center-row">
                        <div class="col-lg-6 center-block login">
                            <div id="titleView">
                                <a title="Home" class="logoLogin" href="#"><img height="38" src="../img/logo.png" alt="logo universidade de vigo"/></a>
                            </div>
                            <div class="col-lg-12 center-block">
                                <form method="POST" action="USER_Controller.php">
                                    <div id="inputLogin">
                                        <div class="inputWithIcon inputIconBg">
                                            <input type="text" name="username" placeholder="Username" required>
                                            <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                        </div>

                                        <div class="inputWithIcon inputIconBg">
                                            <input type="password" name="passwd" placeholder="Password" required>
                                            <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                        </div>

                                        <div class="item-select">
                                            <p><select name="language">
                                                    <option value="Castellano">Castellano</option>
                                                    <option value="Galego">Galego</option>
                                                    <option value="English">English</option>
                                            </select></p>
                                        </div>
                                        <button type="submit" name="submit" class="loginButton btn btn-darkLogin">Login</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
    <?php } 
} ?>

