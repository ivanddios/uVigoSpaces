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
        $listTitles = array('idBuilding', 'nameSpace', 'surfaceSpace', 'numberInventorySpace');

        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Spaces"]);?>

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
                        <a href="FLOOR_Controller.php?building=<?= $this->spaces[0]['idBuilding']?>"><img src="../img/iconback.png" alt="<?= $strings["Back"]?>" class="iconBack"></a>
                        <input type="text" id="searchBox" onkeyup="searchInTable()" placeholder="<?= $strings["Search"]?>">
                    </div>
                    <table id="dataTable" class="table text-center">
                        <thead>
                            <tr>
                                <?php foreach ($listTitles as $title): ?>
                                    <th scope="col"><?=$strings[$title]?></th>
                                <?php endforeach; ?>
                                <th scope="col"><a href="SPACE_Controller.php?action=<?= $strings['Add']?>&building=<?= $_GET['building']?>&floor=<?= $_GET['floor']?>"><span title="<?= $strings['Add Space']?>" class="btn btn-success btn-sm fa fa-plus"></span></a></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for ($j = 0; $j < count($this->spaces); $j++): ?>
                                <tr id="<?=$this->spaces[$j]['idSpace']?>">
                                    <?php foreach ($this->spaces [$j] as $key => $value):
                                        for ($i = 0; $i < count($listTitles); $i++):
                                            if ($key === $listTitles[$i]): ?>
                                                <?php if($key === 'idBuilding'): ?>
                                                    <td id="item-idSpace-<?=$j?>">
                                                    <a title="<?=$strings['Show']?>" href='SPACE_Controller.php?action=<?= $strings['Show']?>&building=<?= $this->spaces[$j]['idBuilding']?>&floor=<?= $this->spaces[$j]['idFloor']?>&space=<?= $this->spaces[$j]['idSpace']?>'> <?= $this->spaces[$j]['idBuilding'].$this->spaces[$j]['idFloor'].$this->spaces[$j]['idSpace']?></a>    
                                                <?php elseif ($key === 'nameSpace'): ?>
                                                    <td id="item-nameSpace-<?=$j?>"> 
                                                    <?= $value; ?>
                                                <?php elseif($key === 'surfaceSpace'): ?>
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
                                    <td>
                                        <a href="SPACE_Controller.php?action=<?php echo $strings['Edit']?>&building=<?= $this->spaces[$j]['idBuilding']?>&floor=<?= $this->spaces[$j]['idFloor']?>&space=<?= $this->spaces[$j]['idSpace']?>">
                                        <span title="<?= $strings['Edit Space']?>" class="btn btn-primary btn-sm fa fa-pencil"></span></a>
                                        <i title="<?= $strings['Delete Space']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?=$this->spaces[$j]['idSpace']?>"></i>
                                        <div id="item-<?=$this->spaces[$j]['idSpace']?>" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <?= $strings["Attention"]?>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?= sprintf($strings["Are you sure you want to delete the space \"%s\" ?"], $this->spaces[$j]['idBuilding'].$this->spaces[$j]['idFloor'].$this->spaces[$j]['idSpace'])?><br/> <br>
                                                        <b><strong><?= $strings["The information that this space has will be lost"]?></strong></b>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form method="POST" action="SPACE_Controller.php?action=<?= htmlentities($strings['Delete'])?>&building=<?= htmlentities($this->spaces[$j]['idBuilding'])?>&floor=<?= $this->spaces[$j]['idFloor']?>&space=<?= $this->spaces[$j]['idSpace']?>">
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
        <script>highlightNumberInventoryAndSurface();</script>
    <?php
        include 'footer.php';  
    } 
}

?>