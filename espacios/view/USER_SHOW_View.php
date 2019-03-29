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
						<?=htmlentities($strings["Edit User"])?>
					</div>
					<div class="col-lg-12 center-block-content">
							<div id="group-form">
								<div id="profilePhoto-container">
									<?php if($this->user['photo']){ ?>
										<img id="photo" alt="<?= $strings['ProfilePhoto']?>" src="<?=$this->user['photo']?>"/>
									<?php } else { ?>
										<img id="photo" alt="<?= $strings['ProfilePhoto']?>" src="../img/notUser.jpg"/>
									<?php } ?>
								</div>
								
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="username" name="username" placeholder="<?= $strings['What is the username of this user?']?>" value="<?=$this->user['username']?>" readonly>
									<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
								</div>
								
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="name" name="name" placeholder="<?= $strings['What is the name of the user?']?>" value="<?=$this->user['name']?>" readonly>
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="surname" name="surname" placeholder="<?= $strings["What are the user's surnames?"]?>" value="<?=$this->user['surname']?>"  readonly>
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon inputIconBg">
									<input type="text" id="dni" name="dni" placeholder="<?= $strings['What is your ID?']?>" value="<?=$this->user['dni']?>" onkeyup="checkDNI(this.id)" readonly>
									<i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                                </div>
								
                                <div class="inputWithIcon inputIconBg">
									<input type="text" id="birthdate" name="birthdate" class ="date" placeholder="<?= $strings['What is his birthdate?']?>" value="<?= date('d/m/Y', strtotime($this->user['birthdate']));?>" readonly>
									<i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
                                </div>
                                
                                <div class="inputWithIcon inputIconBg">
									<input type="text" id="email" name="email" placeholder="<?= $strings['What is his email?']?>" value="<?=$this->user['email']?>" onkeyup="checkEmail(this.id)" readonly>
									<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="phone" name="phone" placeholder="<?= $strings['What is his phone?']?>" value="<?=$this->user['phone']?>"onkeyup="checkNumPhone(this.id)" readonly>
									<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
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
