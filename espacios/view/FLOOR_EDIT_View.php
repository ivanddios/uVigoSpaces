<?php

class FLOOR_EDIT{
    private $floor;

    function __construct($floor) {
        $this->floor = $floor;
        $this->render();
    }
    
    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
        include 'header.php' ?>

<div class="container">
	<div class="row center-row">
		<div class="col-lg-6 center-block">
			<div id="subtitlePoll">
				<?=htmlentities($strings["Do you want to change something?"])?>
			</div>
			<div class="col-lg-12 center-block2">
				<form method="POST" action="FLOOR_Controller.php?action=<?php echo $strings['Edit']?>&building=<?php echo $this->floor['idBuilding']?>&floor=<?php echo $this->floor['idFloor']?>">
                <div id="optionalInput">
                    	<div class="inputWithIconLogin inputIconBg">
                        	<input type="text" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->floor['idBuilding']?>" readonly>
                        	<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
                   		 </div>
					</div>
					<div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="idFloor" placeholder="<?= $strings['What is the identifier of this floor?']?>"  value="<?=$this->floor['idFloor']?>">
							<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
						</div>
					</div>
					<div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="nameFloor" placeholder="<?= $strings['What floor is it?']?>" value="<?=$this->floor['nameFloor']?>">
							<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
						</div>
					</div>

                    <div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="planFloor" placeholder="<?= $strings['Is there a plan for this floor?']?> " value="<?=$this->floor['planFloor']?>">
							<i class="fa  fa-picture-o fa-lg fa-fw" aria-hidden="true"></i>
						</div>
					</div>

					<div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="surfaceBuildingFloor" placeholder="<?= $strings['What is the constructed surface?']?>" value="<?=$this->floor['surfaceBuildingFloor']?>">
							<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
						</div>
					</div>
                    <div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="surfaceUsefulFloor" placeholder="<?= $strings['What is the useful surface?']?>" value="<?=$this->floor['surfaceUsefulFloor']?>">
							<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
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
