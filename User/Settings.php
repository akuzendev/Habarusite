<?php
session_start();
include_once('inc/checkstate.php');
include_once('../php/Database.php');


$currentuserid = $_SESSION['userid'];


try{
    $currentuserinfo = new Database();
    $getcurrentuserinfo = new Database();
    $chksql1 = "SELECT tbl_users.fname, tbl_users.lname, tbl_users.username, tbl_users.gender, app_gender.name as gendername, tbl_users.countrycode, tbl_users.phoneno, tbl_users.email  FROM tbl_users  INNER JOIN app_gender ON tbl_users.gender = app_gender.id  WHERE tbl_users.id = :id";
    $chkarg1 = array('id' => $currentuserid );
    $response  = $currentuserinfo->executesql('selectone',$chksql1,$chkarg1);
    //var_dump($response);
}catch(Exception $e){
    return 'An error occured with retrieving current user information' .$e;
}


try{
    $currentusergender = new Database();
    $chksql2 = "SELECT app_gender.id, app_gender.name FROM tbl_users
     INNER JOIN app_gender ON tbl_users.gender = app_gender.id 
     WHERE tbl_users.id = :id";
    $chkarg2 = array('id' => $currentuserid);
    $response2  = $currentusergender->executesql('selectone',$chksql2,$chkarg2);
    //var_dump($response);
}catch(Exception $e){
    return 'An error occured with retrieving current user information' .$e;
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
    <title>Settings</title>
</head>
<body>


<?php include_once('inc/user-navbar.php') ?>
<br>
<br>
<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1>User Settings</h1>
        </div>
    </div>

<div class="row">
    <!-- Card -->
<div class="card">
<div class="col-sm-12">
    <h4 class="m-5">Update User Information:</h4>

        <form method="POST" action="inc/UpdateInformation.php" class="needs-validation m-3" novalidate>
         
            <div class="form-row">
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">First name</label>
                <input type="text" class="form-control" name="editfname" id="validationCustom01" value="<?php echo $response['fname'] ?>" required>
                <div class="valid-feedback">
                Looks good!
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom02">Last name</label>
                <input type="text" class="form-control" name="editlname" id="validationCustom02" value="<?php echo $response['lname'] ?>" required>
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
                <input type="text" class="form-control" name="editusername" id="validationCustomUsername"
                    aria-describedby="inputGroupPrepend" value="<?php echo $response['username'] ?>" required>
                <div class="invalid-feedback">
                    Please choose a username.
                </div>
                </div>
            </div>
            </div>
            <div class="form-row">
            <div class="col-md-6 mb-3">
                <label for="validationCustom03">Gender</label>
                <select type="number" name="editgender" class="browser-default custom-select" class="form-control" id="validationCustomUsername" required>
                  <?php 
                    if($response['gender'] !== null){
                        echo "<option selected value=".$response2['id'].">".$response2['name']."</option>";
                        echo 
                        "
                        <option disabled>___________________________</option>
                        <option value='1'>Male</option>
                        <option value='2'>Female</option>
                        <option value='3'>Other</option>
                        ";
                    }else{
                        echo 
                        "
                        <option disabled selected>Please Choose an Option</option>
                        <option value='1'>Male</option>
                        <option value='2'>Female</option>
                        <option value='3'>Other</option>
                        ";
                    }
                  ?>
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
                <input type="number" class="form-control" name="editcountrycode" id="validationCustom04" value="<?php echo $response['countrycode'] ?>" required>
                <div class="invalid-feedback">
                Please provide a Country Code.
                </div>
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom05">Phone Number:</label>
                <input type="number" class="form-control" name="editphoneno" id="validationCustom05" value="<?php echo $response['phoneno'] ?>" required>
                <div class="invalid-feedback">
                Please provide a Phone Number.
                </div>
            </div>
            <div class="col-md-12 mb-3">
                <label for="validationCustom05">Email:</label>
                <input type="email" class="form-control" name="editemail" id="validationCustom05" value="<?php echo $response['email'] ?>" required>
                <div class="invalid-feedback">
                Please provide a Email.
                </div>
            </div>
            </div>
            


                        <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#basicExampleModal">
            Submit
            </button>

            <!-- Modal -->
            <div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Attention</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <p>To update your information, please provide your password to verify your identity.</p>  
                <div class="col-md-12 mb-3">
                <label for="validationCustom05">Password:</label>
                <input type="password" class="form-control" name="infoupdatepass" id="validationCustom05" required>
                <div class="invalid-feedback">
                Please provide a Password.
                </div>
            </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submituserinfoupdate" class="btn btn-primary">Update Information</button>
                </div>
                </div>
            </div>
            </div>
        </form>
</div>
</div>
</div>
<!-- Card -->
<br>
<br>

<div class="row">
    <!-- Card -->
<div class="card">
<div class="col-sm-12">
    <h4 class="m-5">Update Password:</h4>

        <form method="POST" action="inc/changepass.php" class="needs-validation m-3" novalidate>
         
            <div class="form-row">
        
            <div class="col-md-12 mb-3">
                <label for="validationCustom05">Old Password::</label>
                <input type="password" class="form-control" name="oldpass" id="validationCustom05" required>
                <div class="invalid-feedback">
                Please provide a Email.
                </div>
            </div>
            
            <div class="col-md-12 mb-3">
                <label for="validationCustom05">New Password:</label>
                <input type="password" class="form-control" name="newpass" id="validationCustom05" required>
                <div class="invalid-feedback">
                Please provide a Email.
                </div>
            </div>
            </div>
                 
            <button type="submit" name="submit" class="btn btn-primary">
            Submit
            </button>
        </form>
</div>
</div>
</div>

<br>
<br>

<div class="row">
    <!-- Card -->
<div class="card">
<div class="col-sm-12">
    <h4 class="m-5">Delete My Account:</h4>

        <form method="POST" action="inc/set-delete.php" class="needs-validation m-3" novalidate>
         
            <div class="form-row">

                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteaccmodal">
                Set Account to Deletion
                </button>

                <!-- Modal -->
                <div class="modal fade" id="deleteaccmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Warning!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <p>By clicking Account Deletion, Your account will be permenantly deleted, Click only if you are sure of this desicion. </p>  
                    <div class="col-md-12 mb-3">
                </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" name="submitdeletionrequest" class="btn btn-danger">Delete Your Account</button>
                    </div>
                    </div>
                </div>
                </div>
            

            </div>                 
        </form>
</div>
</div>
</div>
</div>





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
