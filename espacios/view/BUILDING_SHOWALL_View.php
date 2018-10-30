<?php

class BUILDING_SHOWALL{
    private $buildings;
    private $popMessage;

    function __construct($buildings) {
        $this->buildings = $buildings;

        if(empty($_SESSION['popMessage'])){
            $this->popMessage = '';
        }else $this->popMessage = $_SESSION['popMessage'];

        $this->render();
    }

    function render() {
        include '../locate/Strings_' . $_SESSION['LANGUAGE'] . '.php';
        $listTitles = array('idBuilding', 'nameBuilding', 'addressBuilding', 'phoneBuilding', 'responsibleBuilding');
        ?> 

        <?php include 'header.php' ?>

        <?php if (!empty($this->popMessage)): ?>
            <div class="alert alert-success text-center" id="success-alert" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<?php echo $this->popMessage; unset($_SESSION['popMessage']);?>
            </div>
        <?php  endif; ?>

        <div class="container">
            <div class="row center-row">
                <div class="col-lg-12 center-block">
                    <div id="titleView">
                        <h1><?php echo $strings['Buildings'] ?></h1>
                    </div>
                    <div class="col-lg-12 center-block-content">
                        <table id="dataTable" class="table text-center">
                            <thead>
                                <tr>
                                    <?php foreach ($listTitles as $title): ?>
                                        <th scope="col"><?=$strings[$title]?></th>
                                    <?php endforeach; ?>
                                    <th scope="col"><a href="BUILDING_Controller.php?&action=<?php echo $strings['Add']?>">
                                    <span title="<?php echo $strings['Add Building']?>" class="btn btn-success btn-sm fa fa-plus"></span></a></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php for ($j = 0; $j < count($this->buildings); $j++) : ?>
                                    <tr>
                                        <?php foreach ($this->buildings [$j] as $key => $value) :
                                            for ($i = 0; $i < count($listTitles); $i++):
                                                if ($key === $listTitles[$i]) : ?>
                                                    <td>
                                                    <?php if ($key === 'idBuilding') {?>
                                                        <a title="<?php echo $strings['Show']?>" href='BUILDING_Controller.php?action=<?php echo $strings['Show']?>&building=<?php echo $this->buildings[$j]['idBuilding']?>'><?php echo $value?></a>                
                                                    <?php }else {
                                                        echo $value;
                                                    } ?>
                                                    </td>
                                                <?php endif;
                                            endfor;
                                        endforeach;?>
                                        
                                        <td>
                                            <a href="FLOOR_Controller.php?building=<?= htmlentities($this->buildings[$j]['idBuilding'])?>">
                                                <span title="<?php echo $strings['Show Floors']?>" class="btn btn-success btn-sm fa fa-building"></span></a>
                                            <a href="BUILDING_Controller.php?action=<?php echo $strings['Edit']?>&building=<?php echo $this->buildings[$j]['idBuilding']?>">
                                                <span title="<?php echo $strings['Edit Building']?>" class="btn btn-primary btn-sm fa fa-pencil"></span></a>
                                            <i title="<?php echo $strings['Delete Building']?>" class="btn btn-danger btn-sm fa fa-trash" data-toggle="modal" data-target="#item-<?= $this->buildings[$j]['idBuilding']?>"></i>
                                            <div id="item-<?= $this->buildings[$j]['idBuilding']?>" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <?php echo $strings["Attention"]?>
                                                        </div>
                                                        <div class="modal-body">
                                                            <?php echo $strings["Are you sure you want to delete this building?"]?>
                                                            <p><?php echo $strings["The information that this building has will be lost"]?></p>
                                                        </div>
                                                        <form method="POST" action="BUILDING_Controller.php?action=<?= htmlentities($strings['Delete'])?>">
                                                            <input type="hidden" name="building" value=<?php echo $this->buildings[$j]['idBuilding']?>>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $strings["Cancel"]?></button>
                                                                <button type="submit" name="submit" id="submit" class="btn btn-success success"><?php echo $strings["Ok"]?></button>
                                                            </div>
                                                        </form>
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