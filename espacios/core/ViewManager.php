<?php
// file: /core/ViewManager.php
/**
* Class ViewManager
*
* This class implements the glue between the controller
* and the view.
*
* This class is a singleton. You should use getInstance()
* to get the view manager instance.
*
* The main responsibilities are:
*
* 1.Save variables from the controller and make them available
*	 for views. This includes "flash" variables, which are
*	 variables kept in session that are removed just after
*	 they are retrieved. Use methods like setVariable, getVariable and
*	 setFlash.
*
* 2.Render views. This basically performs an 'include' of the view
*	 file, but with more MVC-oriented parameters
*	 (controller name and view name).
*
* 3.Layout (or templating) system. Based on PHP output buffers
*	 (ob_ functions). Once the view manager is initialized,
*	 the output buffer is enabled. By default, all contents that are
*	 generated inside your views will be saved in a DEFAULT_FRAGMENT.
*	 The DEFAULT_FRAGMENT is normally used as the "main" content of
*	 the resulting layout. However, you can generate contents for
*	 other fragments that will go into the layout. For example, inside
*	 your views, you have to call moveToFragment(fragmentName) before
*	 generating content for a desired fragment. This fragment normally
*	 will be after retrieved by the layout (via calls to getFragment).
*	 Typical fragments are 'css', 'javascript', so you can specify
*	 additional css and javascripts from your specific views.
*
* @author lipido <lipido@gmail.com>
*/



class ViewManager {

	public function __construct() {
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		
		if(!isset($_SESSION['LANGUAGE'])){
			$_SESSION['LANGUAGE'] = 'Castellano';
		}

		ob_start();
	}

	/// VARIABLES MANAGEMENT
	/**
	* Establishes a variable for the view
	*
	* Variables could be also kept in session (via $flash parameter)
	*
	* @param string $varname The name of the variable
	* @param any $value The value of the variable
	* @param boolean $flash If the variable value shoud be kept
	* in session
	*/
	public function setVariable($varName, $value, $flash=false) {
		$this->variables[$varName] = $value;
		if ($flash) {
			//a flash variable, will be stored in session_start
			if(!isset($_SESSION["__flash_variable__"])) {
				$_SESSION["__flash_variable__"][$varName] = $value;
				print_r($_SESSION["__flash_variable__"]);
			}else{
				$_SESSION["__flash_variable__"][$varName] = $value;
			}
		}
    }
    
    	/**
	* Retrieves a previously established variable.
	*
	* If the variable is a flash variable, it removes it
	* from the session after being retrieved
	*
	* @param string $varname The name of the variable
	* @param $default The value of the variable to return
	* if the variable does not exists
	* @return any value of the variable
	*/
	public function getVariable($varName, $default=NULL) {
		if (!isset($this->variables[$varName])) {
			if (isset($_SESSION["__flash_variable__"]) && isset($_SESSION["__flash_variable__"][$varName])){
				$toret=$_SESSION["__flash_variable__"][$varName];
				unset($_SESSION["__flash_variable__"][$varName]);
				return $toret;
			}
			return $default;
		}
		return $this->variables[$varName];
	}

	/**
	* Establishes a flash message
	*
	* Flash messages are useful to pass text from one page to other
	* via HTTP redirects, sinde they are kept in session.
	*
	* @param string $flashMessage The message to save into session
	* @return void
	*/
	public function setFlashSuccess($flashMessage) {
		$this->setVariable("flashmessageSuccess", $flashMessage, true);
	}
	/**
	* Retrieves the flash message (and pops it)
	*
	* @return string The flash message
	*/
	public function popFlashSuccess() {
		return $this->getVariable("flashmessageSuccess", "");
    }
    

    public function setFlashDanger($flashMessage) {
		$this->setVariable("flashmessageDanger", $flashMessage, true);
	}
	/**
	* Retrieves the flash message (and pops it)
	*
	* @return string The flash message
	*/
	public function popFlashDanger() {
		return $this->getVariable("flashmessageDanger", "");
	}

	/**
	* Sends an HTTP 302 redirection to a given action
	* inside a controller
	*
	* @param string $controller The name of the controller
	* @param string $action The name of the action
	* @param string $queryString An optional query string
	* @return void
    */
    
	public function redirect($controller, $action, $queryString=NULL) {
		if(empty($action)){
			header("Location: $controller");
		} else {
			header("Location: $controller?action=$action".(isset($queryString)?"$queryString":""));
		}
		die();		
    }


  public function setElement($element, $content){
    $buffer = ob_get_contents();
		ob_end_clean();
		$buffer=str_replace($element, $content, $buffer);
		echo $buffer;
    }
}
