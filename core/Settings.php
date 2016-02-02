<?php



class Settings
{
    static private $_file_congig = 'settings.ini';
    static private $_instance = null;
    static private $_server_address = null;
    static private $_settings;

    protected function __construct(){

      $host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_SPECIAL_CHARS);
      $dir = dirname(filter_input(INPUT_SERVER, 'PHP_SELF', FILTER_SANITIZE_SPECIAL_CHARS));
      self::$_server_address = 'http://'.$host.$dir  ;
//      self::$_settings = self::$_file_congig;

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

//var_dump(self::$_file_congig); die;
        if(!$settings = parse_ini_file(self::$_file_congig, TRUE)) {
            throw new exception('Unable to open ' . self::$_file_congig . '.');
        };
         return $settings;
    }

    private static function get($zmienna = null){
        self::$_settings = self::set();
        return $zmienna ? self::$_settings[$zmienna] : self::$_settings;
    }

    public static function setPath($path = array()) {
//        var_dump($path);
        foreach($path['pathe'] as $name ) {
            $zm = '';
//            var_dump($name); die;

            $name = explode("/", $name);
            foreach ($name as $value) {
                $zm .= $value . DIRECTORY_SEPARATOR;
            }
            $zm = substr($zm, 0, strlen($zm) - 1);
//            echo $zm.' <br>';
            set_include_path(get_include_path() . PATH_SEPARATOR . $zm);
//            echo get_include_path();
//            echo '<br>';
        }

        spl_autoload_register(function($class) {
            require_once $class . '.php';
        });
//        echo get_include_path();
    }



}
//$var = 'ala1/ala2/ala3/ala4';
//$var2 = explode("/",$var);
//
////var_export($var2);
//echo '<br>';
//echo Settings::setPath(array('ala1/ala2/ala4', 'ola', 'ela'));

//var_export(Settings::get('dir'));
//echo '<br>';
//var_export( PATH_SEPARATOR );
//echo '<br>';
//var_export( DIRECTORY_SEPARATOR );
//echo '<br>';
//var_export( get_include_path(). PATH_SEPARATOR."admin" );

