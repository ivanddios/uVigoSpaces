<?php

class FLOOR_SHOW_PLANE{

	private $floor;
	private $spaces;

    function __construct($floor, $spaces) {
		$this->floor = $floor;
		$this->spaces = $spaces;
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
						<?=htmlentities($strings["Data of the new space"])?>
						
						<img src="<?= $this->floor?>" class ="viewPlane" alt="Espacios" usemap="#spaces"/>
						<map name="spaces">
						<?php for($i=0; $i<count($this->spaces); $i++){ 
											if($this->spaces[$i]['coordsPlane'] != '') { ?>
												<area shape="poly" coords="<?= $this->spaces[$i]['coordsPlane']?>" 
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
