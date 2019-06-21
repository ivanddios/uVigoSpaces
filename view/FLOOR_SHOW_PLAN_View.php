<?php

class FLOOR_SHOW_plan{

	private $spaces;
	private $plan;
	private $floor;

  function __construct($spaces, $plan, $floor) {
		$this->spaces = $spaces;
		$this->plan = $plan;
		$this->floor = $floor;
		$this->render();
  }
    
		
	function render() {
		include 'header.php';
		$this->view->setElement("%TITLE%", $strings["Show Plan"]);?>
		<script type="text/javascript" src="../view/js/space-plan.js"></script>
		<script type="text/javascript" src="../view/js/jquery.maphilight.js"></script>

		<div id="titleView">
			<h3><?= $this->floor['sm_nameBuilding']?><h3>
			<h4><?= $this->floor['sm_nameFloor']?><h4>
		</div> 
			<img id="plan" class="map" src="<?= $this->plan?>" usemap="#spaces" onload="resizeImgMap(1)"/>
			<map name="spaces">
				<?php for($i=0; $i<count($this->spaces); $i++):
					if($this->spaces[$i]['sm_coordsplan'] != ''): ?>
						<area shape="poly" class="mapArea" title="<?= $this->spaces[$i]['sm_nameSpace']?>" coords="<?= $this->spaces[$i]['sm_coordsplan']?>" onclick="loadModal('#'+'<?=$this->spaces[$i]['sm_idSpace']?>')">
						<div id="<?=$this->spaces[$i]['sm_idSpace']?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title"><?=$strings['sm_idSpace']?>: <?=$this->spaces[$i]['sm_idBuilding'].$this->spaces[$i]['sm_idFloor'].$this->spaces[$i]['sm_idSpace']?></h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div class="input-container">
											<span class="input-group-text fa fa-reorder"></span>
											<input type="text" id="nameSpace" name="idFloor" value="<?=$this->spaces[$i]['sm_nameSpace']?>" readonly>
											<label for="idFloor"><?= $strings['sm_nameSpace']?></label>
										</div>
									
										<div class="input-container">
											<span class="input-group-text fa fa-area-chart"></span>
											<input type="text" id="surfaceSpace" name="surfaceSpace" value="<?=$this->spaces[$i]['sm_surfaceSpace']?> m²" readonly>
											<label for="surfaceSpace"><?= $strings['sm_surfaceSpace']?></label>
										</div>

										<div class="input-container">
											<span class="input-group-text fa fa-barcode"></span>
											<input type="text" id="numberInventorySpace" name="numberInventorySpace" value="<?=$this->spaces[$i]['sm_numberInventorySpace']?>" readonly>
											<label for="numberInventorySpace"><?= $strings['sm_numberInventorySpace']?></label>
										</div>

										<label class="control-label"><?= $strings['Click to see the space in the plan']?></label>
										<div id="plane_floor" class="inputWithIcon inputIconBg">
											<a target="_blank" href="SPACE_Controller.php?action=ShowSpacePlan&building=<?= $this->spaces[$i]['sm_idBuilding']?>&floor=<?= $this->spaces[$i]['sm_idFloor']?>&space=<?= $this->spaces[$i]['sm_idSpace']?>">
												<img id="view-plan" src='<?= $this->plan; ?>' class="avatarplan">
												<img id="icon-view" src="../view/img/iconTouch.png">
											</a>
										</div>
									
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-light" data-dismiss="modal"><?=$strings['Close']?></button>
									</div>
								</div>
							</div>
						</div>
					<?php 
					endif;
				endfor; 
				?>
			</map>
			<div id="planButtons">
				<li>
					<ul><button id="fullButton" type="button" class="btn btn-primary " onclick="resizeImgMap(0)"><i class="fa fa-expand" aria-hidden="true"></i>&nbsp<?= $strings['Extend']?></button></ul>
					<ul><button id="resizeButton" type="button" class="btn btn-primary " onclick="resizeImgMap(1)" disabled><i class="fa fa-window-maximize" aria-hidden="true"></i>&nbsp<?= $strings['Adjust']?></button></ul>
					<ul><a href="<?=$_SERVER['HTTP_REFERER']?>" class="btn btn-secondary"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp<?= $strings['Back']?></a></ul>
				</li>
			</div>

			<script>
				function loadModal(id){
					$(id).modal()
				}
			</script>
		<?php include 'footer.php';  
	} 
}



?>
