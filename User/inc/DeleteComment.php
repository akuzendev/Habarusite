<?php
session_start();
require('checkstate.php');
include_once('../../php/Database.php');


$targetcontent = $_GET['commentid'];
$cltargetcontent = filter_var(htmlspecialchars($targetcontent),FILTER_SANITIZE_NUMBER_INT);

$currentarticle = $_GET['articleid'];
$clcurrentarticle = filter_var(htmlspecialchars($currentarticle),FILTER_SANITIZE_NUMBER_INT);

echo $cltargetcontent;
echo '<br>';
echo $clcurrentarticle;



try{
    $getcomment = new database();
    $sql = "SELECT tbl_comments.content, tbl_comments.id, tbl_comments.byuserid FROM tbl_comments WHERE tbl_comments.id = :id";
    $args = array(
        'id' => $cltargetcontent
    );
    $response = $getcomment->executesql('selectone',$sql,$args);
    var_dump($response);
}catch(Exception $e){
    return 'An error occured with getting the comment,'.$e;
}


if($response['byuserid'] == $_SESSION['userid']){
    echo 'The comment was made by this user';


    try{
        $deleteyourcomment = new Database();
        $sql = "DELETE FROM tbl_comments WHERE tbl_comments.id =:id";
        $args = array('id' =>$response['id']);
        $resp = $deleteyourcomment->executesql('crud',$sql,$args);
        header("Location: ../Article.php?articleid=$clcurrentarticle");
    }catch(Exception $e){
        return 'An error occured in comment deletion'.$e;
    }



}else{
    echo 'Unauthorized attempt, exitting';
}


