<?php

session_start();


if($_SESSION['userid'] == null){
    echo 'Userid is null, Session destroyed, and sent to Guest';
    exit();
}else{

    if($_SESSION['userstate'] == 0){
        echo 'User is Active, No further actions';
    }else if($_SESSION['userstate'] == 1){
        echo 'User is Blocked';
    }else if($_SESSION['userstate'] == 2){
        echo 'User is set to be deleted';
    }else{
        echo 'User state unknown, session_destroy();';
    }
}

