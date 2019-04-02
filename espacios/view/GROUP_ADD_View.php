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

								<?php foreach($this->functions as $function): ?>
									
									<button id="<?=$function['idFunction']?>" type="button" class="btn btn-primary boxx" onclick="showActions(this.id)"><?=$function['nameFunction']?></button>
									<?=$strings['Check the actions:']?>
										<?php foreach($this->actions as $action): ?>
										<div id="checkboxActions" class="checkbox-<?=$function['idFunction']?>">
												<input type="checkbox" name="action" id="<?=$action['idAction']?>" value="<?=$action['idAction']?>"/>
												<label for="<?=$action['idAction']?>"><?=$action['nameAction']?></label>
											</div>
										<?php endforeach; ?>
									



									<?php endforeach; ?>






									<input type="hidden" id="actions" name="actions">

                              
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
