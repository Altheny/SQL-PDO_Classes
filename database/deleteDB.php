<?php

/**
 * Created by PhpStorm.
 * User: Tomek
 * Date: 04.02.2016
 * Time: 15:19
 */
class deleteDB extends DB
{
   public function delete($table_name, $where){

       /*********** $where ************/
       $wh = '';
       $param = array();

       if(count($where) > 0) {
//            var_dump($where); die;
           $wh = $where[0] ;
           $param = $where[1];

       }

       $sql =
<<<TAG
DELETE FROM `$table_name`  $wh
TAG;


       $statement = self::$db->prepare($sql);
       $statement->execute($param);

//        var_dump($statement->rowCount()); die;
//       $count = self::$db->exec($sql);
//
//       return $count;
       return $statement->rowCount();
   }



    /*
     *  Delete Id
     */
    public function id($table_name, $where){

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
                $wynik .= $val . ',';
            }

//          $wynik = substr($wynik,0,strlen($wynik)-1);
            $wynik = rtrim($wynik, ',');

            $id .= "`".$name_id."` IN (" . $wynik . ")" ;

        } else {
            $id .= "`".$name_id."` = " . $value_id ;
        }


        $sql =
<<<TAG
DELETE FROM `$table_name`  WHERE $id
TAG;

       $count = self::$db->exec($sql);
       return $count;

    }

}