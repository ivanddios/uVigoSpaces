<?php


/**
* Class ViewManager
*
* Manager between the views and controllers
*
*/

class ViewManager {

	/**
    * Attributes:  
	*   @var array $variables Array of sytem variables  
    *   @var string DEFAULT_LANGUAGE Default language
	*/
	
	private $variables;
	const DEFAULT_LANGUAGE="Castellano";
	
	/**
	* The ViewManager constructor create a session and set default language
	*/
	public function __construct() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(!isset($_SESSION['LANGUAGE'])){
			$_SESSION['LANGUAGE'] = self::DEFAULT_LANGUAGE;
		}
		ob_start();
	}

	/**
	* Sets some value in the view.
	* Used in this project to set the title of views
	*
	* @param html_element HTML element to edit
	* @param string Content to add to the HTML element
	* 
	* @return void
	*/
	public function setElement($element, $content){
    	$buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace($element, $content, $buffer);
		echo $buffer;
	}

	/**
	* Sets content of session's variables.
	*
	* @param string $varName Session's variable name
	* @param string $value Session's variable content
	* 
	* @return void
	*/
	public function setVariableSession($varName, $value) {
		$_SESSION[$varName] = $value;
	}


	/**
	* Sets session's variables with flash messages
	*
	* @param string $varName Session's variable type (success, danger)
	* @param string $value Session's variable message content
	* 
	* @return void
	*/
	public function setVariable($varName, $value) {
		$this->variables[$varName] = $value;
		$_SESSION["flashVariable"][$varName] = $value;
  	}


	/**
	* Gets and unsets variables flash messages
	*
	* @param string $varName Session's variable type (success, danger)
	* 
	* @return void
	*/
	public function getVariable($varName) {
		if (!isset($this->variables[$varName])) {
			if (isset($_SESSION["flashVariable"]) && isset($_SESSION["flashVariable"][$varName])){
				$var = $_SESSION["flashVariable"][$varName];
				unset($_SESSION["flashVariable"][$varName]);
				return $var;
			}
			return null;
		}
		return $this->variables[$varName];
	}


	/**
	* Sets a success message
	*
	* @param string $flashMessage message
	* 
	* @return void
	*/
	public function setFlashSuccess($flashMessage) {
		$this->setVariable("flashMessageSuccess", $flashMessage);
	}

	/**
	* Gets a success message
	*
	* @return string message 
	*/
	public function popFlashSuccess() {
		return $this->getVariable("flashMessageSuccess");
  }
    

  	/**
	* Sets a danger message
	*
	* @param string $flashMessage message
	* 
	* @return void
	*/
  public function setFlashDanger($flashMessage) {
		$this->setVariable("flashMessageDanger", $flashMessage);
	}

	/**
	* Gets a danger message
	*
	* @return string message 
	*/
	public function popFlashDanger() {
		return $this->getVariable("flashMessageDanger");
	}


	/**
	* Redirects to a controller with action (optional) and other data (optional)
	*
	* @param string $controller Controller to which redirects
	* @param string $action option in the controller (optional)
	* @param string $queryString option in the action (option)
	* 
	* @return void
	*/
	public function redirect($controller, $action=null, $queryString=null) {
		if(empty($action)){
			header("Location: $controller");
		} else {
			if(!isset($queryString)){
				header("Location: $controller?action=$action");
			} else {
				header("Location: $controller?action=$action&$queryString");
			}
		}
		die();		
	}


	/**
	* Checks if a user logged can access a one functionality action
	*
	* @param string $action action
	* @param string $funcion functionality
	* 
	* @return bolean
	*/
	public function checkRol($action, $funcion){
		if(isset($_SESSION['PERMISSIONS'])){
			$permissions = $_SESSION['PERMISSIONS'];
			for($i=0; $i<count($permissions);$i++){
				if(($permissions[$i][0] == $action) && ($permissions[$i][1] == $funcion)){
					return true;
				}
			}
		} else {
			return false;
		}	
		return false;
	}

	
}
