<?php

class BUILDING_ADD{

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
        $buffer=str_replace("%TITLE%",$strings['Add Building'],$buffer);
		echo $buffer;
		

		?> <script src="../js/validates.js"></script><?php
		////////////////////////////////////////////////////
		
        ?>
		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Datas of the new building"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="BUILDING_Controller.php?action=<?= $strings['Add']?>" onblur="addBuilding();">
							<div id="group-form">
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="idBuilding" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" onblur="checkBuildingId(this.id)">
									<i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
								</div>


								<div class="inputWithIcon inputIconBg">
									<input type="text" id="nameBuilding" name="nameBuilding" placeholder="<?= $strings['What building is it?']?>" onblur="checkText(this.id)">
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="addressBuilding" name="addressBuilding" placeholder="<?= $strings['What is your postal address?']?>" onblur="checkText(this.id)">
									<i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="phoneBuilding" name="phoneBuilding" placeholder="<?= $strings['What is your phone?']?>" onblur="checkNumPhone(this.id)">
									<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="responsibleBuilding" name="responsibleBuilding" placeholder="<?= $strings['Who is the responsible?']?>" onblur="checkText(this.id)">
									<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
								</div>
							</div>

							<div id="group-form">
								<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>

							<!-- <div id="error" name="error" class="alert alert-danger alert-dismissable" style="display:none">
								<strong>¡Error!</strong> Revisa los campos del formulario.  
							</div> -->
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
