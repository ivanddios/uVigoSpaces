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
										<input type="text" id="username" name="username" value="<?= $this->user['sm_username']?>" readonly/>
										<label for="username"><?= $strings['What is the username of this user?']?></label>
									</div>
									
									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="name" name="name" value="<?=$this->user['sm_name']?>" readonly/>
										<label for="name"><?= $strings['What is the name of the user?']?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-reorder"></span>
										<input type="text" id="surname" name="surname" value="<?=$this->user['sm_surname']?>" readonly/>
										<label for="surname"><?= $strings["What are the user's surnames?"]?></label>
									</div>

									<div class="input-container">
										<span class="input-group-text fa fa-id-card"></span>
										<input type="text" id="dni" name="dni" value="<?=$this->user['sm_dni']?>" readonly/>
										<label for="dni"><?= $strings['What is your ID?']?></label>
									</div>
									
									<div class="input-container">
										<span class="input-group-text fa fa-calendar"></span>
										<?php if($_SESSION['LANGUAGE'] === 'English'): ?>
											<input type="text" id="date-eng" name="birthdate" class ="date" value="<?= date('d/m/Y', strtotime($this->user['sm_birthdate']));?>"  readonly>
											<label for="date-eng"><?= $strings['What is his birthdate?']?></label>
										<?php else: ?>
											<input type="text" id="date-es" name="birthdate" class ="date" value="<?= date('d/m/Y', strtotime($this->user['sm_birthdate']));?>"  readonly>
											<label for="date-es"><?= $strings['What is his birthdate?']?></label>
										<?php endif; ?>
									</div>
															
									<div class="input-container">
										<span class="input-group-text fa fa-envelope"></span>
										<input type="text" id="email" name="email" value="<?=$this->user['sm_email']?>" readonly/>
										<label for="email"><?= $strings['What is his email?']?></label>
									</div>

									<div class="input-container preSelect">
										<span class="input-group-text fa fa-phone"></span>
										<input type="text" id="phone" name="phone" value="<?=$this->user['sm_phone']?>" readonly/>
										<label for="phone"><?= $strings['What is his phone?']?></label>
									</div>

									<label class="labelSelect"><?= $strings['What is his group?']?></label>
									<div class="input-container">
										<select class="custom-select" name="group" readonly>
												<option selected><?=$this->user['sm_nameGroup'] ." - ". $this->user['sm_descripGroup']?></option>
										</select>
										<i class="input-group-text fa fa-tag" aria-hidden="true"></i>
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
