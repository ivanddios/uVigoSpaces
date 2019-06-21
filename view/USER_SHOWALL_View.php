<?php

class USER_SHOWALL{
    private $users;

    function __construct($users) {
        $this->users = $users;

        $this->render();
    }

    function render() {
        
        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Users"]); 
        $listTitles = array('photo', 'email', 'name', 'surname', 'dni');?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <?php if(count($this->users) > 0): ?>
                        <div id="titleView">
                            <h1><?= $strings['Users'] ?></h1>
                        </div>
                   
                        <div id="pnlBoxSearch">
                            <input type="text" id="searchBox" onkeyup="searchInTable()" placeholder="<?= $strings["Search"]?>">
                        </div>

                        <table id="dataTable" class="table text-center">
                            <thead>
                                <tr>
                                    <?php foreach ($listTitles as $title): 
                                        if($title == "photo"): ?>
                                            <th scope="col">
                                        <?php else: ?>
                                            <th scope="col"><?=$strings[$title]?></th>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if(isset($_SESSION['LOGIN'])): ?>
                                        <th scope="col">
                                            <?php  if(checkRol('ADD', 'USER')): ?>
                                                <a href="USER_Controller.php?action=Add">
                                                    <span title="<?= $strings['Add User']?>" class="btn btn-success btn-sm fa fa-plus"></span>
                                                </a>
                                            <?php endif; ?>
                                            <?php  if(checkRol('SEARCH', 'USER')): ?>    
                                                <a href="USER_Controller.php?action=Search">
                                                    <span title="<?= $strings['Search User']?>" class="btn btn-info btn-sm fa fa-search"></span>
                                                </a>
                                            <?php endif; ?>
                                        </th>
                                    <?php endif; ?>
                                </tr>
                            </thead>

                            <tbody>
                                <?php for ($j = 0; $j < count($this->users); $j++) : ?>
                                    <tr>
                                        <?php foreach ($this->users [$j] as $key => $value) :
                                            for ($i = 0; $i < count($listTitles); $i++):
                                                if ($key === $listTitles[$i]) : ?>
                                                    <td>
                                                        <?php if ($key === 'photo') {
                                                                if (is_file($value)) {?>
                                                                    <a target='_blank' href='<?= $value?>'>
                                                                        <img src='<?= $value?>' class='avatarUser'>
                                                                    </a> 
                                                                <?php } else { ?>
                                                                    <img src="../view/img/notUser.jpg" class='avatarUser'>
                                                                <?php } 
                                                        } elseif ($key === 'email') {?>
                                                            <a title="<?= $strings['Show User']?>" href='USER_Controller.php?action=Show&user=<?= $this->users[$j]['email']?>'><?= $value?></a>                
                                                        <?php }else { ?>
                                                            <?= $value;
                                                        } ?>
                                                    </td>
                                                <?php endif;
                                            endfor;
                                        endforeach;?>
                                            
                                        <td>
                                            <?php  if(checkRol('EDIT', 'USER')): ?>
                                                <a href="USER_Controller.php?action=Edit&user=<?= $this->users[$j]['email']?>">
                                                    <span title="<?= $strings['Edit User']?>" class="btn btn-warning btn-sm fa fa-pencil"></span>
                                                </a>
                                            <?php endif; ?>
                                            <?php  if(checkRol('DELETE', 'USER')): ?>
                                                <i title="<?= $strings['Delete User']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?= $this->users[$j]['dni']?>"></i>
                                                <div id="item-<?= $this->users[$j]['dni']?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <?= $strings["Attention"]?>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?= sprintf($strings["Are you sure you want to delete the user \"%s\" ?"], $this->users[$j]['email'] )?>
                                                                <p><?= $strings["The information that this user has will be lost"]?></p>
                                                            </div>
                                                            <form method="POST" action="USER_Controller.php?action=Delete">
                                                                <input type="hidden" name="email" value="<?= $this->users[$j]['email']?>" readonly>
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
                    <?php else: ?>
                    <div id="messageView">
                        <h1><?=$strings['No User']?></h1>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php
        include 'footer.php';  
    } 
}

?>