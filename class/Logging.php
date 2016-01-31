<?php

class Logging {

    // Defaultowy plik konfitu
    static private $_file_congig = '../core/logging.ini';
    static private $_settings = array();

    static public function add($logText, $line = 0, $file_name = false, $log_filename = false) {

        $settings = self::settings();

        $_log_path = $settings['logging']['path'];
        $_log_filename = $settings['logging']['filename'];


        $ip = $_SERVER['REMOTE_ADDR'];
        $time = date('H:i:s');
        $line = ($line == 0) ? "" : "[line #{$line}]";
        $file_name = ($file_name === false) ? "" : "[file $file_name]";


//        var_dump(self::$_log_file); die;
        if($log_filename === false) { $log_filename = $_log_path.date("d_m_Y"). $_log_filename. ".log"; }
        else {
            $log_filename = $_log_path.date("d_m_Y").".$log_filename.log";
        }



        if(file_exists($log_filename)) {
            $fh = fopen($log_filename, "a") or die("Pliku Log nie da siê zapisaæ. !");
        } else {
            $fh = fopen($log_filename, "w") or die("Nie utworzono pliku Log, lub plik nie da siê zapisaæ nie da siê zapisaæ. Przyczyn¹ m¿e byæ brak katalogu, lub katalog niezapisywalny!");
            fwrite($fh, "\n--------------------------------------------\n"." Plik loginng z dnia: [ ".date("d/m/Y")." ]\n--------------------------------------------\n\n");
        }

        fwrite($fh, "+ [$time][$ip]$file_name$line: $logText\n");
        fclose($fh);



    }

    /**
     *
     * Singleton
     *
     */
    static public function settings($file = false){

        if (empty(self::$_settings[0])) {
            if (!$file) {
                $file = self::$_file_congig;
            }

            if (!$settings = parse_ini_file($file, TRUE)) {
                throw new exception('Unable to open ' . $file . '.');
            }
            self::$_settings = $settings;
        }

             return self::$_settings;
    }
}


/*
Require !!!
 LOG catalog
 core/logging.ini
*/
/** Logging Test: */

//$name = 'nazwa1';
//$liczba = 444;
//Logging::add("Error: Zapis do bazy danych INSERT INTO[ $name ]. O treœci: liczba [$liczba ] ", __LINE__, __FILE__, 'cena');

/* Test End */

