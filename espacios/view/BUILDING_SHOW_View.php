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
									<div class="input-container">
											<span class="input-group-text fa fa-lock"></span>
											<input type="text" id="idBuilding" name="idBuilding" value="<?=$this->building['idBuilding']?>" readonly/>
											<label for="idBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="nameBuilding" name="nameBuilding" value="<?=$this->building['nameBuilding']?>" readonly/>
										<label for="nameBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-map-marker"></span>
										<input type="text" id="addressBuilding" name="addressBuilding" value="<?=$this->building['addressBuilding']?>" readonly/>
										<label for="addressBuilding"><?= $strings['What is your postal address?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-phone"></span>
										<input type="text" id="phoneBuilding" name="phoneBuilding" value="<?=$this->building['phoneBuilding']?>" readonly/>
										<label for="phoneBuilding"><?= $strings['What is your phone?']?></label>
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
