<?php

//include_once'DB.php';
//include_once 'Logging.php';


class InsertDB extends DB
{


    /*
 * Insert
 */
    public function insert ($table_name, array $data, $lastId = false) {
        $column = '';
        $value = '';
        $d = array();

        foreach ($data as $col => $val) {
            $d[':'.$col] = $val;
            $column .=   $col . ',' ;
            $value .= ":" . $col . ',';
        }
        $column = substr($column,0,strlen($column)-1);
        $value = substr($value,0,strlen($value)-1);

        $sql =
        <<<TAG
            INSERT INTO `$table_name` ( $column ) VALUES ($value)
TAG;


        $statement = self::$db->prepare($sql);

        foreach ($d as $key => $val ) {
            $statement->bindParam($key, $val , \PDO::PARAM_STR);
        }

        $statement->execute();

//      $lastIde = self::$db->lastInsertId();
        $ls = $lastId ? parent::lastInsertId() : false;

        return $ls ? $ls : true;

    }



}



/* Test */
//include_once'DB.php';
//include_once '../class/Logging.php';
//$zmienna = new InsertDB();
//var_dump($zmienna);
//
//$test1 = array(
//    'var1'=> 'wartosc1',
//    'var2'=> 'wartosc2',
//    'var4'=> 'wartosc4'
//
//);
//
//$table = 'table_name';
//echo $zmienna->insert($table, $test1, true);

/* Test End*/