<?php

class SPACE_SHOW_PLAN{

	private $space;
	private $plan;

    function __construct($space, $plan) {
		$this->space = $space;
		$this->plan = $plan;
		$this->render();
		}
		
		
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["ViewSpace"]); ?>
		<script type="text/javascript" src="../view/js/space-plan.js"></script>

		<div id="titleView">
			<h3><?= $this->space['sm_nameBuilding'];?><h3>
			<h4><?= $this->space['sm_nameFloor'];?> ~ <?= $this->space['sm_nameSpace'];?>
		</div>
		<div id="container-canvas">
			<canvas id="canvasImage"></canvas>
			<canvas id="canvasSelection"></canvas>
		</div>
		<div id="planButtons">
			<li>
				<ul><button id="fullButton" type="button" class="btn btn-primary "><i class="fa fa-expand" aria-hidden="true"></i>&nbsp<?= $strings['Extend']?></button></ul>
				<ul><button id="resizeButton" type="button" class="btn btn-primary " disabled><i class="fa fa-window-maximize" aria-hidden="true"></i>&nbsp<?= $strings['Adjust']?></button></ul>
				<ul><a href="SPACE_Controller.php?building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>" class="btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp<?= $strings['Back']?></a></ul>
			</li>
		</div>	 	
		<?php
	} 
}

?>
