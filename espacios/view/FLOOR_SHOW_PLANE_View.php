<?php

class FLOOR_SHOW_PLANE{

	private $spaces;
	private $plane;
	private $floor;

    function __construct($spaces, $plane, $floor) {
		$this->spaces = $spaces;
		$this->plane = $plane;
		$this->floor = $floor;
		$this->render();
		
    }
    
		
	  function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Show Plane"]);?>

			<div id="titleView">
				<h3><?= $this->floor['sm_nameBuilding']?><h3>
				<h4><?= $this->floor['sm_nameFloor']?><h4> 
				<img id="plane" src="<?= $this->plane?>" usemap="#spaces" onload="resize()"/>
				<map name="spaces">
					<?php for($i=0; $i<count($this->spaces); $i++):
						if($this->spaces[$i]['sm_coordsPlane'] != ''): ?>
							<area shape="poly" name="<?= $this->spaces[$i]['sm_nameSpace']?>" coords="<?= $this->spaces[$i]['sm_coordsPlane']?>" 
										href='SPACE_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->spaces[$i]['sm_idBuilding']?>&floor=<?= $this->spaces[$i]['sm_idFloor']?>&space=<?= $this->spaces[$i]['sm_idSpace']?>' alt="<?= $this->spaces[$i]['sm_nameSpace']?>">
						<?php	endif;
					endfor; ?>
				</map>
			</div>	
		<?php
		include 'footer.php';  
	} 
}

?>
