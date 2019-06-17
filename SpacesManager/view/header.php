<?php
    require_once("../core/ViewManager.php");
    $this->view = new ViewManager();
    include '../view/locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
    $this->flashMessageSuccess = $this->view->popFlashSuccess("successMessage");
    $this->flashMessageDanger = $this->view->popFlashDanger("dangerMessage");
?>

<!DOCTYPE html>
    <html lang="es">
        <head>
            <title>%TITLE%</title>
            <link rel="shortcut icon" href="../view/img/favicon.png"/>
            <meta charset="utf-8"/>
            <!-- Styles -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
            <link href="https://fonts.googleapis.com/css?family=K2D" rel="stylesheet">

            <!-- Our Styles -->
            <link rel="stylesheet" href="../../styles/styles.css">
            <link rel="stylesheet" href="../view/css/style.css">

            <!-- Bootstrap JavaScript -->
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
                crossorigin="anonymous"></script>

            <!-- Our JS -->
            <script type="text/javascript" src="../view/js/common.js"></script>
            <script type="text/javascript" src="../view/js/validates.js"></script>
        </head>


        <?php if(get_class($this) === 'SPACE_SHOW_PLAN'){ ?>
            <body onload = "viewSpace('<?= $this->space['sm_coordsplan'] ?>','<?= $this->plan ?>')">
        <?php } else if(get_class($this) === 'SPACE_SELECT_PLAN'){ ?>
            <body onload = "selectSpace('<?= $this->space['sm_coordsplan'] ?>','<?= $this->plan ?>')"> 
        <?php } else { ?>
             <body>
        <?php } ?>

        <!-- HEADER -->
        <header>
            <nav class="navbar navbar-expand-lg navbar-light">
                <a title="Home" class="navbar-brand" href="../index.php">
                    <img src="../view/img/logo.png" class="logoPpal" alt="<?=$strings['LogoUVigo']?>"/>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <?php  if(checkRol('SHOW ALL', 'USER')): ?>
                            <div class="nav-item dropdown">
                                <a id="navbarDropdown-User" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <?=$strings['Admin']?></a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown-User">
                                    <?php  if(checkRol('SHOW ALL', 'ACTION')): ?>
                                    <a class="dropdown-item" href="../controller/ACTION_Controller.php"><?=$strings['Actions']?></a>
                                    <?php endif; ?>  
                                    <?php  if(checkRol('SHOW ALL', 'FUNCTIONALITY')): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../controller/FUNCTIONALITY_Controller.php"><?=$strings['Functionalities']?></a>
                                    <?php endif; ?>  
                                    <?php  if(checkRol('SHOW ALL', 'GROUP')): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../controller/GROUP_Controller.php"><?=$strings['Groups']?></a>
                                    <?php endif; ?>  
                                    <?php  if(checkRol('SHOW ALL', 'USER')): ?>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="../controller/USER_Controller.php"><?=$strings['Users']?></a>
                                    <?php endif; ?> 
                                    <div class="dropdown-divider"></div> 
                                    <?php  if(checkRol('SHOW ALL', 'TEST')): ?>
                                    <a class="dropdown-item" href="../controller/TEST_Controller.php"><?=$strings['Tests']?></a>
                                    <?php endif; ?>  
                                </div>
                            </div>
                        <?php endif; ?>   
                        <li><a class="nav-link" href="../controller/BUILDING_Controller.php"><?=$strings['Show Buildings']?></a></li>
                    </ul>
                </div>

                <?php if(isset($_SESSION['LOGIN'])): ?>

                <div class="nav-item language-box">
                    <?php if($_SESSION['LANGUAGE'] === 'Castellano') { ?>
                        <a class="lang-selected" href="#">ESP</a> |
                        <a class="lang-no-selected" href="../core/ChangeLanguage.php?idioma=Galego">GAL</a> |
                        <a class="lang-no-selected" href="../core/ChangeLanguage.php?idioma=English">ENG</a>
                    <?php } elseif($_SESSION['LANGUAGE'] === 'English') { ?>
                        <a class="lang-no-selected" href="../core/ChangeLanguage.php?idioma=Castellano">ESP</a> |
                        <a class="lang-no-selected" href="../core/ChangeLanguage.php?idioma=Galego">GAL</a> |
                        <a class="lang-selected" href="#">ENG</a>
                    <?php } else { ?>
                        <a class="lang-no-selected" href="../core/ChangeLanguage.php?idioma=Castellano">ESP</a> |
                        <a class="lang-selected" href="#">GAL</a> |
                        <a class="lang-no-selected" href="../core/ChangeLanguage.php?idioma=English">ENG</a>
                    <?php } ?>
                </div>

        
                    <div  class="nav-item dropdown noArrow">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="inset">
                                <?php if(isset($_SESSION['PHOTO']) && is_file($_SESSION['PHOTO'])): ?>    
                                    <img src="<?=$_SESSION['PHOTO']?>">
                                <?php else: ?>
                                    <img src="../view/img/notUser.jpg">
                                <?php endif; ?>
                            </div>
                        </a>	
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="../controller/USER_Controller.php?action=EditProfile&user=<?=$_SESSION['LOGIN']?>"><?=$strings['My Profile']?></a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="../controller/LOGIN_Controller.php?action=Logout"><?=$strings['Logout']?></a>
                        </div>
                    </div>
                <?php else: ?>
                    <a class="nav-link nav-a" href="../controller/LOGIN_Controller.php?action=Login"><?=$strings['Login']?></a>
                <?php endif; ?>
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