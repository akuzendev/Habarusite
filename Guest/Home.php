<?php

include_once('../php/Database.php');



try{
  $row1db = new Database();
  $chksql1 = 'SELECT tbl_articles.id, tbl_articles.title, tbl_articles.subtitle, tbl_articles.thumbnail, tbl_articles.timestamp, tbl_users.username FROM tbl_articles
INNER JOIN app_settings ON tbl_articles.catergory = app_settings.row1cat
INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id 
WHERE app_settings.row1cat = tbl_articles.catergory AND tbl_articles.status = 1
ORDER BY timestamp DESC
LIMIT 3';
  $chkarg1 = null;
  $res1 = $row1db->executesql('selectall',$chksql1,$chkarg1);
  //var_dump($res1);
}catch(Exception $e){
  return 'An error occured with the returning row 1' .$e;
}


try{
  $row2db = new Database();
  $chksql2 = 'SELECT tbl_articles.id, tbl_articles.title, tbl_articles.subtitle, tbl_articles.thumbnail, tbl_articles.timestamp, tbl_users.username FROM tbl_articles
INNER JOIN app_settings ON tbl_articles.catergory = app_settings.row2cat
INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id 
WHERE app_settings.row2cat = tbl_articles.catergory AND tbl_articles.status = 1
ORDER BY timestamp DESC
LIMIT 3';
  $chkarg2 = null;
  $res2 = $row2db->executesql('selectall',$chksql2,$chkarg2);
  //var_dump($res2);
}catch(Exception $e){
  return 'An error occured with the returning row 2' .$e;
}


try{
  $row3db = new Database();
  $chksql3 = 'SELECT tbl_articles.id, tbl_articles.title, tbl_articles.subtitle, tbl_articles.thumbnail, tbl_articles.timestamp, tbl_users.username FROM tbl_articles
INNER JOIN app_settings ON tbl_articles.catergory = app_settings.row3cat
INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id 
WHERE app_settings.row3cat = tbl_articles.catergory AND tbl_articles.status = 1
ORDER BY timestamp DESC
LIMIT 3';
  $chkarg3 = null;
  $res3 = $row3db->executesql('selectall',$chksql3,$chkarg3);
  //var_dump($res3);
}catch(Exception $e){
  return 'An error occured with the returning row 3' .$e;
}


try{
  $row4db = new Database();
  $chksql4 = 'SELECT tbl_articles.id, tbl_articles.title, tbl_articles.subtitle, tbl_articles.thumbnail, tbl_articles.timestamp, tbl_users.username FROM tbl_articles
INNER JOIN app_settings ON tbl_articles.catergory = app_settings.row4cat
INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id 
WHERE app_settings.row4cat = tbl_articles.catergory AND tbl_articles.status = 1
ORDER BY timestamp DESC
LIMIT 3';
  $chkarg4 = null;
  $res4 = $row4db->executesql('selectall',$chksql4,$chkarg4);
  //var_dump($res3);
}catch(Exception $e){
  return 'An error occured with the returning row 3' .$e;
}






try{
  //returns row1cat info
  $returnconfig1 = new Database();
  $chkconfig1 = 'SELECT app_settings.row1cat, app_catergories.name as row1name FROM app_settings
  INNER JOIN app_catergories ON app_settings.row1cat = app_catergories.id';
  $chkargconfig1 = null;
  $resconfig1 = $returnconfig1->executesql('selectall',$chkconfig1,$chkargconfig1);
}catch(Exception $e){
  return 'An error occured with the returning Config' .$e;
}


try{
  //returns row2cat info
  $returnconfig2 = new Database();
  $chkconfig2 = 'SELECT app_settings.row2cat, app_catergories.name as row2name FROM app_settings
  INNER JOIN app_catergories ON app_settings.row2cat = app_catergories.id';
  $chkargconfig2 = null;
  $resconfig2 = $returnconfig2->executesql('selectall',$chkconfig2,$chkargconfig2);
}catch(Exception $e){
  return 'An error occured with the returning Config' .$e;
}


