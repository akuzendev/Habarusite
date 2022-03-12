<?php

session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');

$userid = $_SESSION['userid'];
$editcomment = $_GET['commentid'];


try{
    $newDb = new Database();
    $chksql = 'SELECT * FROM tbl_users WHERE status = 0';
    $chkarg = null;
    $chkusers = $newDb->executesql('selectall',$chksql,$chkarg); 
    //var_dump($chkcat);
}catch(Exception $e){
    echo '';
}


try{
    $newDb = new Database();
    $chksql2 = 'SELECT * FROM tbl_articles WHERE status = 1';
    $chkarg2 = null;
    $chkarticles = $newDb->executesql('selectall',$chksql2,$chkarg2); 
    //var_dump($chkcat);
}catch(Exception $e){
    echo '';
}





try{
    $edcomment = new Database();
    $chksqledit = "SELECT 
    tbl_comments.id,
    tbl_comments.content,
    tbl_comments.timestamp,
    tbl_comments.byuserid,
    tbl_users.username,
    tbl_comments.onarticleid,
    tbl_articles.title,
    tbl_comments.status
    FROM `tbl_comments`
    INNER JOIN tbl_users ON tbl_users.id = tbl_comments.byuserid INNER JOIN tbl_articles ON tbl_articles.id =tbl_comments.onarticleid WHERE tbl_comments.id = :id";
    $chkargedit = array('id' => $editcomment);
    $reseditcomment = $edcomment->executesql('selectone',$chksqledit, $chkargedit);
    //var_dump($reseditcomment);
}catch(Exception $e){
    echo 'An Error occured in Comment retreival' .$e;
}




if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $editcontent = $_POST['commentcontent'];
    $editcommenttimestamp = $_POST['commenttimestamp'];
    $editbyuserid = $_POST['editbyuser'];
    $editonarticleid = $_POST['editonarticleid'];
    $editstatus = $_POST['editstatus'];


    try{
        $edittimeline = new Database();
        $editsql = "UPDATE `tbl_comments` SET `content`='$editcontent',`timestamp`='$editcommenttimestamp',`byuserid`='$editbyuserid',`onarticleid`='$editonarticleid',`status`='$editstatus' WHERE tbl_comments.id =$editcomment";
        $editarg = null;
        $res = $edittimeline->executesql('crud',$editsql,$editarg);
        header('Location: ../CommentsDashboard.php');
    }catch(Exception $e){
        echo 'Error occured with Editting Timelines'.$e;
    }


}else{
 
}


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Comment</title>
</head>
<body>


<div class="container">
    <div class="row">
    <div class="col-sm-1">
<br>
            <a class="btn btn-primary" href="../CommentsDashboard.php"><i data-feather="arrow-left"></i></a>
        </div>
        <div class="col-sm-11">
<br>
            <h1 class="d-flex justify-content-center">Edit Comment</h1>
<br>
        </div>
    <div class="col-md-12">


<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3 needs-validation" novalidate>

<div class="col-md-9">
    <label for="validationCustom01" class="form-label">Comment Content</label>
    <input type="text" class="form-control" name="commentcontent" id="validationCustom01" value="<?php echo $reseditcomment['content'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Title
    </div>
</div>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Thumbnail Timestamp</label>
    <input type="datetime-local" class="form-control" name="commenttimestamp" id="validationCustom01" value="<?php echo date('Y-m-d\TH:i:s', strtotime($reseditcomment['timestamp'])); ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Timestamp
    </div>
</div>


<div class="col-md-4">
<label for="validationCustom04" class="form-label">By User</label>
    <select class="form-select" id="validationCustom04" name="editbyuser">
    <?php
        echo "<option selected value=".$reseditcomment['byuserid'].">".$reseditcomment['byuserid']."---".$reseditcomment['username']."</option>";
        echo "<option disabled>__________</option>";
        foreach($chkusers as $users){
            echo "<option value=".$users['id'].">".$users['id']."---".$users['username']."</option>";
        }
      ?> 
    </select>
</div>



<div class="col-md-4">
<label for="validationCustom04" class="form-label">Target Article</label>
    <select class="form-select" id="validationCustom04" name="editonarticleid">
    <?php
        echo "<option selected value=".$reseditcomment['onarticleid'].">".$reseditcomment['onarticleid']."---".$reseditcomment['title']."</option>";
        echo "<option disabled>__________</option>";
        foreach($chkarticles as $articles){
            echo "<option value=".$articles['id'].">".$articles['id']."---".$articles['title']."</option>";
        }
      ?> 
    </select>
</div>






<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Status</label>
    <select class="form-select" name="editstatus">
        <?php 
            if($reseditcomment['status'] == 1){
                echo "<option selected value='1'>Active</option>";
                echo "<option value='2'>Taken Down</option>";
            }else if($reseditcomment['status'] == 2){
                echo "<option selected value='2'>Taken Down</option>"; 
                echo "<option  value='1'>Active</option>";
            }else{

            }
        ?>
    </select>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Timestamp
    </div>
</div>



<div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="valid-feedback">
      Ok!
    </div>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
</div>


<div class="col-12">
    <button class="btn btn-primary" type="submit">Edit Article</button>
</div>


</form>





    </div>
    </div>
</div>

<script>
      feather.replace()
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
