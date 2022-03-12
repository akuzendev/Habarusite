<?php
session_start();
require_once('inc/checkstate.php');
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


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Settings</title>
</head>
<body>
<?php include_once('inc/admin-navbar.php'); ?>
<br>




<div class="container">
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center"><h1>Account Settings</h1></div>
    </div>
<br>
<br>
<div class="card">
    <div class="row ">
        <div class="col-sm-12 d-flex justify-content-start  m-3"><h4>Update User Information:</h4></div>
    </div>
    <div class="row">
            <div class="col-sm-12  m-3">
                <form method="POST" action="inc/UpdateInformation.php">
    <br>
    <br>
                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">First Name</label>
                    <input type="text" class="form-control" name="editfname" value="<?php echo $response['fname'] ?>" id="validationCustom01" required>
                    <div class="valid-feedback">
                    Looks good!
                    </div>
                    <div class="invalid-feedback">
                    Please enter a First Name
                    </div>
                </div>
    <br>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="editlname" value="<?php echo $response['lname'] ?>" id="validationCustom01" required>
                    <div class="valid-feedback">
                    Looks good!
                    </div>
                    <div class="invalid-feedback">
                    Please enter a First Name
                    </div>
                </div>
    <br>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Username</label>
                    <input type="text" class="form-control" name="editusername" value="<?php echo $response['username'] ?>" id="validationCustom01" required>
                    <div class="valid-feedback">
                    Looks good!
                    </div>
                    <div class="invalid-feedback">
                    Please enter a First Name
                    </div>
                </div>
    <br>
                    <div class='col-md-4'>
                <label for='validationCustom04' class='form-label'>Gender</label>
                    <select class='form-select' id='validationCustom04' name="editgender" required>
                    <option disabled value="">Please Choose a Gender</option>
                    <?php 
                    echo "<option selected value=".$response['gender'].">".$response['gendername']."</option>";
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
    <br>


                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Email</label>
                    <input type="text" class="form-control" name="editemail" value="<?php echo $response['email'] ?>" id="validationCustom01" required>
                    <div class="valid-feedback">
                    Looks good!
                    </div>
                    <div class="invalid-feedback">
                    Please enter a First Name
                    </div>
                </div>
    <br>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Country Code</label>
                    <input type="text" class="form-control" name="editcountrycode" value="<?php echo $response['countrycode'] ?>" id="validationCustom01" required>
                    <div class="valid-feedback">
                    Looks good!
                    </div>
                    <div class="invalid-feedback">
                    Please enter a First Name
                    </div>
                </div>
    <br>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" name="editphoneno" value="<?php echo $response['phoneno'] ?>" id="validationCustom01" required>
                    <div class="valid-feedback">
                    Looks good!
                    </div>
                    <div class="invalid-feedback">
                    Please enter a First Name
                    </div>
                </div>
            </div>

            <div class="col-md-12">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Submit Update
            </button>

            <!-- Modal -->
            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Confirm User Information Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Please Enter your Password to Confirm User Information Update</p>
                    <input type="password" name="infoupdatepass" class="form-input"/>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submituserinfoupdate" class="btn btn-primary">Understood</button>
                </div>
                </div>
            </div>
            </div>

            </div>



            </form>
        </div>
<br>
<br>
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-start"><h3>Update your Password</h3></div>
            <div class="col-sm-12 m-3">
                <form method="POST" action="inc/EditYourPassword.php">

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">Old Password</label>
                    <input type="password" class="form-control" name="oldpass" id="validationCustom01" required>
                    <div class="invalid-feedback">
                    Please enter your Old Password
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="validationCustom01" class="form-label">New Password</label>
                    <input type="password" class="form-control" name="newpass" id="validationCustom01" required>
                    <div class="invalid-feedback">
                    Please enter your New Password
                    </div>
                </div>

                <button type="submit" name="submitchangepass" class="btn btn-primary">Change Password</button>
                </form>
            </div>
        </div>
<br>
<br>
        <div class="row">
            <div class="col-sm-12 d-flex justify-content-start"><h3>Delete your Account</h3></div>
            <div class="col-sm-12 m-3">
                <form method="POST" action="inc/set-delete.php">

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#accountdeletionmodal">
            Delete your Account
            </button>

            <!-- Modal -->
            <div class="modal fade" id="accountdeletionmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="accountdeletionmodalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="accountdeletionmodalLabel">Attention!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>By Clicking this, Your Account will be set to be Deleted. </p>  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="submitdeletionrequest" class="btn btn-primary">Understood</button>
                </div>
                </div>
            </div>
            </div>


                </form>
            </div>
        </div>




    </div>
</div>





<script>
/*
Proposal
SWOT Analysis
Feasibility Stuyd
    Time
    Scope
Gantt Chart
SDLC

Design
    ERD -> Normalization
    Usecase
    Flowchart

Techical Document
    Runs on Server
    Database
    Type of Browser


    PPT (4-5 slides) + Dhivehi + 10minutes
        Introduction
        What is this Software
            Purpose


*/


</script>



            

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>