try{
  //returns row3cat info
  $returnconfig3 = new Database();
  $chkconfig3 = 'SELECT app_settings.row3cat, app_catergories.name as row3name FROM app_settings
  INNER JOIN app_catergories ON app_settings.row3cat = app_catergories.id';
  $chkargconfig3 = null;
  $resconfig3 = $returnconfig3->executesql('selectall',$chkconfig3,$chkargconfig3);
}catch(Exception $e){
  return 'An error occured with the returning Config 3' .$e;
}



try{
  //returns row3cat info
  $returnconfig4 = new Database();
  $chkconfig4 = 'SELECT app_settings.row4cat, app_catergories.name as row4name FROM app_settings
  INNER JOIN app_catergories ON app_settings.row4cat = app_catergories.id';
  $chkargconfig4 = null;
  $resconfig4 = $returnconfig4->executesql('selectall',$chkconfig4,$chkargconfig4);
}catch(Exception $e){
  return 'An error occured with the returning Config 4' .$e;
}



try{
  //returns row3cat info
  $returnconfig5 = new Database();
  $chkconfig5 = "SELECT app_settings.breakingnewsid FROM app_settings";
  $chkargconfig5 = null;
  $resconfig5 = $returnconfig5->executesql('selectone',$chkconfig5,$chkargconfig5);
  //var_dump($resconfig5);
}catch(Exception $e){
  return 'An error occured with the returning Config 4' .$e;
}






if($resconfig5['breakingnewsid'] == 0){
  //return top news
  try{
    $returnconfig8 = new Database();
    $chkconfig8 = "SELECT tbl_articles.id, tbl_articles.title, tbl_articles.subtitle, tbl_articles.thumbnail, tbl_articles.timestamp, tbl_users.username FROM tbl_articles
    INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id
    WHERE tbl_articles.status = 1
    ORDER BY timestamp ASC
    LIMIT 1";
    $chkargconfig8 = null;
    $resconfig8 = $returnconfig8->executesql('selectone',$chkconfig8,$chkargconfig8);
    //var_dump($resconfig8);
  }catch(Exception $e){
    return 'An error occured with the returning Config 4' .$e;
  }
  }else if($resconfigbn['breakingnewsid'] !== 0){
  //return breaking news
  try{
      $returnconfig8 = new Database();
      $chkconfig8 = " SELECT tbl_articles.id, tbl_articles.title, tbl_articles.subtitle, tbl_articles.thumbnail, tbl_articles.timestamp, tbl_users.username, app_settings.breakingnewsid
      FROM tbl_articles
      INNER JOIN app_settings ON tbl_articles.id = app_settings.breakingnewsid 
      INNER JOIN tbl_users ON tbl_articles.byuserid = tbl_users.id 
      WHERE tbl_articles.status = 1 AND tbl_articles.id = app_settings.breakingnewsid 
      ORDER BY tbl_articles.timestamp ASC LIMIT 1";
      $chkargconfig8 = null;
      $resconfig8 = $returnconfig8->executesql('selectone',$chkconfig8,$chkargconfig8);
      //var_dump($resconfig8);
    }catch(Exception $e){
      return 'An error occured with the returning Config 4' .$e;
    }
  }else{
      echo 'An error occured';
  }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="../assets/css/css.css">
    <!-- Bootstrap core CSS -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../assets/css/mdb.min.css" rel="stylesheet">

    <title>Habarusite - Home</title>
</head>
<body>

<?php include_once('inc/guest-navbar.php') ?>

<br>
<br>
<br>

<div class="container mt-5">


<!--

Example Top News Card

-->

