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
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["ViewSpace"]); ?>

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
