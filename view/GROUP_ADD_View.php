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
				<div class="col-lg-10 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new group"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="GROUP_Controller.php?action=Add" onkeyup="validateGroup(this)">
							<div id="group-form grpfrm">

								<div class="input-container group-dates">
									<span class="input-group-text group fa fa-users"></span>
									<input type="text" id="nameGroup" name="nameGroup" onkeyup="checkText(this)" required/>
									<label for="nameGroup" class="label-group"><?= $strings['What group is it?']?></label>
								</div>

								<div class="input-container group-dates">
									<span class="input-group-text group fa fa-reorder"></span>
									<input type="text" id="descripGroup" name="descripGroup" onkeyup="checkText(this)" required/>
									<label for="descripGroup" class="label-group" ><?= $strings['What is the group about?']?></label>
								</div>

								<label class="control-label"><?=$strings['SelectActionsFunction']?></label>
								<?php foreach($this->functions as $function): ?>
									<ul class="orderBlock">
										<li>
											<div class="input-group">
												<span class="input-group-btn">
													<div class="button-funct">
														<button id="button-<?=$function['sm_idFunction']?>" type="button" class="btn btn-hover" data-toggle="modal" data-target="#<?= str_replace(' ','',$function['sm_nameFunction'].$function['sm_idFunction'])?>">
															<span class="txt"><?=$function['sm_nameFunction']?></span>
															<span class="round"><i class="fa fa-chevron-right"></i></span>
														</button>
													</div>
												</span>
												<?php foreach($this->actions as $action): 
													if($function['sm_idFunction'] === $action['sm_idFunction']): ?>
														<button id="buttonAction-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" style="display:none" type="button" class="btn btn-labeled btn-danger" onclick="actionManage(<?=$function['sm_idFunction']?>, <?=$action['sm_idAction']?>, this)">
															<span class="btn-label"><i class="fa fa-close"></i></span> <?=$action['sm_nameAction']?>
														</button>
													<?php endif;
												endforeach; ?>
											</div>	
										</li>

										<div id="<?= str_replace(' ','',$function['sm_nameFunction'].$function['sm_idFunction'])?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title"><?=$strings['Function']?> > <?=$function['sm_nameFunction']?></h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="function id-<?=$function['sm_idFunction']?>">
															<div class="checkboxList">
																<input id="toggleAll-<?= $function['sm_idFunction']?>" type="checkbox" onClick="selectAll(<?=$function['sm_idFunction']?>, this)"/>
																<label for="toggleAll-<?= $function['sm_idFunction']?>" class="toggle"><?=$strings['selectAll']?></label>
															</div>
															<?php foreach($this->actions as $action): 
																if($function['sm_idFunction'] === $action['sm_idFunction']): ?>
																	<div class="checkboxList checkbox-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>">
																		<input id="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" class="<?=$function['sm_idFunction']?>" type="checkbox" name="actions[]" value="<?=$function['sm_idFunction']?>,<?=$action['sm_idAction']?>" onClick="inputManager(<?=$function['sm_idFunction']?>, <?=$action['sm_idAction']?>)"/>
																		<label for="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" id="label-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
																	</div>
																<?php endif;
															endforeach; ?>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-light" data-dismiss="modal"><?=$strings['Close']?></button>
													</div>
												</div>
											</div>
										</div>
									</ul>
								<?php endforeach; ?>
								<div class="col-lg-4 center-block-content">
									<button id="saveButton" type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
								</div>
							</div> 
						</form>
						<a class="a-back-group" href="GROUP_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
