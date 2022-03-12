<?php 
session_start();
require_once('inc/checkstate.php');
include_once('../php/Admin.php');


try{
    $newcounter = new Admin();
    $restimelines = $newcounter->returnalltimelines();
}catch(Exception $e){
    return 'Error occured with Article Return' .$e;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timeline Dashboard</title>
</head>
<body>
<?php include_once('inc/admin-navbar.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-1">
        <br>
            <a class="btn btn-success"href="inc/AddTimelines.php">Add a Timeline</a>
        </div>
        <div class="col-sm-11">
        <br>
            <h1 class="d-flex justify-content-center">Timelines Dashboard</h1>
            <br>
<br>
<br>
        </div>
    </div>

    <div class="table-responsive" style="height: 500px !important; width: 100% !important; overflow: scroll;">
    <div class="row">
            <table class="table table-hover table-bordered border border-dark">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Subtitle</th>
                    <th scope="col">Thumbnail URL</th>
                    <th scope="col">Created At</th>
                    <th scope="col">By User</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
               <?php

                foreach($restimelines as $res){
               echo "
                    <tr>
                        <th scope='row'>".$res['id']."</th>
                            <td>".$res['title']."</td>
                            <td>".$res['subtitle']."</td>
                            <td>".$res['thumbnailurl']."</td>
                            <td>".$res['createddate']."</td>
                            <td>".$res['createdbyusername']."</td>
                            <td>".$res['status']."</td>
                            <td>
                                <a class='btn btn-warning m-2' href='inc/EditTimeline.php?timelineid=".$res['id']."'>Edit Timeline</a>
                                <a class='btn btn-danger m-2' href='inc/DeleteTimeline.php?deltimelineid=".$res['id']."'>Delete Timeline</a>
                            </td>
                    </tr>
                ";
                }
                ?>
               
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>