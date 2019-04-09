<?php

class GROUP_ADD{

	private $functions;
	private $actions;

    function __construct($functions, $actions) {
			$this->functions = $functions;
			$this->actions = $actions;
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
						<form method="POST" action="GROUP_Controller.php?action=<?= $strings['Add']?>">
							<div id="group-form">

								<div class="input-container">
										<span class="input-group-text fa fa-users"></span>
										<input type="text" id="nameGroup" name="nameGroup" onkeyup="checkText(this.id)" required/>
										<label for="nameGroup"><?= $strings['What group is it?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="descripGroup" name="descripFunction" onkeyup="checkText(this.id)" required/>
										<label for="descripGroup"><?= $strings['What is the group about?']?></label>
									</div>

								<?=$strings['Functionalities']?>:
								<?php foreach($this->functions as $function): ?>
									<button id="<?=$function['sm_idFunction']?>" type="button" class="btn btn-primary boxx" onclick="showActions(this.id)"><?=$function['sm_nameFunction']?></button>
									<div class="function id-<?=$function['sm_idFunction']?>">
										<?php foreach($this->actions as $action): ?>
											<div class="checkboxList checkbox-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>">
													<input id="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" type="checkbox" name="action" value="<?=$function['sm_idFunction']?>,<?=$action['sm_idAction']?>"/>
													<label for="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
								<input type="hidden" id="permissions" name="permissions">
								<button type="submit" name="submit" class="btn-dark" onclick="validatePermissions()"><?= $strings["Save"]?></button>
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
