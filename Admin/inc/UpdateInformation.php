<?php 
session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');



if(isset($_POST['submituserinfoupdate'])){

    $currentuserid = $_SESSION['userid'];

    try{
        $getthisuserpass = new Database();
        $chksql1 = 'SELECT tbl_users.pssword FROM tbl_users WHERE tbl_users.id = :id';
        $chkarg1 = array('id'=> $currentuserid);
        $response = $getthisuserpass->executesql('selectone',$chksql1,$chkarg1);

    }catch(Exception $e){
        return 'An Error occured with Password Retrieval'.$e;
    }



    $updatefname = filter_var(htmlspecialchars($_POST['editfname']),FILTER_SANITIZE_STRING);
    $updatelname = filter_var(htmlspecialchars($_POST['editlname']),FILTER_SANITIZE_STRING);
    $updateusername = filter_var(htmlspecialchars($_POST['editusername']),FILTER_SANITIZE_STRING);
    $updateemail = filter_var(htmlspecialchars($_POST['editemail']),FILTER_SANITIZE_EMAIL);
    $updategender = filter_var(htmlspecialchars($_POST['editgender']),FILTER_SANITIZE_NUMBER_INT);
    $updatecountrycode = filter_var(htmlspecialchars($_POST['editcountrycode']),FILTER_SANITIZE_NUMBER_INT);
    $updatephoneno = filter_var(htmlspecialchars($_POST['editphoneno']),FILTER_SANITIZE_NUMBER_INT);
    $updateinfoupdatepass = htmlspecialchars($_POST['infoupdatepass']);




    if(password_verify($updateinfoupdatepass,$response['pssword'])){
        echo $updatefname;
        echo '<br>';
        echo $updatelname;
        echo '<br>';
        echo $updateusername;
        echo '<br>';
        echo $updategender;
        echo '<br>';
        echo $updateemail;
        echo '<br>';
        echo $updatecountrycode;
        echo '<br>';
        echo $updatephoneno;
        echo '<br>';
        echo $updateinfoupdatepass;
        echo '<br>';
        echo '<br>';
        echo $response['pssword'];


        try{
            $edituser = new Database();
            $editsql = "UPDATE `tbl_users` SET `fname`='$updatefname',`lname`='$updatelname',`username`='$updateusername',`gender`='$updategender',`countrycode`='$updatecountrycode',`phoneno`='$updatephoneno',`email`='$updateemail' WHERE tbl_users.id = $currentuserid";
            $editarg = null;
            $res = $edituser->executesql('crud',$editsql,$editarg);
            header('Location: ../AdminSettings.php');
       
  
        }catch(Exception $e){
          return 'An Error occured in Editting the user'. $e;
        }
  
        

    }else{
        echo 'passwords did not match';
    }


}else{

}

?>
