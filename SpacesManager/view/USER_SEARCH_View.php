<?php

class USER_SEARCH{

	private $groups;

    function __construct($groups) {
			$this->groups = $groups;
			$this->render();
    }
    
    function render() {
			include 'header.php';
			$this->view->setElement("%TITLE%", $strings["Add User"]);?>

			<script src="http://momentjs.com/downloads/moment-with-locales.min.js"></script>
			<script src="../view/js/bootstrap-material-datetimepicker.js"></script>
			<script src="../view/js/calendar.js"></script>

			<link rel="stylesheet" href="../view/css/bootstrap-material-datetimepicker.css"/>
			<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Search user/s"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="USER_Controller.php?action=Search" enctype="multipart/form-data">
							<div id="group-form">

								<div class="input-container">
									<span class="input-group-text fa fa-envelope"></span>
									<input type="text" id="email" name="email"/>
									<label for="email"><?= $strings['What is his email?']?></label>
								</div>


								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="name" name="name"/>
									<label for="name"><?= $strings['What is the name of the user?']?></label>
								</div>


								<div class="input-container">
									<span class="input-group-text fa fa-reorder"></span>
									<input type="text" id="surname" name="surname" />
									<label for="surname"><?= $strings["What are the user's surnames?"]?></label>
								</div>

								<div class="input-container">
									<span class="input-group-text fa fa-id-card"></span>
									<input type="text" id="dni" name="dni"/>
									<label for="dni"><?= $strings['What is its ID?']?></label>
								</div>
								
								<div class="input-container">
									<span class="input-group-text fa fa-calendar"></span>
									<?php if($_SESSION['LANGUAGE'] === 'English'): ?>
										<input type="text" id="date-eng" name="birthdate" class ="date">
										<label for="date-eng"><?= $strings['What is his birthdate?']?></label>
									<?php else: ?>
										<input type="text" id="date-es" name="birthdate" class ="date">
										<label for="date-es"><?= $strings['What is his birthdate?']?></label>
									<?php endif; ?>
								</div>
														
								<div class="input-container preSelect">
									<span class="input-group-text fa fa-phone"></span>
									<input type="text" id="phone" name="phone"/>
									<label for="phone"><?= $strings['What is his phone?']?></label>
								</div>

								<label class="labelSelect"><?= $strings['What is his group?']?></label>
								<div class="input-container">
									<select class="custom-select" name="group" required>
										<option value="0" selected><?=$strings['Choose']?></option>
										<?php foreach($this->groups as $group): ?>
											<option value="<?=$group['sm_idGroup']?>"><?=$group['sm_nameGroup'] ." - ". $group['sm_descripGroup']?></option>
										<?php endforeach; ?>
									</select>
									<i class="input-group-text fa fa-tag" aria-hidden="true"></i>
								</div>
				
								<button id="saveButton" type="submit" name="submit" class="btn-dark"><?= $strings["Search"]?></button>
							</div> 
						</form>
						<a class="a-back" href="../controller/USER_Controller.php"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 		<?php  include 'footer.php';  
  } 
}

?>
