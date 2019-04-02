<?php

class GROUP_SHOWALL{
    private $groups;

    function __construct($groups) {
        $this->groups = $groups;
        $this->render();
    }

    function render() {

        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Groups"]);
        $listTitles = array('nameGroup', 'descripGroup'); ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?= $strings['Groups'] ?></h1>
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
                                <?php  if(checkRol('ADD', 'GROUP')): ?>
                                    <th scope="col">
                                        <a href="GROUP_Controller.php?action=<?= $strings['Add']?>">
                                            <span title="<?= $strings['Add Group']?>" class="btn btn-success btn-sm fa fa-plus"></span>
                                        </a>
                                    </th>
                                <?php endif; ?>
                            </tr>
                        </thead>

                        <tbody>
                            <?php for ($j = 0; $j < count($this->groups); $j++) : ?>
                                <tr>
                                    <?php foreach ($this->groups [$j] as $key => $value) :
                                        for ($i = 0; $i < count($listTitles); $i++):
                                            if ($key === $listTitles[$i]) : ?>
                                                <td>
                                                    <?php if ($key === 'nameGroup') {?>
                                                        <a title="<?= $strings['Show Group']?>" href='GROUP_Controller.php?action=<?= $strings['Show']?>&group=<?= $this->groups[$j]['idGroup']?>'><?= $value?></a>                
                                                    <?php }else {
                                                        echo $value;
                                                    } ?>
                                                </td>
                                            <?php endif;
                                        endfor;
                                    endforeach;?>
                                        
                                    <td>
                                <!--    <?php  if(checkRol('EDIT', 'GROUP')): ?> -->
                                            <a href="GROUP_Controller.php?action=<?= $strings['FindUsers']?>&group=<?= $this->groups[$j]['idGroup']?>">
                                                <span title="<?= $strings['Show Users']?>" class="btn btn-warning btn-sm fa fa-users"></span>
                                            </a>
                                <!--    <?php endif; ?> -->
                                        <?php  if(checkRol('EDIT', 'GROUP')): ?>
                                            <a href="GROUP_Controller.php?action=<?= $strings['Edit']?>&group=<?= $this->groups[$j]['idGroup']?>">
                                                <span title="<?= $strings['Edit Group']?>" class="btn btn-primary btn-sm fa fa-pencil"></span>
                                            </a>
                                        <?php endif; ?>
                                        <?php  if(checkRol('DELETE', 'GROUP')): ?>
                                            <i title="<?= $strings['Delete Group']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?= $this->groups[$j]['idGroup']?>"></i>
                                            <div id="item-<?= $this->groups[$j]['idGroup']?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?= $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?= sprintf($strings["Are you sure you want to delete the group \"%s\" ?"], $this->groups[$j]['nameGroup'] )?>
                                                            <p><?= $strings["The information that this group has will be lost"]?></p>
                                                        </div>
                                                        <form method="POST" action="GROUP_Controller.php?action=<?=$strings['Delete']?>">
                                                            <input type="hidden" name="group" value="<?=$this->groups[$j]['idGroup']?>" readonly>
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