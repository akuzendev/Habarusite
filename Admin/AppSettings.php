<?php
session_start();
require_once('inc/checkstate.php');
include_once('../php/Database.php');

$currentuserid = $_SESSION['userid'];


try{
    $allcatergories = new Database();
    $sql ="SELECT * FROM app_catergories";
    $arg = null;
    $rescatergories = $allcatergories->executesql('selectall',$sql,$arg);
    //var_dump($rescatergories); 
}catch(Exception $e){
    return 'An error occured with Catergories retrieval'.$e;
}


if($_SERVER["REQUEST_METHOD"] == "POST") {

    $catergoryname = $_POST['catname'];
    $catergorydescription = $_POST['catdescription'];



    try{
        $addcat = new Database();
        $sql = "INSERT INTO app_catergories (name, description) VALUES (:name,:description)";
        $arg = array(
          'name' => $catergoryname,
          'description' => $catergorydescription
      );
        $res = $addcat->executesql('crud',$sql,$arg);
        header('Location: AppSettings.php');    
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Settings</title>
</head>
<body>
<?php include_once('inc/admin-navbar.php'); ?>
<br>




<div class="container">
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center"><h1>Application Settings</h1></div>
    </div>
<br>
<br>
<div class="card">
    <div class="row">
        <div class="m-3">
            <div class="col-sm-2 d-flex justify-content-start">
                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Catergory
                    </button>
            </div>
            <div class="col-sm-10 d-flex justify-content-center"><h4>Article Catergories:</h4></div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
        <div class="table-responsive" style="height: 500px !important; width: 100% !important; overflow: scroll;">
    <div class="row">
            <table class="table table-hover table-bordered border border-dark">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
               <?php

                foreach($rescatergories as $res){
               echo "
                    <tr>
                        <th scope='row'>".$res['id']."</th>
                            <td>".$res['name']."</td>
                            <td>".$res['description']."</td>
                            <td>
                                <a class='btn btn-warning m-2' href='inc/EditCatergory.php?catergoryid=".$res['id']."'>Edit Catergory</a>
                                <a class='btn btn-danger m-2' href='inc/DeleteCatergory.php?catergoryid=".$res['id']."'>Delete Catergory</a>
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
    </div>
</div>
<br>
<br>
</div>

<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Catergory</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>">

      <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Name</label>
        <input type="text" class="form-control" name="catname" id="validationCustom01" required>
        <div class="valid-feedback">
        Looks good!
        </div>
        <div class="invalid-feedback">
        Please enter a Catergory Name
        </div>
    </div>

    <div class="col-md-12">
        <label for="validationCustom01" class="form-label">Description</label>
        <input type="text" class="form-control" name="catdescription" id="validationCustom01" required>
        <div class="valid-feedback">
        Looks good!
        </div>
        <div class="invalid-feedback">
        Please enter a Description
        </div>
    </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Understood</button>
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