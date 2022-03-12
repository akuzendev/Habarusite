<?php
include_once('../php/Database.php');

$getarticle = $_GET['articleid'];
$clgetarticle = filter_var(htmlspecialchars($getarticle), FILTER_SANITIZE_NUMBER_INT);


try{
    $getarticle = new Database();
    $chksql = 'SELECT tbl_articles.id, tbl_articles.istimeline, tbl_articles.timelineid, tbl_articles.title, tbl_articles.subtitle, app_catergories.name, tbl_articles.thumbnail, tbl_articles.byuserid, tbl_users.username, tbl_articles.timestamp, tbl_articles.content, tbl_articles.relcommentid, app_catergories.name as catergoryname FROM tbl_articles
    INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id
    INNER JOIN app_catergories ON tbl_articles.catergory = app_catergories.id
    WHERE tbl_articles.id = :id AND tbl_articles.status = 1 LIMIT 1';
    $chkargs = array('id'=>$clgetarticle);
    $resarticle = $getarticle->executesql('selectone',$chksql, $chkargs);
    //var_dump($resarticle);
}catch(Exception $e){
    return 'an error occured in article retreival' .$e;
}



try{
    $getcommentsofarticle = new Database();
    $chksql1 = 'SELECT tbl_comments.id as commentid, tbl_comments.content, tbl_comments.timestamp, tbl_comments.onarticleid, tbl_comments.byuserid, tbl_users.username as commentusername FROM tbl_comments 
    INNER JOIN tbl_users ON tbl_comments.byuserid = tbl_users.id
    INNER JOIN tbl_articles ON tbl_comments.onarticleid = tbl_articles.id
    WHERE tbl_comments.onarticleid = :id AND tbl_comments.status = 1';
    $chkargs1 = array('id'=>$clgetarticle);
    $rescomments = $getcommentsofarticle->executesql('crud',$chksql1, $chkargs1);
    //var_dump($rescomments);
}catch(Exception $e){
    return 'an error occured in comment retreival' .$e;
}





?>


<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../assets/css/all.css">
        <link rel="stylesheet" href="../assets/css/css.css">
        <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="../assets/css/mdb.min.css" rel="stylesheet">
        <script src="https://unpkg.com/feather-icons"></script>        
        <title><?php echo $resarticle['title']; ?></title>
    </head>
    <body>

    <?php include_once('inc/guest-navbar.php') ?>
<br>
<br>
<br>
<br>
<section class='mx-md-5 dark-grey-text'>
  <div class='row'>
    <div class='col-md-12 card card-cascade m-2 p-3'>
      <div class='d-flex justify-content-start'>
      </div>
      <div class='wider reverse'>
        <div class='view view-cascade overlay'>
        <div class="text-center d-flex justify-content-center">
          <img class='card-img-top img-fluid' style="width:40%;height:30%;" src='<?php echo $resarticle['thumbnail'] ?>' alt='Article Thumbnail'>
        </div>
          <a href='#!'>
            <div class='mask rgba-white-slight'></div>
          </a>
        </div>
        <div class='card-body card-body-cascade text-center'>
        <a href="" class="text-success"><i class=""></i><?php echo $resarticle['catergoryname'] ?></a>
          <h1 class='font-weight-bold'><a><?php echo $resarticle['title'] ?></a></h1>
          <h6 class='font-weight-bold'><a><?php echo $resarticle['subtitle'] ?></a></h6>
          <p class="">Written by: <a><strong><?php echo $resarticle['username'] ?></strong></a>, <?php echo $resarticle['timestamp'] ?></p>
        </div>
      </div>
      <div class='mt-5'>
        <p><?php echo $resarticle['content'] ?></p>
      </div>
    </div>
  </div>
  <hr class='mb-5 mt-4'>
</section>
    






<div class="container my-5">
  <!--Section: Content-->
  <section class="dark-grey-text">
    <!-- Section heading -->
    <h3 class="text-center font-weight-bold mb-4 pb-2">Comment Section</h3>
    <hr class="w-header">
    <!-- Section description -->
    <p class="lead text-center w-responsive mx-auto text-muted mt-4 pt-2 mb-5">Please Login to Comment on the Article.</p>
    <div class="text-center">
    </div>
    <!--First row-->
    <div class="row">
      <!--First column-->

      <?php 
        foreach($rescomments as $articlecomments){
            echo 
            "
            <div class='container py-2 my-2'>
            <section class='p-md-12 mx-md-5 text-center text-lg-left z-depth-1'>
                <div class='row d-flex justify-content-center'>
                <div class='col-md-12'>
                    <div class='card-body m-3'>
                        <div class='row'>
                        <div class='col-lg-8'>
                        <p class='font-weight-bold lead mb-2'><strong>@".$articlecomments['commentusername']."</strong></p>
                            <p class='font-weight-bold text-muted mb-0'>".$articlecomments['timestamp']."</p>
                            <br>
                            <p class='text-muted font-weight-light mb-4'>".$articlecomments['content']."</p>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
            </section>
            </div>
            ";
        }
       ?>


      <!--Second column-->
    </div>
    <!--First row-->
	</section>
</div>



<?php

include('inc/footer.php');

?>









    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>

    </body>
    </html>  






