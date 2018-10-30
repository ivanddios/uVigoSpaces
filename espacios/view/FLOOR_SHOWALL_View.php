<?php

class FLOOR_SHOWALL{
    private $floors;
    private $popMessage;

    function __construct($floors) {
        $this->floors = $floors;
        if(empty($_SESSION['popMessage'])):
            $this->popMessage = '';
        else: 
            $this->popMessage = $_SESSION['popMessage'];
        endif;
        $this->render();
    }

    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
        $listTitles = array('idBuilding', 'nameFloor', 'planeFloor', 'surfaceBuildingFloor', 'surfaceUsefulFloor');?> 

        <?php include 'header.php' ?>

        <?php if (!empty($this->popMessage)): ?>
            <div class="alert alert-success text-center" id="success-alert" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->popMessage; $_SESSION['popMessage'] = '';?>
            </div>
        <?php endif; ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?php echo $strings['nameBuilding']; echo " "; echo $_GET['building']; ?></h1>
                    </div>
                    <div id="subtitleView">
                        <?php //////////////////////////////////////////////////?>
                        <?php echo "Información sobre las plantas del edificio" ?>
                    </div>
                    <div class="col-lg-12 center-block-content">
                        <table id="dataTable" class="table text-center">
                            <thead>
                                <tr>
                                    <?php foreach ($listTitles as $title): ?>
                                        <th scope="col"><?=$strings[$title]?></th>
                                    <?php endforeach; ?>
                                    <th scope="col"><a href="FLOOR_Controller.php?&action=<?php echo $strings['Add']?>&building=<?php echo $_GET['building']?>"><span title="<?php echo $strings['Add Floor']?>" class="btn btn-success btn-sm fa fa-plus"></span></a></th>
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
                                                            <a title="<?php echo $strings['Show']?>" href='FLOOR_Controller.php?action=<?php echo $strings['Show']?>&building=<?php echo $this->floors[$j]['idBuilding']?>&floor=<?php echo $this->floors[$j]['idFloor']?>'> <?php echo $this->floors[$j]['idBuilding'].$this->floors[$j]['idFloor']?></a> 
                                                        <?php elseif($key === 'planeFloor'): ?>
                                                            <?php if($value === ''): ?>
                                                                <img src="../img/noPlane.png" width="25px" height="25px">
                                                            <?php else: ?>
                                                                <a href="<?php echo $this->floors[$j]['planeFloor']?>" target="_blank"><img src="<?php echo $this->floors[$j]['planeFloor']?>" alt="plane" class="logo"></a>
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
                                            <a href="SPACE_Controller.php?&building=<?php echo $this->floors[$j]['idBuilding']?>&floor=<?php echo $this->floors[$j]['idFloor']?>">
                                                <span title="<?php echo $strings['Show Space']?>" class="btn btn-success btn-sm fa fa-cube"></span></a>
                                            <a href="FLOOR_Controller.php?action=<?php echo $strings['Edit']?>&building=<?php echo $this->floors[$j]['idBuilding']?>&floor=<?php echo $this->floors[$j]['idFloor']?>">
                                                <span title="<?php echo $strings['Edit Building']?>" class="btn btn-primary btn-sm fa fa-pencil"></span></a>
                                            <i title="<?php echo $strings['Delete Building']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?=$this->floors[$j]['idFloor']?>"></i>
                                            <div id="item-<?=$this->floors[$j]['idFloor']?>" class="modal fade"  tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?php echo $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $strings["Are you sure you want to delete this floor?"]?><br/> <br>
                                                            <b><strong><?php echo $strings["The information that this floor has will be lost"]?></strong></b>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="POST" action="FLOOR_Controller.php?action=<?= htmlentities($strings['Delete'])?>&building=<?= htmlentities($this->floors[$j]['idBuilding'])?>&floor=<?php echo $this->floors[$j]['idFloor']?>">
                                                                    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $strings["Cancel"]?></button>
                                                                    <button type="submit" name="submit" class="btn btn-success success"><?php echo $strings["Ok"]?></button> 
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