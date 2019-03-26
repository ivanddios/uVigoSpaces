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
				<h3><?= $this->floor['nameBuilding']?><h3>
				<h4><?= $this->floor['nameFloor']?><h4> 
				<img id="plane" src="<?= $this->plane?>" usemap="#spaces" onload="resize()"/>
				<map name="spaces">
					<?php for($i=0; $i<count($this->spaces); $i++):
						if($this->spaces[$i]['coordsPlane'] != ''): ?>
							<area shape="poly" name="<?= $this->spaces[$i]['nameSpace']?>" coords="<?= $this->spaces[$i]['coordsPlane']?>" 
										href='SPACE_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->spaces[$i]['idBuilding']?>&floor=<?= $this->spaces[$i]['idFloor']?>&space=<?= $this->spaces[$i]['idSpace']?>' alt="<?= $this->spaces[$i]['nameSpace']?>">
						<?php	endif;
					endfor; ?>
				</map>
			</div>	
		<?php
		include 'footer.php';  
	} 
}

?>
