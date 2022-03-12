<?php
require_once('../../php/Database.php');

try{
    $newDb = new Database();
    $chksql = 'SELECT * FROM app_catergories';
    $chkarg = null;
    $chkcat = $newDb->executesql('selectone',$chksql,$chkarg); 
    var_dump($chkcat);
}catch(Exception $e){
    echo '';
}
