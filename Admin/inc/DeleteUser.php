<?php

session_start();
require_once('checkstate.php');
include_once('../../php/Admin.php');


if(isset($_GET['deluserid'])){
    $delid = $_GET['deluserid'];
    $deleteuser = new Admin();
    $res = $deleteuser->deleteuser($delid);
    header('../ArticleDashboard.php');
}else{
    return 'An error occured with Deletion'.$e;
}