<?php
session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');

if(isset($_POST['submitchangepass'])){

    $currentuserid = $_SESSION['userid'];
    $oldpass = $_POST['oldpass'];
    $newpass = $_POST['newpass'];



    try{
        $getcurrentuser = New Database();
        $chksql1 = "SELECT tbl_users.pssword FROM tbl_users WHERE tbl_users.id =:id";
        $chkarg1 = array('id'=>$currentuserid);
        $resp = $getcurrentuser->executesql('selectone',$chksql1,$chkarg1);
        var_dump($resp);
    }catch(Exception $e){
        return 'An error occured with User Retrieval'.$e;
    }


    echo '<br>';
    echo '<br>';
    echo $resp["pssword"];
    
    
    if(password_verify($oldpass,$resp['pssword'])){

    $hashpwd = password_hash($newpass,PASSWORD_DEFAULT);

    try{
        $updatemypass = New Database();
        $chksql2 = "UPDATE `tbl_users` SET `pssword`='$hashpwd' WHERE tbl_users.id = $currentuserid";
        $chkarg2 = null;
        $response = $updatemypass->executesql('crud',$chksql2,$chkarg2);
        var_dump($response);
    }catch(Exception $e){
        return 'An error occured with Password Change'.$e;
    }     


    }else{
        return 'Passwords dont match';
    }




}else{

}