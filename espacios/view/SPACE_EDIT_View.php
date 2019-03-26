<?php

class SPACE_EDIT{
	
	private $space;
	private $plane;

	function __construct($space, $plane) {
			$this->space = $space;
			$this->plane = $plane;
			
			$this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Edit Space"]); ?>

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=htmlentities($strings["Do you want to change something?"])?>
						</div>
						<div class="col-lg-12 center-block-content">
							<form method="POST" action="SPACE_Controller.php?action=<?= $strings['Edit']?>&building=<?= $this->space['idBuilding']?>&floor=<?= $this->space['idFloor']?>&space=<?=$this->space['idSpace']?>" onkeyup="validateSpace()">
								<div id="group-form">

									<input type="hidden" name="idBuilding" value="<?=$this->space['idBuilding']?>" readonly>
									<input type="hidden" name="idFloor" value="<?=$this->space['idFloor']?>" readonly>

									<div class="inputWithIcon inputIconBg">
										<input type="text" placeholder="<?= $this->space['idBuilding'].$this->space['idFloor']?>" readonly>
										<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" name="idSpace" placeholder="<?= $strings['What is the identifier of this space?']?>" value="<?=$this->space['idSpace']?>" onkeyup="checkSpaceId()">
										<i class="fa fa-cube fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" name="nameSpace" placeholder="<?= $strings['What space is it?']?>" value="<?=$this->space['nameSpace']?>" onkeyup="checkText()">
										<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" name="surfaceSpace" placeholder="<?= $strings['What is the surface of space?']?>" value="<?=$this->space['surfaceSpace']?>" onkeyup="checkSurface()">
										<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
									</div>

									<div class="inputWithIcon inputIconBg">
										<input type="text" name="numberInventorySpace" placeholder="<?= $strings['What is the number inventory?']?>" value="<?=$this->space['numberInventorySpace']?>" onkeyup="checkNumberInventory()">
										<i class="fa fa-barcode fa-lg fa-fw" aria-hidden="true"></i>
									</div>
									<div class="inputWithIcon inputIconBg">
										<a href="SPACE_Controller.php?action=<?= $strings['EditSpacePlane']?>&building=<?= $this->space['idBuilding']?>&floor=<?= $this->space['idFloor']?>&space=<?= $this->space['idSpace']?>"><img src='<?= $this->plane; ?>' class="avatarPlane" onchange="validateUpdloadFile(this.id)"></a>
									</div>
								</div>	
								<button type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</form>
							<a href="SPACE_Controller.php?building=<?=$this->space['idBuilding']?>&floor=<?=$this->space['idFloor']?>"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
