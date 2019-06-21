
<?php
    class Connection {
        // private static $dbhost = "10.2.1.116";
        // private static $dbuser = "u716496248_infra";
        // private static $dbpass = "s0ft1nfr4";
        // private static $dbname = "u716496248_infra";
        // private static $dbcharset = "utf8";

        private static $dbhost = "127.0.0.1";
        private static $dbuser = "root";
        private static $dbpass = "";
        private static $dbname = "u716496248_infra";
        private static $dbcharset = "utf8";

    public static function connectionBD()
    {
        $mysqli = new mysqli(self::$dbhost, self::$dbuser, self::$dbpass, self::$dbname);
        $mysqli->set_charset(self::$dbcharset);
        if ($mysqli->connect_errno) {
            echo "Fail to connect to Mysql: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
        return $mysqli;
    }
}

?>