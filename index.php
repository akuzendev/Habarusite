<?php

/*

How session_control works::

    the sessioncheck is a middleware that queries the database everytime.
    it checks if the currently logged in user id has the status ACTIVE
    and the designation and will redirect to the relevant index page.



_index.php is the first file that the application loads on the browser.
_No HTML
_It checks the status
    0 => active
    1 => block
    2 => deleted
_It checks the session for designation
_if designation
    0 or NULL => Guest
    1 => User
    2 => Writer
    3 => Admin

    
*/


session_start();

$_SESSION['userid'];
$_SESSION['username'];
$_SESSION['userstate'];
$_SESSION['designation'];

/*
echo $_SESSION['userid'];
echo '<br>';
echo $_SESSION['userstate'];
echo '<br>';
echo $_SESSION['designation'];
*/


if($_SESSION['userid'] == null){
    //Userid is null;
    session_destroy();
    header('Location: ./Guest/Home.php');
    exit();
}else{

    if($_SESSION['userstate'] == 0 ){

        switch($_SESSION['designation']){
            case 1:
                header('Location: ./User/Home.php');
            break;
            case 2:
                header('Location: ./Writer/WDashboard.php');
            break;
            case 3:
                header('Location: ./Admin/AdminDashboard.php');
            break;
            default:
                //'User Designation not Found, sent to Guest with destroyed session';
                session_destroy();
                header('Location: ./Guest/Home.php');
                exit();
        }

    }else if ($_SESSION['userstate'] == 1 ){
        //echo 'User is Pending Approval, session_destroy() and sent to Guest';
        session_destroy();
        header('Location: ./Guest/PendingUser.php');
        exit();
    }else if ($_SESSION['userstate'] == 2){
        session_start();
        header('Location: ./Guest/ToDeletion.php');
        exit();
    }else if($_SESSION['userstate'] == 3){
        session_destroy();
        header('Location: ./Guest/Blocked.php');
        exit();
        //echo 'User is Blocked, session_destroy() and sent to Guest';
    }else{
        //'User state unknown, session_destroy() and sent to Guest';
        session_destroy();
        header('Location: ./Guest/Home.php');
        exit();

    }
}

/*
header('Location: ./Guest/Home.php');
*/


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="php/logout.php">Logout</a>
</body>
</html>