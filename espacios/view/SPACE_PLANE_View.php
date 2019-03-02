<?php

class SPACE_PLANE{

    private $plane;

    function __construct($plane) {
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
		$buffer=str_replace("%TITLE%",$strings['Add Floor'],$buffer);
		echo $buffer;

		?> <script src="../js/validates.js"></script><?php
		////////////////////////////////////////////////////
		?>

		<div id="titleView">
			<?=htmlentities($strings["Data of the new space"])?>
			<canvas id="canvas" style="background-image:url('<?= $this->plane ?>');" width="1579" height="2233" ></canvas>	
            <form method="POST" action="SPACE_Controller.php?action=<?= $strings['Plane']?>" enctype="multipart/form-data">
				<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>   
			</form> 		
		</div>	
							
						
						<button id="clearAll">Clear Canvas</button>
						<a href="SPACE_Controller.php?building=<?= $this->building?>&floor=<?= $this->floor?>"><?= $strings["Back"] ?></a>
					<!-- </div> -->
				<!-- </div> -->
			<!-- </div> -->
		<!-- </div> -->
 <?php
    include 'footer.php';  
  } 
}

?>
