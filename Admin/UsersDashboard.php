<?php 
session_start();
require_once('inc/checkstate.php');
include_once('../php/Admin.php');


try{
    $newcounter = new Admin();
    $resusers = $newcounter->returnallusers();
}catch(Exception $e){
    return 'Error occured with Users Return' .$e;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
<?php include_once('inc/admin-navbar.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-2">
        <a class="btn btn-success"href="inc/AddUser.php">Add a new User</a>
        </div>
        <div class="col-sm-10">
            <h1 class="d-flex justify-content-center">Users Dashboard</h1>
            <br>
<br>
<br>
        </div>
    </div>

    <div class="table-responsive" style="height: 500px !important; width: 100% !important; overflow: scroll;">
    <div class="row">
            <table class="table table-hover table-bordered border border-dark">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">First Name</th>
                    <th scope="col">Last Name</th>
                    <th scope="col">Username</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Status</th>
                    <th scope="col">Country Code</th>
                    <th scope="col">Phone number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
               <?php

                foreach($resusers as $res){
               echo "
                    <tr>
                        <th scope='row'>".$res['id']."</th>
                            <td>".$res['fname']."</td>
                            <td>".$res['lname']."</td>
                            <td>".$res['username']."</td>
                            <td>".$res['gender']."</td>
                            <td>".$res['designation']."</td>
                            <td>".$res['status']."</td>
                            <td>".$res['countrycode']."</td>
                            <td>".$res['phoneno']."</td>
                            <td>".$res['email']."</td>
                            <td>
                                <a class='btn btn-warning m-2' href='inc/EditUser.php?userid=".$res['id']."'>Edit User</a>
                                <a class='btn btn-danger m-2' href='inc/DeleteUser.php?deluserid=".$res['id']."'>Delete User</a>
                            </td>
                    </tr>
                ";
                }
                ?>
               
                </tbody>
            </table>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>