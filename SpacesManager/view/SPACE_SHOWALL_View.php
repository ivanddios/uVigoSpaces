<?php

class SPACE_SHOWALL{
    private $spaces;
    private $buildingName;
    private $floorName;

    function __construct($spaces, $buildingName, $floorName) {
        $this->spaces = $spaces;
        $this->buildingName = $buildingName;
        $this->floorName = $floorName;
        $this->render();
    }

    function render() {
        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Spaces"]);
        $listTitles = array('sm_idBuilding', 'sm_nameSpace', 'sm_surfaceSpace', 'sm_numberInventorySpace'); ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?= $this->buildingName;?></h1>
                        <h3><?= $this->floorName;?></h3>
                    </div>
                    <div id="subtitleView">
                        <?= $strings["Information about the building's spaces"] ?>
                    </div>
                    <div id="pnlBoxSearch">
                        <a href="FLOOR_Controller.php?building=<?= $this->spaces[0]['sm_idBuilding']?>"><img src="../view/img/iconback.png" alt="<?= $strings["Back"]?>" class="iconBack"></a>
                        <input type="text" id="searchBox" onkeyup="searchInTable()" placeholder="<?= $strings["Search"]?>">
                    </div>
                    <table id="dataTable" class="table text-center">
                        <thead>
                            <tr>
                                <?php foreach ($listTitles as $title): ?>
                                    <th scope="col"><?=$strings[$title]?></th>
                                <?php endforeach; ?>
                                <?php  if(checkRol('ADD', 'SPACE')): ?>
                                    <th scope="col">
                                        <a href="SPACE_Controller.php?action=<?= $strings['Add']?>&building=<?= $_GET['building']?>&floor=<?= $_GET['floor']?>">
                                            <span title="<?= $strings['Add Space']?>" class="btn btn-success btn-sm fa fa-plus"></span>
                                        </a>
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for ($j = 0; $j < count($this->spaces); $j++): ?>
                                <tr id="<?=$this->spaces[$j]['sm_idSpace']?>">
                                    <?php foreach ($this->spaces [$j] as $key => $value):
                                        for ($i = 0; $i < count($listTitles); $i++):
                                            if ($key === $listTitles[$i]): ?>
                                                <?php if($key === 'sm_idBuilding'): ?>
                                                    <td id="item-idSpace-<?=$j?>">
                                                    <a title="<?=$strings['Show']?>" href='SPACE_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->spaces[$j]['sm_idBuilding']?>&floor=<?= $this->spaces[$j]['sm_idFloor']?>&space=<?= $this->spaces[$j]['sm_idSpace']?>'> <?= $this->spaces[$j]['sm_idBuilding'].$this->spaces[$j]['sm_idFloor'].$this->spaces[$j]['sm_idSpace']?></a>    
                                                <?php elseif ($key === 'sm_nameSpace'): ?>
                                                    <td id="item-nameSpace-<?=$j?>"> 
                                                    <?= $value; ?>
                                                <?php elseif($key === 'sm_surfaceSpace'): ?>
                                                        <td id="item-surfaceSpace-<?=$j?>" class="surface">
                                                        <?=$value . ' m²'?>
                                                <?php else:?>
                                                        <td id="item-numberInventorySpace-<?=$j?>" class="numberInventory">
                                                        <?=$value; 
                                                    endif; ?>
                                                </td> 
                                            <?php endif;
                                        endfor; ?>
                                    <?php endforeach; ?>
                                    <?php if(isset($_SESSION['LOGIN'])) { ?>
                                        <td>
                                            <?php  if(checkRol('EDIT', 'SPACE')): ?>
                                                <a href="SPACE_Controller.php?action=<?php echo $strings['Edit']?>&building=<?= $this->spaces[$j]['sm_idBuilding']?>&floor=<?= $this->spaces[$j]['sm_idFloor']?>&space=<?= $this->spaces[$j]['sm_idSpace']?>">
                                                    <span title="<?= $strings['Edit Space']?>" class="btn btn-warning btn-sm fa fa-pencil"></span>
                                                </a>
                                            <?php endif; ?>
                                            <?php  if(checkRol('DELETE', 'SPACE')): ?>
                                                <i title="<?= $strings['Delete Space']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?=$this->spaces[$j]['sm_idSpace']?>"></i>
                                                <div id="item-<?=$this->spaces[$j]['sm_idSpace']?>" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <?= $strings["Attention"]?>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?= sprintf($strings["Are you sure you want to delete the space \"%s\" ?"], $this->spaces[$j]['sm_idBuilding'].$this->spaces[$j]['sm_idFloor'].$this->spaces[$j]['sm_idSpace'])?><br/> <br>
                                                                <b><strong><?= $strings["The information that this space has will be lost"]?></strong></b>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="POST" action="SPACE_Controller.php?action=<?= htmlentities($strings['Delete'])?>&building=<?= htmlentities($this->spaces[$j]['sm_idBuilding'])?>&floor=<?= $this->spaces[$j]['sm_idFloor']?>&space=<?= $this->spaces[$j]['sm_idSpace']?>">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?= $strings["Cancel"]?></button>
                                                                    <button type="submit" name="submit" class="btn btn-primary success"><?= $strings["Ok"]?></button> 
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                    <?php } ?>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>highlightNumberInventoryAndSurface();</script>
    <?php
        include 'footer.php';  
    } 
}

?>