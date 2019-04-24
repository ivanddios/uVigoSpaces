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
							<?=$this->building['sm_nameBuilding']?>
						</div>
						<div class="col-lg-12 center-block-content">
								<div id="group-form">
									<div class="input-container">
											<span class="input-group-text fa fa-lock"></span>
											<input type="text" id="idBuilding" name="idBuilding" value="<?=$this->building['sm_idBuilding']?>" readonly/>
											<label for="idBuilding"><?= $strings['idBuilding']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="nameBuilding" name="nameBuilding" value="<?=$this->building['sm_nameBuilding']?>" readonly/>
										<label for="nameBuilding"><?= $strings['nameBuilding']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-map-marker"></span>
										<input type="text" id="addressBuilding" name="addressBuilding" value="<?=$this->building['sm_addressBuilding']?>" readonly/>
										<label for="addressBuilding"><?= $strings['addressBuilding']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-phone"></span>
										<input type="text" id="phoneBuilding" name="phoneBuilding" value="<?=$this->building['sm_phoneBuilding']?>" readonly/>
										<label for="phoneBuilding"><?= $strings['phoneBuilding']?></label>
									</div>
								</div>
							<a href="../controller/BUILDING_Controller.php?"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
