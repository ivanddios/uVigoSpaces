<?php

class FLOOR_ADD{

    private $building;

    function __construct($building) {
        $this->building = $building;
        $this->render();
    }
    
    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
        include 'header.php' ?>

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Data of the new building's floor"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="FLOOR_Controller.php?action=<?php echo $strings['Add']?>&building=<?php echo $this->building?>">
							<div id="group-form">
								<div class="inputWithIcon inputIconBg">
									<input type="text" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?php echo $this->building?>" readonly>
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="idFloor" placeholder="<?= $strings['What is the identifier of this floor?']?>">
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="nameFloor" placeholder="<?= $strings['What floor is it?']?>">
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="surfaceBuildingFloor" placeholder="<?= $strings['What is the constructed surface?']?>">
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="surfaceUsefulFloor" placeholder="<?= $strings['What is the useful surface?']?>">
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>

								<div class="inputWithIcon inputIconBg">
									<input type="file" name="planeFloor" accept="image/*" value="<?=$this->floor['planeFloor']?>">
								</div>
							</div>	
							<button type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
						</form>
						<a href="../index.php?"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
