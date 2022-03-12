<?php
session_start();
require_once('inc/checkstate.php');
include_once('../php/Admin.php');



try{
    $returnreports = new Database();
    $chksql = 'SELECT * FROM tbl_reports';
    $chkarg = null;
    $res = $returnreports->executesql('selectall',$chksql,$chkarg);
    //var_dump($res);

}catch(Exception $e){
    return 'An error occured with returning reports'.$e;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports Dashboard</title>
</head>
<body>
<?php include_once('inc/admin-navbar.php'); ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center"><h1>Reports Dashboard</h1></div>
    </div>
    <br>
    <div class="row">
        <div class="col-sm-12">
        <div class="table-responsive" style="height: 500px !important; width: 100% !important; overflow: scroll;">
        <table class="table table-hover table-bordered border border-dark">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Report Concern</th>
                    <th scope="col">Content Type</th>
                    <th scope="col">Target ID</th>
                    <th scope="col">Reported by</th>
                    <th scope="col">Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Handled By User ID</th>
                    <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    foreach($res as $reports){
                        echo "
                        
                        <tr>
                        <th scope='row'>".$reports['id']."</th>
                            <td>".$reports['remarks']."</td>
                            <td>".$reports['type']."</td>
                            <td>".$reports['targetid']."</td>
                            <td>".$reports['reportbyuser']."</td>
                            <td>".$reports['date']."</td>
                            <td>".$reports['status']."</td>
                            <td>".$reports['handledbyuserid']."</td>
                            <td>
                                <a class='btn btn-warning m-2' href='inc/PreviewReport.php?type=".urlencode($reports['type'])."&reportsid=".urlencode($reports['id'])."'>View Content</a>
                             </td>
                        </tr>

                        ";
                    }
                ?>
                </tbody>
        </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>