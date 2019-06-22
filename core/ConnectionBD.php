
<?php

/**
* Class Connection
*
* Connection with the database
*
*/

class Connection {
    
    /**
    * Attributes:  
	*   @var string $dbhost The host of databse.  
    *   @var string $dbuser The user of database. 
    *   @var string $dbpass The user's pass of database 
    *   @var string $dbname The database name. 
    *   @var string $dbcharset The coding of the database
    */

    private static $dbhost = "127.0.0.1";
    private static $dbuser = "uvigoSpaces";
    private static $dbpass = "uvigoSpacesPass";
    private static $dbname = "uVigoSpaces";
    private static $dbcharset = "utf8";

    /**
	* Gets a instance to connect with the datase
	*
	* @return mysqli
	*/
    public static function connectionBD(){
        $mysqli = new mysqli(self::$dbhost, self::$dbuser, self::$dbpass, self::$dbname);
        $mysqli->set_charset(self::$dbcharset);
        if ($mysqli->connect_errno) {
            echo "Fail to connect to Mysql: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        return $mysqli;
    }
}

?>