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
						<form  method="POST" action="ACTION_Controller.php?action=<?= $strings['Add']?>" onkeyup="validateAction()">
							<div id="group-form">

								<!-- <div class="inputWithIcon inputIconBg">
									<input type="text" id="nameAction" name="nameAction" placeholder="<?= $strings['What action is it?']?>" onkeyup="checkText(this.id)" required >
                  <i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="descripAction" name="descripAction" placeholder="<?= $strings['What is the action about?']?>" onkeyup="checkText(this.id)" required>
                  <i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div> -->


								<div class="input-container">
									<span class="input-group-text fa fa-users"></span>
									<input type="text" id="nameAction" name="nameAction" onkeyup="checkText(this.id)" required/>
									<label for="nameAction"><?= $strings['What action is it?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="descripAction" name="descripAction" value="<?=$this->values['descripAction']?>" onkeyup="checkText(this.id)" required/>
									<label for="descripAction"><?= $strings['What is the action about?']?></label>
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
