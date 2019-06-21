<?php

class FUNCTIONALITY_SHOW{

    private $function;
    private $actions;
    private $actionsForFunction;

    function __construct($valuesFunctionality, $actions, $actionsForFunction) {
        $this->function = $valuesFunctionality;
        $this->actions = $actions;
        $this->actionsForFunction = $actionsForFunction;
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Show Functionality"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
                        <?=htmlentities($strings["Function: "] . $this->function['sm_nameFunction'])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<div id="group-form">
                            <div class="input-container">
								<span class="input-group-text fa fa-lock"></span>
								<input type="text" id="idFunction" name="idFunction" value="<?=$this->function['sm_idFunction']?>" readonly/>
								<label for="idFunction"><?= $strings['idFunction']?></label>
							</div>

                            <div class="input-container">
								<span class="input-group-text fa fa-reorder"></span>
								<input type="text" id="nameFunction" name="nameFunction" value="<?=$this->function['sm_nameFunction']?>" readonly/>
								<label for="nameFunction"><?= $strings['nameFunction']?></label>
							</div>

							<div class="input-container">
								<span class="input-group-text fa fa-reorder"></span>
								<input type="text" id="descripFunction" name="descripFunction" value="<?=$this->function['sm_descripFunction']?>" readonly/>
								<label for="descripFunction"><?= $strings['descripFunction']?></label>
							</div>
      
                            
                            <label class="control-label"><?= $strings['Actions associated with functionality:']?></label>
                            <?php foreach($this->actions as $action): ?>
                                <div class="checkboxList">
                                    <?php if (in_array($action['sm_idAction'], $this->actionsForFunction)): ?>
                                        <input type="checkbox" name="action" id="<?=$action['sm_idAction']?>" value="<?=$action['sm_idAction']?>" onclick="return false;" checked/>
                                    <?php else : ?>
                                        <input type="checkbox" name="action" id="<?=$action['sm_idAction']?>" value="<?=$action['sm_idAction']?>" onclick="return false;"/>
                                    <?php endif; ?>
                                        <label for="<?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
                                </div>
                            <?php endforeach; ?>
						</div> 
						<a class="a-back showEntity" href="FUNCTIONALITY_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>