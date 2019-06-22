<?php

class INDEX{

    function __construct() {
        $this->render();
        
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Welcome"]);?>
		
        <div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Welcome"])?>
                    </div>
                </div>
            </div>
        </div>
        <img id="imgIndex" src="../view/img/uvigo.jpg">	
        <!-- <img id="imgIndex" src="../view/img/uvigo.jpg" onload="loadWelcomeImg()">	 -->
 <?php } 
}

?>