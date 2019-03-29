<?php

class USER_EDIT{

    private $user;

    function __construct($user) {
			$this->user = $user;
			$this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Edit User"]); ?>

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
						<?=htmlentities($strings["Edit User"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form name="userForm" method="POST" action="USER_Controller.php?action=<?= $strings['Edit']?>&user=<?= $this->user['username']?>" enctype="multipart/form-data" onkeyup="validateEditUser()">
							<div id="group-form">

								<div id="profilePhoto-container">
									<?php if($this->user['photo']){ ?>
										<img id="profilePhoto" alt="<?= $strings['ProfilePhoto']?>" src="<?=$this->user['photo']?>" onclick="uploadProfilePhoto()"/>
									<?php } else { ?>
										<img id="profilePhoto" alt="<?= $strings['ProfilePhoto']?>" src="../img/notUser.jpg" onclick="uploadProfilePhoto()"/>
									<?php } ?>
									<input id="imageUpload" type="file" name="photo" accept="image/*" onchange="previewProfilePhoto(this)">
								</div>
								
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="username" name="username" placeholder="<?= $strings['What is the username of this user?']?>" value="<?=$this->user['username']?>" onkeyup="checkUser(this.id)" readonly>
									<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="password" id="password" name="password" placeholder="<?= $strings['Do you want to change the password?']?>" onkeyup="checkPassword(this.id)">
									<i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                  <div id="passwordAlert" class="alert alert-secondary passwordAlert" role="alert">
											<p id="length" class="invalid"><?=$strings['PasswordCharacters']?></p>
											<p id="lowercase" class="invalid"><?=$strings['PasswordLowercase']?></p>
											<p id="uppercase" class="invalid"><?=$strings['PasswordUppercase']?></p>
											<p id="number" class="invalid"><?=$strings['PasswordNumber']?></p>
									</div>
								</div>
								
								<div class="inputWithIcon inputIconBg">
									<input type="hidden" id="passwordConfirm" name="passwordConfirm" placeholder="<?= $strings['Repeat new password']?>" onkeyup="checkConfirmPassword(this.id)" required>
									<i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="name" name="name" placeholder="<?= $strings['What is the name of the user?']?>" value="<?=$this->user['name']?>" onkeyup="checkText(this.id)" required>
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="surname" name="surname" placeholder="<?= $strings["What are the user's surnames?"]?>" value="<?=$this->user['surname']?>" onkeyup="checkText(this.id)" required>
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
                </div>

                <div class="inputWithIcon inputIconBg">
									<input type="text" id="dni" name="dni" placeholder="<?= $strings['What is your ID?']?>" value="<?=$this->user['dni']?>" onkeyup="checkDNI(this.id)" required>
									<i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                </div>
								
                <div class="inputWithIcon inputIconBg">
									<?php if($_SESSION['LANGUAGE'] === 'English'): ?>
										<input type="text" id="date-eng" name="birthdate" class ="date" placeholder="<?= $strings['What is his birthdate?']?>" value="<?= date('d/m/Y', strtotime($this->user['birthdate']));?>"  onchange="checkDate(this)" required>
									<?php else: ?>
										<input type="text" id="date-es" name="birthdate" class ="date" placeholder="<?= $strings['What is his birthdate?']?>"  value="<?= date('d/m/Y', strtotime($this->user['birthdate']));?>"  onchange="checkDate(this)" required>
									<?php endif; ?>
									<i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
                </div>
                                
                <div class="inputWithIcon inputIconBg">
									<input type="text" id="email" name="email" placeholder="<?= $strings['What is his email?']?>" value="<?=$this->user['email']?>" onkeyup="checkEmail(this.id)" required>
									<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="phone" name="phone" placeholder="<?= $strings['What is his phone?']?>" value="<?=$this->user['phone']?>"onkeyup="checkNumPhone(this.id)" required>
									<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
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
