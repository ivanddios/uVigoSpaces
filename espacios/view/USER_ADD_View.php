<?php

class USER_ADD{

    function __construct() {
        $this->render();
    }
    
    function render() {
		include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
		

        ////////////////////////////////////////////////////
        ob_start();
        include 'header.php';
        $buffer = ob_get_contents();
        ob_end_clean();
        $buffer=str_replace("%TITLE%",$strings['Add User'],$buffer);
		echo $buffer;
		

		?> <script src="../js/validates.js"></script><?php
		////////////////////////////////////////////////////
		
        ?>
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["New user"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="USER_Controller.php?action=<?= $strings['Add']?>">
							<div id="group-form">
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="username" name="username" placeholder="<?= $strings['What is the username of this user?']?>" onblur="checkText(this.id)">
									<i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="name" name="name" placeholder="<?= $strings['What is the name of the user?']?>" onblur="checkText(this.id)">
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="surname" name="surname" placeholder="<?= $strings["What are the user's surnames?"]?>" onblur="checkText(this.id)">
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon inputIconBg">
									<input type="text" id="dni" name="dni" placeholder="<?= $strings['What is your ID?']?>" onblur="checkDNI(this.id)">
									<i class="fa fa-id-card fa-lg fa-fw" aria-hidden="true"></i>
                                </div>

                                <div class="inputWithIcon inputIconBg">
									<input type="text" id="birthdate" name="birthdate" placeholder="<?= $strings['What is his birthdate?']?>" onblur="checkDate(this.id)">
									<i class="fa fa-calendar fa-lg fa-fw" aria-hidden="true"></i>
                                </div>
                                
                                <div class="inputWithIcon inputIconBg">
									<input type="text" id="email" name="email" placeholder="<?= $strings['What is his email?']?>" onblur="checkEmail(this.id)">
									<i class="fa fa-envelope fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="phone" name="phone" placeholder="<?= $strings['What is his phone?']?>" onblur="checkNumPhone(this.id)">
									<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
                                </div>
                                
                                <div class="inputWithIcon inputIconBg">
									<input type="file" id="photo" name="photo" accept="image/*" onchange="validateUpdloadFile(this.id)">
                                </div>
                                
								<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
							</div> 
						</form>
						<a href="../index.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
