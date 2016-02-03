<?php

include_once'core/Settings.php';
Settings::getInstance();

/* Test Insert*/

//$zmienna = new insertDB();
//
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

/* Test Insert End*/



/* Test Select*/

$ala = new selectDB();
$select = array('var1', 'var4');

$tabela = array(
    $where = 'WHERE id = :id',
    $param = array(
        ':id' => 1
    )
);


$result = $ala->select('table_name', $select, $tabela );
//var_dump($result);
foreach ($result as $val ) {

  var_dump($val);
}

/* Test Select End*/