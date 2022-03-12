<?php 
include_once('../php/Database.php');

$gettimelineid = $_GET['timelineid'];
$cltimelineid = filter_var(htmlspecialchars($gettimelineid), FILTER_SANITIZE_NUMBER_INT);


try{
  $returntimelineinfo = new Database();
  $chksql = 'SELECT tbl_articles.thumbnail as articlethumbnailurl, tbl_articles.id, tbl_articles.title, tbl_articles.subtitle, tbl_articles.timestamp FROM tbl_articles
  INNER JOIN tbl_timelines ON tbl_articles.timelineid = tbl_timelines.id 
  WHERE tbl_articles.istimeline = 1 AND tbl_timelines.id = :id
  ORDER BY tbl_articles.timestamp ASC
  ';
  $chkarg = array('id'=>$cltimelineid);
  $restimelinedata = $returntimelineinfo->executesql('crud',$chksql,$chkarg);
  //var_dump($restimelinedata);
}catch(Exception $e){
  return 'An error occured with the returning Timelines'.$e;
}



try{
    $restimelinemeta = new Database();
    $chksql1 = 'SELECT tbl_timelines.title as timelinetitle, tbl_timelines.subtitle as timelinesubtitle, tbl_timelines.thumbnailurl as timelinethumbnailurl  FROM tbl_timelines WHERE tbl_timelines.id = :id LIMIT 1';
    $chkarg1 = array('id'=>$cltimelineid);
    $restimelineinfo = $restimelinemeta->executesql('selectone',$chksql1,$chkarg1);
    //var_dump($restimelineinfo);
}catch(Exception $e){
    return 'An error occured with returning Timeline info'.$e;
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
    <title><?php echo $restimelineinfo["timelinetitle"] ?></title>
</head>
<body>


<?php include_once('inc/guest-navbar.php') ?>


<div class="container z-depth-1 my-5 py-5 px-4 px-lg-0">


  <section> 
    <style>
      .timeline {
        position: relative;
        list-style: none;
        padding: 1rem 0;
        margin: 0;
      }

      .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        top: 0;
        bottom: 0;
        width: 2px;
        margin-left: -1px;
        background-color: #50a1ff;
      }

      .timeline-element {
        position: relative;
        width: 50%;
        padding: 1rem 0;
        padding-right: 2.5rem;
        text-align: right;
      }

      .timeline-element::before {
        content: '';
        position: absolute;
        right: -8px;
        top: 1.35rem;
        display: inline-block;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 2px solid #50a1ff;
        background-color: #fff;
      }

      .timeline-element:nth-child(even)::before {
        right: auto;
        left: -8px;
      }

      .timeline-element:nth-child(even) {
        margin-left: 50%;
        padding-left: 2.5rem;
        padding-right: 0;
        text-align: left;
      }

      @media (max-width: 767.98px) {
        .timeline::before {
          left: 8px;
        }
      }

      @media (max-width: 767.98px) {
        .timeline-element {
          width: 100%;
          text-align: left;
          padding-left: 2.5rem;
          padding-right: 0;
        }
      }

      @media (max-width: 767.98px) {
        .timeline-element::before {
          top: 1.25rem;
          left: 1px;
        }
      }

      @media (max-width: 767.98px) {
        .timeline-element:nth-child(even) {
          margin-left: 0rem;
        }
      }

      @media (max-width: 767.98px) {
        .timeline-element {
          width: 100%;
          text-align: left;
          padding-left: 2.5rem;
          padding-right: 0;
        }
      }

      @media (max-width: 767.98px) {
        .timeline-element:nth-child(even)::before {
          left: 1px;
        }
      }

      @media (max-width: 767.98px) {
        .timeline-element::before {
          top: 1.25rem;
        }
      }
    </style>

    
    <div class="row">
      <div class="col-lg-8 mx-auto">
            <h3 class='font-weight-bold text-center dark-grey-text pb-2'>"<?php echo $restimelineinfo["timelinetitle"] ?>"</h3>
            <hr class='w-header my-4'>
            <p class='lead text-center text-muted  mb-5'>"<?php echo $restimelineinfo["timelinesubtitle"] ?>"</p>    
        <ol class="timeline">

        <?php
        
        foreach ($restimelinedata as $timelineentry){
            echo "
            <li class='timeline-element'>
            <h5 class='font-weight-bold dark-grey-text mb-3'>".$timelineentry['title']."</h5>
            <h6 class='font-weight-bold dark-grey-text mb-3'>".$timelineentry['subtitle']."</h6>
            <p class='grey-text font-small'>".$timelineentry['timestamp']."</p>
            <p><img class='img-fluid z-depth-1-half rounded' src='".$timelineentry['articlethumbnailurl']."' alt='...'></p>
            <a class='btn btn-info outline' href='Article.php?articleid=".$timelineentry['id']."'>Read Article</a>
            </li>

            ";
        }
        
        ?>



        </ol>

      </div>
    </div>
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