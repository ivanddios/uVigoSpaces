<?php

class TEST_VIEW{
    private $testValues;
    private $totalTests;
    private $testsValids;
    private $testsInvalids;

    function __construct($testValues, $totalTests, $testsValids, $testsInvalids) {
        $this->testValues = $testValues;
        $this->totalTests = $totalTests;
        $this->testsValids = $testsValids;
        $this->testsInvalids = $testsInvalids;
        $this->render();
    }

    function render() {

        include 'header.php';
        $this->view->setElement("%TITLE%", $strings["Tests"]); ?>
        <?php $listTitles = array('Functionality', 'Description', 'Expected', 'Result'); ?>
            <div class="container">
                <div class="row center-row">
                    <div class="col-lg-12 center-block">
                        <div id="titleView">
                            <h1>TESTING SPACES MANAGER</h1>
                        </div>
                    
                        <div class="resume-tests" style="margin-left:auto;margin-right:auto;margin-top:2%;">
                            <label class="resume">Total Tests: <?= $this->totalTests ?></label>
                            <label class="test-valid">Valid: <?= $this->testsValids ?></label>
                            <label class="test-invalid">Invalid: <?= $this->testsInvalids ?></label>
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
                                    if($values['Expected'] === $values['Result']){ ?>
                                        <tr class="test-valid">
                                    <?php } else { ?>
                                        <tr class="test-invalid">
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
        <?php  include 'footer.php';  
    } 
}

?>
