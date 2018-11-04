<?php

class BUILDING_EDIT{
    private $building;

    function __construct($building) {
        $this->building = $building;
        $this->render();
    }
    
    function render() {
		include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
		
        ////////////////////////////////////////////////////
		ob_start();
		include 'header.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace("%TITLE%",$strings['Edit Building'],$buffer);
		echo $buffer;
		?> <script src="../js/validates.js"></script><?php
		////////////////////////////////////////////////////
		?>

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
					<div id="titleView">
						<?=htmlentities($strings["Do you want to change something?"])?>
					</div>
					<div class="col-lg-12 center-block-content">
						<form method="POST" action="BUILDING_Controller.php?action=<?= $strings['Edit']?>&building=<?= $this->building['idBuilding']?>">
							<div id="group-form">
								<div class="inputWithIcon inputIconBg">
									<input type="text" id="idBuilding" name="idBuilding" placeholder="<?= $strings['What is the identifier of this building?']?>" value="<?=$this->building['idBuilding']?>" onblur="checkBuildingId(this.id)">
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="nameBuilding" name="nameBuilding" placeholder="<?= $strings['What building is it?']?>"  value="<?=$this->building['nameBuilding']?>" onblur="checkText(this.id)">
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="addressBuilding" name="addressBuilding" placeholder="<?= $strings['What is your postal address?']?>" value="<?=$this->building['addressBuilding']?>" onblur="checkText(this.id)">
									<i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="phoneBuilding" name="phoneBuilding" placeholder="<?= $strings['What is your phone?']?> " value="<?=$this->building['phoneBuilding']?>" onblur="checkNumPhone(this.id)">
									<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" id="responsibleBuilding" name="responsibleBuilding" placeholder="<?= $strings['Who is the responsible?']?>" value="<?=$this->building['responsibleBuilding']?>" onblur="checkText(this.id)">
									<i class="fa fa-user fa-lg fa-fw" aria-hidden="true"></i>
								</div>
							</div>
							<button type="submit" name="submit" class="btn-dark"><?= $strings["Save"]?></button>
						</form>
						<a href="../index.php?"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>
