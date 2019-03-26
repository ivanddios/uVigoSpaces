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
							<?=$this->floor['nameFloor']?>
						</div>
						<div class="col-lg-12 center-block-content">
								<div id="group-form">
									<label><?= $strings['idBuilding']; ?></label>
									<div class="inputWithIcon inputIconBg">
										<input type="text" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->floor['idBuilding']?><?=$this->floor['idFloor']?>" readonly>
										<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
									</div>
										
									<label><?= $strings['nameFloor']; ?></label>	
									<div class="inputWithIcon inputIconBg">
										<input type="text" name="nameFloor" placeholder="<?= $strings['What floor is it?']?>" value="<?=$this->floor['nameFloor']?>" readonly>
										<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<label><?= $strings['surfaceBuildingFloor']; ?></label>	
									<div class="inputWithIcon inputIconBg">
										<input type="text" name="surfaceBuildingFloor" placeholder="<?= $strings['What is the constructed surface?']?>" value="<?=$this->floor['surfaceBuildingFloor']?> m²" readonly>
										<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<label><?= $strings['surfaceUsefulFloor']; ?></label>
									<div class="inputWithIcon inputIconBg">
										<input type="text" name="surfaceUsefulFloor" placeholder="<?= $strings['What is the useful surface?']?>" value="<?=$this->floor['surfaceUsefulFloor']?> m²" readonly>
										<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<label><?= $strings['planeFloor']; ?></label>
									<div class="inputWithIcon inputIconBg">
										<a target='_blank' href="FLOOR_Controller.php?action=<?= $strings['Show Plane']?>&building=<?= $this->floor['idBuilding']?>&floor=<?= $this->floor['idFloor']?>"><img src='<?= $this->floor['planeFloor']; ?>' class="avatarPlane"></a>
									</div>
									
								</div>
							<a href="FLOOR_Controller.php?building=<?= $this->floor['idBuilding']?>"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
