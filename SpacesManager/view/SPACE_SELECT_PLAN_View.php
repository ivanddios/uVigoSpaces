<?php

class SPACE_SELECT_PLAN{

	private $space;
	private $plan;

  	function __construct($space, $plan) {
		$this->space = $space;
		$this->plan = $plan;
		$this->render();
  	}
    
  	function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["SelectSpace"]); ?>
		<script type="text/javascript" src="../view/js/space-plan.js"></script>

		<div id="titleView">
			<?=htmlentities($strings["Select the space in the plan"])?>
		</div>
		<div id="container-canvas">
			<canvas id="canvasImage"></canvas>
			<canvas id="canvasSelection"></canvas>
		</div>

		<form method="POST" action="SPACE_Controller.php?action=SelectSpacePlan&building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>&space=<?= $this->space['sm_idSpace']?>">
			<div id="planButtons">
				<li>
					<ul><button id="saveButton" type="submit" name="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i><?= $strings['Save']?></button></ul>
					<ul><button id="clearButton" type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp<?= $strings['Delete']?></button></ul>
					<ul><button id="fullButton" type="button" class="btn btn-primary "><i class="fa fa-expand" aria-hidden="true"></i>&nbsp<?= $strings['Extend']?></button></ul>
					<ul><button id="resizeButton" type="button" class="btn btn-primary" disabled><i class="fa fa-window-maximize" aria-hidden="true"></i>&nbsp<?= $strings['Adjust']?></button></ul>
					<ul><a href="SPACE_Controller.php?building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>" class="btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp<?= $strings['Back']?></a></ul>
				</li>
			</div>
			<input type="hidden" id="coordsSpace" name="coordsSpace">
		</form> 		 	
		<?php
	} 
}

?>
