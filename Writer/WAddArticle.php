<?php
session_start();

require_once('../php/Database.php');
require_once('inc/checkstate.php');
require_once('../php/Article.php');
$userid = $_SESSION['userid'];


$timestamp = date('Y-m-d H:i:s');
echo $timestamp;


if ($_SERVER["REQUEST_METHOD"] == "POST") {



        $istimeline = filter_var(htmlspecialchars($_POST['istimeline']),FILTER_SANITIZE_NUMBER_INT);
        $timelineid = filter_var(htmlspecialchars($_POST['timelineid']),FILTER_SANITIZE_NUMBER_INT);
        $title = filter_var(htmlspecialchars($_POST['title']),FILTER_SANITIZE_STRING);
        $subtitle = filter_var(htmlspecialchars($_POST['subtitle']),FILTER_SANITIZE_STRING);
        $thumbnail = filter_var(htmlspecialchars($_POST['thumbnail']),FILTER_SANITIZE_STRING);
        $catergory = filter_var(htmlspecialchars($_POST['catergory']),FILTER_SANITIZE_NUMBER_INT);
        $content = filter_var(htmlspecialchars($_POST['content']),FILTER_SANITIZE_STRING);
        $relcommentid = filter_var(htmlspecialchars($_POST['relcommentid']),FILTER_SANITIZE_NUMBER_INT);
        $userid = $_SESSION['userid'];
/*
        echo $istimeline;
        echo '<br>';
        echo $timelineid;
        echo '<br>';
        echo $title;
        echo '<br>';
        echo $subtitle;
        echo '<br>';
        echo $thumbnail;
        echo '<br>';
        echo $catergory;
        echo '<br>';
        echo $content;
        echo '<br>';
        echo $relcommentid;
        echo '<br>';
        echo $userid;
*/


         if (empty($title)){
            echo 'title is empty';
            exit();
        }else if (empty($subtitle)){
            echo 'subtitle is empty';
            exit();
        }else if (empty($thumbnail)){
            echo 'thumbnail is empty';
            exit();
        }else if (empty($catergory)){
            echo 'catergory is empty';
            exit();
        }else if (empty($content)){
            echo 'content is empty';
            exit();
        }else if (empty($relcommentid)){
            echo 'related comment id is empty';
            exit();
        }else{
            try{
                    $newarticle = new Article();
                    $res = $newarticle->addArticle($istimeline,$timelineid,$title,$subtitle,$catergory,$thumbnail,$content,$relcommentid,$userid);
                    var_dump($res);
                }catch(Exception $e){
                  return 'An Error occured in the Article Insertion'. $e;
                }      
            
             }      


        }else{
            echo '';
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Add Article</title>
</head>
<body>

<?php include_once('inc/writer-navbar.php') ?>
<br>



<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="d-flex justify-content-center">Add Article</h1>
<br>
<br>
<br>
        </div>
        <div class="col-sm-12">

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3 needs-validation" novalidate>

<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Is this article part of a timeline?</label>
    <select class="form-select" name="istimeline" id="validationCustom01" required>
            <option selected value="">Please choose an Option</option>
            <option value="1">Yes</option>
            <option value="0">No</option>
    </select>
    <div class="valid-feedback">
    Ok!
    </div>
    <div class="invalid-feedback">
    Please select an Option
    </div>
</div>

<div class="col-md-6">
    <label class="form-label">Please select a Timeline (If nessesary) </label>
    <select class="form-select" name="timelineid">
                <option selected value="0"></option>
            <?php
                foreach($chktimelines as $timelines){
                    echo '<option value='.$timelines['id'].'>'.$timelines['title'].'</option>';
                }
            ?> 
    </select>
</div>


<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Title</label>
    <input class="form-control" type="text" name="title" id="validationCustom01" required/>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Username
    </div>
</div>




<div class='col-md-6'>
<label for='validationCustom04' class='form-label'>Subtitle</label>
    <input class="form-control" type="text" name="subtitle" id="validationCustom01" required/>
    <div class='valid-feedback'>
      Noted!
    </div>
    <div class='invalid-feedback'>
      Please choose a Gender Option.
    </div>
</div>




<div class="col-md-4">
<label for="validationCustom04" class="form-label">Catergory</label>
<select class="form-select" name="catergory" id="validationCustom01" required>
        <option value="">select a catergory</option>
            <?php
                foreach($chkcat as $catergories){
                    echo '<option value='.$catergories['id'].'>'.$catergories['name'].'</option>';
                }
            ?> 
    </select>   
    <div class='valid-feedback'>
      Noted!
    </div>
    <div class='invalid-feedback'>
      Please choose a Designation Option.
    </div>
</div>


<div class="col-md-4">
<label for="validationCustom04" class="form-label">Comment section ID</label>
<input type="number" class="form-control" name="relcommentid" placeholder="" id="validationCustom01" required/>
    <div class='valid-feedback'>
      Noted!
    </div>
    <div class='invalid-feedback'>
      Please choose a Comment Section ID.
    </div>
</div>



<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Thumbnail URL</label>
    <input class="form-control" type="text" name="thumbnail" id="validationCustom01" required/>
    <div class="valid-feedback">
      Ok!
    </div>
    <div class="invalid-feedback">
      Please enter a valid Thumbnail URL
    </div>
</div>





<div class="col-md-12">
    <label for="validationCustom01" class="form-label">Article Content</label>
    <input class="form-control" style="height:200px" type="text" name="content" id="validationCustom01" required/>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Country Code
    </div>
</div>


<div class="col-12">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck" id="validationCustom01" required>
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
    <button class="btn btn-primary" name="submit" type="submit">Add Article</button>
</div>


</form>

<br>
<br>
<br>
        </div>
    </div>
</div>






<br>
<br>
<br>
<br>
  



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

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

</body>
</html>