<?php

class FLOOR_SHOWALL{
    private $floors;
    private $buildingName;

    function __construct($floors, $buildingName) {
        $this->floors = $floors;
        $this->buildingName = $buildingName;
        $this->render();
    }

    function render() {
        $listTitles = array('idBuilding', 'nameFloor', 'planeFloor', 'surfaceBuildingFloor', 'surfaceUsefulFloor');

        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Floors"]);?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?=$this->buildingName;?></h1>
                    </div>
                    <div id="subtitleView">
                        <?= $strings["Information about the building's floors"] ?>
                    </div>
                    <div class="col-lg-12 center-block-content">
                        <table id="dataTable" class="table text-center">
                            <thead>
                                <tr>
                                    <?php foreach ($listTitles as $title): ?>
                                        <th scope="col"><?=$strings[$title]?></th>
                                    <?php endforeach; ?>
                                    <th scope="col"><a href="FLOOR_Controller.php?&action=<?= $strings['Add']?>&building=<?= $_GET['building']?>"><span title="<?= $strings['Add Floor']?>" class="btn btn-success btn-sm fa fa-plus"></span></a></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php for ($j = 0; $j < count($this->floors); $j++): ?>
                                    <tr>
                                        <?php foreach ($this->floors [$j] as $key => $value):
                                            for ($i = 0; $i < count($listTitles); $i++):
                                                if ($key === $listTitles[$i]): ?>
                                                    <td>
                                                        <?php if ($key === 'idBuilding'): ?>
                                                            <a title="<?= $strings['Show']?>" href='FLOOR_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->floors[$j]['idBuilding']?>&floor=<?= $this->floors[$j]['idFloor']?>'> <?= $this->floors[$j]['idBuilding'].$this->floors[$j]['idFloor']?></a> 
                                                        <?php elseif($key === 'planeFloor'): ?>
                                                            <?php if($value === ''): ?>
                                                                <img src="../img/noPlane.png" width="25px" height="25px">
                                                            <?php else: ?>
                                                                <a href="<?= $this->floors[$j]['planeFloor']?>" target="_blank"><img src="<?= $this->floors[$j]['planeFloor']?>" alt="plane" class="logo"></a>
                                                            <?php endif; ?>   
                                                        <?php elseif($key === 'surfaceBuildingFloor' || $key === 'surfaceUsefulFloor'): ?>
                                                            <?=$value . ' m²'?>
                                                        <?php else:
                                                            echo $value;
                                                        endif; ?>
                                                    </td> 
                                                <?php endif;
                                            endfor;
                                        endforeach; ?>
                                        <td>
                                            <a href="SPACE_Controller.php?&building=<?= $this->floors[$j]['idBuilding']?>&floor=<?= $this->floors[$j]['idFloor']?>">
                                                <span title="<?= $strings['Show Space']?>" class="btn btn-success btn-sm fa fa-cube"></span></a>
                                            <a href="FLOOR_Controller.php?action=<?php echo $strings['Edit']?>&building=<?= $this->floors[$j]['idBuilding']?>&floor=<?= $this->floors[$j]['idFloor']?>">
                                                <span title="<?= $strings['Edit Building']?>" class="btn btn-primary btn-sm fa fa-pencil"></span></a>
                                            <i title="<?= $strings['Delete Building']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?=$this->floors[$j]['idFloor']?>"></i>
                                            <div id="item-<?=$this->floors[$j]['idFloor']?>" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?= $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= $strings["Are you sure you want to delete this floor?"]?><br/> <br>
                                                            <b><strong><?= $strings["The information that this floor has will be lost"]?></strong></b>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="FLOOR_Controller.php?action=<?= htmlentities($strings['Delete'])?>&building=<?= htmlentities($this->floors[$j]['idBuilding'])?>&floor=<?= $this->floors[$j]['idFloor']?>">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= $strings["Cancel"]?></button>
                                                                    <button type="submit" name="submit" class="btn btn-success success"><?= $strings["Ok"]?></button> 
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endfor; ?>
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