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

		<!-- <div class="divImg"> -->
			<!-- <div class="row center-row"> -->
				<!-- <div class="col-lg-6 center-block"> -->
					<div id="titleView">
						<?=htmlentities($strings["Data of the new space"])?>
                       
					</div>
					<!-- <div class="col-lg-12 center-block-content"> -->
						<form method="POST" action="SPACE_Controller.php?action=<?= $strings['Plane']?>" enctype="multipart/form-data">
                        <!-- <div id="titleView"> -->
								<div class="inputWithIcon inputIconBg">
                                <img src='<?= $this->plane ?>' onclick="selectCoords(event)" usemap="#planetmap">
								</div>

                                <p id="demo"></p>
                                    <!-- <map name="planetmap">
										<area shape="poly" coords="400,286,606,286,400,357,605,358" href="triangulo.html" />
                                        <area alt="" title="asdasdasd" href="#" shape="poly" coords="554,1907,761,1907,762,1985,556,1980" />
                                        <!-- coords="400,286,606,286,400,357,605,358"
                                        coords="555,286,759,288,555,358,761,358" -->
										<area shape="default" nohref="nohref" /> 
									</map> -->

							<!-- </div>	 -->
							<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
						</form>
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
