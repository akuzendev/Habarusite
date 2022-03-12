<?php

session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');


if(isset($_GET['catergoryid'])){
    $delcatergory = $_GET['catergoryid'];
    $delthiscatergory = new Database();
    $sql = "DELETE FROM app_catergories WHERE app_catergories.id = $delcatergory";
    $arg = null;
    $res = $delthiscatergory->executesql('crud',$sql,$arg);
    header('../AppSettings.php');
}else{
    return 'An error occured with Deletion'.$e;
}