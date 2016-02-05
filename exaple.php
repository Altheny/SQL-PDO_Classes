<?php

include_once'core/Settings.php';
Settings::getInstance();

/************************ Test Insert **********************************/

//$zmienna = new insertDB();
//
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



/***************************** Test Select ***************************/

//$zmienna = new selectDB();
//$select = array('var1', 'var4');
//
//$tabela = array(
//    $where = 'WHERE id = :id',
//    $param = array(
//        ':id' => 1
//    )
//);
//
//
//$result = $zmienna->select('table_name', $select, $tabela );
////var_dump($result);
//foreach ($result as $val ) {
//
//  var_dump($val);
//}

/* Test Select End*/

/******************** Test Update ******************************/

//$data = array(
//    'var1' => 'cos zza',
//    'var3' => 'zza'
//);
//$tabela = array(
//    $where = 'WHERE id = :id',
//    $param = array(
//        ':id' => 5
//    )
//);
//
//$baza = new updateDB();
//$baza->update('table_name', $data, $tabela);

/* TEst Update End*/

/***************** Delete ******************************/
//$tabela = array(
//    $where = 'WHERE id = :id',
//    $param = array(
//        ':id' => 8
//    )
//);
//
//$baza = new deleteDB();
//$baza->delete('table_name',$tabela);

/*** End ***/

/***************   Examle Delete Id ****************/

//$where = array(
//    'id' =>  9
////       'id' => array(12,14)
//);
//
//$baza = new deleteDB();
//$baza->id('table_name', $where);

/*** End  ***/

/******************** Select Id ************************/

//$select = array('var1', 'var4');
//$where = array(
////    'id' =>  15
//       'id' => array(15,17)
//);
//
//$zmienna = new selectDB();
//  $wynik =  $zmienna->id('table_name',$select, $where);
//
//var_dump($wynik);

/*** End ***/

/**************** Update id ******************/

$data = array(
    'var1' => 'av1',
    'var3' => 'av2',
    'var4' => 'av4'
);

$where = array(
    'id' =>  19
//       'id' => array(15,17)
);

$baza = new updateDB();
$baza->id('table_name', $data, $where);


/***   ***/