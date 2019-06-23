<?php

class GROUP_SHOW{

	private $groupValues;
	private $functions;
	private $actions;

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
				<div class="col-lg-10 center-block">
					<div id="titleView">
          				<?=htmlentities($strings["sm_nameGroup"])?> : <?=$this->values['sm_nameGroup']?>
					</div>
					<div class="col-lg-12 center-block-content">
					
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
														<button id="button-<?=$function['sm_idFunction']?>" type="button" class="btn btn-hover">
															<span class="txt"><?=$function['sm_nameFunction']?></span>
															<span class="round"><i class="fa fa-chevron-right"></i></span>
														</button>
													</div>
												</span>
												<?php foreach($this->actions as $action):
													if($function['sm_idFunction'] === $action['sm_idFunction']):
														foreach($this->permissions as $permission): ?>
															<?php if($function['sm_idFunction'] === $permission['sm_idFunction'] && $action['sm_idAction'] === $permission['sm_idAction']): ?>
                                                                    <button id="buttonAction-<?=$function['sm_idFunction']?><?=$action['sm_idAction']?>" style="display:block" type="button" class="btn btn-labeled btn-info">
                                                                        <?=$action['sm_nameAction']?>
                                                                    </button>
															<?php endif; 
														endforeach;		 
													endif;
												endforeach; ?>
											</div>	
										</li>
									</ul>
								<?php endforeach; ?>
							</div> 
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
