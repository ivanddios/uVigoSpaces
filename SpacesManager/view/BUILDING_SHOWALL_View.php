<?php

class BUILDING_SHOWALL{
    private $buildings;

    function __construct($buildings) {
        $this->buildings = $buildings;

        $this->render();
    }

    function render() {

        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Buildings"]);
        $listTitles = array('sm_idBuilding', 'sm_nameBuilding', 'sm_addressBuilding', 'sm_phoneBuilding'); ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?= $strings['Buildings'] ?></h1>
                    </div>
                    <div id="pnlBoxSearch">
                        <input type="text" id="searchBox" onkeyup="searchInTable()" placeholder="<?= $strings["Search"]?>">
                    </div>
                    <table id="dataTable" class="table text-center">
                        <thead>
                            <tr>
                                <?php foreach ($listTitles as $title): ?>
                                    <th scope="col"><?=$strings[$title]?></th>
                                <?php endforeach; ?>
                               
                                <th scope="col">
                                    <?php  if(checkRol('ADD', 'BUILDING')): ?>
                                        <a href="BUILDING_Controller.php?&action=<?= $strings['Add']?>">
                                            <span title="<?= $strings['Add Building']?>" class="btn btn-success btn-sm fa fa-plus"></span>
                                        </a>
                                    <?php endif; ?>
                                </th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for ($j = 0; $j < count($this->buildings); $j++) : ?>
                                <tr>
                                    <?php foreach ($this->buildings [$j] as $key => $value) :
                                        for ($i = 0; $i < count($listTitles); $i++):
                                            if ($key === $listTitles[$i]) : ?>
                                                <td>
                                                    <?php if ($key === 'sm_idBuilding') {?>
                                                        <a title="<?= $strings['Show Building']?>" href='BUILDING_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->buildings[$j]['sm_idBuilding']?>'><?= $value?></a>                
                                                    <?php }else {
                                                        echo $value;
                                                    } ?>
                                                </td>
                                            <?php endif;
                                        endfor;
                                    endforeach;?>
                                        
                                    <td>
                                        <a href="FLOOR_Controller.php?building=<?= htmlentities($this->buildings[$j]['sm_idBuilding'])?>">
                                            <span title="<?= $strings['Show Floors']?>" class="btn btn-success btn-sm fa fa-building"></span>
                                        </a>
                                        <?php  if(checkRol('EDIT', 'BUILDING')): ?>
                                            <a href="BUILDING_Controller.php?action=<?= $strings['Edit']?>&building=<?= $this->buildings[$j]['sm_idBuilding']?>">
                                                <span title="<?= $strings['Edit Building']?>" class="btn btn-primary btn-sm fa fa-pencil"></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php  if(checkRol('DELETE', 'BUILDING')): ?>
                                            <i title="<?= $strings['Delete Building']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?= $this->buildings[$j]['sm_idBuilding']?>"></i>
                                            <div id="item-<?= $this->buildings[$j]['sm_idBuilding']?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?= $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= sprintf($strings["Are you sure you want to delete the building \"%s\" ?"], $this->buildings[$j]['sm_nameBuilding'] )?>
                                                            <p><?= $strings["The information that this building has will be lost"]?></p>
                                                        </div>
                                                        <form method="POST" action="BUILDING_Controller.php?action=<?= htmlentities($strings['Delete'])?>">
                                                            <input type="hidden" name="building" value="<?= $this->buildings[$j]['sm_idBuilding']?>" readonly>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $strings["Cancel"]?></button>
                                                                <button type="submit" name="submit" id="submit" class="btn btn-success success"><?= $strings["Ok"]?></button>
                                                            </div>
                                                        </form>
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