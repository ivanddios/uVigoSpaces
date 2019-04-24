<?php

class FUNCTIONALITY_ADD{

    private $actions;

    function __construct($actions) {
        $this->actions = $actions;
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Add Functionality"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new functionality"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form  method="POST" action="FUNCTIONALITY_Controller.php?action=<?= $strings['Add']?>" onkeyup="validateFunction(this)">
							<div id="group-form">

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="nameFunction" name="nameFunction" onkeyup="checkText(this)" required/>
									<label for="nameFunction"><?= $strings['What functionality is it?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="descripFunction" name="descripFunction" onkeyup="checkText(this)" required/>
									<label for="descripFunction"><?= $strings['What is the functionality about?']?></label>
								</div>
							  
								<label class="control-label"><?=$strings['Check the actions:']?></label>
                                <?php foreach($this->actions as $action): ?>
                                    <div class="checkboxList">
                                        <input type="checkbox" name="action" id="<?=$action['sm_idAction']?>" value="<?=$action['sm_idAction']?>"/>
                                        <label for="<?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
                                    </div>
                                <?php endforeach; ?>
                                <input type="hidden" id="actions" name="actions">
								<button id="saveButton" type="submit" name="submit" class="btn-dark" onclick="validateCheckboxes()" disabled><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a href="FUNCTIONALITY_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
