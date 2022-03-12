<?php
session_start();
require_once('../../php/User.php');


if(isset($_POST['submit'])){

    $oldpass = htmlspecialchars($_POST['oldpass']);
    $newpass = htmlspecialchars($_POST['newpass']);



    if(empty($oldpass)){
        echo 'old password is empty';
        exit();
    }else if(empty($newpass)){
        echo 'new password is empty';
        exit();
    }else{

        $chkuserid = $_SESSION['userid'];
        try{
            $updateUser = new User();
            $updateUser->changeUserPassword($chkuserid,$oldpass,$newpass);
            header('Location: ../Settings.php');
            //return $updateUser;
        }catch(Exception $e){
            return $e;
        }

    }

}else{
    header('Location: ../Settings.php');
    exit();
}