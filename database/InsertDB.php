<?php



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
            $statement->bindParam($key, $val);
        }

        $statement->execute();
        $ls = $lastId ? parent::lastInsertId() : false;
        return $ls ? $ls : true;

    }

}



