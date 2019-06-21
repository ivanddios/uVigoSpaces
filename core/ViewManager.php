<?php
// file: /core/ViewManager.php

class ViewManager {

	private $variables = array();
	const DEFAULT_LANGUAGE="Castellano";
	
	public function __construct() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(!isset($_SESSION['LANGUAGE'])){
			$_SESSION['LANGUAGE'] = self::DEFAULT_LANGUAGE;
		}

		ob_start();
	}

	 public function setElement($element, $content){
    	$buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace($element, $content, $buffer);
		echo $buffer;
	}

	public function setVariable($varName, $value) {
		$this->variables[$varName] = $value;
		$_SESSION["flashVariable"][$varName] = $value;
  }
    

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


	public function setFlashSuccess($flashMessage) {
		$this->setVariable("flashMessageSuccess", $flashMessage);
	}

	public function popFlashSuccess() {
		return $this->getVariable("flashMessageSuccess");
  }
    

  public function setFlashDanger($flashMessage) {
		$this->setVariable("flashMessageDanger", $flashMessage);
	}

	public function popFlashDanger() {
		return $this->getVariable("flashMessageDanger");
	}


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
	
 
	
}
