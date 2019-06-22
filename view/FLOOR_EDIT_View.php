<?php

class FLOOR_EDIT{
    private $floor;

    function __construct($floor) {
        $this->floor = $floor;
        $this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Edit Floor"]);?>
			<script type="text/javascript" src="../view/js/bootstrap-filestyle.js"></script> 

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=htmlentities($strings["Do you want to change something?"])?>
						</div>
						<div class="col-lg-12 center-block-content">
							<form method="POST" action="FLOOR_Controller.php?action=Edit&building=<?= $this->floor['sm_idBuilding']?>&floor=<?= $this->floor['sm_idFloor']?>" enctype="multipart/form-data" onchange="validateFloor(this)">
								<div id="group-form">

									<input type="hidden" id="idBuilding" name="idBuilding" value="<?=$this->floor['sm_idBuilding']?>" readonly>

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="idFloor" name="idFloor" value="<?=$this->floor['sm_idFloor']?>" readonly>
										<label for="idFloor"><?= $strings['What is the identifier of this floor?']?></label>
									</div>
								
									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="nameFloor" name="nameFloor" value="<?=$this->floor['sm_nameFloor']?>" onkeyup="checkText(this)" required>
										<label for="nameFloor"><?= $strings['What floor is it?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="builtSurfaceFloor" name="builtSurfaceFloor" value="<?=$this->floor['sm_builtSurfaceFloor']?>" onkeyup="checkSurface(this)" required>
										<label for="builtSurfaceFloor"><?= $strings['What is the constructed surface?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceUsefulFloor" name="surfaceUsefulFloor" value="<?=$this->floor['sm_surfaceUsefulFloor']?>" onkeyup="checkSurface(this)" required>
										<label for="surfaceUsefulFloor"><?= $strings['What is the useful surface?']?></label>
									</div>

									<div class="input-file">
										<i class="input-group-text fileInputEdit fa fa-file-image-o" aria-hidden="true"></i>
										<label class="control-label"><?= $strings['Is there a plan for this floor?']?></label>
										<input type="file" name="planFloor" class="filestyle" value="<?=$this->floor['sm_planFloor']?>" onchange="validateUpdloadFile(this)">
									</div>
									<input type="hidden" id="planFloorOriginal" name="planFloorOriginal" value="<?=$this->floor['sm_planFloor']?>">
								
								</div>
								<button id="saveButton" type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</form>
							<a class="a-back" href="FLOOR_Controller.php?building=<?= $this->floor['sm_idBuilding']?>"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
