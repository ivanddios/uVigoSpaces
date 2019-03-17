<?php

class SPACE_SHOW_PLANE{

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
			$buffer=str_replace("%TITLE%",$strings['ViewSpace'],$buffer);
			echo $buffer;
			////////////////////////////////////////////////////
			?>

			<div id="titleView">
				<h3><?= $this->space['nameBuilding'];?><h3>
				<h4><?= $this->space['nameFloor'];?> ~ <?= $this->space['nameSpace'];?>
				<canvas id="canvas"></canvas>		 
			</div>	
		    <?php
				include 'footer.php';  
		} 
	}

?>
