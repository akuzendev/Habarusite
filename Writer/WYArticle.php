<?php
session_start();
require('inc/checkstate.php');
include_once('../php/Writer.php');

$userid = $_SESSION['userid'];
$username = $_SESSION['username']; 


try{
    $reurarticles = new Writer();
    $rest = $reurarticles->returnallyourarticles($userid);
 
}catch(Exception $e){
    return 'An error occured in Returning your Articles' .$e;
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
    <title><?php echo $username ?>'s Articles</title>
</head>
<body>

<?php include_once('inc/writer-navbar.php') ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="d-flex justify-content-center">Your Articles</h1>
<br>
<br>
<br>
        </div>
        <div class="col-sm-12">


        <div class="table-responsive" style="height: 500px !important; width: 100% !important; overflow: scroll;">
    <div class="row">
            <table class="table table-hover table-bordered border border-dark">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Title</th>
                    <th scope="col">Subtitle</th>
                    <th scope="col">is Timeline?</th>
                    <th scope="col">Timeline ID</th>
                    <th scope="col">Thumbnail URL</th>
                    <th scope="col">Catergory</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
               <?php


            foreach($rest as $res){
               echo "
                    <tr>
                        <th scope='row'>".$res['articleid']."</th>
                            <td>".$res['title']."</td>
                            <td>".$res['subtitle']."</td>
                            <td>".$res['istimeline']."</td>
                            <td>".$res['timelineid']."</td>
                            <td>".$res['name']."</td>
                            <td>".$res['thumbnail']."</td>
                            <td>".$res['timestamp']."</td>
                            <td>
                                <a class='btn btn-warning m-2' href='inc/EditArticle.php?articleid=".$res['articleid']."'>Edit Article</a>
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