<div class='card p-5'>
  <!--Section: Content-->

  <?php

  if($resconfig5['breakingnewsid'] == 0){
    

    echo "
    
    <section class='dark-grey-text'>
    <div class='row align-items-center'>
      <!-- Grid column -->
      <div class='col-lg-5'>
        <!-- Featured image -->
        <div class='view overlay rounded z-depth-2 mb-lg-0 mb-4'>
          <img class='img-fluid' src=".$resconfig8['thumbnail']." alt='Sample image'>
          <a>
            <div class='mask rgba-white-slight'></div>
          </a>
        </div>
      </div>
      <!-- Grid column -->
      <!-- Grid column -->
      <div class='col-lg-7'>
        <!-- Category -->
        <a href='#!' class='green-text'>
          <h6 class='font-weight-bold mb-3'><i class='far fa-newspaper mr-2'></i>Top News</h6>
        </a>
        <!-- Post title -->
        <h4 class='font-weight-bold mb-3'><strong>".$resconfig8['title']."</strong></h4>
        <!-- Excerpt -->
        <p>".$resconfig8['subtitle']."</p>
        <!-- Post data -->
        <p>by: <a><strong>@".$resconfig8['username']."</strong></a>, ".$resconfig8['timestamp']."</p>
        <!-- Read more button -->
        <a class='btn btn-success btn-md btn-rounded mx-0' href='Article.php?articleid=".$resconfig8['id']."'>Read more</a>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
    <hr class='my-5'>
  </section>


    
    ";






  }else if($resconfig5['breakingnewsid'] !== 0){

    echo "
    
    <section class='dark-grey-text'>
    <div class='row align-items-center'>
      <!-- Grid column -->
      <div class='col-lg-5'>
        <!-- Featured image -->
        <div class='view overlay rounded z-depth-2 mb-lg-0 mb-4'>
          <img class='img-fluid' src=".$resconfig8['thumbnail']." alt='Sample image'>
          <a>
            <div class='mask rgba-white-slight'></div>
          </a>
        </div>
      </div>
      <!-- Grid column -->
      <!-- Grid column -->
      <div class='col-lg-7'>
        <!-- Category -->
        <a href='#!' class='red-text'>
          <h6 class='font-weight-bold mb-3'><i class='fas fa-fire-alt mr-2'></i>Breaking News</h6>
        </a>
        <!-- Post title -->
        <h4 class='font-weight-bold mb-3'><strong>".$resconfig8['title']."</strong></h4>
        <!-- Excerpt -->
        <p>".$resconfig8['subtitle']."</p>
        <!-- Post data -->
        <p>by: <a><strong>@".$resconfig8['username']."</strong></a>, ".$resconfig8['timestamp']."</p>
        <!-- Read more button -->
        <a class='btn btn-success btn-md btn-rounded mx-0' href='Article.php?articleid=".$resconfig8['id']."'>Read more</a>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
    <hr class='my-5'>
  </section>


    
    ";

  }else{

  }

  ?>

  <!--Section: Content-->
  </div>
</div>





