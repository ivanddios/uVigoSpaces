<?php

require_once("../core/ConnectionBD.php");
require_once("../model/GROUP_Model.php");

/**
* Class SPACE_Model
*
* Represents a user
*
*/

class USER_Model {
    
    /**
    * Attributes:  
    *   @var string $email The user's email.
    *   @var string $password The user's password.  
    *   @var string $name. The user's name. 
    *   @var string $surname The space's surname.
    *   @var string $dni The user's dni.
    *   @var string $birthdate The user's birthdate. 
    *   @var int $phone The user's phone. 
    *   @var array $photo Image file of the user's photo. 
    *   @var string $dirPhoto The user's photo route on the server. 
    *   @var int $group The user's group. 
    *   @var mysqli $mysqli Connection with the database. 
    */

	private $email;
	private $password;
	private $name;
	private $surname;
	private $dni;
	private $birthdate;
	private $phone;
    private $photo;
    private $dirPhoto;
    private $group;
	private $mysqli;


    /**
	* The USER_Model constructor
	*
    * @param string $email The identifier of the user.
    * @param string $password The user's password.
    * @param string $name The user's name.
    * @param string $surname The user's surname.
    * @param string $dni The user's dni.
    * @param string $birthdate The user's birthdate.
    * @param int $phone The user's phone.
    * @param array $photo Image file of the user's photo.
    * @param int $group The user's group.
	*/
    public function __construct($email=null, $password=null, $name=null, $surname=null, $dni=null, $birthdate=null, $phone=null, $photo=null, $group=null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->name = $name;
        $this->surname = $surname;
        $this->dni = $dni;
        $this->birthdate = $birthdate;
        $this->phone = $phone;
        $this->photo = $photo;
        $this->group = $group;
        $this->dirPhoto = '../document/Users/'.$this->getEmail().'/';
        $this->mysqli = Connection::connectionBD();
    }


    /**
	* Gets the email of the user
	*
	* @return int The email of the user
	*/
    public function getEmail(){
        return $this->email;
    }

    /**
	* Gets the password of the user 
	*
	* @return string The email of the user
	*/
    public function getPassword(){
        return $this->password;
    }

    /**
	* Gets the group of the user 
	*
	* @return int The group of the user
	*/
    public function getGroup(){
        return $this->group;
    }

    /**
    * Gets name of the image of user's photo
    * or the file temporal of the image.
    *
    * @param $option @var string. Key to the associative array. 
    *
    * @return string When $option is 'name', return the name of image file,
    * when it's 'tmp_name' return the temporal image file.
	*/
    public function getPhoto($option=null){
        if($option !== null && isset($this->photo[$option])){
            return $this->photo[$option];
        } else {
            return $this->photo;
        }   
    }

    /**
	* Check if a user can access the system
    *
    * @return boolean true when the login is valid
    * and string with a error when the login is invalid
	*/
    public function login() {
        $errors = $this->checkLogin();
        if($errors === false){
            if($this->existsUserInSM()){
                $sql = "SELECT * FROM `USER` WHERE email = '$this->email'";
                $result = $this->mysqli->query($sql);
                if ($result->num_rows == 1) {
                    $tuple = $result->fetch_array();
                    if ($tuple['passwd'] == md5($this->password)) {
                        return true;
                    } else{
                        return "Password is incorrect";
                    }
                }
            }else {
                return "Not exists this account";
            }
        } else{
            return $errors;
        }

    }


    /**
    * Gets the lists of permissions for a user
    *
    * @return Feth array with the actions of each functionality 
    * for which the user has access based on their permission group
	*/
    public function getPermissions(){
        $sql ="SELECT DISTINCT A.sm_nameAction, F.sm_nameFunction 
                FROM `SM_GROUP` AS G, `SM_USER_GROUP` AS UG, `SM_PERMISSION` AS P, `SM_FUNCTIONALITY` AS F, `SM_ACTION` AS A 
                WHERE UG.sm_email = '$this->email' AND UG.sm_idGroup = G.sm_idGroup 
                    AND G.sm_idGroup = P.sm_idGroup
                    AND P.sm_idFunction = F.sm_idFunction AND P.sm_idAction = A.sm_idAction";
        $result = $this->mysqli->query($sql);  
        $j = 0;
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }

