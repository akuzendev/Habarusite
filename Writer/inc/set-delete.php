<?php
session_start();

require_once('../../php/User.php');



$userid = $_SESSION['userid'];
$userstate = $_SESSION['userstate'];

echo $userid;
echo '<br>';
echo $userstate;
echo '<br>';
echo '<br>';



if(isset($_POST['submitdeletionrequest'])){


    if($userstate == 0){

        try{
            $setdelete = new User();
            $res = $setdelete->setUserToDeletion($userid);
            session_destroy();
            header('location: ../../index.php');
        }catch(Exception $e){
            return 'An error occured in the registration' .$e;
        }
            
    }else{
        echo 'user already set to deletion';
        exit();
    }
    

}else{

}


