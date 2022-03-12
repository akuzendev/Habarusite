<?php 
session_start();
require_once('inc/checkstate.php');
include_once('../php/Admin.php');


try{
    $newcounter = new Admin();
    $resarticles = $newcounter->returnallarticles();
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
    <title>Article Dashboard</title>
</head>
<body>
<?php include_once('inc/admin-navbar.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="d-flex justify-content-center">Articles Dashboard</h1>
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
                    <th scope="col">isTimeline?</th>
                    <th scope="col">TimelineID</th>
                    <th scope="col">Thumbnail URL</th>
                    <th scope="col">Datetime</th>
                    <th scope="col">Catergory</th>
                    <th scope="col">Status</th>
                    <th scope="col">Handled by User</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
               <?php

                foreach($resarticles as $res){
               echo "
                    <tr>
                        <th scope='row'>".$res['id']."</th>
                            <td>".$res['title']."</td>
                            <td>".$res['subtitle']."</td>
                            <td>".$res['istimeline']."</td>
                            <td>".$res['timelineid']."</td>
                            <td>".$res['thumbnail']."</td>
                            <td>".$res['timestamp']."</td>
                            <td>".$res['catergory']."</td>
                            <td>".$res['status']."</td>
                            <td>".$res['approvedbyuserid']."</td>
                            <td>
                                <a class='btn btn-success m-2' href='inc/ApproveArticle.php?articleid=".$res['id']."'>Approve Article</a>
                                <a class='btn btn-warning m-2' href='inc/EditArticle.php?articleid=".$res['id']."'>Edit Article</a>
                                <a class='btn btn-danger m-2' href='inc/DeleteArticle.php?delarticleid=".$res['id']."'>Delete Article</a>
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