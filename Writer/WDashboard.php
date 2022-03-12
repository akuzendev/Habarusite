<?php
session_start();
require('inc/checkstate.php');
include_once('../php/Admin.php');

$userid = $_SESSION['userid'];

try{
    $newcounter  = new Admin();
    $res1 = $newcounter->countTotalArticlesOfUser($userid);
    $result1 = $res1['COUNT(id)'];
    //return $result['int'];
}catch(Exception $e){
    return 'Error occured with counting' .$e;
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Writer Dashboard</title>
</head>
<body>

<?php include_once('inc/writer-navbar.php') ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="d-flex justify-content-center">Writer Dashboard</h1>
<br>
<br>
<br>
        </div>

<div class="">

</div>
        <div class="col-sm-12 d-flex justify-content-center">
        <div class="card text-center">
            <div class="card-header">
                Total No. of your Article
            </div>
            <div class="card-body">
                <p class="card-text"><?php if($result1 == 0 ){echo '0'; }else{echo $result1;};?></p>
            </div>
            <div class="card-footer text-muted">
                <a href="WYArticle.php" class="btn btn-primary">Go to Articles</a>
            </div>
        </div>


        </div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>