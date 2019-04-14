<?php

class TEST_VIEW{
    private $testValues;

    function __construct($testValues) {
        $this->testValues = $testValues;
        $this->render();
    }

    function render() {

    ?>
    <!DOCTYPE html>
        <html lang="es">
            <head>
                <title>TEST</title>
                <link rel="shortcut icon" href="../img/favicon.png"/>
                <meta charset="utf-8"/>

                <link rel="stylesheet" href="../css/styleTFG.css">
                <!-- <link rel="stylesheet" href="../css/style.css"> -->

                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
                    crossorigin="anonymous"></script>
            </head>
    
            <body>
            <?php $listTitles = array('Functionality', 'Description', 'Expected', 'Result'); ?>

            <div class="container">
                <div class="row center-row">
                    <div class="col-lg-12 center-block">
                        <div id="titleView">
                            <h1>TEST</h1>
                        </div>
                        <table id="dataTable" class="table text-center">
                            <thead>
                                <tr>
                                    <?php foreach ($listTitles as $title): ?>
                                        <th scope="col"><?=$title?></th>
                                    <?php endforeach; ?>
                                </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($this->testValues as $test => $values) : 
                                    if($values['Expected'] == $values['Result']){ ?>
                                        <tr style="color: green; font-weight: bold;">
                                    <?php } else { ?>
                                        <tr style="color: red; font-weight: bold;">
                                    <?php } 
                                   
                                     foreach ($values as $key => $value) :
                                            for ($i = 0; $i < count($listTitles); $i++):
                                                if ($key === $listTitles[$i]) : ?>
                                                   <td >
                                                        <?= $value; ?>    
                                                    </td>
                                                <?php endif;
                                            endfor;
                                        endforeach;?>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
        } 
    }

?>