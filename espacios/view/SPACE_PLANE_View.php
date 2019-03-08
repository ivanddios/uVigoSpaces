<?php

class SPACE_PLANE{

	private $space;
	private $plane;

    function __construct($space, $plane) {
		$this->space = $space;
		$this->plane = $plane;
		$this->render();
		
    }
    
    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
				require_once(__DIR__."..\..\core\ViewManager.php");
				$this->view = new ViewManager();
				$this->flashMessageSuccess = $this->view->popFlashSuccess("successMessage");
				$this->flashMessageDanger = $this->view->popFlashDanger("dangerMessage");
				?>

				<!DOCTYPE html>
					<html lang="es">
						<head>
							<title><?= $strings["Select Space"] ?></title>
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

						<body onload = "map('<?= $this->plane ?>')">
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

							<div id="titleView">
								<?=htmlentities($strings["Select the space in the plane"])?>
								<canvas id="canvas"></canvas>
								
								<form method="POST" action="SPACE_Controller.php?action=<?= $strings['Plane']?>&building=<?= $this->space['idBuilding']?>&floor=<?= $this->space['idFloor']?>&space=<?= $this->space['idSpace']?>">
									<input  type="hidden" name="idBuilding" value="<?=$this->space['idBuilding']?>" readonly>
									<input  type="hidden"name="idFloor" value="<?=$this->space['idFloor']?>" readonly>
									<input  type="hidden" name="idSpace" value="<?=$this->space['idSpace']?>" readonly>
									<input  type="hidden" id="coordsSpace" name="coordsSpace">
									<div class="fixed">
										<!-- <button id="Clear"><?= $strings["Clear"] ?></button> -->
										<button type="button" class="btn btn-primary"><i class="fa fa-trash" aria-hidden="true"></i>  Delete</button>

										<a class="btn icon-btn btn-success" href="#">
											<span class="glyphicon glyphicon-plus"></span> Add
										</a>

										<!-- <button type="submit" name="submit"><?= $strings["Save"]?></button>   -->
									</div>
								 
								</form> 		 
							</div>	
					<?php
				include 'footer.php';  
		} 
	}

?>
