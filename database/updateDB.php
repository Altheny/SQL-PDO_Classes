<?php


/**
*
 */
class updateDB extends  DB
{
    /*
     *
     */
    public function update ($table_name, array $data, $where)
    {
        /******** $ data ******/
        $dt='';
            foreach($data as $name => $value) {
               $dt .= '`'. $name . '`' . ' = ' .'"'. $value . '"'.',';
            }
        $dt = rtrim($dt, ',');

        /*********** $where ************/
        $wh = '';
        $param = array();

        if(count($where) > 0) {
            $wh =$where[0] ;
            $param = $where[1];
        }

        $sql =
<<<TAG
UPDATE `$table_name` SET $dt $wh
TAG;

        $statement = self::$db->prepare($sql);
        $statement->execute($param);
        return $statement->rowCount();
    }


    /*
     *
     */
    public function id($table_name, $data=array(), $where){

        /******** $ data ******/
        $dt='';
        foreach($data as $name => $value) {
            $dt .= '`'. $name . '`' . ' = ' .'"'. $value . '"'.',';
        }
        $dt = rtrim($dt, ',');


        /* id */
        $id = $this->whereId($where);

        $sql =
<<<TAG
UPDATE `$table_name` SET $dt WHERE $id;
TAG;

//         var_dump($id); die;

        $statement = self::$db->prepare($sql);
        $statement->execute();
        return $statement->rowCount();

    }
}

