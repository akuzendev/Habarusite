<?php
session_start();
require('checkstate.php');
include_once('../../php/Database.php');
//var_dump($_SESSION);



$reporttype= $_GET['typeid'];
$targetcontent = $_GET['oncontentid'];
$currentarticle = $_GET['onarticleid'];

$clreporttype = filter_var(htmlspecialchars($reporttype),FILTER_SANITIZE_STRING);
$cltargetcontent = filter_var(htmlspecialchars($targetcontent),FILTER_SANITIZE_NUMBER_INT);
$clcurrentarticle = filter_var(htmlspecialchars($currentarticle),FILTER_SANITIZE_NUMBER_INT); 

$useremark = htmlspecialchars($_POST['userconcern']);
$byuserid = $_SESSION['userid'];


if($_SERVER["REQUEST_METHOD"] == "POST") {

    /*
    echo $clreporttype;
    echo '<br>';
    echo $cltargetcontent;
    echo '<br>';
    echo $clcurrentarticle;
    */

    $timestamp = date('Y-m-d H:i:s');


        try{
            $addreport = new Database();
            $chksql = 'INSERT INTO tbl_reports (`type`, `reportbyuser`, `targetid`, `remarks`, `date`, `status`, `handledbyuserid`) VALUES (:type, :reportbyuser, :targetid, :remarks, :date, :status, :handledbyuserid)';
            $chkarg = array(
                'type'=>$clreporttype,
                'reportbyuser'=>$byuserid,
                'targetid'=>$cltargetcontent,
                'remarks'=>$useremark,
                'date'=>$timestamp,
                'status'=>0,
                'handledbyuserid'=> 0
            );
            $res = $addreport->executesql('crud',$chksql,$chkarg);
            header("Location: ../Article.php?articleid=".$clcurrentarticle."");
        }catch(Exception $e){
            return 'An error occured with reporting' .$e;
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
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../../assets/css/all.css">
    <!-- Google Fonts -->
    <link rel="stylesheet" href="../../assets/css/css.css">
    <!-- Bootstrap core CSS -->
    <link href="../../assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="../../assets/css/mdb.min.css" rel="stylesheet">
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Report a Comment</title>
</head>
<body>

<br>
<br>
<div class="container">
    <div class="row">
        <div class="col-sm-2 d-flex justify-content-start">
            <a class="btn btn-primary" href="../Article.php?articleid=<?php echo $cltargetcurrentarticle ?>">Back</a>
        </div>
        <div class="col-sm-10">
            <h1 class="d-flex justify-content-center">Report Comment</h1>
        </div>
        <div class="col-sm-12 d-flex justify-content-center m-4">
        <form method="POST" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" class="needs-validation" novalidate>
        <br>
<br>
            <div class="form-row">
                <div class="col-md-12 mb-5">
                <label for="validationCustom01">Tell us your concern</label>
                <textarea type="text" class="form-control" name="userconcern" id="validationCustom01" required></textarea>
                <div class="valid-feedback">
                    Looks good!
                </div>
                <div class="invalid-feedback">
                    Please provide some info
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
            <button class="btn btn-primary btn-sm" type="submit">Submit Report for Moderators</button>
            </form>

        </div>
    </div>
</div>






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






<script type="text/javascript" src="../../assets/js/jquery.min.js"></script>
<script type="text/javascript" src="../../assets/js/mdb.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="../../assets/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="../../assets/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->

</body>
</html>