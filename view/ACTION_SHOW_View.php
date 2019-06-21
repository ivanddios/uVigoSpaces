<?php

class ACTION_SHOW{

  private $action;

  function __construct($action) {
      $this->action = $action;
      $this->render();
  }
    
  function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Show Action"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
                        <?=htmlentities($strings["Action :"] . $this->action['sm_nameAction'])?>
					</div>
					<div class="col-lg-12 center-block-content">
							<div id="group-form">

                                <div class="input-container">
									<span class="input-group-text fa fa-lock"></span>
									<input type="text" id="idAction" name="idAction" value="<?=$this->action['sm_idAction']?>" readonly/>
									<label for="idAction"><?= $strings['idAction']?></label>
                                </div>
                                
								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="nameAction" name="nameAction" value="<?=$this->action['sm_nameAction']?>" readonly/>
									<label for="nameAction"><?= $strings['nameAction']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="descripAction" name="descripAction" value="<?=$this->action['sm_descripAction']?>" readonly/>
									<label for="descripAction"><?= $strings['descripAction']?></label>
								</div>

							</div> 
						<a class="a-back showEntity" href="ACTION_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 		<?php
    	include 'footer.php';  
  } 
}

?>