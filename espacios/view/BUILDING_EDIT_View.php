<?php

class BUILDING_EDIT{
    private $building;
    private $back;

    function __construct($building, $back) {
        $this->building = $building;
        $this->back = $back;
        $this->render();
    }
    
    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
        include 'header.php' ?>

<div class="container">
	<div class="row center-row">
		<div class="col-lg-6 center-block">
			<div id="subtitlePoll">
				<?=htmlentities($strings["Do you want to change something?"])?>
			</div>
			<div class="col-lg-12 center-block2">
				<form method="POST" action="BUILDING_Controller.php?action=<?php echo $strings['Edit']?>&building=<?php echo $this->building['idBuilding']?>">
                <div id="optionalInput">
                    	<div class="inputWithIconLogin inputIconBg">
                        	<input type="text" placeholder="<?php echo $this->building['idBuilding']?>" readonly>
                        	<i class="fa fa-lock fa-lg fa-fw" aria-hidden="true"></i>
                   		 </div>
					</div>
					<div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="nameBuilding" placeholder="<?= $strings['What building is it?']?>"  value="<?=$this->building['nameBuilding']?>">
							<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
						</div>
					</div>
					<div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="addressBuilding" placeholder="<?= $strings['What is your postal address?']?>" value="<?=$this->building['addressBuilding']?>">
							<i class="fa fa-map-marker fa-lg fa-fw" aria-hidden="true"></i>
						</div>
					</div>

                    <div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="phoneBuilding" placeholder="<?= $strings['What is your phone?']?> " value="<?=$this->building['phoneBuilding']?>">
							<i class="fa fa-phone fa-lg fa-fw" aria-hidden="true"></i>
						</div>
					</div>

					<div id="optionalInput">
						<div class="inputWithIconLogin inputIconBg">
							<input type="text" name="responsibleBuilding" placeholder="<?= $strings['Who is the responsible?']?>" value="<?=$this->building['responsibleBuilding']?>">
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
