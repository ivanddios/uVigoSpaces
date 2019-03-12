<?php

class SPACE_SHOW_PLANE{

	private $coords;
	private $plane;

    function __construct($coords, $plane) {
			$this->coords = $coords;
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
			$buffer=str_replace("%TITLE%",$strings['View Space'],$buffer);
			echo $buffer;
			////////////////////////////////////////////////////
			?>

			<div id="titleView">
				<?=htmlentities($strings["View Space"])?>
				<canvas id="canvas"></canvas>		 
			</div>	
		    <?php
				include 'footer.php';  
		} 
	}

?>
