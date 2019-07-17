<?php

class SPACE_EDIT{
	
	private $space;
	private $plan;

	function __construct($space, $plan) {
			$this->space = $space;
			$this->plan = $plan;
			$this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Edit Space"]); 
			$selectOptions = array('Infraestructura', 'PAS', 'Servicios', 'Docencia'); ?>

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=htmlentities($strings["Do you want to change something?"])?>
						</div>
						<div class="col-lg-12 center-block-content">
							<form method="POST" action="SPACE_Controller.php?action=Edit&building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>&space=<?=$this->space['sm_idSpace']?>" onkeyup="validateSpace(this)">
								<div id="group-form">

									<input type="hidden" name="idBuilding" value="<?=$this->space['sm_idBuilding']?>" readonly>
                                	<input type="hidden" name="idFloor" value="<?=$this->space['sm_idFloor']?>" readonly>

									<div class="input-container inputidSpace">
										<span class="input-group-text fa fa-cube"></span>
										<input type="text" id="idSpace" name="idSpace" value="<?=$this->space['sm_idSpace']?>" onkeyup="checkSpaceId(this)" required>
										<label for="idSpace"><?= $strings['What is the identifier of this space?']?></label>
									</div>

									<label class="labelSelect"><?= $strings['What is its category?']?></label>
									<div class="input-container labelCategory">
										<select class="custom-select" name="categorySpace" required>
											<?php foreach($selectOptions as $option): 
												if($option == $this->space['sm_categorySpace']) : ?>
													<option value="<?=$option?>" selected ><?=$strings[$this->space['sm_categorySpace']]?></option>
												<?php else: ?>
													<option value="<?=$option?>"><?=$strings[$option]?></option>
												<?php endif;
											endforeach; ?>
										</select>
										<i class="input-group-text fa fa-tag" aria-hidden="true"></i>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="nameSpace" name="nameSpace" value="<?=$this->space['sm_nameSpace']?>" onkeyup="checkText(this)" required>
										<label for="idFloor"><?= $strings['What space is it?']?></label>
									</div>
									
									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceSpace" name="surfaceSpace" value="<?=$this->space['sm_builtSurface']?>" onkeyup="checkSurface(this)">
										<label for="surfaceSpace"><?= $strings['What is the surface of space?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-barcode"></span>
										<input type="text" id="numberInventorySpace" name="numberInventorySpace" value="<?=$this->space['sm_numberInventorySpace']?>" onkeyup="checkNumberInventory(this)">
										<label for="numberInventorySpace"><?= $strings['What is the number inventory?']?></label>
									</div>

									<label class="control-label"><?= $strings['Click to edit the space in the plan']?></label>
									<div id="plane_floor" class="inputWithIcon inputIconBg">
										<a href="SPACE_Controller.php?action=SelectSpacePlan&building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>&space=<?= $this->space['sm_idSpace']?>">
											<img id="view-plan" src='<?= $this->plan; ?>' class="avatarplan">
											<img id="icon-view" src="../view/img/iconTouch.png">
										</a>
									</div>

								</div>	
								<button id="saveButton" type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</form>
							<a class="a-back" href="SPACE_Controller.php?building=<?=$this->space['sm_idBuilding']?>&floor=<?=$this->space['sm_idFloor']?>"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
