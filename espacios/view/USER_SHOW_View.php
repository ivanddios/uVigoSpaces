<?php

class USER_SHOW{

    private $user;

    function __construct($user) {
			$this->user = $user;
			$this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Show User"]); ?>

			<div class="container">
				<div class="row center-row">
					<div class="col-lg-6 center-block">
						<div id="titleView">
							<?=htmlentities($strings["sm_username"])?>: <?= $this->user['sm_username']?>
						</div>
						<div class="col-lg-12 center-block-content">
								<div id="group-form">
									
									<div id="profilePhoto-container">
										<?php if($this->user['sm_photo']): ?>
											<img id="profilePhoto" alt="<?= $strings['ProfilePhoto']?>" src="<?=$this->user['sm_photo']?>"/>
										<?php else: ?>
											<img id="profilePhoto" alt="<?= $strings['ProfilePhoto']?>" src="../img/notUser.jpg"/>
										<?php endif; ?>
									</div>
									
									<div class="input-container">
										<span class="input-group-text fa fa-user"></span>
										<input type="text" id="username" value="<?= $this->user['sm_username']?>" readonly/>
										<label for="username"><?= $strings['What is the username of this user?']?></label>
									</div>
									
									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="name" value="<?=$this->user['sm_name']?>" readonly/>
										<label for="name"><?= $strings['What is the name of the user?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="surname" value="<?=$this->user['sm_surname']?>" readonly/>
										<label for="surname"><?= $strings["What are the user's surnames?"]?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-id-card"></span>
										<input type="text" id="dni" value="<?=$this->user['sm_dni']?>" readonly/>
										<label for="dni"><?= $strings['What is your ID?']?></label>
									</div>
									
									<div class="input-container">
										<span class="input-group-text fa fa-calendar"></span>
											<input type="text" id="date" value="<?= date('d/m/Y', strtotime($this->user['sm_birthdate']));?>"  readonly>
											<label for="date"><?= $strings['What is his birthdate?']?></label>
									</div>
															
									<div class="input-container">
										<span class="input-group-text fa fa-envelope"></span>
										<input type="text" id="email" value="<?=$this->user['sm_email']?>" readonly/>
										<label for="email"><?= $strings['What is his email?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-phone"></span>
										<input type="text" id="phone" value="<?=$this->user['sm_phone']?>" readonly/>
										<label for="phone"><?= $strings['What is his phone?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-tag"></span>
										<input type="text" id="group" value="<?=$this->user['sm_nameGroup'] ." - ". $this->user['sm_descripGroup']?>" readonly/>
										<label for="group"><?= $strings['What is his group?']?></label>
									</div>

								</div> 
							<a href="../controller/USER_Controller.php"><?= $strings["Back"] ?></a>
						</div>
					</div>
				</div>
			</div>
 <?php
    include 'footer.php';  
  } 
}

?>
