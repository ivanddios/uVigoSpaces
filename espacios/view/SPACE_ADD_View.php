<?php

class SPACE_ADD{

    private $building;
	private $floor;

    function __construct($building, $floor) {
        $this->building = $building;
		$this->floor = $floor;
        $this->render();
    }
    
    function render() {
        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Add Floor"]); ?>

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Data of the new space"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="SPACE_Controller.php?action=<?= $strings['Add']?>&building=<?= $this->building?>&floor=<?= $this->floor?>" enctype="multipart/form-data" onkeyup="validateSpace()">
							<div id="group-form">
                                <input type="hidden" name="idBuilding" value="<?=$this->building?>" readonly>
                                <input type="hidden" name="idFloor" value="<?=$this->floor?>" readonly>

								<div class="inputWithIcon inputIconBg">
									<input type="text" placeholder="<?= $this->building.$this->floor?>" readonly>
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="idSpace" name="idSpace" placeholder="<?= $strings['What is the identifier of this space?']?> *" onkeyup="checkSpaceId(this.id)">
									<i class="fa fa-cube fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="nameSpace" name="nameSpace" placeholder="<?= $strings['What space is it?']?> *" onkeyup="checkText(this.id)">
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="surfaceSpace" name="surfaceSpace" placeholder="<?= $strings['What is the surface of space?']?>" onkeyup="checkSurfaceSpace(this.id)">
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input id="numberInventorySpace" type="text" name="numberInventorySpace" placeholder="<?= $strings['What is the number inventory?']?>" onkeyup="checkNumberInventory(this.id)">
									<i class="fa fa-barcode fa-lg fa-fw" aria-hidden="true"></i>
								</div>

							</div>	
							<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
						</form>
						<a href="SPACE_Controller.php?building=<?= $this->building?>&floor=<?= $this->floor?>"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
