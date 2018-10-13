<?php

class BUILDING_SHOWALL{
    private $buildings;
    private $back;

    function __construct($buildings, $back) {
        $this->buildings = $buildings;
        $this->back = $back;
        $this->render();
    }
    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
        $listTitles = array('idBuilding', 'nameBuilding', 'addressBuilding', 'phoneBuilding', 'responsibleBuilding');
        ?> 

      <?php include 'header.php' ?>
    <div class="container">
      <div class="row center-row">
        <div class="col-lg-12 center-block">
          <div id="subtitle">
            <h1><?php echo $strings['Buildings'] ?></h1>
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
                      <?php for ($j = 0; $j < count($this->buildings); $j++) {
                                    echo "<tr>";
                                    foreach ($this->buildings [$j] as $key => $value) {
                                        for ($i = 0; $i < count($listTitles); $i++) {
                                            if ($key === $listTitles[$i]) {
                                                echo "<td>";
                                                if ($key === 'nameBuilding') {?>
                                            <a title="See" href='BUILDING_Controller.php?action=<?php echo $strings['See']?>&building=<?php echo $this->buildings[$j]['idBuilding']?>'><?php echo $value?></a>                
                                           <?php }else {
                                            echo $value;
                                        }
                                        echo "</td>";
                                    }
                                }
                            } 
                            ?>
                            <td>
                                <a href="BUILDING_Controller.php?action=<?php echo $strings['Edit']?>&building=<?php echo $this->buildings[$j]['idBuilding']?>">
                                <span title="Edit" class="btn btn-primary btn-sm fa fa-pencil"></a>
                                    <i title="Delete" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#confirm-submit"></i>
                                    <div class="modal fade" id="confirm-submit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <?php echo $strings["Attention"]?>
                                                </div>
                                                <div class="modal-body">
                                                    <?php echo $strings["Are you sure you want to delete this building?"]?> 
                                                </div>
                                                <form method="POST" action="BUILDING_Controller.php?action=Delete&building=<?php echo $this->buildings[$j]['idBuilding']?>">
                                                    <input type="hidden" name="poll" value=<?php echo $this->buildings[$j]['idBuilding']?>>
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