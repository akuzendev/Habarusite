<?php

session_start();
require_once('checkstate.php');
include_once('../../php/Admin.php');


if(isset($_GET['delcommentid'])){
    $delcomment = $_GET['delcommentid'];
    $delthiscomment = new Admin();
    $res = $delthiscomment->delcomment($delcomment);
    header('../CommentsDashboard.php');
}else{
    return 'An error occured with Deletion'.$e;
}