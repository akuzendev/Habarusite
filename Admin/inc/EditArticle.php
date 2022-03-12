<?php
session_start();

require_once('checkstate.php');
include_once('../../php/Database.php');

$userid = $_SESSION['userid'];
$editarticleid = $_GET['articleid'];

try{
    $edtart = new Database();
    $chksqledit = "SELECT tbl_articles.relcommentid, tbl_articles.istimeline, tbl_articles.timelineid, tbl_articles.title, tbl_articles.subtitle, tbl_articles.catergory, tbl_articles.thumbnail, tbl_articles.timestamp,tbl_articles.content,tbl_articles.status, tbl_articles.approvedbyuserid 
    FROM `tbl_articles`
    WHERE tbl_articles.id = :id";
    $chkargedit = array('id' => $editarticleid);
    $reseditart = $edtart->executesql('selectone',$chksqledit, $chkargedit);
    //var_dump($reseditart);
}catch(Exception $e){
    echo 'An Error occured in Article retreival' .$e;
}


try{
  $edarttimeline = new Database();
  $chksqltimeline = "SELECT tbl_timelines.id, tbl_timelines.title FROM tbl_timelines
  INNER JOIN tbl_articles ON tbl_timelines.id = tbl_articles.timelineid
  WHERE tbl_timelines.id =".$reseditart['timelineid']." AND tbl_articles.timelineid !=0";
  $chkargstimeline = null;
  $restimeline = $edarttimeline->executesql('selectone',$chksqltimeline,$chkargstimeline);
  //var_dump($restimeline);
}catch(Exception $e){
  return 'An error occured with the timeline retrieval'.$e;
}



try{
    $newDb = new Database();
    $chksql = 'SELECT * FROM app_catergories';
    $chkarg = null;
    $chkcat = $newDb->executesql('selectall',$chksql,$chkarg); 
    //var_dump($chkcat);
}catch(Exception $e){
    echo '';
}


