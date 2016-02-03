<?php



class Settings
{
    static private $_file_congig = 'settings.ini';
    static private $_server_address = null;
    static private $_settings;

    protected function __construct(){

      $host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_SPECIAL_CHARS);
      $dir = dirname(filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_SPECIAL_CHARS));
      self::$_server_address = 'http://'.$host.$dir  ;

    }

    public static function getInstance($file = null){
        if($file){
           self::$_file_congig = $file;
           new Settings();
        }

        if(!isset(self::$_server_address)){
           new Settings();
        }
        // Dodajemy katalogi do Path
        self::setPath(self::get('dir'));
        return self::$_server_address;
    }

    private static function set(){

        if(!$settings = parse_ini_file(self::$_file_congig, TRUE)) {
            throw new exception('Unable to open ' . self::$_file_congig . '.');
        };
         return $settings;
    }

    public static function get($zmienna = null){
        self::$_settings = self::set();
        return $zmienna ? self::$_settings[$zmienna] : self::$_settings;
    }

    public static function setPath($path = array()) {
        foreach($path['pathe'] as $name ) {
            $zm = '';

            $name = explode("/", $name);
            foreach ($name as $value) {
                $zm .= $value . DIRECTORY_SEPARATOR;
            }
            $zm = substr($zm, 0, strlen($zm) - 1);
            set_include_path(get_include_path() . PATH_SEPARATOR . $zm);
        }

        spl_autoload_register(function($class) {
            $path = $class .'.php';
            require_once $path;
        });
    }



}


