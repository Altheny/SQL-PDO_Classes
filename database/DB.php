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


    /*
     *  Select
     *  Metoda powtarzalna
     */
    protected function sel($select){
        $sel='';
        if(count($select) == 1) {
            $sel .= $select[0];
        } else {
            foreach($select as $column) {
                $sel .= $column.",";
            }
        }
        $sel = rtrim($sel, ',');

        return $sel;
    }




    /*
     *  Where Id
     *  Metoda powtarzalna
     */
      protected function whereId($where){
          $id = '';
          $name_id = '';
          $wynik = '';
          $value_id = array();

          foreach ($where as $key => $value ) {
              $name_id = $key;
              $value_id = $value;
          }

          if(is_array($value_id)){
              foreach ($value_id as $val ) {
                  $wynik .= (int)$val . ',';
              }

//          $wynik = substr($wynik,0,strlen($wynik)-1);
              $wynik = rtrim($wynik, ',');

              $id .= "`".$name_id."` IN (" . $wynik . ")" ;

          } else {
              $id .= "`".$name_id."` = " . (int)$value_id ;
          }
            return $id;
      }
}

