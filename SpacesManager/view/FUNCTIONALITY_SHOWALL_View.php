<?php

class FUNCTIONALITY_SHOWALL{
    private $functions;

    function __construct($functions) {
        $this->functions = $functions;
        $this->render();
    }

    function render() {

        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Functionalities"]);
        $listTitles = array('sm_nameFunction', 'sm_descripFunction'); ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?= $strings['Functionalities'] ?></h1>
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
                                <?php  if(checkRol('ADD', 'FUNCTIONALITY')): ?>
                                    <th scope="col">
                                        <a href="FUNCTIONALITY_Controller.php?action=Add">
                                            <span title="<?= $strings['Add Functionality']?>" class="btn btn-success btn-sm fa fa-plus"></span>
                                        </a>
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for ($j = 0; $j < count($this->functions); $j++) : ?>
                                <tr>
                                    <?php foreach ($this->functions [$j] as $key => $value) :
                                        for ($i = 0; $i < count($listTitles); $i++):
                                            if ($key === $listTitles[$i]) : ?>
                                                <td>
                                                    <?php if ($key === 'sm_nameFunction') {?>
                                                        <a title="<?= $strings['Show Functionality']?>" href='FUNCTIONALITY_Controller.php?action=<?= $strings['Show']?>&function=<?= $this->functions[$j]['sm_idFunction']?>'><?= $value?></a>                
                                                    <?php }else {
                                                        echo $value;
                                                    } ?>
                                                </td>
                                            <?php endif;
                                        endfor;
                                    endforeach;?>
                                        
                                    <td>
                                        <?php  if(checkRol('EDIT', 'FUNCTIONALITY')): ?>
                                            <a href="FUNCTIONALITY_Controller.php?action=<?= $strings['Edit']?>&function=<?= $this->functions[$j]['sm_idFunction']?>">
                                                <span title="<?= $strings['Edit Functionality']?>" class="btn btn-warning btn-sm fa fa-pencil"></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php  if(checkRol('DELETE', 'FUNCTIONALITY')): ?>
                                            <i title="<?= $strings['Delete Functionality']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?= $this->functions[$j]['sm_idFunction']?>"></i>
                                            <div id="item-<?= $this->functions[$j]['sm_idFunction']?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?= $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= sprintf($strings["Are you sure you want to delete the functionality \"%s\" ?"], $this->functions[$j]['sm_nameFunction'] )?>
                                                            <p><?= $strings["The information that this functionality has will be lost"]?></p>
                                                        </div>
                                                        <form method="POST" action="FUNCTIONALITY_Controller.php?action=<?=$strings['Delete']?>">
                                                            <input type="hidden" name="function" value="<?=$this->functions[$j]['sm_idFunction']?>" readonly>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?= $strings["Cancel"]?></button>
                                                                <button type="submit" name="submit" id="submit" class="btn btn-primary success"><?= $strings["Ok"]?></button>
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