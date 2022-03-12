<?php

session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $afname = $_POST['editfname'];
    $alname = $_POST['editlname'];
    $ausername = $_POST['editusername'];
    $agender = $_POST['editgender'];
    $adesignation =  $_POST['editdesignation'];
    $astatus = $_POST['editstatus'];
    $acountrycode = $_POST['editcountrycode'];
    $aphoneno = $_POST['editphoneno'];
    $aemail = $_POST['editemail'];
    $apass = $_POST['editpssword'];
    $ehashpwd = PASSWORD_HASH($apass,PASSWORD_DEFAULT);
  
    /*
    echo '<br>';
    echo $afname;
    echo '<br>';
    echo $alname;
    echo '<br>';
    echo $ausername;
    echo '<br>';
    echo $agender;
    echo '<br>';
    echo $adesignation;
    echo '<br>';
    echo $astatus;
    echo '<br>';
    echo $acountrycode;
    echo '<br>';
    echo $aphoneno;
    echo '<br>';
    echo $aemail;
    echo '<br>';
    echo $apass;
    echo '<br>';
    echo $ehashpwd;
    */
    

        try{
          $adduser = new Database();
          $editsql = "INSERT INTO tbl_users (fname, lname, username, gender, designation, status, countrycode, phoneno, email, pssword ) VALUES (:fname,:lname,:username,:gender,:designation,:status,:countrycode,:phoneno,:email,:pssword)";
          $editarg = array(
            'fname' => $afname,
            'lname' => $alname,
            'username' => $ausername,
            'gender' => $agender,
            'countrycode' => $acountrycode,
            'phoneno' => $aphoneno,
            'email' => $aemail,
            'pssword' => $ehashpwd,
            'status' => $astatus,
            'designation' =>$adesignation
        );
          $res = $adduser->executesql('crud',$editsql,$editarg);
          header('Location: ../UsersDashboard.php');    
      }catch(Exception $e){
        return 'An Error occured in Adding the user'. $e;
      }

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
    <title>Add User</title>
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
            <h1 class="d-flex justify-content-center">Add User</h1>
<br>
<br>
<br>
        </div>
        <div class="col-sm-12">

<form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="row g-3 needs-validation" novalidate>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">First Name</label>
    <input type="text" class="form-control" name="editfname" id="validationCustom01" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a First Name
    </div>
</div>

<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Last Name</label>
    <input type="text" class="form-control" name="editlname" id="validationCustom01" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Last Name
    </div>
</div>


<div class="col-md-4">
    <label for="validationCustom01" class="form-label">Username</label>
    <input type="text" class="form-control" name="editusername" id="validationCustom01" required>
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
<select class='form-select' id='validationCustom04' name="editdesignation" required>
    <option disabled value="">Please Choose a Designation</option>
    <option value="0">Guest</option>
    <option value="1">User</option>
    <option value="2">Writer</option>
    <option value="3">Admin</option>
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
    <input type="number" class="form-control" name="editcountrycode" id="validationCustom01" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Country Code
    </div>
</div>

<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Phone Number</label>
    <input type="number" class="form-control" name="editphoneno" id="validationCustom01" required>
    <div class="valid-feedback">
      Looks good!
    </div>
    <div class="invalid-feedback">
      Please enter a Phone Number
    </div>
</div>


<div class="col-md-6">
    <label for="validationCustom01" class="form-label">Email</label>
    <input type="email" class="form-control" name="editemail" id="validationCustom01" required>
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
    <button class="btn btn-primary" name="submit" type="submit">Add User</button>
</div>


</form>

<br>
<br>
<br>
        </div>
    </div>
</div>




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