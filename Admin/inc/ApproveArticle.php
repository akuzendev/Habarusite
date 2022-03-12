<?php
session_start();
require_once('checkstate.php');
include_once('../../php/Admin.php');

$ararticleid = htmlspecialchars($_GET['articleid']);
$aruserid = $_SESSION['userid'];

try{
    /*
    echo $aruserid;
    echo '<br>';
    echo $ararticleid;
    echo '<br>';
    */

    $approvearticle = new Admin();
    $res = $approvearticle->approveArticle($aruserid,$ararticleid);
    header('Location: ../ArticleDashboard.php');
    //var_dump($res);

}catch(Exception $e){
    return 'An error occured with article approval' .$e;

}