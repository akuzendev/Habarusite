<?php
session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');


if(isset($_POST['updatebreakingnews'])){
    $articletobreakingnews = htmlspecialchars($_POST['breakingnewsarticle']);
    
    if(empty($articletobreakingnews)){
        try{
            $updatebreakingnews = new Database();
            $chksql = "UPDATE `app_settings` SET `breakingnewsid`=0 WHERE 1";
            $chkargs = NULL;
            $info = $updatebreakingnews->executesql('crud',$chksql,$chkargs);
            header('Location: ../AdminDashboard.php');
        }catch(Exception $e){
            return 'An error occured with updating'.$e;
        }
    }else{
        try{
            $updatebreakingnews = new Database();
            $chksql = "UPDATE `app_settings` SET `breakingnewsid`='$articletobreakingnews' WHERE 1";
            $chkargs = NULL;
            $info = $updatebreakingnews->executesql('crud',$chksql,$chkargs);
            header('Location: ../AdminDashboard.php');
        }catch(Exception $e){
            return 'An error occured with updating'.$e;
        }
    }
}else{
    header('Location: ../AdminDashboard.php');
}