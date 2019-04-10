
<?php 
require_once(__DIR__.'..\..\model\USER_Model.php');

$errors = array();

$user = new USER_Model();
$errors['TEST1']=(['Description' => 'Test 2. Attempt to login without username.',
                'Expected' => 'ERROR',
                'Result' => 'Not executed']);

if($user->getUsername() == null){
    $errors["TEST1"]["Result"] = 'ERROR';
} else {
    $errors["TEST1"]["Result"] = 'OK';
}


$errors['TEST2']=(['Description' => 'Test 2. Attempt to login without password.',
                'Expected' => 'ERROR',
                'Result' => 'Not executed']);

if($user->getPassword() == null){
    $errors["TEST2"]["Result"] = 'ERROR';
} else {
    $errors["TEST2"]["Result"] = 'ERROR';
}


$user = new USER_Model('admin', '');
if($user->login()){
    array_push($errors,'ERROR. ' . $user->login());
}

// $user = new USER_Model('', 'admin');
// if($user->login()){
//     array_push($errors,'ERROR. ' . $user->login());
// }


foreach($errors as $error){

    if($error['Expected'] == $error['Result']){
        echo "\e[32m".$error['Description'] . " Expected: " .$error['Expected']. " Result: ". $error['Result'] ."\e[0m" .PHP_EOL;
    } else {
        echo "\e[31m".$error['Description'] . " Expected: " .$error['Expected']. " Result: ". $error['Result'] ."\e[0m" .PHP_EOL;
    }
}


?>