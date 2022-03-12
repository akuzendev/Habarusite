<?php

session_start();

require_once('checkstate.php');
include_once('../../php/Database.php');

$userid = $_SESSION['userid'];
$edituserid = $_GET['userid'];

try{
    $edtart = new Database();
    $chksqledit = "SELECT 
    tbl_users.fname,
    tbl_users.lname,
    tbl_users.username,
    tbl_users.gender,
    tbl_users.designation,
    app_gender.name as usergender,
    app_designation.name as userdesignation,
    app_status.name as userstatus,
    tbl_users.status,
    tbl_users.countrycode,
    tbl_users.phoneno,
    tbl_users.email,
    tbl_users.pssword
    FROM tbl_users 
    INNER JOIN app_gender ON tbl_users.gender = app_gender.id 
    INNER JOIN app_designation ON tbl_users.designation = app_designation.id
    INNER JOIN app_status ON tbl_users.status = app_status.id
    WHERE tbl_users.id =:id";
    $chkargedit = array('id' => $edituserid);
    $reseditusr = $edtart->executesql('selectone',$chksqledit, $chkargedit);
}catch(Exception $e){
    echo 'An Error occured in Article retreival' .$e;
}





if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $efname = $_POST['editfname'];
    $elname = $_POST['editlname'];
    $eusername = $_POST['editusername'];
    $egender = $_POST['editgender'];
    $edesignation =  $_POST['editdesignation'];
    $estatus = $_POST['editstatus'];
    $ecountrycode = $_POST['editcountrycode'];
    $ephoneno = $_POST['editphoneno'];
    $eemail = $_POST['editemail'];
    $epass = $_POST['editpssword'];


    if(empty($epass)){
      //if edit-password field is empty on POST
      // try function where edit fields post form info into database excluding form-password
      // form-password be equal to value of res['password'] from the database;
     

        try{
          $edituser = new Database();
          $editsql = "UPDATE `tbl_users` SET `fname`='$efname',`lname`='$elname',`username`='$eusername',`gender`='$egender',`designation`='$edesignation',`status`='$estatus',`countrycode`='$ecountrycode',`phoneno`='$ephoneno',`email`='$eemail' WHERE tbl_users.id = $edituserid";
          $editarg = null;
          $res = $edituser->executesql('crud',$editsql,$editarg);
          header('Location: ../UsersDashboard.php');
     

      }catch(Exception $e){
        return 'An Error occured in Editting the user'. $e;
      }


    }else{

      $t1 = password_verify($epass,$reseditusr['pssword']);
      if($t1 == true){
        $ehashpwd = $reseditusr['pssword'];
      }else{
        $ehashpwd = PASSWORD_HASH($epass,PASSWORD_DEFAULT);
      }



      try{
        $edituser = new Database();
        $editsql = "UPDATE `tbl_users` SET `fname`='$efname',`lname`='$elname',`username`='$eusername',`gender`='$egender',`designation`='$edesignation',`status`='$estatus',`countrycode`='$ecountrycode',`phoneno`='$ephoneno',`email`='$eemail',`pssword`='$ehashpwd' WHERE tbl_users.id = $edituserid";
        $editarg = null;
        $res = $edituser->executesql('crud',$editsql,$editarg);
        header('Location: ../UsersDashboard.php');
   

    }catch(Exception $e){
      return 'An Error occured in Editting the user'. $e;
    }

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
    <title>Edit User</title>
</head>
<body>
<br>
<br>
<?php

?>

<div class="container">
    <div class="row">
        <div class="col-sm-1">
            <a class="btn btn-primary" href="../UsersDashboard.php"><i data-feather="arrow-left"></i></a>
        </div>
        <div class="col-sm-11">
            <h1 class="d-flex justify-content-center">Edit User</h1>
<br>
<br>
<br>
        </div>
        <div class="col-sm-12">

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3 needs-validation" novalidate>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">First Name</label>
    <input type="text" class="form-control" name="editfname" id="validationCustom01" value="<?php echo $reseditusr['fname'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a First Name
    </div>
</div>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Last Name</label>
    <input type="text" class="form-control" name="editlname" id="validationCustom01" value="<?php echo $reseditusr['lname'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Last Name
    </div>
</div>


<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Username</label>
    <input type="text" class="form-control" name="editusername" id="validationCustom01" value="<?php echo $reseditusr['username'] ; ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Username
    </div>
</div>




<div class='col-md-4'>
<label for='validationCustom04' class='form-label'>Gender</label>
    <select class='form-select' id='validationCustom04' name="editgender" required>
    <option disabled value="">Please Choose a Gender</option>
    <?php 
    echo "<option selected value=".$reseditusr['gender'].">".$reseditusr['usergender']."</option>";
    ?>
    <option disabled>_________________</option>
    <option value="1">Male</option>
    <option value="2">Female</option>
    <option value="3">Other</option>
    </select>
    <div class='valid-feedback'>
      Noted!
    </div>
    <div class='invalid-feedback'>
      Please choose a Gender Option.
    </div>
</div>




<div class="col-md-4">
<label for="validationCustom04" class="form-label">Designation</label>
<select class='form-select' id='validationCustom04' name="editdesignation"  required>
    <option disabled value="">Please Choose a Designation</option>
    <?php 
    echo "<option selected value=".$reseditusr['designation'].">".$reseditusr['userdesignation']."</option>";
    ?>
    <option disabled>_________________</option>
    <option value="1">Guest</option>
    <option value="2">User</option>
    <option value="3">Writer</option>
    <option value="4">Admin</option>
    </select>
    <div class='valid-feedback'>
      Noted!
    </div>
    <div class='invalid-feedback'>
      Please choose a Designation Option.
    </div>
</div>



<div class="col-md-4">
<label for="validationCustom04" class="form-label">Status</label>
    <select class="form-select" id="validationCustom04" name="editstatus" required>
        <option disabled value="">Please Choose a Status</option>
        <?php 
        echo "<option selected value=".$reseditusr['status'].">".$reseditusr['userstatus']."</option>";
        ?>
        <option disabled>_________________</option>
        <option value="0">Active</option>
        <option value="1">Pending</option>
        <option value="2">To Be Deleted</option>
        <option value="3">Blocked</option>
    </select>

      <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please select a Status.
    </div>
</div>


<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Country Code</label>
    <input type="number" class="form-control" name="editcountrycode" id="validationCustom01" value="<?php echo $reseditusr['countrycode'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Country Code
    </div>
</div>

<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Phone Number</label>
    <input type="number" class="form-control" name="editphoneno" id="validationCustom01" value="<?php echo $reseditusr['phoneno'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Phone Number
    </div>
</div>


<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Email</label>
    <input type="email" class="form-control" name="editemail" id="validationCustom01" value="<?php echo $reseditusr['email'] ?>" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Email
    </div>
</div>

<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Password</label>
    <input type="text" class="form-control" name="editpssword" id="validationCustom01">
    <small class="text-danger">By editing this field, you will change this user's password</small>
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