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
		include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
		////////////////////////////////////////////////////
		ob_start();
		include 'header.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace("%TITLE%",$strings['SelectSpace'],$buffer);
		echo $buffer;
		////////////////////////////////////////////////////
		?>

		<div id="titleView">
			<?=htmlentities($strings["Select the space in the plane"])?>
			<canvas id="canvas"></canvas>
								
			<form method="POST" action="SPACE_Controller.php?action=<?= $strings['Plane']?>&building=<?= $this->space['idBuilding']?>&floor=<?= $this->space['idFloor']?>&space=<?= $this->space['idSpace']?>">
				<input  type="hidden" name="idBuilding" value="<?=$this->space['idBuilding']?>" readonly>
				<input  type="hidden"name="idFloor" value="<?=$this->space['idFloor']?>" readonly>
				<input  type="hidden" name="idSpace" value="<?=$this->space['idSpace']?>" readonly>
				<input  type="hidden" id="coordsSpace" name="coordsSpace">
				<div id="planeButtons">
					<li>
						<ul><button id="saveButton" type="submit" name="submit" class="btn btn-success" disabled><i class="fa fa-plus" aria-hidden="true"></i><?= $strings['Save']?></button></ul>
						<ul><button id="clearButton" type="button" class="btn btn-danger" disabled><i class="fa fa-trash" aria-hidden="true"></i><?= $strings['Delete']?></button></ul>
					</li>
				</div>
			</form> 		 
		</div>	
		<?php
			include 'footer.php';  
		} 
	}

?>
