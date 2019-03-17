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
				include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
				
					 ////////////////////////////////////////////////////
				ob_start();
				include 'header.php';
				$buffer = ob_get_contents();
				ob_end_clean();
				$buffer=str_replace("%TITLE%",$strings['Show Floor'],$buffer);
				echo $buffer;
				////////////////////////////////////////////////////
				?>

					<div id="titleView">
						<h3><?= $this->floor['nameBuilding']?><h3>
						<h4><?= $this->floor['nameFloor']?><h4> 
						<img id="plane" src="<?= $this->plane?>" usemap="#spaces" onload="resize()"/>
						<map name="spaces">
						<?php for($i=0; $i<count($this->spaces); $i++){ 
											if($this->spaces[$i]['coordsPlane'] != '') { ?>
												<area shape="poly" name="<?= $this->spaces[$i]['nameSpace']?>" coords="<?= $this->spaces[$i]['coordsPlane']?>" 
												href='SPACE_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->spaces[$i]['idBuilding']?>&floor=<?= $this->spaces[$i]['idFloor']?>&space=<?= $this->spaces[$i]['idSpace']?>' alt="<?= $this->spaces[$i]['nameSpace']?>">
										<?php	}
											} ?>
						</map>
						</div>
					</div>	
			<?php
		include 'footer.php';  
	} 
}

?>