	/**
	* Retrieves all users
	*
	* @return mixed Fetch array with users and its values
	*/
    public function getAllUsers() {
        $sql = "SELECT U.* FROM `USER` AS U, `SM_USER` AS SMU WHERE U.email = SMU.sm_email";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }

    /**
	* Loads a user values from the database given its email
	*
	* @return Fetch array with a user's values or empty array
	* if the action isn't found
    */
    public function getUser() {
        $sql = "SELECT U.*, G.sm_nameGroup, G.sm_descripGroup 
                FROM `USER` AS U, `SM_USER` AS SMU, `SM_USER_GROUP` AS UG, `SM_GROUP` AS G 
                WHERE U.email = SMU.sm_email AND SMU.sm_email = '$this->email' AND SMU.sm_email = UG.sm_email AND UG.sm_idGroup = G.sm_idGroup";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $result = $resultado->fetch_array();
            return $result;
        }
    }


    /**
	* Saves a user into the database 
	*
    * @return true when the operations is successfully or
    * string with the error
    */
    public function addUser() {
        $errors = $this->checkIsValidForAdd();
        if($errors === false){
            if(!$this->existsUserInSM()){
                if(!$this->existsDNI()){
                    if(!$this->existsUser()){
                        $passwordBD = md5($this->password);
                        $dateBD = $this->formatDate($this->birthdate);
                        $photoBD =$this->dirPhoto.$this->getPhoto('name');
                        $sqlUser = "INSERT INTO `USER` VALUES ('$photoBD', '$this->email', '$passwordBD', '$this->name', '$this->surname', '$this->dni', '$dateBD', '$this->phone')";
                        if (!($resultado = $this->mysqli->query($sqlUser))) {
                            return 'Error in the query on the database';
                        }   
                    }
                    }else{
                        return 'There is another user with that DNI in the DB';
                    }
                $sqlSM_USER = "INSERT INTO `SM_USER` VALUES ('$this->email')";
                if (!($resultado = $this->mysqli->query($sqlSM_USER))) {
                    return 'Error in the query on the database';
                } else {
                    if($this->addRoleUser() === true){
                        $this->updateDirPhoto();
                        return true;
                    }else {
                        return 'Error in the query on the database';
                    }
                }  
            }else{
                return 'This user already is in Spaces application';
            }  
        }else {
            return $errors;
        }
    }


    /**
	* Updates all user's values in the database (ADMIN)
    *
    * @param string $emailOriginal The original email of the user
    * because it's posible modify its email
    *
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function updateUser($emailOriginal) {
       
        $errors = $this->checkIsValidForEdit($emailOriginal);
        if($errors === false){
            if($this->email !== $emailOriginal){
                $this->deleteDirPhoto($emailOriginal);
            }
            $dateBD = $this->formatDate($this->birthdate);
            if($this->getPhoto('name') == '' && empty($this->password)){
                $sql = "UPDATE `USER` SET name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$emailOriginal'";  
            }else if($this->getPhoto('name') == '' && !empty($this->password)){
                $passwordBD = md5($this->password);
                $sql = "UPDATE `USER` SET passwd = '$passwordBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$emailOriginal'";  
            }else if($this->getPhoto('name') !== '' && empty($this->password)){
                $photoBD =$this->dirPhoto.$this->getPhoto('name');
                $sql = "UPDATE `USER` SET photo = '$photoBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$emailOriginal'";
                $this->updateDirPhoto();
            } else {
                $passwordBD = md5($this->password);
                $photoBD =$this->dirPhoto.$this->getPhoto('name'); 
                $sql = "UPDATE `USER` SET photo = '$photoBD', passwd = '$passwordBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', email = '$this->email', phone = '$this->phone' WHERE email = '$emailOriginal'";
                $this->updateDirPhoto(); 
            }
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                $sqlGroup = "UPDATE `SM_USER_GROUP` SET sm_idGroup = '$this->group' WHERE sm_email = '$this->email'";
                if (!($resultado = $this->mysqli->query($sqlGroup))) {
                    return 'Error in the query on the database';
                }
                return true;
            }
        } else {
            return $errors;
        }
    }

    /**
	* Updates a user's some values in the database (Any user)
    *
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function updateUserProfile() {
            $errors = $this->checkIsValidForEditProfile();
            if($errors === false){
                $dateBD = $this->formatDate($this->birthdate);
            if($this->getPhoto('name') == '' && empty($this->password)){
                $sql = "UPDATE `USER` SET  name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', phone = '$this->phone' WHERE email = '$this->email'";  
            }else if($this->getPhoto('name') == '' && !empty($this->password)){
                $passwordBD = md5($this->password);
                $sql = "UPDATE `USER` SET  passwd = '$passwordBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', phone = '$this->phone' WHERE email = '$this->email'";  
            }else if($this->getPhoto('name') !== '' && empty($this->password)){
                $photoBD =$this->dirPhoto.$this->getPhoto('name');
                $sql = "UPDATE `USER` SET photo = '$photoBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', phone = '$this->phone' WHERE email = '$this->email'";
                $this->deleteDirPhoto($this->email);
                $this->updateDirPhoto();
            } else {
                $passwordBD = md5($this->password);
                $photoBD =$this->dirPhoto.$this->getPhoto('name'); 
                $sql = "UPDATE `USER` SET  photo = '$photoBD', passwd = '$passwordBD', name = '$this->name', surname = '$this->surname', dni = '$this->dni', birthdate = '$dateBD', phone = '$this->phone' WHERE email = '$this->email'";
                $this->deleteDirPhoto($this->email);
                $this->updateDirPhoto();
            }
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;
        }
    }


    /**
	* Checks if it's possible change the user's email checking 
    * if the new email already exists in database
    *
    * @return false when the new space's identifier doesn't exists in database  
    * and string with errors when it exists in database
	*/
    public function existsUserForEdit($emailOriginal) {
        $sql = "SELECT email
                FROM `USER` 
                WHERE email NOT IN (
                                        SELECT email 
                                        FROM `USER` 
                                        WHERE email='$emailOriginal'
                                        )
                AND email = '$this->email'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }

            foreach($toret as $space){
                if($space['email'] == $this->email){
                    return false;
                }
            }
            return true;
        }
    }

    /**
    * Deletes a user's access to the system
    * but keeps its values 
	*
	* @return true when the operations is successfully or
    * string with the error
	*/
    public function deleteUser() {
        $errors = $this->checkIsValidForDelete();
        if($errors === false){
            $this->deleteDirPhoto($this->email);
            $sql = "DELETE FROM `SM_USER` WHERE sm_email ='$this->email'";
            if (!($resultado = $this->mysqli->query($sql))) {
                return 'Error in the query on the database';
            } else {
                return true;
            }
        } else {
            return $errors;;
        }
    }


    /**
	* Retrieves all users that match with user's instance values
	*
    * @return mixed Fetch array with users and its values or
    * empty array if no user matches with the values
	*/
    public function searchUser() {

        $dateBD = $this->formatDate($this->birthdate);
        if($this->group !== '0'){
            $sqlUser = "SELECT DISTINCT U.* FROM `USER` AS U, `SM_USER` AS SMU, `SM_USER_GROUP` AS SMUG 
            WHERE U.email LIKE '%$this->email%' 
                AND U.name LIKE '%$this->name%' 
                AND U.surname LIKE '%$this->surname%' 
                AND U.dni LIKE '%$this->dni%' 
                AND U.birthdate LIKE '%$this->birthdate%' 
                AND U.phone LIKE '%$this->phone%' 
                AND U.email = SMU.sm_email
                AND SMU.sm_email = SMUG.sm_email
                AND SMUG.sm_idGroup = '$this->group'";
        } else{
            $sqlUser = "SELECT DISTINCT U.* FROM `USER` AS U, `SM_USER` AS SMU, `SM_USER_GROUP` AS SMUG 
            WHERE U.email LIKE '%$this->email%' 
                AND U.name LIKE '%$this->name%' 
                AND U.surname LIKE '%$this->surname%' 
                AND U.dni LIKE '%$this->dni%' 
                AND U.birthdate LIKE '%$this->birthdate%' 
                AND U.phone LIKE '%$this->phone%'
                AND U.email = SMU.sm_email ";
        }
        
        if (!($resultado = $this->mysqli->query($sqlUser))) {
            return 'Error in the query on the database';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }



    /**
	* Saves the user's group
	*
    * @return true when the operations is successfully or
    * string with the error
    */
    public function addRoleUser() {
        $sql = "INSERT INTO `SM_USER_GROUP` VALUES ('$this->email','$this->group')";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            return true;
        }
    }


    /**
	* Gets the user photo route on the server
	*
    * @return string with the photo route or NULL if 
    * the photo route isn't found
	*/
    public function getLinkProfilePhoto($email) {
        $sql = "SELECT photo FROM `USER` WHERE email='$email'";
        $result = $this->mysqli->query($sql)->fetch_array();
        return $result['photo'];
    }

    /**
	* Format the birthdate to 'YYY-MM-DD'
    *
    * @param string $date The user's birthdate in format 'DD/MM/YYYY'
    *
    * @return date
	*/
    public function formatDate($date){
        $dateFormat = str_replace('/', '-', $date);
        $dateFormat = date('Y-m-d', strtotime($dateFormat));
        return $dateFormat;
    }


    /**
	* Updates the photo file in server
    *
    * @return void
	*/
    public function updateDirPhoto() {
        if (!is_dir($this->dirPhoto)) {
            mkdir($this->dirPhoto, 0777, true);
        }

        if ($this->getPhoto('name') !== '') {
            move_uploaded_file($this->getPhoto('tmp_name'), $this->dirPhoto.$this->getPhoto('name'));
        }
    }

    /**
	* Deletes the photp directory in server
    *
    * @return void
	*/
    public function deleteDirPhoto($email) {

        if(is_file($this->getLinkProfilePhoto($email))){
            unlink($this->getLinkProfilePhoto($email));
        }
        
        if(is_dir('../document/Users/'.$email.'/')){
            return (rmdir('../document/Users/'.$email.'/'));
        }
    }


    /**
	* Retrieve all users that have a group of permissions
	*
    * @return mixed Fetch array with users and its values or
    * empty array if no user 
	*/
    public function getUsersForGroup() {
        $sql = "SELECT U.* FROM `USER` AS U, `SM_USER` AS SMU, `SM_USER_GROUP`AS SMUG, `SM_GROUP` AS SMG 
                WHERE U.email = SMU.sm_email AND SMU.sm_email = SMUG.sm_email AND SMUG.sm_idGroup = SMG.sm_idGroup 
                AND SMG.sm_idGroup = '$this->group'";
        if (!($resultado = $this->mysqli->query($sql))) {
            return 'Error in the query on the database';
        } else {
            $toret = array();
            $i = 0;
            while ($fila = $resultado->fetch_array()) {
                $toret[$i] = $fila;
                $i++;
            }
            return $toret;
        }
    }

    /**
	* Checks if a user exists in database (Table USER ->Common for others systems)
    *
    * @return boolean true when the user is in database and false
    * when it isn't in database 
	*/
    public function existsUser() {
        $sql = "SELECT * FROM `USER` WHERE email = '$this->email'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
	* Checks if a user exists in database (Table SM_USER ->Specific for this system)
    *
    * @return boolean true when the user is in database and false
    * when it isn't in database 
	*/
    public function existsUserInSM() {
        $sql = "SELECT * FROM `SM_USER` WHERE sm_email = '$this->email'";
        $result = $this->mysqli->query($sql);
        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    /**
	* Checks if a user's dni already is in database
    *
    * @return boolean true when the user's dni is in database and false
    * when it isn't in database 
	*/
    public function existsDNI() {
        $sqlDNI = "SELECT * FROM `USER` WHERE dni = '$this->dni'";
        $resultDNI = $this->mysqli->query($sqlDNI);
        if ($resultDNI->num_rows == 0) {
            $sqlDNIforEmail = "SELECT * FROM `USER` WHERE email = '$this->email' AND dni = '$this->dni'";
            $resultDNIforEmail = $this->mysqli->query($sqlDNIforEmail);
            if ($resultDNIforEmail->num_rows == 1) {
                return true;
            } else{
                return false;
            }
        } else {
            return true;
        }
    }

    /**
	* Checks if a user's dni's format is valid
    *
    * @return boolean true when the user's dni is valid and false
    * when it isn't valid 
	*/
    public function validateletterDNI($dni) {
        $letterDNI = substr($dni, -1, 1);
        $numberDNI = substr($dni, 0, 8);
    
        $mod = $numberDNI % 23;
        $validLetters = "TRWAGMYFPDXBNJZSQVHLCKE";
        $letterCorrect = substr($validLetters, $mod, 1);

        if (strtoupper($letterDNI) != strtoupper($letterCorrect)) {
            return false;
        } else {
            return true;
        }
    }


    /**
	* Checks if a user's birthdate's format is valid
    *
    * @return boolean true when the user's birthdate is valid and false
    * when it isn't valid 
	*/
    public function validateDate($date){
        $day = (int) substr($date, 0, 2);
        $month = (int) substr($date, 3, 2);
        $year = (int) substr($date, 6, 12);
        $currentDate = date("d/m/Y");
        $currentYear = (int) substr($currentDate, 6, 12);

        if(checkdate($month, $day, $year) && ($currentYear > $date)){
            return true;
        } else {
            return false;
        }
    }
    


    /**
	* Checks if the current user's instance is valid
	* for being logged in the system
	*
    * @return false when the user's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkLogin(){
        $errors = false;

        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if(!$this->existsUser()){
            $errors = "There isn't a user with that email";
        }else if (strlen(trim($this->password)) == 0 ) {
            $errors= "Password is mandatory";
        }else if (strlen(trim($this->password)) < 8) {
            $errors = "Password can't be less than 8 characters";
        }else if (strlen(trim($this->password)) > 16 ) {
            $errors = "Password can't be larger than 16 characters";
        }else if(!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,15}$/', $this->password)){
            $errors = "Password format is invalid";
        }
        return $errors;
    }

    /**
	* Checks if the current user's instance is valid
	* for being added in the database
	*
    * @return false when the user's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForAdd() {
        $errors = false;
        $group = new GROUP_Model($this->group);
        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if($this->existsUserInSM()){
            $errors = "There is already a user with that email in this aplication";
        }else if (strlen(trim($this->password)) == 0) {
            $errors= "Password is mandatory";
        }else if (strlen(trim($this->password)) < 8) {
            $errors = "Password can't be less than 8 characters";
        }else if (strlen(trim($this->password)) > 16 ) {
            $errors = "Password can't be larger than 16 characters";
        }else if(!preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,15}$/', $this->password)){
            $errors = "Password format is invalid";
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can't be larger than 40 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name format is invalid";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can't be larger than 100 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames format is invalid";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "NID can't be different from 9 characters";;
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User NID format is invalid";
        }else if(!$this->validateletterDNI($this->dni)){
            $errors = "User NID letter is incorrect";
        }else if(strlen(trim($this->birthdate)) == 0){
            $errors = "Birthdate is mandatory";
        }else if(strlen(trim($this->birthdate)) > 10){
            $errors = "Birthdate can't be larger than 10 characters";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate format is invalid";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone size is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid";
        }else if(!preg_match('/^\d+$/', $this->group)){
            $errors = "The role format is invalid";
        }else if(!$group->existsGroup()){
            $errors = "The role doesn't exist";
        }else if($this->getPhoto('name') !== null && $this->getPhoto('name') !== ''){
            var_dump($this->getPhoto('name'));
            exit();
            $extension = explode('.', $this->getPhoto('name'));
            if($extension[1] !== 'jpg' || $extension[1] !== 'jpeg' || $extension[1] !== 'png'){
                $errors = "The image extension is incorrect";
            }
        }
       return $errors;
    }


    /**
	* Checks if the current user's instance is valid
	* for being modified in the database
    *
    * @param string $emailOriginal The original email of user before
    * the operation
    *
    * @return false when the user's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForEdit($emailOriginal) {
        $errors = false;
        $group = new GROUP_Model($this->group);
        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if(!$this->existsUserForEdit($emailOriginal)){
            $errors = "There is a user with that email";
        }else if($this->password !== '' && strlen(trim($this->password)) < 8) {
            $errors =  "Password can't be less than 8 characters";
        }else if($this->password !== '' && strlen(trim($this->password)) > 16) {
            $errors = "Password can't be larger than 16 characters";
        }else if($this->password !== '' && !preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,15}$/', $this->password)){
            $errors = 'Password format is invalid';
        }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can't be larger than 40 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name format is invalid";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can't be larger than 100 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames format is invalid";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "NID can't be different from 9 characters";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User NID format is invalid";
        }elseif(!$this->validateletterDNI($this->dni)){
            $errors = "User NID letter is incorrect";
        }else if(strlen(trim($this->birthdate)) == 0){
            $errors = "Birthdate is mandatory";
        }else if(strlen(trim($this->birthdate)) > 10){
            $errors = "Birthdate can't be larger than 10 characters";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate format is invalid";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone size is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid";
        }else if(!preg_match('/^\d+$/', $this->group)){
            $errors = "The role format is invalid";
        }else if(!$group->existsGroup()){
            $errors = "The role doesn't exist";
        }else if($this->getPhoto('name') !== null && $this->getPhoto('name') !== ''){
            $extension = explode('.', $this->getPhoto('name'));
            if($extension[1] !== 'jpg' && $extension[1] !== 'jpeg' && $extension[1] !== 'png'){
                $errors = "The image extension is incorrect";
            }
        }
       return $errors;      
    }


    /**
	* Checks if the current user's instance is valid
	* for being modified in the database
    *
    * @return false when the user's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForEditProfile() {

        $errors = false;
        $group = new GROUP_Model($this->group);


        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if(!$this->existsUser($this->email)){
            $errors = "There isn't a user with that email";
        }else if($this->password !== '' && strlen(trim($this->password)) < 8) {
            $errors =  "Password can't be less than 8 characters";
         }else if($this->password !== '' && strlen(trim($this->password)) > 16) {
             $errors = "Password can't be larger than 16 characters";
         }else if($this->password !== '' && !preg_match('/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,15}$/', $this->password)){
                 $errors = 'Password format is invalid';
         }else if (strlen(trim($this->name)) == 0 ) {
            $errors= "User name is mandatory";
        }else if (strlen(trim($this->name)) > 40 ) {
            $errors = "User name can't be larger than 40 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->name)){
            $errors = "User name format is invalid";
        }else if (strlen(trim($this->surname)) == 0 ) {
            $errors= "User surnames are mandatory";
        }else if (strlen(trim($this->surname)) > 100 ) {
            $errors = "User surnames can't be larger than 100 characters";
        }else if(!preg_match('/[A-Za-zñÑ-áéíóúÁÉÍÓÚ\s\t-]/', $this->surname)){
            $errors = "User surnames format is invalid";
        }else if (strlen(trim($this->dni)) != 9 ) {
            $errors= "NID can't be different from 9 characters";
        }else if (!preg_match('/^\d{8}[a-zA-Z]$/', $this->dni)) {
            $errors = "User NID format is invalid";
        }elseif(!$this->validateletterDNI($this->dni)){
            $errors = "User NID letter is incorrect";
        }else if(strlen(trim($this->birthdate)) == 0){
            $errors = "Birthdate is mandatory";
        }else if(strlen(trim($this->birthdate)) > 10){
            $errors = "Birthdate can't be larger than 10 characters";
        }else if(!$this->validateDate($this->birthdate)){
            $errors = "Birthdate format is invalid";
        }else if (strlen(trim($this->phone)) != 9 ) {
            $errors= "User phone size is incorrect";
        }else if(!preg_match('/^[9|6|7][0-9]{8}$/', $this->phone)){
            $errors = "User phone format is invalid";
        }
       return $errors;      
    }

    
    /**
	* Checks if the current user's instance is valid
	* for being deleted to database
    *
    * @return false when the user's values are valids or
    * string with the error when some value is wrong
	*/
    public function checkIsValidForDelete() {

        $errors = false;

        if (strlen(trim($this->email)) == 0) {
            $errors= "Email is mandatory";
        }else if (strlen(trim($this->email)) > 50 ) {
            $errors= "Email can't be larger than 50 characters";
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $errors = "Email format is invalid";
        }else if(!$this->existsUser()){
            $errors = "There isn't a user with that email";
        }

       return $errors;      
    }

}

?>
