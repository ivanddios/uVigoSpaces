<?php

class GROUP_EDIT{

		private $groupValues;
		private $functions;
		private $actions;
		private $permissions;

    function __construct($groupValues, $functions, $actions, $permissions) {
				$this->values = $groupValues;
				$this->functions = $functions;
				$this->actions = $actions;
				$this->permissions = $permissions;
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Edit Group"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
          	<?=htmlentities($strings["Do you want to change something?"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form  method="POST" action="GROUP_Controller.php?action=<?= $strings['Edit']?>&group=<?=$this->values['sm_idGroup']?>" onkeyup="validateGroup(this)">
							<div id="group-form">

								<div class="input-container">
									<span class="input-group-text fa fa-users"></span>
									<input type="text" id="nameGroup" name="nameGroup" value="<?=$this->values['sm_nameGroup']?>" onkeyup="checkText(this)" required/>
									<label for="nameGroup"><?= $strings['What group is it?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="descripGroup" name="descripGroup" value="<?=$this->values['sm_descripGroup']?>" onkeyup="checkText(this)" required/>
									<label for="descripGroup"><?= $strings['What is the group about?']?></label>
								</div>
                              
								<label class="control-label"><?=$strings['Functionalities']?></label>
								<?php foreach($this->functions as $function): ?>
									<button id="<?=$function['sm_idFunction']?>" type="button" class="btn btn-primary orderBlock" onclick="showActions(this.id)"><?=$function['sm_nameFunction']?></button>
									<div class="function id-<?=$function['sm_idFunction']?>">
										<?php foreach($this->actions as $action):
											$band = true; 
											if($function['sm_idFunction'] === $action['sm_idFunction']): 
												foreach($this->permissions as $permission): ?>
													<div class="checkboxList checkbox-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>">
														<?php if($function['sm_idFunction'] === $permission['sm_idFunction'] && $action['sm_idAction'] === $permission['sm_idAction']): ?>
															<input id="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" type="checkbox" name="action" value="<?=$function['sm_idFunction']?>,<?=$action['sm_idAction']?>" checked/>
															<label for="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
															<?php $band = false;
														endif; ?>
													</div>
												<?php endforeach; 
												if($band): ?>
												<div class="checkboxList checkbox-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>">
													<input id="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" type="checkbox" name="action" value="<?=$function['sm_idFunction']?>,<?=$action['sm_idAction']?>"/>
													<label for="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
												</div>
												<?php endif; ?>
											<?php endif;
										endforeach; ?>
									</div>
								<?php endforeach; ?>
								<input type="hidden" id="permissions" name="permissions">
								<button id="saveButton" type="submit" name="submit" class="btn-dark" onclick="validatePermissions()"><?= $strings["Save"]?></button>
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