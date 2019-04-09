<?php

class BUILDING_ADD{

    function __construct() {
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Add Building"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new building"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="BUILDING_Controller.php?action=<?= $strings['Add']?>" onkeyup="validateBuilding();">
							<div id="group-form">

								<div class="input-container">
										<span class="input-group-text fa fa-lock"></span>
										<input type="text" id="idBuilding" name="idBuilding" onkeyup="checkBuildingId(this.id)" required/>
										<label for="idBuilding"><?= $strings['What is the identifier of this building?']?></label>
								</div>

								<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="nameBuilding" name="nameBuilding" onkeyup="checkText(this.id)" required/>
										<label for="nameBuilding"><?= $strings['What is the identifier of this building?']?></label>
								</div>
								
								<div class="input-container">
										<span class="input-group-text fa fa-map-marker"></span>
										<input type="text" id="addressBuilding" name="addressBuilding" onkeyup="checkText(this.id)" required/>
										<label for="addressBuilding"><?= $strings['What is your postal address?']?></label>
								</div>

								<div class="input-container">
										<span class="input-group-text fa fa-phone"></span>
										<input type="text" id="phoneBuilding" name="phoneBuilding" onkeyup="checkNumPhone(this.id)" required/>
										<label for="phoneBuilding"><?= $strings['What is your phone?']?></label>
								</div>

								<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a href="../index.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
