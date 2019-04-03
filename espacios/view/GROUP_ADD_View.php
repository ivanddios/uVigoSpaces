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
						<form  method="POST" action="GROUP_Controller.php?action=<?= $strings['Add']?>">
							<div id="group-form">

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="nameGroup" name="nameGroup" placeholder="<?= $strings['What group is it?']?>" onkeyup="checkText(this.id)" required >
                  <i class="fa fa-users fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="descripGroup" name="descripGroup" placeholder="<?= $strings['What is the group about?']?>" onkeyup="checkText(this.id)" required>
                  <i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>


								<?=$strings['Functionalities']?>:
							
								<?php foreach($this->functions as $function): ?>
									<button id="<?=$function['idFunction']?>" type="button" class="btn btn-primary boxx" onclick="showActions(this.id)"><?=$function['nameFunction']?></button>
									<div class="function id-<?=$function['idFunction']?>">
										<?php foreach($this->actions as $action): ?>
											<div class="checkbox-<?=$function['idFunction']?><?=$action['idAction']?>">
													<input id="<?=$function['idFunction']?><?=$action['idAction']?>" type="checkbox" name="action" value="<?=$function['idFunction']?>,<?=$action['idAction']?>"/>
													<label for="<?=$function['idFunction']?><?=$action['idAction']?>"><?=$action['nameAction']?></label>
											</div>
										<?php endforeach; ?>
									</div>
								<?php endforeach; ?>
								<input type="hidden" id="permissions" name="permissions">
								<button type="submit" name="submit" class="btn-dark" ><?= $strings["Save"]?></button>
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
