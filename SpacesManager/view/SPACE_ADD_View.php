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
						<form method="POST" action="SPACE_Controller.php?action=<?= $strings['Add']?>&building=<?= $this->building?>&floor=<?= $this->floor?>" enctype="multipart/form-data" onkeyup="validateSpace(this)">
							<div id="group-form">
                      
								<input type="hidden" name="idBuilding" value="<?=$this->building?>" readonly>
                                <input type="hidden" name="idFloor" value="<?=$this->floor?>" readonly>

								<div class="input-container">
									<span class="input-group-text fa fa-cube"></span>
									<input type="text" id="idSpace" name="idSpace" onkeyup="checkSpaceId(this)" required/>
									<label for="idSpace"><?= $strings['What is the identifier of this space?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="nameSpace" name="nameSpace" onkeyup="checkText(this)" required/>
									<label for="nameSpace"><?= $strings['What space is it?']?></label>
								</div>
								
								<div class="input-container">
									<span class="input-group-text fa fa-area-chart"></span>
									<input type="text" id="surfaceSpace" name="surfaceSpace" onkeyup="checkSurface(this)"/>
									<label for="surfaceSpace"><?= $strings['What is the surface of space?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-barcode"></span>
									<input type="text" id="numberInventorySpace" name="numberInventorySpace" onkeyup="checkSurface(this)"/>
									<label for="numberInventorySpace"><?= $strings['What is the number inventory?']?></label>
								</div>

							</div>	
							<button id="saveButton" type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
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
