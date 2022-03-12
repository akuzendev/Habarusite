<?php 
include_once('../php/Database.php');



try{
  $returntimelines = new Database();
  $chksql = 'SELECT * FROM tbl_timelines WHERE tbl_timelines.status = 1';
  $chkarg = null;
  $restimelines = $returntimelines->executesql('selectall',$chksql,$chkarg);
//  var_dump($restimelines);
}catch(Exception $e){
  return 'An error occured with the returning Timelines' .$e;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../assets/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="../assets/css/css.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../assets/css/mdb.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Timelines</title>
</head>
<body>


<?php include_once('inc/guest-navbar.php') ?>

<br>
<br>
<br>
<br>
<div class="container my-5">
  <!--Section: Content-->
  <section class="dark-grey-text">
    <!-- Section heading -->
    <h3 class="text-center font-weight-bold mb-4 pb-2">Timelines</h3>
    <hr class="w-header">
    <!-- Section description -->
    <!--First row-->
    <div class="row">

    <?php 
        foreach($restimelines as $timelines){
            echo "
            <div class='col-md-12 mb-4'>
              <a href='' class='card hoverable'></a>
                <div class='card-body'>
                    <div class='media'>
                    <span class='card-img-100 d-inline-flex justify-content-center align-items-center grey lighten-3 mr-4'>
                      <img src='".$timelines['thumbnailurl']."' class='img-fluid'/>
                    </span>
                    <div class='media-body'>
                      <h5 class='dark-grey-text mb-3'>".$timelines['title']."</h5>
                      <p class='dark-grey-text text-small mb-3'>".$timelines['createddate']."</p>
                      <p class='font-weight-light text-muted mb-0'>".$timelines['subtitle']."</p>
                     <br>      
                   </div>
                   <span class='card-img-300 d-inline-flex justify-content-start align-items-end lighten-3 mr-4'>
                          <a class='btn btn-primary text-white' href='Timeline.php?timelineid=".$timelines['id']."'>Read More</a> 
                    </span>
                  </div>
                </div>
              </a>
              <!-- Card -->
            </div>
                  
            
            ";


        }    
    
    ?>
      <!--First column-->


      <!--Second column-->
    </div>
    <!--First row-->
	</section>
</div>

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
<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../assets/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
</body>
</html>