<?php
include_once('../php/User.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $logemail = htmlspecialchars($_POST['logemail']);
    $logpassword = htmlspecialchars($_POST['logpassword']);
  
    if(empty($logemail)){
      echo 'No Email';
    }else if(empty($logpassword)){
      echo 'No Password';
    }else{ 


      try{
        $logUser = new User();
        $res = $logUser->LoginUser($logemail,$logpassword);
        return $res;
      }catch(Exception $e){
        return 'An Error with Login' .$e;
      }

    }
  }else{
      $logemail = null;
      $logpassword = null;
    echo '';
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
    <title>Login</title>
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
    <div class="col-sm-12 d-flex justify-content-center"><h1>Login</h1></div>
  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-sm-12">

        <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="needs-validation" novalidate>
          <div class="form-row">
            <div class="col-md-12 mb-3">
              <label for="validationCustom01">Email:</label>
              <input type="text" class="form-control" name="logemail" id="validationCustom01" placeholder="Eg: johndoe@gmail.com"
                required>
              <div class="valid-feedback">
                Looks good!
              </div>
              <div class="invalid-feedback">
                An Email is required!
              </div>
            </div>
            <div class="col-md-12 mb-3">
              <label for="validationCustom02">Password:</label>
              <input type="password" class="form-control" name="logpassword" id="validationCustom02"
                required>
              <div class="valid-feedback">
                Looks good!
              </div>
              <div class="invalid-feedback">
                Password is required!
              </div>
            </div>
          </div>

          <button type="submit" name="submit" class="btn btn-primary btn-sm">Login User</button>
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