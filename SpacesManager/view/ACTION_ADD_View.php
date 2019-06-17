<?php

class ACTION_ADD{

  function __construct() {
    $this->render();
  }
    
  function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Add Action"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new action"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form  method="POST" action="ACTION_Controller.php?action=Add" onkeyup="validateAction(this)">
							<div id="group-form">

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="nameAction" name="nameAction" onkeyup="checkText(this)" required/>
									<label for="nameAction"><?= $strings['What action is it?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="descripAction" name="descripAction" onkeyup="checkText(this)" required/>
									<label for="descripAction"><?= $strings['What is the action about?']?></label>
								</div>
                            
								<button id="saveButton" type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a class="a-back" href="ACTION_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 		<?php
    	include 'footer.php';  
  } 
}

?>
