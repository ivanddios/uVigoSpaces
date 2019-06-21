<?php

class FUNCTIONALITY_EDIT{

    private $values;
    private $actions;
    private $actionsForFunction;

    function __construct($valuesFunctionality, $actions, $actionsForFunction) {
        $this->values = $valuesFunctionality;
        $this->actions = $actions;
        $this->actionsForFunction = $actionsForFunction;
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Edit Functionality"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
                     <?=htmlentities($strings["Do you want to change something?"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form  method="POST" action="FUNCTIONALITY_Controller.php?action=Edit&function=<?=$this->values['sm_idFunction']?>" onkeyup="validateFunction(this)">
							<div id="group-form">

                                <div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="nameFunction" name="nameFunction" value="<?=$this->values['sm_nameFunction']?>" onkeyup="checkText(this)" required/>
									<label for="nameFunction"><?= $strings['What functionality is it?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="descripFunction" name="descripFunction" value="<?=$this->values['sm_descripFunction']?>" onkeyup="checkText(this)" required/>
									<label for="descripFunction"><?= $strings['What is the functionality about?']?></label>
								</div>
                              
                                <label class="control-label"><?=$strings['Check the actions:']?></label>
                                    <?php foreach($this->actions as $action): ?>
                                        <div class="checkboxList">
                                            <?php if (in_array($action['sm_idAction'], $this->actionsForFunction)): ?>
                                                <input type="checkbox" name="actions[]" id="<?=$action['sm_idAction']?>" value="<?=$action['sm_idAction']?>" checked/>
                                            <?php else : ?>
                                                <input type="checkbox" name="actions[]" id="<?=$action['sm_idAction']?>" value="<?=$action['sm_idAction']?>"/>
                                            <?php endif; ?>
                                                <label for="<?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
                                        </div>
                                    <?php endforeach; ?>
								<button id="saveButton" type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a class="a-back" href="FUNCTIONALITY_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>