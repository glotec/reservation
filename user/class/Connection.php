<?php
    namespace App;

    Class Connection {

        public static function getConnect()
        {
            if (!isset($db))
            {
                $dbhost = 'localhost';
                $port = 3306;
                $dbname = 'reservation';
                $dbuser = 'root';
                $dbpassword = '';

                try {
                    $db = new \PDO ('mysql:host=' . $dbhost . ';dbname=' . $dbname . ';port=' . $port, $dbuser, $dbpassword, 
                        array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING));
                } catch (\PDOException $e) {
                    echo "L'erreur suivante est survenue : " . $e->getMessage();

                }
                return $db;
                }
        }
    }
?>