<?php

class USER_EDIT_PROFILE{

	private $user;
	private $groups;

    function __construct($user, $groups) {
			$this->user = $user;
			$this->groups = $groups;
			$this->render();
    }
    
    function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Edit User"]); ?>

		<script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
		<script src="../view/js/bootstrap-material-datetimepicker.js"></script>
		<script src="../view/js/calendar.js"></script>

		<link rel="stylesheet" href="../view/css/bootstrap-material-datetimepicker.css"/>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Do you want to change something?"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="USER_Controller.php?action=EditProfile&user=<?= $this->user['email']?>" enctype="multipart/form-data" onkeyup="validateEditUser(this)">
							<div id="group-form">

								<div id="profilePhoto-container">
									<?php if(is_file($this->user['photo'])): ?>
										<img id="profilePhoto" alt="<?= $strings['ProfilePhoto']?>" src="<?=$this->user['photo']?>" onclick="uploadProfilePhoto()"/>
									<?php else: ?>
										<img id="profilePhoto" alt="<?= $strings['ProfilePhoto']?>" src="../view/img/notUser.jpg" onclick="uploadProfilePhoto()"/>
									<?php endif; ?>
									<input id="imageUpload" type="file" name="photo" accept="image/*" onchange="previewProfilePhoto(this)">
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-envelope"></span>
									<input type="text" id="email" name="email" value="<?=$this->user['email']?>" onkeyup="checkEmail(this)" readonly/>
									<label for="email"><?= $strings['What is his email?']?></label>
								</div>
								
								<div class="input-container">
									<span class="input-group-text fa fa-lock"></span>
									<input type="password" id="password" name="password" onkeyup="checkPassword(this)" optional/>
									<label for="password"><?= $strings['Do you want to change the password?']?></label>
								</div>

								<div id="passwordAlert" class="alert alert-secondary passwordAlert" role="alert">
											<p id="length" class="invalid"><?=$strings['PasswordCharacters']?></p>
											<p id="lowercase" class="invalid"><?=$strings['PasswordLowercase']?></p>
											<p id="uppercase" class="invalid"><?=$strings['PasswordUppercase']?></p>
											<p id="number" class="invalid"><?=$strings['PasswordNumber']?></p>
									</div>

								<div id="divChangePasswd" class="input-container">
									<span class="input-group-text fa fa-lock"></span>
									<input type="password" id="passwordConfirm" name="passwordConfirm" onkeyup="checkConfirmPassword(this)"/>
									<label for="passwordConfirm"><?= $strings['Repeat new password']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="name" name="name" value="<?=$this->user['name']?>" onkeyup="checkText(this)" required/>
									<label for="name"><?= $strings['What is the name of the user?']?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="surname" name="surname" value="<?=$this->user['surname']?>" onkeyup="checkText(this)" required/>
									<label for="surname"><?= $strings["What are the user's surnames?"]?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-id-card"></span>
									<input type="text" id="dni" name="dni" value="<?=$this->user['dni']?>" onkeyup="checkDNI(this)" required/>
									<label for="dni"><?= $strings['What is its ID?']?></label>
								</div>
								
								<div class="input-container">
									<span class="input-group-text fa fa-calendar"></span>
									<?php if($_SESSION['LANGUAGE'] === 'English'): ?>
										<input type="text" id="date-eng" name="birthdate" class ="date" value="<?= date('d/m/Y', strtotime($this->user['birthdate']));?>"  onchange="checkDate(this)" required>
										<label for="date-eng"><?= $strings['What is his birthdate?']?></label>
									<?php else: ?>
										<input type="text" id="date-es" name="birthdate" class ="date" value="<?= date('d/m/Y', strtotime($this->user['birthdate']));?>"  onchange="checkDate(this)" required>
										<label for="date-es"><?= $strings['What is his birthdate?']?></label>
									<?php endif; ?>
								</div>
													
								<div class="input-container preSelect">
									<span class="input-group-text fa fa-phone"></span>
									<input type="text" id="phone" name="phone" value="<?=$this->user['phone']?>" onkeyup="checkNumPhone(this)" required/>
									<label for="phone"><?= $strings['What is his phone?']?></label>
								</div>

								<button id="savetButton" type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a class="a-back" href="<?=$_SERVER["HTTP_REFERER"]?>"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
