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
		////////////////////////////////////////////////////
		?>

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Do you want to change something?"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="FLOOR_Controller.php?action=<?php echo $strings['Edit']?>&building=<?php echo $this->floor['idBuilding']?>&floor=<?php echo $this->floor['idFloor']?>" enctype="multipart/form-data">
							<div id="group-form">
								<label><?php echo $strings['idBuilding']; ?></label>
								<div class="inputWithIcon inputIconBg">
									<input type="text" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->floor['idBuilding']?>" readonly>
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>
										
								<label><?php echo $strings['idFloor']; ?></label>	
								<div class="inputWithIcon inputIconBg">
									<input type="text" name="idFloor" placeholder="<?= $strings['What is the identifier of this floor?']?>"  value="<?=$this->floor['idFloor']?>">
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<label><?php echo $strings['nameFloor']; ?></label>	
								<div class="inputWithIcon inputIconBg">
									<input type="text" name="nameFloor" placeholder="<?= $strings['What floor is it?']?>" value="<?=$this->floor['nameFloor']?>">
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<label><?php echo $strings['surfaceBuildingFloor']; ?></label>	
								<div class="inputWithIcon inputIconBg">
									<input type="text" name="surfaceBuildingFloor" placeholder="<?= $strings['What is the constructed surface?']?>" value="<?=$this->floor['surfaceBuildingFloor']?>">
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<label><?php echo $strings['surfaceUsefulFloor']; ?></label>
								<div class="inputWithIcon inputIconBg">
									<input type="text" name="surfaceUsefulFloor" placeholder="<?= $strings['What is the useful surface?']?>" value="<?=$this->floor['surfaceUsefulFloor']?>">
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<label><?php echo $strings['planeFloor']; ?></label>
								<div class="inputWithIcon inputIconBg">
									<a target='_blank' href='<?php echo $this->floor['planeFloor']; ?>'><img src='<?= $this->floor['planeFloor']; ?>' width="250" height="250"></a>
									<input type="file" name="planeFloor" accept="image/*">
									<input type="hidden" name="planeFloorOriginal" value="<?=$this->floor['planeFloor']?>">
								</div>
							</div>
							<button type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
						</form>
						<a href="FLOOR_Controller.php?building=<?php echo $this->floor['idBuilding']?>"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
