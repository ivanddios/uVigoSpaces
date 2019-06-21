<?php

class SPACE_SHOW{
		private $space;
		private $plan;

    function __construct($space, $plan) {
				$this->space = $space;
				$this->plan = $plan;
        $this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Show Space"]); ?>

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
                <div id="titleView">
						<?=$this->space['sm_nameSpace']?>
					</div>
					<div class="col-lg-12 center-block-content">
            <div id="group-form">

								<div class="input-container">
									<span class="input-group-text fa fa-cube"></span>
									<input type="text" id="idSpace" name="idSpace" value="<?=$this->space['sm_idSpace']?>" readonly>
									<label for="idSpace"><?= $strings['sm_idSpace']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="nameSpace" name="idFloor" value="<?=$this->space['sm_nameSpace']?>" readonly>
									<label for="idFloor"><?= $strings['sm_nameSpace']?></label>
								</div>
									
								<div class="input-container">
									<span class="input-group-text fa fa-area-chart"></span>
									<input type="text" id="surfaceSpace" name="surfaceSpace" value="<?=$this->space['sm_surfaceSpace']?> m²" readonly>
									<label for="surfaceSpace"><?= $strings['sm_surfaceSpace']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-barcode"></span>
									<input type="text" id="numberInventorySpace" name="numberInventorySpace" value="<?=$this->space['sm_numberInventorySpace']?>" readonly>
									<label for="numberInventorySpace"><?= $strings['sm_numberInventorySpace']?></label>
								</div>

								<label class="control-label"><?= $strings['Click to see the space in the plan']?></label>
								<div id="plane_floor" class="inputWithIcon inputIconBg">
									<a href="SPACE_Controller.php?action=ShowSpacePlan&building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>&space=<?= $this->space['sm_idSpace']?>">
										<img id="view-plan" src='<?= $this->plan; ?>' class="avatarplan" onchange="validateUpdloadFile(this)">
										<img id="icon-view" src="../view/img/iconTouch.png">
									</a>
								</div>
								
							</div>
						<a class="a-back showEntity" href="<?= $_SERVER['HTTP_REFERER'];?>"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>