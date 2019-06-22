<?php

class FLOOR_SHOW{
    private $floor;

    function __construct($floor) {
        $this->floor = $floor;
        $this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Show Floor"]);?>

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=$this->floor['sm_nameFloor']?>
						</div>
						<div class="col-lg-12 center-block-content">
								<div id="group-form">

									<div class="input-container">
										<span class="input-group-text fa fa-building"></span>
										<input type="text" id="idBuilding" name="idBuilding" value="<?=$this->floor['sm_idBuilding']?>" readonly>
										<label for="idBuilding"><?= $strings['idBuilding']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-lock"></span>
										<input type="text" id="idFloor" name="idFloor" value="<?=$this->floor['sm_idFloor']?>" readonly>
										<label for="idFloor"><?= $strings['idFloor']?></label>
									</div>
								
									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="nameFloor" name="nameFloor" value="<?=$this->floor['sm_nameFloor']?>" readonly>
										<label for="nameFloor"><?= $strings['nameFloor']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="builtSurfaceFloor" name="builtSurfaceFloor" value="<?=$this->floor['sm_builtSurfaceFloor']?>  m²" readonly>
										<label for="builtSurfaceFloor"><?= $strings['builtSurfaceFloor']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-area-chart"></span>
										<input type="text" id="surfaceUsefulFloor" name="surfaceUsefulFloor" value="<?=$this->floor['sm_surfaceUsefulFloor']?>  m²" readonly>
										<label for="surfaceUsefulFloor"><?= $strings['surfaceUsefulFloor']?></label>
									</div>

									<?php if(is_file($this->floor['sm_planFloor'])): ?>
										<div class="input-file">
											<label class="control-label"><?= $strings['Click to see the plan']?></label>
											<div id="plane_floor" class="inputWithIcon inputIconBg">
												<a target='_blank' href="FLOOR_Controller.php?action=ShowPlan&building=<?= $this->floor['sm_idBuilding']?>&floor=<?= $this->floor['sm_idFloor']?>">
													<img id="view-plan" src='<?= $this->floor['sm_planFloor']; ?>' class="avatarplan">
													<img id="icon-view" src = "../view/img/iconTouch.png">
												</a>
											</div>
										</div>
									<?php endif; ?>

									<div class="input-container">
										<span class="input-group-text fa fa-cube"></span><label class="show-a"><?= $strings['seeSpaces']?> <a href="../controller/SPACE_Controller.php?building=<?=$this->floor['sm_idBuilding']?>&floor=<?=$this->floor['sm_idFloor']?>"><?=$strings['here']?></a></label>
									</div>
								
								</div>
							<a class="a-back showEntity" href="FLOOR_Controller.php?building=<?= $this->floor['sm_idBuilding']?>"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
