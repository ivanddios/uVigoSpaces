<?php

class INDEX{

    function __construct() {
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Add Action"]);?>
		
		<!-- <div class="container">
        <img id="imgIndex" src="../img/uvigo.jpg">
    </div> -->
    

    <div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new functionality"])?>
          </div>
          </div>
    </div>
    </div>
          <img id="imgIndex" src="../img/uvigo.jpg">
				
		
 <?php
  } 
}

?>