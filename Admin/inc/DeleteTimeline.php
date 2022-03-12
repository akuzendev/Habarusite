<?php

session_start();
require_once('checkstate.php');
include_once('../../php/Admin.php');


if(isset($_GET['deltimelineid'])){
    $deltimelineid = $_GET['deltimelineid'];
    $deletetimelines = new Admin();
    $res = $deletetimelines->deletetimeline($deltimelineid);
    header('../TimelinesDashboard.php');
}else{
    return 'An error occured with Deletion'.$e;
}