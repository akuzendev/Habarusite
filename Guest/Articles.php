<?php
include_once('../php/Database.php');

$cattype = $_GET['catergoryid'];
$ccatype = htmlspecialchars($cattype);


try{
    $getarticle = new Database();
    $chksql = 'SELECT tbl_articles.id, tbl_articles.istimeline, tbl_articles.timelineid, tbl_articles.title, tbl_articles.subtitle, app_catergories.name, tbl_articles.thumbnail, tbl_articles.byuserid, tbl_users.username, tbl_articles.timestamp, tbl_articles.content, tbl_articles.relcommentid, app_catergories.name as catergoryname FROM tbl_articles
    INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id
    INNER JOIN app_catergories ON tbl_articles.catergory = app_catergories.id
    WHERE tbl_articles.catergory = :id AND tbl_articles.status = 1';
    $chkargs = array('id'=>$ccatype);
    $resarticle = $getarticle->executesql('crud',$chksql, $chkargs);
    //var_dump($resarticle);

}catch(Exception $e){
    return 'an error occured in article retreival' .$e;
}



try{
  $getmeta = new Database();
  $chksql = "SELECT * FROM app_catergories WHERE app_catergories.id = $ccatype";
  $args = null;
  $responsemeta = $getmeta->executesql('selectone',$chksql,$args);
  //var_dump($responsemeta);
}catch(Exception $e){
  return 'An error occured with response meta'.$e;
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
        <title><?php $responsemeta['name'] ?></title>
    </head>
    <body>
    <?php include_once('inc/guest-navbar.php') ?>
<br>
<br>
<br>
<br>
    <div class="container mt-5">
    <div class="row">
      <div class="col-sm-12">
        <h3 class="text-center font-weight-bold mb-4 pb-2"><?php echo $responsemeta['name']; ?></h3>
        <h6 class="text-center font-weight-bold mb-4 pb-2"><?php echo $responsemeta['description']; ?></h6>
      </div>
    </div>
    <!--Section: Content-->
    <section class="">
      <!-- Section heading -->
          <!-- Grid row -->
      <div class="row"> 
      <?php
      
      foreach ($resarticle as $articles){

        echo "
        <div class='col-lg-4 col-md-6 mb-3'>
          <div class='card hoverable'>
            <img class='card-img-top' src='".$articles['thumbnail']."' alt='Card image'>
            <div class='card-body'>
              <a class='black-text'>".$articles['title']."</a>
              <p class='card-title text-muted font-small mt-3 mb-2'>".$articles['subtitle']."</p>
              <br>
              <div class='row'>
                <div class='col-sm-5 d-flex justify-content-start'><p class='text-small'>@".$articles['username']."</p></div>
                <div class='col-sm-7 d-flex justify-content-end'><p class='text-small'>".$articles['timestamp']."</p></div>
              </div>
              <a class='btn btn-primary text-white' href='Article.php?articleid=".$articles['id']."'>Read More</a>
            </div>
          </div>
        </div>
        ";
    
      }
      ?>
    </section>

</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php

include('inc/footer.php');

?>









    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../assets/js/mdb.min.js"></script>
    <script type="text/javascript" src="../assets/js/popper.min.js"></script>

    </body>
    </html>  






