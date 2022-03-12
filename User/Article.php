<?php
session_start();
include_once('inc/checkstate.php');
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


if($_SERVER["REQUEST_METHOD"] == "POST") {
  $articlecommentcontent = htmlspecialchars($_POST['articlecommentcontent']);
  $commentarticleid = htmlspecialchars($_POST['commentarticleid']);
  $currentuser = $_SESSION['userid'];
  $timestamp = date('Y-m-d H:i:s');

/*
  echo $articlecommentcontent;
  echo '<br>';
  echo $commentarticleid;
  echo '<br>';
  echo $currentuser;
  echo '<br>';
  echo $timestamp;
*/
  
  try{
      $addcommentc = new Database();
      $sql2 = "INSERT INTO tbl_comments (content, timestamp, byuserid, onarticleid, status) VALUES (:content,:timestamp,:byuserid,:onarticleid,:status)";
      $arg2 = array(
          'content'=>$articlecommentcontent,
          'timestamp'=>$timestamp,
          'byuserid'=>$currentuser,
          'onarticleid'=>$commentarticleid,
          'status'=>1
      );
      $res2 = $addcommentc->executesql('crud',$sql2,$arg2);
      header("Location: ./Article.php?articleid='.$commentarticleid.");
  }catch(Exception $e){
      return 'An error occured with comment insertion'.$e;
  }


}else{
  echo '';
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

    <?php include_once('inc/user-navbar.php') ?>
    <br>
<br>
<br>
<br>

<section class='mx-md-5 dark-grey-text'>
  <div class='row'>
    <div class='col-md-12 card card-cascade m-2 p-3'>
    <div class='d-flex justify-content-start'>
      <a class='btn btn-danger text-white' href='inc/ReportArticle.php?typeid=article&articleid="<?php echo $resarticle['id'] ?>"&currentarticle="<?php echo $resarticle['id']?>"'>Report Article</a>
      </div>

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
    <p class="lead text-center w-responsive mx-auto text-muted mt-4 pt-2 mb-5">Reminder to be courteous and respectful in the comment section.</p>
    <div class="text-center">
    <a class="btn btn-info btn-rounded mb-4" data-toggle="modal" data-target="#modalLoginForm">Add Comment</a>
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
                        <div class='col-lg-4 d-flex justify-content-end align-items-center'>
                          ";
                          if($articlecomments['byuserid'] == $_SESSION['userid']){
                            echo "<a class='btn btn-grey text-white' href='inc/DeleteComment.php?articleid=".urlencode($resarticle['id'])."&commentid=".urlencode($articlecomments['commentid'])."&onarticleid=".urlencode($resarticle['id'])."'>Delete Comment</a>";
                          }else{
                            echo "<a class='btn btn-danger text-white' href='inc/Report.php?articleid=".urlencode($resarticle['id'])."&typeid=comment&oncontentid=".urlencode($articlecomments['commentid'])."&onarticleid=".urlencode($resarticle['id'])."'>Report Comment</a>";
                          }
                          echo"
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











<div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Add Comment</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
        <form class="needs-validation" method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" novalidate>
        <div class="form-row">
            <div class="col-md-12 mb-3">
            <label for="validationCustom01">Comment</label>
            <input type="text" class="form-control" id="validationCustom01" name="articlecommentcontent" required>
            <div class="valid-feedback">
                Looks good!
            </div>
        </div>
        <div class="col-md-12 mb-3">
            <div class="form-check">
            <input class="form-check-input" type="checkbox" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
            </div>
        </div>
        </div>
        <div class="modal-footer d-flex justify-content-center">
            <input style="visibility:hidden;"class="form-check-input" type="number" name ="commentarticleid" value="<?php echo $clgetarticle; ?>" id="invalidCheck" required>
            <button type="submit" class="btn btn-default" name="commentsubmit">Add Comment</button>
        </div>
      </form>
    </div>
  </div>
</div>
</div>



<?php

include('inc/footer.php');

?>





<script>

(function() {
'use strict';
window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();


</script>



    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>

    </body>
    </html>  






