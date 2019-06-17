
<?php

require_once("../core/ViewManager.php");

class Login{

    private $flashMessageDanger;

    function __construct(){	
        $view = new ViewManager();
        $this->flashMessageDanger = $view->popFlashDanger("dangerMessage");
        $this->render();
    }
    
    function render(){ 
        include '../view/locate/Strings_' . $_SESSION['LANGUAGE'] . '.php'; ?>
        
        <!DOCTYPE html>
            <html lang="es">
                <head>
                    <title><?=$strings["Login"]?></title>
                    <link rel="shortcut icon" href="../view/img/favicon.png"/>
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
                    <link rel="stylesheet" href="../../styles/styles.css">
                    <link rel="stylesheet" href="../view/css/style.css">
                </head>

                <body>
                    <div class="container">
                        <div class="row center-row">
                            <div class="col-lg-6 center-block loginContainer">
                                <div id="titleView">
                                    <img class="logoPpal" src="../view/img/logo.png" alt="logo universidade de vigo"/>
                                </div>
                                <div class="col-lg-12 center-block">
                                    <form method="POST" action="LOGIN_Controller.php?action=Login">
                                        <div id="loginContainer">
                                            <div class="inputWithIcon inputIconBg">
                                                <input id="loginUsername" type="text" name="email" placeholder="Email" required>
                                                <i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
                                            </div>

                                            <div class="inputWithIcon inputIconBg">
                                                <input id="loginPassword" type="password" name="passwd" placeholder="Password" required>
                                                <i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                                                <?php if(isset($this->flashMessageDanger)): ?> 
                                                    <div class="alert alert-danger" role="alert">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        <?= $strings[$this->flashMessageDanger]?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <div class="input-container item-select">
                                                <select class="custom-select select-login" name="language" required>
                                                    <option selected value="Castellano"><?=$strings["Spanish"]?></option>
                                                    <option value="Galego"><?=$strings["Galician"]?></option>
                                                    <option value="English"><?=$strings["English"]?></option>
                                                </select>
                                            </div>
                                            <button type="submit" name="submit" class="loginButton btn btn-darkLogin"><?=$strings["Login"]?></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </body>
            </html>
    <?php } 
} ?>

