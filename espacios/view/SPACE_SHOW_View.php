<?php

class SPACE_SHOW{
		private $space;
		private $plane;

    function __construct($space, $plane) {
				$this->space = $space;
				$this->plane = $plane;
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

								<!-- <div class="inputWithIcon inputIconBg">
									<input type="text" name="idSpace" placeholder="<?= $strings['What is the identifier of this space?']?>" value="<?= $this->space['idBuilding'].$this->space['idFloor'].$this->space['idSpace']?>" readonly>
									<i class="fa fa-cube fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="nameSpace" placeholder="<?= $strings['What space is it?']?>" value="<?=$this->space['nameSpace']?>" readonly>
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="surfaceSpace" placeholder="<?= $strings['What is the surface of space?']?>" value="<?=$this->space['surfaceSpace']?>" readonly>
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="numberInventorySpace" placeholder="<?= $strings['What is the number inventory?']?>" value="<?=$this->space['numberInventorySpace']?>" readonly>
									<i class="fa fa-barcode fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<a href="SPACE_Controller.php?action=<?= $strings['ShowSpacePlane']?>&building=<?= $this->space['idBuilding']?>&floor=<?= $this->space['idFloor']?>&space=<?= $this->space['idSpace']?>"><img src='<?= $this->plane; ?>' class="avatarPlane"></a>
								</div> -->


								<div class="input-container">
									<span class="input-group-text fa fa-cube"></span>
									<input type="text" id="idSpace" name="idSpace" value="<?=$this->space['sm_idSpace']?>" readonly>
									<label for="idSpace"><?= $strings['What is the identifier of this space?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="nameSpace" name="idFloor" value="<?=$this->space['sm_nameSpace']?>" readonly>
									<label for="idFloor"><?= $strings['What space is it?']?></label>
								</div>
									
								<div class="input-container">
									<span class="input-group-text fa fa-area-chart"></span>
									<input type="text" id="surfaceSpace" name="surfaceSpace" value="<?=$this->space['sm_surfaceSpace']?>" readonly>
									<label for="surfaceSpace"><?= $strings['What is the surface of space?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-barcode"></span>
									<input type="text" id="numberInventorySpace" name="numberInventorySpace" value="<?=$this->space['sm_numberInventorySpace']?>" readonly>
									<label for="numberInventorySpace"><?= $strings['What is the number inventory?']?></label>
								</div>

								<div class="inputWithIcon inputIconBg">
									<a href="SPACE_Controller.php?action=<?= $strings['EditSpacePlane']?>&building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>&space=<?= $this->space['sm_idSpace']?>"><img src='<?= $this->plane; ?>' class="avatarPlane" onchange="validateUpdloadFile(this.id)"></a>
								</div>
								
							</div>
						<a href="<?= $_SERVER['HTTP_REFERER'];?>"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
