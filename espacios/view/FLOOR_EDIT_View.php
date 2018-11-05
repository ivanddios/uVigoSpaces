<?php

class FLOOR_EDIT{
    private $floor;

    function __construct($floor) {
        $this->floor = $floor;
        $this->render();
    }
    
    function render() {
		include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
		  
        ////////////////////////////////////////////////////
		ob_start();
		include 'header.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace("%TITLE%",$strings['Edit Floor'],$buffer);
		echo $buffer;
		?> <script src="../js/validates.js"></script><?php
		////////////////////////////////////////////////////
		?>

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Do you want to change something?"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="FLOOR_Controller.php?action=<?= $strings['Edit']?>&building=<?= $this->floor['idBuilding']?>&floor=<?= $this->floor['idFloor']?>" enctype="multipart/form-data" onchange="validateFloor()">
							<div id="group-form">
								
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="idBuilding" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->floor['idBuilding']?>" readonly onblur="checkBuildingId(this.id)">
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>
											
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="idFloor" name="idFloor" placeholder="<?= $strings['What is the identifier of this floor?']?>"  value="<?=$this->floor['idFloor']?>" onblur="checkFloorId(this.id)">
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>
	
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="nameFloor" name="nameFloor" placeholder="<?= $strings['What floor is it?']?>" value="<?=$this->floor['nameFloor']?>" onblur="checkText(this.id)">
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="surfaceBuildingFloor" name="surfaceBuildingFloor" placeholder="<?= $strings['What is the constructed surface?']?>" value="<?=$this->floor['surfaceBuildingFloor']?>" onblur="checkSurface(this.id)">
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="surfaceUsefulFloor" name="surfaceUsefulFloor" placeholder="<?= $strings['What is the useful surface?']?>" value="<?=$this->floor['surfaceUsefulFloor']?>" onblur="checkSurface(this.id)">
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<a target='_blank' href='<?= $this->floor['planeFloor']; ?>'><img src='<?= $this->floor['planeFloor']; ?>' class="viewPlane" alt="plane"></a>
									<input type="file" name="planeFloor" accept="image/*">
									<input type="hidden" name="planeFloorOriginal" value="<?=$this->floor['planeFloor']?>">
								</div>
							</div>
							<button type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
						</form>
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
