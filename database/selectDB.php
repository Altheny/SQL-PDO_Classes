<?php

/**
 *
 */
class selectDB extends DB
{
//    public function select($TABLE, $COLUMNS = Array("*"), $WHERE = Array(), $LOGIC_OPER = "=", $OPER = "AND" ){
    public function select($from, $select = Array("*"), $where = array() ){

        $sel='';
        $wh = '';
        $param = array();

        if(count($select) == 1) {
            $sel .= $select[0];
        } else {
            foreach($select as $column) {
                $sel .= $column.",";
            }
        }
        $sel = rtrim($sel, ',');


        if(count($where) > 0) {
//            var_dump($where); die;
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

//      var_dump($result); die;
        return $result;
    }

}


