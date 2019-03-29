<?php

class FUNCTIONALITY_ADD{

    private $actions;

    function __construct($actions) {
        $this->actions = $actions;
        $this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Add Functionality"]);?>
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new functionality"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form  method="POST" action="FUNCTIONALITY_Controller.php?action=<?= $strings['Add']?>">
							<div id="group-form">

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="nameFunction" name="nameFunction" placeholder="<?= $strings['What functionality is it?']?>" onkeyup="checkText(this.id)" required >
                                    <i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="descripFunction" name="descripFunction" placeholder="<?= $strings['What is the functionality about?']?>" onkeyup="checkText(this.id)" required>
                                    <i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>
                              
                                <?=$strings['Check the actions:']?>
                                    <?php foreach($this->actions as $action): ?>
                                        <div class="checkbox-primary">
                                            <input type="checkbox" name="action" id="<?=$action['idAction']?>" value="<?=$action['idAction']?>"/>
                                            <label for="<?=$action['idAction']?>"><?=$action['nameAction']?></label>
                                        </div>
                                    <?php endforeach; ?>
                                <input type="hidden" id="actions" name="actions">
								<button type="submit" name="submit" class="btn-dark" onclick="validateCheckboxes()"><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a href="FUNCTIONALITY_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
