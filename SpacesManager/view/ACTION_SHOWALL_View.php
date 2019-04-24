<?php

class ACTION_SHOWALL{
    private $actions;

    function __construct($actions) {
        $this->actions = $actions;
        $this->render();
    }

    function render() {

        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Actions"]);
        $listTitles = array('sm_nameAction', 'sm_descripAction'); ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?= $strings['Actions'] ?></h1>
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
                                <?php  if(checkRol('ADD','ACTION')): ?>
                                    <th scope="col">
                                        <a href="ACTION_Controller.php?action=<?= $strings['Add']?>">
                                            <span title="<?= $strings['Add Action']?>" class="btn btn-success btn-sm fa fa-plus"></span>
                                        </a>
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for ($j = 0; $j < count($this->actions); $j++) : ?>
                                <tr>
                                    <?php foreach ($this->actions [$j] as $key => $value) :
                                        for ($i = 0; $i < count($listTitles); $i++):
                                            if ($key === $listTitles[$i]) : ?>
                                                <td>
                                                    <?php if ($key === 'sm_nameAction') {?>
                                                        <a title="<?= $strings['Show Action']?>" href="ACTION_Controller.php?action=<?= $strings['Show']?>&id=<?= $this->actions[$j]['sm_idAction']?>"><?=$value?></a>                
                                                    <?php }else {
                                                        echo $value;
                                                    } ?>
                                                </td>
                                            <?php endif;
                                        endfor;
                                    endforeach;?>
                                        
                                    <td>
                                        <?php  if(checkRol('EDIT', 'ACTION')): ?>
                                            <a href="ACTION_Controller.php?action=<?= $strings['Edit']?>&accion=<?= $this->actions[$j]['sm_idAction']?>">
                                                <span title="<?= $strings['Edit Action']?>" class="btn btn-warning btn-sm fa fa-pencil"></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php  if(checkRol('DELETE', 'ACTION')): ?>
                                            <i title="<?= $strings['Delete Action']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?= $this->actions[$j]['sm_idAction']?>"></i>
                                            <div id="item-<?= $this->actions[$j]['sm_idAction']?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?= $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= sprintf($strings["Are you sure you want to delete the action \"%s\" ?"], $this->actions[$j]['sm_nameAction'] )?>
                                                            <p><?= $strings["The information that this action has will be lost"]?></p>
                                                        </div>
                                                        <form method="POST" action="ACTION_Controller.php?action=<?=$strings['Delete']?>">
                                                            <input type="hidden" name="action" value="<?=$this->actions[$j]['sm_idAction']?>" readonly>
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