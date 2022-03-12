<?php
session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');


if(isset($_POST['updaterowconfig'])){

    $uprow1 = htmlspecialchars($_POST['setrow1']);
    $uprow2 = htmlspecialchars($_POST['setrow2']);
    $uprow3 = htmlspecialchars($_POST['setrow3']);
    $uprow4 = htmlspecialchars($_POST['setrow4']);
    
    if(empty($uprow1)){
        echo 'Row 1 is empty';
        exit();
    }else if (empty($uprow2)){
        echo 'Row 2 is empty';
        exit();
    }else if (empty($uprow3)){
        echo 'Row 3 is empty';
        exit();
    }else if (empty($uprow4)){
        echo 'Row 4 is empty';
        exit();
    }else{
        try{
            $updatebreakingnews = new Database();
            $chksql = "UPDATE `app_settings` SET `row1cat`='$uprow1',`row2cat`='$uprow2',`row3cat`='$uprow3',`row4cat`='$uprow4' WHERE app_settings.id = 1";
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