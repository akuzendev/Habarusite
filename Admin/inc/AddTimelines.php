<?php

session_start();

require_once('checkstate.php');
include_once('../../php/Database.php');

$userid = $_SESSION['userid'];




try{
    $newDb = new Database();
    $chksql = 'SELECT * FROM tbl_users WHERE designation = 3';
    $chkarg = null;
    $chkusers = $newDb->executesql('selectall',$chksql,$chkarg); 
    //var_dump($chkcat);
}catch(Exception $e){
    echo '';
}



if($_SERVER["REQUEST_METHOD"] == "POST") {

    $etitle = $_POST['edittitle'];
    $esubtitle = $_POST['editsubtitle'];
    $ethumbnailurl = $_POST['editthumbnailurl'];
    $ecreateddate = $_POST['edittimestamp'];
    $ecreatedbyuserid = $_POST['editbyuser'];


    try{
        $addnewtimeline = new Database();
        $editsql = 'INSERT INTO tbl_timelines ( title, subtitle, thumbnailurl, createddate, byuserid, status) VALUES (:title,:subtitle,:thumbnailurl,:createddate,:byuserid,:status)';
        $editarg = array(
            'title' => $etitle,
            'subtitle' => $esubtitle,
            'thumbnailurl' => $ethumbnailurl,
            'createddate' => $ecreateddate,
            'byuserid' => $ecreatedbyuserid,
            'status' => 1,
        );
        $res = $addnewtimeline->executesql('crud',$editsql,$editarg);
       header('Location: ../TimelinesDashboard.php');
    }catch(Exception $e){
        echo 'Error occured with Adding Timelines'.$e;
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
    <title>Add Timeline</title>
</head>
<body>
<br>
<br>
<?php

?>

<div class="container">
    <div class="row">
        <div class="col-sm-1">
            <a class="btn btn-primary" href="../TimelinesDashboard.php"><i data-feather="arrow-left"></i></a>
        </div>
        <div class="col-sm-11">
            <h1 class="d-flex justify-content-center">Add Timeline</h1>
<br>
<br>
<br>
        </div>
        <div class="col-sm-12">

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3 needs-validation" novalidate>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Title</label>
    <input type="text" class="form-control" name="edittitle" id="validationCustom01" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Title
    </div>
</div>

<div class="col-md-8">
    <label for="validationCustom01" class="form-label">Subtitle</label>
    <input type="text" class="form-control" name="editsubtitle" id="validationCustom01" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Subtitle
    </div>
</div>

<div class="col-md-12">
    <label for="validationCustom01" class="form-label">Thumbnail URL</label>
    <input type="text" class="form-control" name="editthumbnailurl" id="validationCustom01" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Thumbnail URL
    </div>
</div>


<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Thumbnail Timestamp</label>
    <input type="datetime-local" class="form-control" name="edittimestamp" id="validationCustom01" required>
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
        foreach($chkusers as $users){
            echo "<option value=".$users['id'].">".$users['id']."---".$users['username']."</option>";
        }
      ?> 
    </select>
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
    <button class="btn btn-primary" type="submit">Add Timeline</button>
</div>


</form>


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