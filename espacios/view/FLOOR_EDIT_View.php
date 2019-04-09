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

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=htmlentities($strings["Do you want to change something?"])?>
						</div>
						<div class="col-lg-12 center-block-content">
							<form method="POST" action="FLOOR_Controller.php?action=<?= $strings['Edit']?>&building=<?= $this->floor['am_idBuilding']?>&floor=<?= $this->floor['sm_idFloor']?>" enctype="multipart/form-data" onkeyup="validateFloor()">
								<div id="group-form">
									
									<!-- <div class="inputWithIcon inputIconBg">
										<input type="text" id="idBuilding" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->floor['idBuilding']?>" readonly>
										<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
									</div>
												
									<div class="inputWithIcon inputIconBg">
										<input type="text" id="idFloor" name="idFloor" placeholder="<?= $strings['What is the identifier of this floor?']?>"  value="<?=$this->floor['idFloor']?>" onkeyup="checkFloorId(this.id)">
										<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
									</div>
		
									<div class="inputWithIcon inputIconBg">
										<input type="text" id="nameFloor" name="nameFloor" placeholder="<?= $strings['What floor is it?']?>" value="<?=$this->floor['nameFloor']?>" onkeyup="checkText(this.id)">
										<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" id="surfaceBuildingFloor" name="surfaceBuildingFloor" placeholder="<?= $strings['What is the constructed surface?']?>" value="<?=$this->floor['surfaceBuildingFloor']?>" onkeyup="checkSurface(this.id)">
										<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" id="surfaceUsefulFloor" name="surfaceUsefulFloor" placeholder="<?= $strings['What is the useful surface?']?>" value="<?=$this->floor['surfaceUsefulFloor']?>" onkeyup="checkSurface(this.id)">
										<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<a target='_blank' href='<?= $this->floor['planeFloor']; ?>'><img src='<?= $this->floor['planeFloor']; ?>' class="avatarPlane" alt="plane" onchange="validateUpdloadFile(this.id)"></a>
										<input type="file" name="planeFloor" accept="image/*">
										<input type="hidden" name="planeFloorOriginal" value="<?=$this->floor['planeFloor']?>">
									</div> -->


									<div class="input-container">
										<span class="input-group-text fa fa-lock"></span>
										<input type="text" id="idBuilding" name="idBuilding" value="<?=$this->floor['sm_idBuilding']?>" readonly>
										<label for="idBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="idFloor" name="idFloor" value="<?=$this->floor['sm_idFloor']?>" onkeyup="checkFloorId(this.id)" required>
										<label for="idFloor"><?= $strings['What is the identifier of this floor?']?></label>
									</div>
								
									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="nameFloor" name="nameFloor" value="<?=$this->floor['sm_nameFloor']?>" onkeyup="checkText(this.id)" required>
										<label for="nameFloor"><?= $strings['What floor is it?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceBuildingFloor" name="surfaceBuildingFloor" value="<?=$this->floor['sm_surfaceBuildingFloor']?>" onkeyup="checkSurface(this.id)" required>
										<label for="surfaceBuildingFloor"><?= $strings['What is the constructed surface?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceUsefulFloor" name="surfaceUsefulFloor" value="<?=$this->floor['sm_surfaceUsefulFloor']?>" onkeyup="checkSurface(this.id)" required>
										<label for="surfaceUsefulFloor"><?= $strings['What is the useful surface?']?></label>
									</div>

									<div class="input-file">
										<label class="control-label"><?= $strings['Upload the floor plane']?></label>
										<input type="file" name="planeFloor" class="filestyle">
										<input type="hidden" id="planeFloorOriginal" name="planeFloorOriginal" value="<?=$this->floor['sm_planeFloor']?>">
									</div>
								
								</div>
								<button type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</form>
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
