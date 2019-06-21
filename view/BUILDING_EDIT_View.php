<?php

class BUILDING_EDIT{
	
    private $building;

    function __construct($building) {
        $this->building = $building;
        $this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Edit Building"]);?>

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=htmlentities($strings["Do you want to change something?"])?>
						</div>
						<div class="col-lg-12 center-block-content">
							<form method="POST" action="BUILDING_Controller.php?action=Edit&building=<?= $this->building['sm_idBuilding']?>" onkeyup="validateBuilding(this)">
								<div id="group-form">

									<div class="input-container">
										<span class="input-group-text fa fa-lock"></span>
										<input type="text" id="idBuilding" name="idBuilding" value="<?=$this->building['sm_idBuilding']?>" readonly/>
										<label for="idBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="nameBuilding" name="nameBuilding" value="<?=$this->building['sm_nameBuilding']?>" onkeyup="checkText(this)" required/>
										<label for="nameBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-map-marker"></span>
										<input type="text" id="addressBuilding" name="addressBuilding" value="<?=$this->building['sm_addressBuilding']?>" onkeyup="checkText(this)" required/>
										<label for="addressBuilding"><?= $strings['What is its postal address?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-phone"></span>
										<input type="text" id="phoneBuilding" name="phoneBuilding" value="<?=$this->building['sm_phoneBuilding']?>" onkeyup="checkNumPhone(this)" required/>
										<label for="phoneBuilding"><?= $strings['What is its phone?']?></label>
									</div>

								</div>
								<button id="saveButton" type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</form>
							<a class="a-back" href="../controller/BUILDING_Controller.php"><?=$strings["Back"]?></a>
						</div>
					</div>
				</div>
			</div>
 	<?php
    include 'footer.php';  
  } 
}

?>