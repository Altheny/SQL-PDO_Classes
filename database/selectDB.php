<?php

/**
 *
 */
class selectDB extends DB
{
    /*
     *  select
     */
    public function select($from, $select = array("*"), $where = array() ){

        $sel = $this->sel($select);

        $wh = '';
        if(count($where) > 0) {
            $wh = $where[0];
            $param = $where[1];
        }

        $sql =
<<<TAG
SELECT $sel FROM $from $wh
TAG;

        $statement = self::$db->prepare($sql);
        $statement->execute($param);
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }


    /*
     *  select id
     */
    public function id($table_name, $select = array("*"), $where ){

    $sel = $this->sel($select);
    $id = $this->whereId($where);

        $sql =
<<<TAG
SELECT $sel FROM `$table_name` WHERE $id
TAG;

        $statement = self::$db->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}


