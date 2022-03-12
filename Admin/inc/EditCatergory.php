<?php

session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');

//$userid = $_SESSION['userid'];
$editcatergory = $_GET['catergoryid'];


try{
    $newDb = new Database();
    $chksql = "SELECT * FROM app_catergories WHERE app_catergories.id = $editcatergory";
    $chkarg = null;
    $chkcatergory = $newDb->executesql('selectone',$chksql,$chkarg); 
}catch(Exception $e){
    echo '';
}






if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $editcatname = $_POST['catname'];
    $editcatdescription = $_POST['catdescription'];


    try{
        $edittimeline = new Database();
        $editsql = "UPDATE `app_catergories` SET `name`='$editcatname',`description`='$editcatdescription' WHERE app_catergories.id =$editcatergory";
        $editarg = null;
        $res = $edittimeline->executesql('crud',$editsql,$editarg);
        header('Location: ../AppSettings.php');
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
    <title>Edit Catergory</title>
</head>
<body>


<div class="container">
    <div class="row">
    <div class="col-sm-1">
<br>
            <a class="btn btn-primary" href="../AppSettings.php"><i data-feather="arrow-left"></i></a>
        </div>
        <div class="col-sm-11">
<br>
            <h1 class="d-flex justify-content-center">Edit Catergory</h1>
<br>
        </div>
    <div class="col-md-12">


<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3 needs-validation" novalidate>

<div class="col-md-12">
    <label for="validationCustom01" class="form-label">Name</label>
    <input type="text" class="form-control" name="catname" id="validationCustom01" value="<?php echo $chkcatergory['name'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Name
    </div>
</div>

<div class="col-md-12">
    <label for="validationCustom01" class="form-label">Description</label>
    <input type="text" class="form-control" name="catdescription" id="validationCustom01" value="<?php echo $chkcatergory['description'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Description
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
    <button class="btn btn-primary" type="submit">Edit Catergory</button>
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
