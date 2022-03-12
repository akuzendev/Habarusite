<?php 
session_start();
require_once('inc/checkstate.php');
include_once('../php/Admin.php');



try{
    $newDb = new Database();
    $chksql = 'SELECT * FROM tbl_users';
    $chkarg = null;
    $chkusers = $newDb->executesql('selectall',$chksql,$chkarg); 
    //var_dump($chkcat);
}catch(Exception $e){
    echo '';
}


try{
    $newDb1 = new Database();
    $chksql1 = 'SELECT * FROM tbl_articles';
    $chkarg1 = null;
    $chkarticles = $newDb1->executesql('selectall',$chksql1,$chkarg1); 
    //var_dump($chkcat);
}catch(Exception $e){
    echo '';
}



try{
    $query1 = new Admin();
    $res1 = $query1->returnallcomments();        
}catch(Exception $e){
    return 'An error occured' .$e;
}









?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments Dashboard</title>
</head>
<body>
<?php include_once('inc/admin-navbar.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="d-flex justify-content-center">Comments Dashboard</h1>
<br>
<br>
<br>
        </div>





<div class="col-md-12">
<br>
<br>
<br>
<div class="table-responsive" style="height: 500px !important; width: 100% !important; overflow: scroll;">
        <table class="table table-hover table-bordered border border-dark">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Comment Content</th>
                    <th scope="col">Timestamp</th>
                    <th scope="col">Comment Author</th>
                    <th scope="col">Target Article</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
               <?php

                foreach($res1 as $result){
               echo "
                    <tr>
                        <th scope='row'>".$result['commentid']."</th>
                            <td>".$result['content']."</td>
                            <td>".$result['timestamp']."</td>
                            <td>".$result['username']."</td>
                            <td>".$result['title']."</td>
                            <td>".$result['status']."</td>
                            <td>
                                <a class='btn btn-warning m-2' href='inc/EditComment.php?commentid=".$result['commentid']."'>Edit Comment</a>
                                <a class='btn btn-danger m-2' href='inc/DeleteComment.php?delcommentid=".$result['commentid']."'>Delete Comment</a>
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
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>