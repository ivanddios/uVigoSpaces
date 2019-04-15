<?php

class USER_ADD{

	private $groups;

    function __construct($groups) {
			$this->groups = $groups;
			$this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Add User"]);
			$this->user = json_decode($this->view->getVariable("userForm"), true); ?>

			<script src="https://code.jquery.com/jquery-1.12.3.min.js" integrity="sha256-aaODHAgvwQW1bFOGXMeX+pC4PZIPsvn2h1sArYOhgXQ=" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/ripples.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/js/material.min.js"></script>
			<script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
			<script src="../js/bootstrap-material-datetimepicker.js"></script>
			<script src="../js/calendar.js"></script>

			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-material-design/0.5.10/css/ripples.min.css"/>
			<link rel="stylesheet" href="../css/bootstrap-material-datetimepicker.css"/>
			<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["New user"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form name="userForm" method="POST" action="USER_Controller.php?action=<?= $strings['Add']?>" enctype="multipart/form-data">
							<div id="group-form">

								<div id="profilePhoto-container" class="profilePhoto-frame">
									<img id="profilePhoto" alt="<?= $strings['ProfilePhoto']?>" src="../img/camera.png" onclick="uploadProfilePhoto()"/>
									<input id="imageUpload" type="file" name="photo" accept="image/*" onchange="previewProfilePhoto(this)">
								</div> 

								<div class="input-container">
									<span class="input-group-text fa fa-user"></span>
									<input type="text" id="username" name="username" onkeyup="checkUser(this.id)" required/>
									<label for="username"><?= $strings['What is the username of this user?']?></label>
								</div>
								
								<div class="input-container passHelp">
									<span class="input-group-text fa fa-lock"></span>
									<input type="password" id="password" name="password" onkeyup="checkPassword(this.id)" required/>
									<label for="password"><?= $strings['What is the password of this user?']?></label>
								</div>

								<div id="passwordAlert" class="alert alert-secondary passwordAlert" role="alert">
											<p id="length" class="invalid"><?=$strings['PasswordCharacters']?></p>
											<p id="lowercase" class="invalid"><?=$strings['PasswordLowercase']?></p>
											<p id="uppercase" class="invalid"><?=$strings['PasswordUppercase']?></p>
											<p id="number" class="invalid"><?=$strings['PasswordNumber']?></p>
									</div>

								<div class="input-container">
									<span class="input-group-text fa fa-lock"></span>
									<input type="password" id="passwordConfirm" name="passwordConfirm" onkeyup="checkConfirmPassword(this.id)" required/>
									<label for="passwordConfirm"><?= $strings['Repeat password']?></label>
								</div>
						

								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="name" name="name" onkeyup="checkText(this.id)" required/>
									<label for="name"><?= $strings['What is the name of the user?']?></label>
								</div>


								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="surname" name="surname" onkeyup="checkText(this.id)" required/>
									<label for="surname"><?= $strings["What are the user's surnames?"]?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-id-card"></span>
									<input type="text" id="dni" name="dni" onkeyup="checkText(this.id)" required/>
									<label for="dni"><?= $strings['What is your ID?']?></label>
								</div>
								
								<div class="input-container">
									<span class="input-group-text fa fa-calendar"></span>
									<?php if($_SESSION['LANGUAGE'] === 'English'): ?>
										<input type="text" id="date-eng" name="birthdate" class ="date" onchange="checkDate(this)" required>
										<label for="date-eng"><?= $strings['What is his birthdate?']?></label>
									<?php else: ?>
										<input type="text" id="date-es" name="birthdate" class ="date" onchange="checkDate(this)" required>
										<label for="date-es"><?= $strings['What is his birthdate?']?></label>
									<?php endif; ?>
								</div>
														
								<div class="input-container">
									<span class="input-group-text fa fa-envelope"></span>
									<input type="text" id="email" name="email" onkeyup="checkEmail(this.id)" required/>
									<label for="email"><?= $strings['What is his email?']?></label>
								</div>

								<div class="input-container preSelect">
									<span class="input-group-text fa fa-phone"></span>
									<input type="text" id="phone" name="phone" onkeyup="checkNumPhone(this.id)" required/>
									<label for="phone"><?= $strings['What is his phone?']?></label>
								</div>

								<label class="labelSelect"><?= $strings['What is his group?']?></label>
								<div class="input-container">
									<select class="custom-select" name="group" required>
										<option selected disabled><?=$strings['Choose']?></option>
										<?php foreach($this->groups as $group): ?>
											<option value="<?=$group['sm_idGroup']?>"><?=$group['sm_nameGroup'] ." - ". $group['sm_descripGroup']?></option>
										<?php endforeach; ?>
									</select>
									<i class="input-group-text fa fa-tag" aria-hidden="true"></i>
								</div>
				
								<button id="submitButton" type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
							</div> 
						</form>
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
