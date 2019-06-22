<?php

class FLOOR_ADD{

    private $building;

    function __construct($building) {
        $this->building = $building;
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Add Floor"]);?>
		<script type="text/javascript" src="../view/js/bootstrap-filestyle.js"></script> 

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Data of the new building's floor"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="FLOOR_Controller.php?action=Add&building=<?= $this->building?>" enctype="multipart/form-data" onkeyup="validateFloor(this)">
							<div id="group-form">

								<div class="input-container">
										<span class="input-group-text fa fa-lock"></span>
										<input type="text" id="idBuilding" name="idBuilding" value="<?= $this->building?>" readonly/>
										<label for="idBuilding"><?= $strings['idBuilding']?></label>
								</div>

								<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="idFloor" name="idFloor" onkeyup="checkFloorId(this)" required/>
										<label for="idFloor"><?= $strings['What is the identifier of this floor?']?></label>
								</div>
								
								<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="nameFloor" name="nameFloor" onkeyup="checkText(this)" required/>
										<label for="nameFloor"><?= $strings['What floor is it?']?></label>
								</div>

								<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="builtSurfaceFloor" name="builtSurfaceFloor" onkeyup="checkSurface(this)" required/>
										<label for="builtSurfaceFloor"><?= $strings['What is the constructed surface?']?></label>
								</div>

								<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceUsefulFloor" name="surfaceUsefulFloor" onkeyup="checkSurface(this)" required/>
										<label for="surfaceUsefulFloor"><?= $strings['What is the useful surface?']?></label>
								</div>

								<div class="input-file">
									<i class="input-group-text fileInput fa fa-file-image-o" aria-hidden="true"></i>
									<label class="control-label"><?= $strings['Is there a plan for this floor?']?></label>
									<input type="file" name=planFloor class="filestyle" onchange="validateUpdloadFile(this)">
								</div>

							</div>	
							<button id="saveButton" type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
						</form>
						<a class="a-back" href="FLOOR_Controller.php?building=<?= $this->building ?>"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
