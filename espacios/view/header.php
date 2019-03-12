<?php
	//include_once '../Functions/Authentication.php';
	//Si no tiene guardado el idioma en la sesion
	// if (!isset($_SESSION['idioma'])) {
	// 	$_SESSION['idioma'] = 'SPANISH';
	// }
    //include '../Locales/Strings_' . $_SESSION['idioma'] . '.php';

    require_once(__DIR__."..\..\core\ViewManager.php");
    $this->view = new ViewManager();
    include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
    $this->flashMessageSuccess = $this->view->popFlashSuccess("successMessage");
    $this->flashMessageDanger = $this->view->popFlashDanger("dangerMessage");
?>

<!DOCTYPE html>
    <html lang="es">
        <head>
            <title>%TITLE%</title>
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

            <!-- Our JS -->
            <script src="../js/common.js"></script>
            <!-- Our CSS -->
            <link rel="stylesheet" href="../css/style.css">
        </head>

       
        <?php if(strpos($_SERVER['REQUEST_URI'],'ShowPlane')) { ?>
            <body onload = "viewSpace('<?= $this->coords ?>', '<?= $this->plane ?>')"> 
        <?php } else if (strpos($_SERVER['REQUEST_URI'],'Plane')) { ?>
            <body onload = "selectSpace('<?= $this->plane ?>')"> 
        <?php } else { ?>
            <body>
        <?php } ?>
            <!-- HEADER -->
            <header>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a title="Home" class="navbar-brand" href="../index.php">
                        <img height="38" src="../img/logo.png" alt="logo universidade de vigo"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="../index.php">Edificios</a>
                            </li>
                        </ul>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Mi Cuenta </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="index.php?controller=users&action=edit">Mi Perfil</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="USER_Controller.php?action=logout">Salir</a>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <?php if (!empty($this->flashMessageSuccess)): ?>
                <div class="alert alert-success text-center" id="success-alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= $this->flashMessageSuccess; ?>
                </div>
            <?php elseif(!empty($this->flashMessageDanger)): ?>
                <div class="alert alert-danger text-center" id="danger-alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <?= $this->flashMessageDanger; ?>
                </div>            
            <?php endif; ?>
