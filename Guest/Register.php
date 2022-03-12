<?php

include_once('../php/User.php');



if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $fname = htmlspecialchars($_POST['regfname']);
    $lname = htmlspecialchars($_POST['reglname']);;
    $username = htmlspecialchars($_POST['regusername']);;
    $gender = htmlspecialchars($_POST['reggender']);;
    $countrycode = htmlspecialchars($_POST['regcountrycode']);;
    $phonenumber = htmlspecialchars($_POST['regphoneno']);;
    $email = htmlspecialchars($_POST['regemail']);;
    $password = htmlspecialchars($_POST['regpassword']);;
 
        
    if(empty($fname)){
        echo 'Fname is empty';
        exit();
      }else if (empty($lname)){
        echo 'Lname is empty';
        exit();
      }else if (empty($username)){
        echo 'Username is empty';
        exit();
      }else if (empty($gender)){
        echo 'Gender is empty';
        exit();
      }else if (empty($countrycode)){
        echo 'CC is empty';
        exit();
      }else if (empty($phonenumber)){
        echo 'Phone is empty';
        exit();
      }else if (empty($email)){
        echo 'Email is empty';
        exit();
      }else if (empty($password)){
        echo 'Psswrd is empty';
        exit();
      }else {
      
      if (!preg_match("/^[a-zA-Z]*$/", $fname)){
        echo 'Fname is invalid';
        exit();
         }else if (!preg_match("/^[a-zA-Z]*$/", $lname)) {
          echo 'Lname is invalid';
          exit();
      } else  {
      
       if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Email is invalid';
         exit();
       } else {
    
        try{
          $createnewuser = new User();
          $res = $createnewuser->RegisterUser($fname,$lname,$username,$gender,$countrycode,$phonenumber,$email,$password);
          var_dump($res);

          }catch(Exception $e){
            return 'An Error occured in the User Registration'. $e;
          }      
      
       }
    
      }
    
    }
    
    }else{
     echo '';
     $fname = null;
     $lname = null;
     $username = null;
     $gender = null;
     $countrycode = null;
     $phonenumber = null;
     $email = null;
     $password = null;
     $designation = null;
     $status = null;
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
    <title>Register</title>
</head>
<body>

<?php
include_once('inc/guest-navbar.php');
?>
<br>


<br>
<br>
<br>


<div class="container">
  <div class="row">
    <div class="col-sm-12 d-flex justify-content-center"><h1>Register</h1></div>
    <br>
  </div>
  <div class="row">
    <div class="col-sm-12">

    <br>
    <br>
    <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="needs-validation" novalidate>

        <div class="form-row">
          <div class="col-md-4 mb-3">
            <label for="validationCustom01">First name</label>
            <input type="text" class="form-control" name="regfname" id="validationCustom01" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationCustom02">Last name</label>
            <input type="text" class="form-control" name="reglname" id="validationCustom02" required>
            <div class="valid-feedback">
              Looks good!
            </div>
          </div>
          <div class="col-md-4 mb-3">
            <label for="validationCustomUsername">Username</label>
            <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text" id="inputGroupPrepend">@</span>
              </div>
              <input type="text" class="form-control" name="regusername" id="validationCustomUsername"
                aria-describedby="inputGroupPrepend" required>
              <div class="invalid-feedback">
                Please choose a username.
              </div>
            </div>
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Gender</label>
              <select type="number" name="reggender" class="browser-default custom-select" class="form-control" id="validationCustomUsername" required>
                <option disabled selected value="">Please Choose an Option</option>
                <option value="1">Male</option>
                <option value="2">Female</option>
                <option value="3">Other</option>
              </select>
            <div class="valid-feedback">
              Ok.
            </div>
            <div class="invalid-feedback">
              Please provide a Gender.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationCustom04">Country Code:</label>
            <input type="number" class="form-control" name="regcountrycode" id="validationCustom04" required>
            <div class="invalid-feedback">
              Please provide a Country Code.
            </div>
          </div>
          <div class="col-md-3 mb-3">
            <label for="validationCustom05">Phone Number:</label>
            <input type="number" class="form-control" name="regphoneno" id="validationCustom05" required>
            <div class="invalid-feedback">
              Please provide a Phone Number.
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="validationCustom05">Email:</label>
            <input type="email" class="form-control" name="regemail" id="validationCustom05" required>
            <div class="invalid-feedback">
              Please provide a Email.
            </div>
          </div>
          <div class="col-md-12 mb-3">
            <label for="validationCustom05">Password:</label>
            <input type="password" class="form-control" name="regpassword" id="validationCustom05" required>
            <div class="invalid-feedback">
              Please provide a Password.
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
              Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
              You must agree before submitting.
            </div>
          </div>
        </div>
        <button class="btn btn-primary btn-sm" name="submit" type="submit">Register User</button>

    </form>
    </div>
  </div>
</div>
<br>
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


<script>

(function() {
'use strict';
window.addEventListener('load', function() {
// Fetch all the forms we want to apply custom Bootstrap validation styles to
var forms = document.getElementsByClassName('needs-validation');
// Loop over them and prevent submission
var validation = Array.prototype.filter.call(forms, function(form) {
form.addEventListener('submit', function(event) {
if (form.checkValidity() === false) {
event.preventDefault();
event.stopPropagation();
}
form.classList.add('was-validated');
}, false);
});
}, false);
})();


</script>

<script type="text/javascript" src="../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../assets/js/mdb.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../assets/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../assets/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
</body>
</html>