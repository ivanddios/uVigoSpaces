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
        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Show Plane"]);
        $listTitles = array('sm_idBuilding', 'sm_nameFloor', 'sm_planeFloor', 'sm_surfaceBuildingFloor', 'sm_surfaceUsefulFloor'); ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?=$this->buildingName;?></h1>
                    </div>
                    <div id="subtitleView">
                        <?= $strings["Information about the building's floors"] ?>
                    </div>
                    <div id="pnlBoxSearch">
                        <a href="BUILDING_Controller.php"><img src="../view/img/iconback.png" alt="<?= $strings["Back"]?>" class="iconBack"></a>
                        <input type="text" id="searchBox" onkeyup="searchInTable()" placeholder="<?= $strings["Search"]?>">
                    </div>
                    <table id="dataTable" class="table text-center">
                        <thead>
                            <tr>
                                <?php foreach ($listTitles as $title): ?>
                                    <th scope="col"><?=$strings[$title]?></th>
                                <?php endforeach; ?>
                              
                                    <th scope="col">
                                        <?php  if(checkRol('ADD', 'FLOOR')): ?>
                                            <a href="FLOOR_Controller.php?&action=<?= $strings['Add']?>&building=<?= $_GET['building']?>">
                                                <span title="<?= $strings['Add Floor']?>" class="btn btn-success btn-sm fa fa-plus"></span>
                                            </a>
                                        <?php endif; ?>
                                    </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for ($j = 0; $j < count($this->floors); $j++): ?>
                                <tr>
                                    <?php foreach ($this->floors [$j] as $key => $value):
                                        for ($i = 0; $i < count($listTitles); $i++):
                                            if ($key === $listTitles[$i]): ?>
                                                <td>
                                                    <?php if ($key === 'sm_idBuilding'): ?>
                                                        <a title="<?= $strings['Show']?>" href='FLOOR_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->floors[$j]['sm_idBuilding']?>&floor=<?= $this->floors[$j]['sm_idFloor']?>'> <?= $this->floors[$j]['sm_idBuilding'].$this->floors[$j]['sm_idFloor']?></a> 
                                                    <?php elseif($key === 'sm_planeFloor'): ?>
                                                        <?php if($value === ''): ?>
                                                            <img src="../view/img/noPlane.png" width="25px" height="25px">
                                                        <?php else: ?>
                                                            <a href="<?= $this->floors[$j]['sm_planeFloor']?>" target="_blank"><img src="<?= $this->floors[$j]['sm_planeFloor']?>" alt="plane" class="miniatureTable"></a>
                                                        <?php endif; ?>   
                                                    <?php elseif($key === 'sm_surfaceBuildingFloor' || $key === 'sm_surfaceUsefulFloor'): ?>
                                                        <?=$value . ' m²'?>
                                                    <?php else:
                                                        echo $value;
                                                    endif; ?>
                                                </td> 
                                            <?php endif;
                                        endfor;
                                    endforeach; ?>
                                    <td>
                                        <a href="SPACE_Controller.php?building=<?= $this->floors[$j]['sm_idBuilding']?>&floor=<?= $this->floors[$j]['sm_idFloor']?>">
                                            <span title="<?= $strings['Show Space']?>" class="btn btn-success btn-sm fa fa-cube"></span>
                                        </a>
                                        <?php if(checkRol('EDIT', 'FLOOR')): ?>
                                            <a href="FLOOR_Controller.php?action=<?= $strings['Edit']?>&building=<?= $this->floors[$j]['sm_idBuilding']?>&floor=<?= $this->floors[$j]['sm_idFloor']?>">
                                                <span title="<?= $strings['Edit Floor']?>" class="btn btn-primary btn-sm fa fa-pencil"></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php if(checkRol('DELETE', 'FLOOR')): ?>
                                            <i title="<?= $strings['Delete Floor']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?=$this->floors[$j]['sm_idFloor']?>"></i>
                                            <div id="item-<?=$this->floors[$j]['sm_idFloor']?>" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?= $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= sprintf($strings["Are you sure you want to delete the floor \"%s\"?"], $this->floors[$j]['sm_nameFloor'])?><br><br>
                                                            <b><strong><?= $strings["The information that this floor has will be lost"]?></strong></b>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="FLOOR_Controller.php?action=<?= htmlentities($strings['Delete'])?>&building=<?= htmlentities($this->floors[$j]['sm_idBuilding'])?>&floor=<?= $this->floors[$j]['sm_idFloor']?>">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $strings["Cancel"]?></button>
                                                                <button type="submit" name="submit" class="btn btn-success success"><?= $strings["Ok"]?></button> 
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php
        include 'footer.php';  
    } 
}

?>