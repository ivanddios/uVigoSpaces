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
							<form method="POST" action="BUILDING_Controller.php?action=<?= $strings['Edit']?>&building=<?= $this->building['sm_idBuilding']?>" onkeyup="validateBuilding();">
								<div id="group-form">
									<!-- <div class="inputWithIcon inputIconBg">
										<input type="text" id="idBuilding" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->building['idBuilding']?>" readonly>
										<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" id="nameBuilding" name="nameBuilding" placeholder="<?= $strings['What building is it?']?>"  value="<?=$this->building['nameBuilding']?>" onkeyup="checkText(this.id)">
										<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" id="addressBuilding" name="addressBuilding" placeholder="<?= $strings['What is your postal address?']?>" value="<?=$this->building['addressBuilding']?>" onkeyup="checkText(this.id)">
										<i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" id="phoneBuilding" name="phoneBuilding" placeholder="<?= $strings['What is your phone?']?> " value="<?=$this->building['phoneBuilding']?>" onkeyup="checkNumPhone(this.id)">
										<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
									</div> -->


									<div class="input-container">
										<span class="input-group-text fa fa-lock"></span>
										<input type="text" id="idBuilding" name="idBuilding" value="<?=$this->building['sm_idBuilding']?>" readonly/>
										<label for="idBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="nameBuilding" name="nameBuilding" onkeyup="checkText(this.id)" value="<?=$this->building['sm_nameBuilding']?>" required/>
										<label for="nameBuilding"><?= $strings['What is the identifier of this building?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-map-marker"></span>
										<input type="text" id="addressBuilding" name="addressBuilding" onkeyup="checkText(this.id)" value="<?=$this->building['sm_addressBuilding']?>" required/>
										<label for="addressBuilding"><?= $strings['What is your postal address?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-phone"></span>
										<input type="text" id="phoneBuilding" name="phoneBuilding" onkeyup="checkNumPhone(this.id)" value="<?=$this->building['sm_phoneBuilding']?>" required/>
										<label for="phoneBuilding"><?= $strings['What is your phone?']?></label>
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
