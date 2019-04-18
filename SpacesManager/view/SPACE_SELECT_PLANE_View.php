<?php

class SPACE_SELECT_PLANE{

	private $space;
	private $plane;

  function __construct($space, $plane) {
		$this->space = $space;
		$this->plane = $plane;
		$this->render();
  }
    
  function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["SelectSpace"]); ?>
		<script type="text/javascript" src="../view/js/space-plane.js"></script>

		<div id="titleView">
			<?=htmlentities($strings["Select the space in the plane"])?>
			<canvas id="canvas"></canvas>	
			<form method="POST" action="SPACE_Controller.php?action=SelectSpacePlane&building=<?= $this->space['sm_idBuilding']?>&floor=<?= $this->space['sm_idFloor']?>&space=<?= $this->space['sm_idSpace']?>">
				<div id="planeButtons">
					<li>
						<ul><button id="saveButton" type="submit" name="submit" class="btn btn-success" disabled><i class="fa fa-plus" aria-hidden="true"></i><?= $strings['Save']?></button></ul>
						<ul><button id="clearButton" type="button" class="btn btn-danger" disabled><i class="fa fa-trash" aria-hidden="true"></i><?= $strings['Delete']?></button></ul>
					</li>
				</div>
				<input type="hidden" id="coordsSpace" name="coordsSpace">
			</form> 		 
		</div>	
	<?php
		include 'footer.php';  
	} 
}

?>
