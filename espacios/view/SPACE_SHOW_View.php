<?php

class SPACE_SHOW{
    private $space;

    function __construct($space) {
        $this->space = $space;
        $this->render();
    }
    
    function render() {
		include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
		  
        ////////////////////////////////////////////////////
		ob_start();
		include 'header.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace("%TITLE%",$strings['Show Space'],$buffer);
		echo $buffer;
		////////////////////////////////////////////////////
		?>

		<div class="container">
			<div class="row center-row">
				<div class="col-lg-6 center-block">
                <div id="titleView">
						<?=$this->space['nameSpace']?>
					</div>
					<div class="col-lg-12 center-block-content">
                        <div id="group-form">
								<div class="inputWithIcon inputIconBg">
									<input type="text" placeholder="<?= $this->space['idBuilding'].$this->space['idFloor']?>" readonly>
									<i class="fa fa-building fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="idSpace" placeholder="<?= $strings['What is the identifier of this space?']?>" value="<?=$this->space['idSpace']?>" readonly>
									<i class="fa fa-cube fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="nameSpace" placeholder="<?= $strings['What space is it?']?>" value="<?=$this->space['nameSpace']?>" readonly>
									<i class="fa fa-reorder fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="surfaceSpace" placeholder="<?= $strings['What is the surface of space?']?>" value="<?=$this->space['surfaceSpace']?>" readonly>
									<i class="fa fa-area-chart fa-lg fa-fw" aria-hidden="true"></i>
								</div>

								<div class="inputWithIcon inputIconBg">
									<input type="text" name="numberInventorySpace" placeholder="<?= $strings['What is the number inventory?']?>" value="<?=$this->space['numberInventorySpace']?>" readonly>
									<i class="fa fa-barcode fa-lg fa-fw" aria-hidden="true"></i>
								</div>
							</div>	
						<a href="SPACE_Controller.php?building=<?=$this->space['idBuilding']?>&floor=<?=$this->space['idFloor']?>"><?= $strings["Back"] ?></a>
					</div>
				</div>
			</div>
		</div>
 <?php
    include 'footer.php';  
  } 
}

?>