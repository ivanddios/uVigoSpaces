<?php

class FLOOR_SHOWALL{
    private $floors;
    private $back;
    private $popMessage;

    function __construct($floors, $back, $message) {
        $this->floors = $floors;
        $this->back = $back;

        if(empty($message)){
            $this->popMessage='';
        }else $this->popMessage= $message;

        $this->render();
    }

    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
        $listTitles = array('idBuilding', 'nameFloor', 'planFloor', 'surfaceBuildingFloor', 'surfaceUsefulFloor');
        ?> 

      <?php include 'header.php' ?>
      <main>
     <?php if (!empty($this->popMessage)){ ?>
            <div class="alert alert-success text-center" id="success-alert" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->popMessage?>
            </div>
    <?php } ?>

    <div class="container">
      <div class="row center-row">
        <div class="col-lg-12 center-block">
          <div id="subtitleView">
            <h1><?php echo $strings['nameBuilding']; echo " "; echo $_GET['building']; ?></h1>
            </div>
            <div id="subsubtitle">
				<?php echo "Información sobre las plantas del edificio" ?>
                </div>
              <div class="col-lg-12 center-block2">
                <table id="dataTable" class="table text-center">
                  <thead>
                      <tr>
                      <?php
                          foreach ($listTitles as $title): ?>
                            <th scope="col"><?=$strings[$title]?></th>
                          <?php endforeach; ?>
                      </tr>
                      </thead>
                      <tbody>
                      <?php for ($j = 0; $j < count($this->floors); $j++) {
                                    echo "<tr>";
                                    foreach ($this->floors [$j] as $key => $value) {
                                        for ($i = 0; $i < count($listTitles); $i++) {
                                            if ($key === $listTitles[$i]) {
                                                echo "<td>";
                                                if ($key === 'idBuilding') {?>
                                                <a title="<?php echo $strings['Show']?>" href='FLOOR_Controller.php?action=<?php echo $strings['Show']?>&building=<?php echo $this->floors[$j]['idBuilding']?>&floor=<?php echo $this->floors[$j]['idFloor']?>'> <?php echo $this->floors[$j]['idBuilding'].$this->floors[$j]['idFloor']?></a> 
                                           <?php }else {
                                            echo $value;
                                        }
                                        echo "</td>";
                                    }
                                }
                            } 
                            ?>
                            <td>
                                <a href="SPACE_Controller.php?&building=<?php echo $this->floors[$j]['idBuilding']?>&floor=<?php echo $this->floors[$j]['idFloor']?>">
                                <span title="<?php echo $strings['Show Space']?>" class="btn btn-success btn-sm fa fa-cube"></a>
                                <a href="FLOOR_Controller.php?action=<?php echo $strings['Edit']?>&building=<?php echo $this->floors[$j]['idBuilding']?>&floor=<?php echo $this->floors[$j]['idFloor']?>">
                                <span title="<?php echo $strings['Edit Building']?>" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                    <i title="<?php echo $strings['Delete Building']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#confirm-submit"></i>
                                    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <?php echo $strings["Attention"]?>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $strings["Are you sure you want to delete this floor?"]?><br/> <br>
                                                    <b><strong><?php echo $strings["The information that this floor has will be lost"]?></strong></b>
                                                </div>
                                                <form method="POST" action="BUILDING_Controller.php?action=<?= htmlentities($strings['Delete'])?>&building=<?= htmlentities($this->floors[$j]['idBuilding'])?>&floor=<?php echo $this->floors[$j]['idFloor']?>">
                                                    <input type="hidden" name="building" value=<?php echo $this->floors[$j]['idBuilding']?>>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $strings["Cancel"]?></button>
                                                        <button type="submit" name="submit" id="submit" class="btn btn-success success"><?php echo $strings["Ok"]?></a>
                                                    </div>
                                                </form>
                                             </div>
                                         </div>
                                     </div>
                               </td>
                            <?php } ?>
                        </tbody>
                  </table>
              </div>
            </div>
        </div>
    </div>

    <?php
    include 'footer.php';  
  } 
}

?>