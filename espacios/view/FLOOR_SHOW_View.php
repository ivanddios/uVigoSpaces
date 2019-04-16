<?php

class FLOOR_SHOW{
    private $floor;

    function __construct($floor) {
        $this->floor = $floor;
        $this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Show Floor"]);?>

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=$this->floor['sm_nameFloor']?>
						</div>
						<div class="col-lg-12 center-block-content">
								<div id="group-form">

									<div class="input-container">
										<span class="input-group-text fa fa-lock"></span>
										<input type="text" id="idBuilding" name="idBuilding" value="<?=$this->floor['sm_idBuilding']?>" readonly>
										<label for="idBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="idFloor" name="idFloor" value="<?=$this->floor['sm_idFloor']?>" readonly>
										<label for="idFloor"><?= $strings['What is the identifier of this floor?']?></label>
									</div>
								
									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="nameFloor" name="nameFloor" value="<?=$this->floor['sm_nameFloor']?>" readonly>
										<label for="nameFloor"><?= $strings['What floor is it?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceBuildingFloor" name="surfaceBuildingFloor" value="<?=$this->floor['sm_surfaceBuildingFloor']?>" readonly>
										<label for="surfaceBuildingFloor"><?= $strings['What is the constructed surface?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceUsefulFloor" name="surfaceUsefulFloor" value="<?=$this->floor['sm_surfaceUsefulFloor']?>" readonly>
										<label for="surfaceUsefulFloor"><?= $strings['What is the useful surface?']?></label>
									</div>

									<div class="input-file">
										<label class="control-label"><?= $strings['Click to see the plane']?></label>
										<div class="inputWithIcon inputIconBg">
										
										<a target='_blank' href="FLOOR_Controller.php?action=<?= $strings['Show Plane']?>&building=<?= $this->floor['sm_idBuilding']?>&floor=<?= $this->floor['sm_idFloor']?>">
											<img id="view-plane" src='<?= $this->floor['sm_planeFloor']; ?>' class="avatarPlane">
											<img id= "icon-view" src = "../img/iconPlane.png">
										</a>
									</div>
									</div>
								
								</div>
							<a href="FLOOR_Controller.php?building=<?= $this->floor['sm_idBuilding']?>"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
