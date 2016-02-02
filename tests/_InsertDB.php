<?php

/* Test */
include_once'../class/DB.php';
include_once '../class/Logging.php';
include_once '../class/InsertDB.php';

$zmienna = new InsertDB();
var_dump($zmienna);

$test1 = array(
    'var1'=> 'wartosc1',
    'var2'=> 'wartosc2',
    'var4'=> 'wartosc4'

);

$table = 'table_name';
echo $zmienna->insert($table, $test1, true);

/* Test End*/