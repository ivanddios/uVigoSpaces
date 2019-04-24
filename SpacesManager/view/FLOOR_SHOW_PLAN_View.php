<?php

class FLOOR_SHOW_plan{

	private $spaces;
	private $plan;
	private $floor;

    function __construct($spaces, $plan, $floor) {
		$this->spaces = $spaces;
		$this->plan = $plan;
		$this->floor = $floor;
		$this->render();
		
    }
    
		
	  function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Show Plan"]);?>
			<script type="text/javascript" src="../view/js/space-plan.js"></script>
			<script type="text/javascript" src="../view/js/jquery.maphilight.js"></script>

			<div id="titleView">
				<h3><?= $this->floor['sm_nameBuilding']?><h3>
				<h4><?= $this->floor['sm_nameFloor']?><h4> 
				<img id="plan" class="map" src="<?= $this->plan?>" usemap="#spaces" onload="resizeImgMap(1)"/>
				<map name="spaces">
					<?php for($i=0; $i<count($this->spaces); $i++):
						if($this->spaces[$i]['sm_coordsplan'] != ''): ?>
							<area shape="poly" class="mapArea" name="<?= $this->spaces[$i]['sm_nameSpace']?>" coords="<?= $this->spaces[$i]['sm_coordsplan']?>" 
										href='SPACE_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->spaces[$i]['sm_idBuilding']?>&floor=<?= $this->spaces[$i]['sm_idFloor']?>&space=<?= $this->spaces[$i]['sm_idSpace']?>' alt="<?= $this->spaces[$i]['sm_nameSpace']?>">
						<?php	endif;
					endfor; ?>
				</map>
				<div id="planButtons">
						<li>
							<ul><button id="fullButton" type="button" class="btn btn-primary " onclick="resizeImgMap(0)"><i class="fa fa-expand" aria-hidden="true"></i>&nbsp<?= $strings['Extend']?></button></ul>
							<ul><button id="resizeButton" type="button" class="btn btn-primary " onclick="resizeImgMap(1)" disabled><i class="fa fa-window-maximize" aria-hidden="true"></i>&nbsp<?= $strings['Adjust']?></button></ul>
						</li>
					</div>
			</div>	
		<?php
		include 'footer.php';  
	} 
}

?>
