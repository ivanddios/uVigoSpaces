<?php

class GROUP_ADD{

    function __construct() {
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Add Group"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new group"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form  method="POST" action="GROUP_Controller.php?action=<?= $strings['Add']?>" onkeyup="validateGroup()">
							<div id="group-form">

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="nameGroup" name="nameGroup" placeholder="<?= $strings['What group is it?']?>" onkeyup="checkText(this.id)" required >
                  <i class="fa fa-users fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="descripGroup" name="descripGroup" placeholder="<?= $strings['What is the group about?']?>" onkeyup="checkText(this.id)" required>
                  <i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>
                              
								<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a href="GROUP_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
