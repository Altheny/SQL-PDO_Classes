<?php
class DB extends PDO
{
    private static $db = null;
    private static $_instance;

    public function __construct($file = '../core/settings.ini')
    {
        if(!$settings = parse_ini_file($file, TRUE)) {
            throw new exception('Unable to open ' . $file . '.');
        };

        $dns = $settings['database']['driver'] .
            ':host=' . $settings['database']['host'] .
            ((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '') .
            ';dbname=' . $settings['database']['db_name'];

        try {
            parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
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

/* Test DB*/

include_once '../class/Logging.php';
$zmienna = new DB();
var_dump($zmienna);