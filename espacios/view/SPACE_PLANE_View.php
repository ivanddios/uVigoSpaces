<?php

class SPACE_PLANE{

    private $plane;

    function __construct($plane) {
        $this->plane = $plane;
        $this->render();
    }
    
    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';  
		
	
		////////////////////////////////////////////////////
		ob_start();
		include 'header.php';
		$buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace("%TITLE%",$strings['Add Floor'],$buffer);
		echo $buffer;

		?> <script src="../js/validates.js"></script><?php
		////////////////////////////////////////////////////
		?>

		<!-- <div class="divImg"> -->
			<!-- <div class="row center-row"> -->
				<!-- <div class="col-lg-6 center-block"> -->
					<div id="titleView">
						<?=htmlentities($strings["Data of the new space"])?>
                       
					<!-- </div> -->
					<!-- <div class="col-lg-12 center-block-content"> -->
						<form method="POST" action="SPACE_Controller.php?action=<?= $strings['Plane']?>" enctype="multipart/form-data">
                        <!-- <div id="titleView"> -->
								
								
						<canvas id="canvas" style="background-image:url('<?= $this->plane ?>');" width="1579" height="2233" ></canvas>
						<!-- <canvas id="canvas" width="1579" height="2233" ></canvas> -->
						
						
						
<script type="text/javascript">

$(function () {
        var canvas = document.getElementById("canvas"),
            ctx = canvas.getContext("2d"),
            storedLines = [], //Lineas provisionales antes del poligono
			polyLines = [],	//Poligono Final
			band = 0;
            radius = 4; //Radio del circle inicial


			//Obtenemos las coordenads del mouse por cada click
        function selectCoords(event) {
            return {
                x: event.offsetX,
                y: event.offsetY
            };
        }

        $("#canvas").mousedown(function (event) {
            var pos = selectCoords(event); //Obtenemos las coordenads del raton cada vez que se clicka
            if (isInitialPoint(pos)) { //Si coincide con las que marcan el punto inicial cerramos el poligono
                polyLines.push(storedLines);
                storedLines = [];
				ctx.clearRect(0, 0, canvas.width, canvas.height); //Eliminamos el punto Inicial
				for(var i=0; i<polyLines.length; i++){
					fillPolyline(polyLines[i]);
				}
            }
            else
            {
				storedLines.push(pos);
				if(storedLines[1] == null){
					drawInitialPoint();
				} else {
					//drawLine(pos);
					drawOtherPoint(pos);
				}
            }
        });

		function drawInitialPoint(){
			//ctx.clearRect(0, 0, canvas.width, canvas.height); //Eliminamos el punto Inicial
				// for(var i=0; i<polyLines.length; i++){
				// 	fillPolyline(polyLines[i]);
				// }
				ctx.fillStyle = '#FF0000';
				ctx.strokeStyle = "#FF0000";
				ctx.beginPath();
				//ctx.arc(storedLines[0].x, storedLines[0].y, radius, 0, 2 * Math.PI, false); 
				ctx.fillRect(storedLines[0].x - 2, storedLines[0].y - 2, 6, 6);
                ctx.strokeRect(storedLines[0].x - 2, storedLines[0].y - 2, 6, 6);
				ctx.fill();
				ctx.beginPath();
				ctx.moveTo(storedLines[0].x, storedLines[0].y);
		}


        // function drawLine(position) {
        //     if(storedLines.length !=0){
		// 		ctx.strokeStyle = "orange";
		// 		ctx.lineWidth = 3;
		// 		for(var i=1; i<storedLines.length; ++i) {
		// 			ctx.lineTo(storedLines[i].x, storedLines[i].y)
		// 		}
		// 		ctx.lineTo(position.x, position.y);
		// 		ctx.stroke();
		// 	}
		// };
		
		function drawOtherPoint(position) {
				ctx.strokeStyle = "#4F95EA";
				ctx.lineWidth = 1;
				for(var i=1; i<storedLines.length; ++i) {
					ctx.fillRect(storedLines[i].x - 4, storedLines[i].y - 4, 8, 8);
					ctx.strokeRect(storedLines[i].x - 4, storedLines[i].y - 4, 8, 8);
					//ctx.lineTo(storedLines[i].x,storedLines[i].y);
				}
				ctx.lineTo(position.x, position.y);
				ctx.stroke();
		};


        function isInitialPoint(pos) {

			if(storedLines[0] != null){
				var start = storedLines[0]
			}else {
				var start = {x:0,y:0};
			}
                dx = pos.x - start.x,
                dy = pos.y - start.y;
            return (dx * dx + dy * dy < radius * radius)
        }










        function fillPolyline(lines) {
            ctx.strokeStyle = "#4F95EA";
			ctx.fillStyle = "#666";
            ctx.lineWidth = 1;
            ctx.beginPath();
            ctx.moveTo(lines[0].x, lines[0].y);
            for (var i = 0; i < lines.length; i++) {
                ctx.lineTo(lines[i].x, lines[i].y);
            }
            ctx.closePath();
            ctx.fill();
            ctx.stroke();
        }

        $("#clear").click(function () {
            polyLines = [];
            draw();
        });
});
</script>
						<!-- <img src='<?= $this->plane ?>'  alt="" usemap="#planetmap"> -->
								
								<!-- <div class="inputWithIcon inputIconBg">
                                	<img src='<?= $this->plane ?>' onclick="selectCoords(event)" usemap="#planetmap">
								</div>

                                <p id="demo"></p> -->


<!-- 
                                    <map name="planetmap">

                                        <area title="asdasdasd" href="#" shape="poly" coords="554,1907,760,1907,760,1980,554,1980" />
										<area shape="default" nohref="nohref" /> 
									</map>  -->

							</div>	
							<button type="submit" name="submit" class="btn-dark" disabled><?= $strings["Save"]?></button>
						</form>
						<a href="SPACE_Controller.php?building=<?= $this->building?>&floor=<?= $this->floor?>"><?= $strings["Back"] ?></a>
					<!-- </div> -->
				<!-- </div> -->
			<!-- </div> -->
		<!-- </div> -->
 <?php
    include 'footer.php';  
  } 
}

?>
