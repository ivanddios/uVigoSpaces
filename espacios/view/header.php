<?php
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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" 
                crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
                crossorigin="anonymous"></script>

            <!-- Our JS -->
            <script src="../js/common.js"></script>
            <script src="../js/validates.js"></script>
            <!-- Our CSS -->
            <link rel="stylesheet" href="../css/style.css">
        </head>

        <?php if(strpos($_SERVER['REQUEST_URI'],'ShowSpacePlane')) { ?>
            <body onload = "viewSpace('<?= $this->space['coordsPlane'] ?>','<?= $this->plane ?>')"> 
        <?php }else if (strpos($_SERVER['REQUEST_URI'],'EditSpacePlane')) { ?>
            <body onload = "editSpace('<?= $this->space['coordsPlane'] ?>','<?= $this->plane ?>')"> 
        <?php } else if (strpos($_SERVER['REQUEST_URI'],'SelectSpacePlane')) { ?>
            <body onload = "selectSpace('<?= $this->plane ?>')"> 
        <?php } else { ?>
            <body>
        <?php } ?>


            <!-- HEADER -->
            <header>
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a title="Home" class="navbar-brand" href="../index.php">
                        <img src="../img/logo.png" class="logoPpal" alt="<?=$strings['LogoUVigo']?>"/>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mr-auto">

                        <li><a class="nav-link" href="../controller/BUILDING_Controller.php"><?=$strings['Buildings']?></a></li>&nbsp;&nbsp;
                            <?php  if(checkRol('SHOW ALL', 'USER')): ?>
                                <div class="nav-item dropdown">
                                    <a id="navbarDropdown-User" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?=$strings['Users']?></a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown-User">
                                        <a class="dropdown-item" href="../controller/FUNCTIONALITY_Controller.php"><?=$strings['Functionalitys']?></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../controller/GROUP_Controller.php"><?=$strings['Groups']?></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../controller/ACTION_CONTROLLER.php"><?=$strings['Actions']?></a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="../controller/USER_CONTROLLER.php"><?=$strings['Users']?></a>
                                        
                                    </div>
                                </div>
                            <?php endif; ?>
                            
                        </ul>
                        <?php if(isset($_SESSION['LOGIN'])): ?>
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown-Account" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?=$strings['My Account']?></a>	
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown-Account">
                                    <a class="dropdown-item" href="../controller/USER_Controller.php?action=<?=$strings['Edit']?>&user=<?=$_SESSION['LOGIN']?>"><?=$strings['My Profile']?></a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../controller/USER_Controller.php?action=<?=$strings['Logout']?>"><?=$strings['Logout']?></a>
                                </div>
                            </div>
                        <?php else: ?>
                            <a class="nav-link nav-a" href="../controller/USER_Controller.php?action=<?=$strings['Login']?>"><?=$strings['Login']?></a>
                        <?php endif; ?>

                        <div class="nav-item dropdown">
                        <a id="navbarDropdownLang" class="nav-link dropdown-toggle nav-a" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if($_SESSION['LANGUAGE'] === 'Castellano') { ?>
                                <img src="../img/spain.png" alt="lang" class="languageFlag">
                            <?php } elseif($_SESSION['LANGUAGE'] === 'English') { ?>
                                <img src="../img/uk.png" alt="lang" class="languageFlag">
                            <?php } else { ?>
                                <img src="../img/galicia2.png" alt="lang" class="languageFlag">
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu languages" aria-labelledby="navbarDropdownLang">
                            <?php if($_SESSION['LANGUAGE'] === 'Castellano') { ?>
                                <a href="../core/CambioIdioma.php?idioma=Galego">
                                    <img src="../img/galicia2.png" alt="lang" class="languageFlag">
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="../core/CambioIdioma.php?idioma=English">
                                    <img src="../img/uk.png" alt="lang" class="languageFlag">
                                </a>
                            <?php } elseif($_SESSION['LANGUAGE'] === 'Galego') { ?>
                                <a href="../core/CambioIdioma.php?idioma=Castellano">
                                    <img src="../img/spain.png" alt="lang" class="languageFlag">
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="../core/CambioIdioma.php?idioma=English">
                                    <img src="../img/uk.png" alt="lang" class="languageFlag">
                                </a>
                            <?php } elseif($_SESSION['LANGUAGE'] === 'English') { ?>
                                <a href="../core/CambioIdioma.php?idioma=Galego">
                                    <img src="../img/galician.gif" alt="lang" class="languageFlag">
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="../core/CambioIdioma.php?idioma=Castellano">
                                    <img src="../img/spain.png" alt="lang" class="languageFlag">
                                </a>
                            <?php } ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </header>

            <?php if (!empty($this->flashMessageSuccess)): ?>
                <div class="alert alert-success text-center" id="success-alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?= $this->flashMessageSuccess; ?>
                </div>
            <?php elseif(!empty($this->flashMessageDanger)): ?>
                <div class="alert alert-danger text-center" id="danger-alert" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?= $this->flashMessageDanger; ?>
                </div>            
            <?php endif; ?>