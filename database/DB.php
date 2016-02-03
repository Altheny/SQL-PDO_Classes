<?php

/*
 *  Main Class Database.
 */
class DB extends PDO
{
    protected static $db = null;
    protected static $_instance;

    public function __construct()
    {

       $settings = Settings::get('database');

        $dns = $settings['driver'] .
            ':host=' . $settings['host'] .
            ((!empty($settings['port'])) ? (';port=' . $settings['port']) : '') .
            ';dbname=' . $settings['db_name'];

        try {
            parent::__construct($dns, $settings['username'], $settings['password']);
            parent::setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            // error reporting (only show errors on localhost)
            if( $_SERVER['SERVER_ADDR'] === '127.0.0.1') {
                parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
            } else {
                parent::setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
            }

            self::$db = $this;
        }
            catch(PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();;
        }

        self::$db = $this;
    }

    /**
     * getInstance
     */
    protected static function getInstance ($file = NULL) {
        if (!isset(self::$_instance)) {
            $class = __CLASS__;
            self::$_instance = new $class($file);
        }
        return self::$_instance;
    }

}

