<?php

class GROUP_EDIT{

		private $groupValues;
		private $functions;
		private $actions;
		private $permissions;
		private $cont;
		private $contActions;
		private $isPermission;

    function __construct($groupValues, $functions, $actions, $permissions) {
				$this->values = $groupValues;
				$this->functions = $functions;
				$this->actions = $actions;
				$this->permissions = $permissions;
				$this->cont = 0;
				$this->contActions = 0;
				$this->isPermission = false;
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Edit Group"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-10 center-block">
					<div id="titleView">
          				<?=htmlentities($strings["Do you want to change something?"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form  method="POST" action="GROUP_Controller.php?action=Edit&group=<?=$this->values['sm_idGroup']?>" onkeyup="validateGroup(this)">
						<div id="group-form grpfrm">

							<div class="input-container group-dates">
								<span class="input-group-text group fa fa-users"></span>
								<input type="text" id="nameGroup" name="nameGroup" onkeyup="checkText(this)" value="<?=$this->values['sm_nameGroup']?>" required/>
								<label for="nameGroup" class="label-group"><?= $strings['What group is it?']?></label>
							</div>

							<div class="input-container group-dates">
								<span class="input-group-text group fa fa-reorder"></span>
								<input type="text" id="descripGroup" name="descripGroup" onkeyup="checkText(this)" value="<?=$this->values['sm_descripGroup']?>" required/>
								<label for="descripGroup" class="label-group" ><?= $strings['What is the group about?']?></label>
							</div>
                              
								<label class="control-label"><?=$strings['ModifyActionsFunction']?></label>
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
												<?php 
												$this->cont = 0;
												$this->contActions = 0;
												foreach($this->actions as $action):
													$this->isPermission = true;
														if($function['sm_idFunction'] === $action['sm_idFunction']):
															$this->contActions += 1;
															foreach($this->permissions as $permission): ?>
																<?php if($function['sm_idFunction'] === $permission['sm_idFunction'] && $action['sm_idAction'] === $permission['sm_idAction']): ?>
																<button id="buttonAction-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" style="display:block" type="button" class="btn btn-labeled btn-danger" onclick="actionManage(<?=$function['sm_idFunction']?>, <?=$action['sm_idAction']?>, this)">
																	<span class="btn-label"><i class="fa fa-close"></i></span> <?=$action['sm_nameAction']?>
																</button>
																	<?php $this->isPermission = false;
																	$this->cont += 1;
																endif; ?>	
															<?php endforeach;
																 
																if($this->isPermission): ?>
																	<button id="buttonAction-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" style="display:none" type="button" class="btn btn-labeled btn-danger" onclick="actionManage(<?=$function['sm_idFunction']?>, <?=$action['sm_idAction']?>, this)">
																		<span class="btn-label"><i class="fa fa-close"></i></span> <?=$action['sm_nameAction']?>
																	</button>
																<?php endif; ?>
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
																<?php if($this->cont == $this->contActions): ?>
																	<input id="toggleAll-<?= $function['sm_idFunction']?>" type="checkbox" onClick="selectAll(<?=$function['sm_idFunction']?>, this)" checked/>
																<?php else: ?>
																	<input id="toggleAll-<?= $function['sm_idFunction']?>" type="checkbox" onClick="selectAll(<?=$function['sm_idFunction']?>, this)"/>
																<?php endif; ?>
																<label for="toggleAll-<?= $function['sm_idFunction']?>" class="toggle"><?=$strings['selectAll']?></label>
															</div>
															<?php foreach($this->actions as $action):
																$this->isPermission = true; 
																if($function['sm_idFunction'] === $action['sm_idFunction']): 
																	foreach($this->permissions as $permission): ?>
																		<div class="checkboxList checkbox-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>">
																			<?php if($function['sm_idFunction'] === $permission['sm_idFunction'] && $action['sm_idAction'] === $permission['sm_idAction']): ?>
																				<input id="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" type="checkbox" name="actions[]" class="<?=$function['sm_idFunction']?>" value="<?=$function['sm_idFunction']?>,<?=$action['sm_idAction']?>"  onClick="inputManager(<?=$function['sm_idFunction']?>, <?=$action['sm_idAction']?>)" checked/>
																				<label for="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
																				<?php $this->isPermission = false;
																			endif; ?>
																		</div>
																	<?php endforeach; 
																	if($this->isPermission): ?>
																		<div class="checkboxList checkbox-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>">
																			<input id="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" type="checkbox" name="actions[]" class="<?=$function['sm_idFunction']?>" value="<?=$function['sm_idFunction']?>,<?=$action['sm_idAction']?>" onClick="inputManager(<?=$function['sm_idFunction']?>, <?=$action['sm_idAction']?>)"/>
																			<label for="<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>"><?=$action['sm_nameAction']?></label>
																		</div>
																	<?php endif; ?>
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
									<button id="saveButton" type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
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