<div class="container mt-5">


  <!--Section: Content-->
  <section class="">

    <!-- Section heading -->
    <?php 
      foreach($resconfig1 as $config1title){
        echo "
        <div class='row'>
          <div class='col-sm-12'>
            <div class='text-start mt-5'>
              <h3 class='text-start font-weight-bold mb-3'>".$config1title['row1name']."</h3>
            </div>        
          </div>
        </div>
        ";
      }
    ?>
  	<!-- Grid row -->
    <div class="row"> 
    <?php
    foreach ($res1 as $res1card){
      echo "
      <div class='col-lg-4 col-md-6 mb-3'>
        <div class='card hoverable'>
          <img class='card-img-top' src='".$res1card['thumbnail']."' alt='Card image'>
          <div class='card-body'>
            <a class='black-text'>".$res1card['title']."</a>
            <p class='card-title text-muted font-small mt-3 mb-2'>".$res1card['subtitle']."</p>
            <br>
            <div class='row'>
              <div class='col-sm-5 d-flex justify-content-start'><p class='text-small'>@".$res1card['username']."</p></div>
              <div class='col-sm-7 d-flex justify-content-end'><p class='text-small'>".$res1card['timestamp']."</p></div>
            </div>
            <a class='btn btn-primary text-white' href='Article.php?articleid=".$res1card['id']."'>Read More</a>
          </div>
        </div>
      </div>
      ";
    }
    ?>
  </section>




  <section class="">
    <!-- Section heading -->
    <?php 
      foreach($resconfig2 as $config2title){
        echo "
        <div class='row'>
          <div class='col-sm-12'>
            <div class='text-start mt-5'>
              <h3 class='text-start font-weight-bold mb-3'>".$config2title['row2name']."</h3>
            </div>        
          </div>
        </div>
        ";
      }
    ?>
  	<!-- Grid row -->
    <div class="row"> 
    <?php
    foreach ($res2 as $res2card){
      echo "
      <div class='col-lg-4 col-md-6 mb-3'>
        <div class='card hoverable'>
          <img class='card-img-top' src='".$res2card['thumbnail']."' alt='Card image'>
          <div class='card-body'>
            <a class='black-text'>".$res2card['title']."</a>
            <p class='card-title text-muted font-small mt-3 mb-2'>".$res2card['subtitle']."</p>
            <br>
            <div class='row'>
              <div class='col-sm-5 d-flex justify-content-start'><p class='text-small'>@".$res2card['username']."</p></div>
              <div class='col-sm-7 d-flex justify-content-end'><p class='text-small'>".$res2card['timestamp']."</p></div>
            </div>
            <a class='btn btn-primary text-white' href='Article.php?articleid=".$res2card['id']."'>Read More</a>
          </div>
        </div>
      </div>
      ";
    }
    ?>
  </section>



  <section class="">
  <?php 
      foreach($resconfig3 as $config3title){
        echo "
        <div class='row'>
          <div class='col-sm-12'>
            <div class='text-start mt-5'>
              <h3 class='text-start font-weight-bold mb-3'>".$config3title['row3name']."</h3>
            </div>        
          </div>
        </div>
        ";
      }
    ?>
  	<!-- Grid row -->
    <div class="row"> 
    <?php
    foreach ($res3 as $res3card){
      echo "
      <div class='col-lg-4 col-md-6 mb-3'>
        <div class='card hoverable'>
          <img class='card-img-top' src='".$res3card['thumbnail']."' alt='Card image'>
          <div class='card-body'>
            <a class='black-text'>".$res3card['title']."</a>
            <p class='card-title text-muted font-small mt-3 mb-2'>".$res3card['subtitle']."</p>
            <br>
            <div class='row'>
              <div class='col-sm-5 d-flex justify-content-start'><p class='text-small'>@".$res3card['username']."</p></div>
              <div class='col-sm-7 d-flex justify-content-end'><p class='text-small'>".$res3card['timestamp']."</p></div>
            </div>
            <a class='btn btn-primary text-white' href='Article.php?articleid=".$res3card['id']."'>Read More</a>
          </div>
        </div>
      </div>
      ";
    }
    ?>
  </section>




  <section class="">
  <?php 
      foreach($resconfig4 as $config4title){
        echo "
        <div class='row'>
          <div class='col-sm-12'>
            <div class='text-start mt-5'>
              <h3 class='text-start font-weight-bold mb-3'>".$config4title['row4name']."</h3>
            </div>        
          </div>
        </div>
        ";
      }
    ?>
  	<!-- Grid row -->
    <div class="row"> 
    <?php
    foreach ($res4 as $res4card){
      echo "
      <div class='col-lg-4 col-md-6 mb-3'>
        <div class='card hoverable'>
          <img class='card-img-top' src='".$res4card['thumbnail']."' alt='Card image'>
          <div class='card-body'>
            <a class='black-text'>".$res4card['title']."</a>
            <p class='card-title text-muted font-small mt-3 mb-2'>".$res4card['subtitle']."</p>
            <br>
            <div class='row'>
              <div class='col-sm-5 d-flex justify-content-start'><p class='text-small'>@".$res4card['username']."</p></div>
              <div class='col-sm-7 d-flex justify-content-end'><p class='text-small'>".$res4card['timestamp']."</p></div>
            </div>
            <a class='btn btn-primary text-white' href='Article.php?articleid=".$res4card['id']."'>Read More</a>
          </div>
        </div>
      </div>
      ";
    }
    ?>
  </section>
</div>

<?php

include('inc/footer.php');

?>








<!--
SELECT * FROM tbl_articles 
INNER JOIN app_settings ON tbl_articles.catergory = app_settings.row1cat
WHERE app_settings.row1cat = tbl_articles.catergory
-->

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/mdb.min.js"></script>

<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../assets/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->

</body>
</html>