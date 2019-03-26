<?php

class BUILDING_SHOW{
    private $building;

    function __construct($building) {
        $this->building = $building;
        $this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Show Building"]);?>

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=$this->building['nameBuilding']?>
						</div>
						<div class="col-lg-12 center-block-content">
								<div id="group-form">
									<div class="inputWithIcon inputIconBg">
										<input type="text" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->building['idBuilding']?>" readonly>
										<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" name="nameBuilding" placeholder="<?= $strings['What building is it?']?>"  value="<?=$this->building['nameBuilding']?>" readonly>
										<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" name="addressBuilding" placeholder="<?= $strings['What is your postal address?']?>" value="<?=$this->building['addressBuilding']?>" readonly>
										<i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" name="phoneBuilding" placeholder="<?= $strings['What is your phone?']?> " value="<?=$this->building['phoneBuilding']?>" readonly>
										<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
									</div>
									
								</div>
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