try{
    $newDb2 = new Database();
    $chksql2 = 'SELECT * FROM tbl_timelines WHERE status = 1';
    $chkarg2 = null;
    $chktimelines = $newDb2->executesql('selectall',$chksql2,$chkarg2); 
    //var_dump($chkcat);
}catch(Exception $e){
    echo '';
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $etitle = $_POST['edittitle'];
    $esubtitle = $_POST['editsubtitle'];
    $etimestamp = $_POST['edittimestamp'];
    $eistimeline = $_POST['editistimeline'];
    $etimeline =  $_POST['edittimeline'];
    $ecatergory = $_POST['editcatergory'];
    $estatus = $_POST['editstatus'];
    $ethumbnail = $_POST['editthumbnail'];
    $econtent = $_POST['editcontent'];
    $erelcommentsec = $_POST['editrelcommentsec'];


    //$datetime = strtotime($etimestamp);



    try{
        $editarticle = new Database();
        $editsql = "UPDATE `tbl_articles` SET `istimeline`='$eistimeline',`timelineid`='$etimeline',`title`='$etitle',`subtitle`='$esubtitle',`catergory`='$ecatergory',`thumbnail`='$ethumbnail',`timestamp`='$etimestamp',`content`='$econtent',`status`='$estatus' WHERE tbl_articles.id = $editarticleid";
        $editarg = null;
        $res = $editarticle->executesql('crud',$editsql,$editarg);
        header('Location: ../ArticleDashboard.php');
    }catch(Exception $e){
        echo 'Error occured with Editting'.$e;
    }

/*
        echo $etitle;
    echo '<br>';
    echo $esubtitle;
    echo '<br>';
    echo $etimestamp;
    echo '<br>';
    echo $eistimeline;
    echo '<br>';
    echo $etimeline;
    echo '<br>';
    echo $ecatergory;
    echo '<br>';
    echo $estatus;
    echo '<br>';
    echo $ethumbnail;
    echo '<br>';
    echo $econtent;


*/  
}else{
 
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
    <title>Edit Article</title>
</head>
<body>
<br>

<?php
//var_dump($chktimelines);


?>

<div class="container">
    <div class="row">
        <div class="col-sm-1">
            <a class="btn btn-primary" href="../ArticleDashboard.php"><i data-feather="arrow-left"></i></a>
        </div>
        <div class="col-sm-11">
            <h1 class="d-flex justify-content-center">Edit Articles</h1>
<br>
<br>
<br>
        </div>
        <div class="col-sm-12">

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3 needs-validation" novalidate>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Title</label>
    <input type="text" class="form-control" name="edittitle" id="validationCustom01" value="<?php echo $reseditart['title'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Title
    </div>
</div>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Subtitle</label>
    <input type="text" class="form-control" name="editsubtitle" id="validationCustom01" value="<?php echo $reseditart['subtitle'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Subtitle
    </div>
</div>


<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Article Timestamp</label>
    <input type="datetime-local" class="form-control" name="edittimestamp" id="validationCustom01" value="<?php echo date('Y-m-d\TH:i:s', strtotime($reseditart['timestamp'])); ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Timestamp
    </div>
</div>




<div class='col-md-4'>
<label for='validationCustom04' class='form-label'>Is this Article part of a Timeline?</label>
    <select class='form-select' id='validationCustom04' name="editistimeline"  required>
    <?php   
        switch($reseditart['istimeline']){
            case 1:
                echo '<option selected value="1">Yes</option>';
                echo '<option value="0">No</option>';    
            break;
            case 0:
                echo '<option selected value="0">No</option>';
                echo '<option value="1">Yes</option>';    
            break;
            default:
                echo '<option selected value="">Please select an Option</option>';
                echo '<option value="1">Yes</option>';
                echo '<option value="0">No</option>';
        }
     ?>        
    </select>
    <div class='valid-feedback'>
      Ok!
    </div>
    <div class='invalid-feedback'>
      Please choose an Article Option.
    </div>
</div>




<div class="col-md-4">
<label for="validationCustom04" class="form-label">Article Timeline</label>
    <select class="form-select" id="validationCustom04" name="edittimeline">
      <?php
      if($reseditart['timelineid'] == 0){
        echo "<option selected value=".$restimeline['id'].">".$restimeline['title']."</option>";
        echo "<option disabled value=''>__________________</option>";
        echo "<option value='0'>No Timeline</option>";
        foreach($chktimelines as $timelines){

            echo '<option value='.$timelines['id'].'>'.$timelines['title'].'</option>';
        }
      }else{
        echo "<option value='0'>No Timeline</option>";
        foreach($chktimelines as $timelines){
            echo '<option selected value='.$timelines['id'].'>'.$timelines['title'].'</option>';
        }
      }
      ?> 
    </select>
</div>



<div class="col-md-4">
<label for="validationCustom04" class="form-label">Article Catergory</label>
    <select class="form-select" id="validationCustom04" name="editcatergory" required>
      <option selected disabled value="">Please choose an Option</option>
      <?php
            
            switch($reseditart['catergory']){
                case 1 :
                    echo 
                    "
                    <option selected value='1'>Local</option>
                    <option value='2'>World</option>
                    <option value='3'>Tech</option>
                    <option value='4'>Buisness</option>
                    <option value='5'>Sports</option>
                    <option value='6'>Op-Ed</option>
                    ";
                break;
                case 2 :
                    echo 
                    "
                    <option value='1'>Local</option>
                    <option selected value='2'>World</option>
                    <option value='3'>Tech</option>
                    <option value='4'>Buisness</option>
                    <option value='5'>Sports</option>
                    <option value='6'>Op-Ed</option>
                    ";                     
                break;
                case 3 :
                    echo 
                    "
                    <option value='1'>Local</option>
                    <option value='2'>World</option>
                    <option selected value='3'>Tech</option>
                    <option value='4'>Buisness</option>
                    <option value='5'>Sports</option>
                    <option value='6'>Op-Ed</option>
                    ";
                break;
                case 4 :
                    echo 
                    "
                    <option value='1'>Local</option>
                    <option value='2'>World</option>
                    <option value='3'>Tech</option>
                    <option selected value='4'>Buisness</option>
                    <option value='5'>Sports</option>
                    <option value='6'>Op-Ed</option>
                    ";
                break;
                case 5 :
                    echo 
                    "
                    <option value='1'>Local</option>
                    <option value='2'>World</option>
                    <option value='3'>Tech</option>
                    <option value='4'>Buisness</option>
                    <option selected value='5'>Sports</option>
                    <option value='6'>Op-Ed</option>
                    ";
                break;
                case 6 :
                    echo 
                    "
                    <option value='1'>Local</option>
                    <option value='2'>World</option>
                    <option value='3'>Tech</option>
                    <option value='4'>Buisness</option>
                    <option value='5'>Sports</option>
                    <option selected value='6'>Op-Ed</option>
                    ";
                break;
                default:
                echo 
                "
                <option selected disabled value=''>Please select a Catergory</option>
                <option value='1'>Local</option>
                <option value='2'>World</option>
                <option value='3'>Tech</option>
                <option value='4'>Buisness</option>
                <option value='5'>Sports</option>
                <option value='6'>Op-Ed</option>
                ";
            }
      ?> 
    </select>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please select an Article Catergory.
    </div>
</div>



<div class="col-md-4">
<label for="validationCustom04" class="form-label">Article Status</label>
    <select class="form-select" id="validationCustom04" name="editstatus" required>
      <option selected disabled value="">Please choose an Option</option>
      <?php   
        switch($reseditart['status']){
            case 1:
                echo '<option selected value="1">Active</option>';
                echo '<option value="0">Taken Down</option>';    
            break;
            case 0:
                echo '<option selected value="0">Taken Down</option>';
                echo '<option value="1">Active</option>';    
            break;
            default:
                echo '<option selected value="">Please select an Option</option>';
                echo '<option value="1">Active</option>';
                echo '<option value="0">Taken Down</option>';
        }
     ?>  
    </select>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please select an Article Status.
    </div>
</div>


<div class="col-md-12">
    <label for="validationCustom01" class="form-label">Article Comment Section ID</label>
    <input type="number" class="form-control" id="validationCustom01" name="editrelcommentsec" value="<?php echo $reseditart['relcommentid'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please Provide a Article Comment Section ID
    </div>
</div>


<div class="col-md-12">
    <label for="validationCustom01" class="form-label">Article Thumbnail</label>
    <input type="text" class="form-control" id="validationCustom01" name="editthumbnail" value="<?php echo $reseditart['thumbnail'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please Provide an Article Thumbnail
    </div>
</div>



<div class="col-md-12">
    <label for="validationCustom01" class="form-label">Article Content</label>
    <input type="textarea" style="height:100px" class="form-control" id="validationCustom01" name="editcontent" value="<?php echo $reseditart['content'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Article Content
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

<br>
<br>
<br>
        </div>
    </div>
</div>





<!--
<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
<select name="istimeline">
    <option value="">Is the article part of a timeline?</option>
    <option value=0>Yes</option>
    <option value=1>No</option>
</select>
<br>
<select>
        <option name="timelineid" value=>select a Timeline (if needed)</option>
    <?php
        foreach($chktimelines as $timelines){
            echo '<option value='.$timelines['id'].'>'.$timelines['title'].'</option>';
        }
    ?> 
</select>
<br>
<input type="text" name="title" placeholder="title"/>
<br>
<input type="text" name="subtitle" placeholder="subtitle"/>
<br>
<input type="text" name="thumbnail" placeholder="thumbnail"/>
<br>
<select name="catergory" >
        <option value="">select a catergory</option>
    <?php
        foreach($chkcat as $catergories){
            echo '<option value='.$catergories['id'].'>'.$catergories['name'].'</option>';
        }
    ?> 
</select>
<br>
<input type="text" name="content" placeholder="content"/>
<br>
<input type="number" name="relcommentid" placeholder="commentid"/>
<br>
<input type="submit" name="submit"/>
</form>
    -->


<script>
      feather.replace()
</script>
<script>
    (function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation')

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
})()

</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>