<?php


/**
*
 */
class updateDB extends  DB
{
    public function update ($table_name, array $data, $where)
    {
        /******** $ data ******/
        $dt='';
        $wh = '';


            foreach($data as $name => $value) {
               $dt .= '`'. $name . '`' . ' = ' .'"'. $value . '"'.',';
            }

        $dt = rtrim($dt, ',');


        /*********** $where ************/
        $param = array();

        if(count($where) > 0) {
//            var_dump($where); die;
            $wh =$where[0] ;
            $param = $where[1];

        }

//        var_dump($wh); die;

        $sql =
<<<TAG
UPDATE `$table_name` SET $dt $wh
TAG;


        $statement = self::$db->prepare($sql);
//        var_dump($dt); die;



        $statement->execute($param);

//        return $statement->rowCount();

    }
}

