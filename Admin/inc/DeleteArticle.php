<?php
session_start();
require_once('checkstate.php');
include_once('../../php/Admin.php');


if(isset($_GET['delarticleid'])){
    $delid = $_GET['delarticleid'];
    $deletearticle = new Admin();
    $res = $deletearticle->deleteArticle($delid);
    header('../ArticleDashboard.php');
}else{
    return 'An error occured with Deletion'.$e;
}