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
        $this->view->setElement("%TITLE%", $strings["Floors"]);
        $listTitles = array('sm_idBuilding', 'sm_nameFloor', 'sm_planFloor', 'sm_surfaceBuildingFloor', 'sm_surfaceUsefulFloor'); ?>


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
                                            <a href="FLOOR_Controller.php?&action=Add&building=<?= $_GET['building']?>">
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
                                                        <a title="<?= $strings['Show']?>" href='FLOOR_Controller.php?action=Show&building=<?= $this->floors[$j]['sm_idBuilding']?>&floor=<?= $this->floors[$j]['sm_idFloor']?>'> <?= $this->floors[$j]['sm_idBuilding'].$this->floors[$j]['sm_idFloor']?></a> 
                                                    <?php elseif($key === 'sm_planFloor'): ?>
														<div id="loading-<?=$this->floors[$j]['sm_idFloor']?>">
															  <img id="loading-image" src="../view/img/glow.gif" width="50px" height="50px" alt="Loading..." />
														</div>
														<div id="div-plane-<?=$this->floors[$j]['sm_idFloor']?>" class="div-plane">
                                                        <?php if(!is_file($value)): ?>
                                                            <img id="no-plane" src="../view/img/noPlane.png" onload="loadImage('<?=$this->floors[$j]['sm_idFloor']?>')">
                                                        <?php else: ?>
                                                             <a href="FLOOR_Controller.php?action=ShowPlan&building=<?= $this->floors[$j]['sm_idBuilding']?>&floor=<?= $this->floors[$j]['sm_idFloor']?>"><img src="<?= $this->floors[$j]['sm_planFloor']?>" onload="loadImage('<?=$this->floors[$j]['sm_idFloor']?>')" alt="plan" class="miniatureTable"></a>
                                                        <?php endif; ?>  
														</div>
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
                                            <span title="<?= $strings['Show Space']?>" class="btn btn-primary btn-sm fa fa-cube"></span>
                                        </a>
                                        <?php if(checkRol('EDIT', 'FLOOR')): ?>
                                            <a href="FLOOR_Controller.php?action=Edit&building=<?= $this->floors[$j]['sm_idBuilding']?>&floor=<?= $this->floors[$j]['sm_idFloor']?>">
                                                <span title="<?= $strings['Edit Floor']?>" class="btn btn-warning btn-sm fa fa-pencil"></span>
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
                                                            <form method="POST" action="FLOOR_Controller.php?action=Delete&building=<?= htmlentities($this->floors[$j]['sm_idBuilding'])?>&floor=<?= $this->floors[$j]['sm_idFloor']?>">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $strings["Cancel"]?></button>
                                                                <button type="submit" name="submit" class="btn btn-primary success"><?= $strings["Ok"]?></button> 
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