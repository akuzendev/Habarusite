<?php
session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');



$reporttype = $_GET['type'];
$reportid = $_GET['reportsid'];

$clreportid = filter_var(htmlspecialchars($reportid),FILTER_SANITIZE_NUMBER_INT);
$clreporttype = filter_var(htmlspecialchars($reporttype),FILTER_SANITIZE_STRING);








switch($clreporttype){
    case 'comment':

        try{
            $getreportmeta = new Database();
            $chksqlrm = "SELECT tbl_reports.id as reportid, tbl_reports.reportbyuser, tbl_reports.targetid, tbl_reports.remarks, tbl_reports.date, tbl_reports.status, tbl_reports.handledbyuserid
            FROM tbl_reports
            WHERE tbl_reports.id = :id";
            $chkargrm = array('id'=>$clreportid);
            $resrm = $getreportmeta->executesql('selectone',$chksqlrm,$chkargrm);
            //var_dump($resrm);
        }catch(Exception $e){
            return 'An error occured at Report Meta stage'.$e;
        }


        try{
            $getcommentmeta = new Database();
            $chksqlcm = "SELECT tbl_comments.id as commentid, tbl_comments.content, tbl_comments.timestamp, tbl_comments.byuserid, tbl_comments.onarticleid FROM tbl_comments
            WHERE tbl_comments.id = :id";
            $chkargcm = array('id' =>$resrm['targetid']);
            $rescm = $getcommentmeta->executesql('selectone',$chksqlcm,$chkargcm);
            //var_dump($rescm);
        }catch(Exception $e){
            return 'An error occured at Comment Meta stage'.$e;
        }


        try{
            $getarticlemeta = new Database();
            $chksqlam = "SELECT tbl_articles.id as articleid, tbl_articles.title FROM tbl_articles
            WHERE tbl_articles.id = :id";
            $chkargam = array('id'=>$rescm['onarticleid']);
            $resam = $getarticlemeta->executesql('selectone',$chksqlam,$chkargam);
            //var_dump($resam);
        }catch(Exception $e){
            return 'An error occured at Article Meta stage'.$e;
        }


        try{
            $getreportermeta = new Database();
            $chksqlrmeta = "SELECT tbl_users.id as reporteruserid, tbl_users.username as reporterusername FROM tbl_users
            WHERE tbl_users.id = :id";
            $chkargrmeta = array('id'=>$resrm['reportbyuser']);
            $resrmeta = $getreportermeta->executesql('selectone',$chksqlrmeta,$chkargrmeta);
            //var_dump($resrmeta);
        }catch(Exception $e){
            return 'An error occured at Reporter Meta stage'.$e;
        }



        try{
            $getsuspectmeta = new Database();
            $chksqlsusmeta = "SELECT tbl_users.id as suspectuserid, tbl_users.username as suspectusername FROM tbl_users
            WHERE tbl_users.id = :id";
            $chkargsusmeta = array('id'=>$rescm['byuserid']);
            $ressusmeta = $getreportermeta->executesql('selectone',$chksqlsusmeta,$chkargsusmeta);
            //var_dump($ressusmeta);
        }catch(Exception $e){
            return 'An error occured at Suspect Meta stage'.$e;
        }


    break;

    case 'article':



        try{
            $getreportmeta = new Database();
            $chksqlrm = "SELECT tbl_reports.id as reportid, tbl_reports.reportbyuser, tbl_reports.targetid, tbl_reports.remarks, tbl_reports.date, tbl_reports.status, tbl_reports.handledbyuserid
            FROM tbl_reports
            WHERE tbl_reports.id = :id";
            $chkargrm = array('id'=>$clreportid);
            $resrm = $getreportmeta->executesql('selectone',$chksqlrm,$chkargrm);
            //var_dump($resrm);
        }catch(Exception $e){
            return 'An error occured at Report Meta stage'.$e;
        }



        try{
            $getarticlemeta = new Database();
            $chksqlam = "SELECT tbl_articles.id as articleid, tbl_articles.title, tbl_articles.thumbnail, tbl_articles.subtitle, tbl_articles.content, tbl_articles.byuserid FROM tbl_articles
            WHERE tbl_articles.id = :id";
            $chkargam = array('id'=>$resrm['targetid']);
            $resam = $getarticlemeta->executesql('selectone',$chksqlam,$chkargam);
            //var_dump($resam);
        }catch(Exception $e){
            return 'An error occured at Article Meta stage'.$e;
        }


        try{
            $getreportermeta = new Database();
            $chksqlrmeta = "SELECT tbl_users.id as reporteruserid, tbl_users.username as reporterusername FROM tbl_users
            WHERE tbl_users.id = :id";
            $chkargrmeta = array('id'=>$resrm['reportbyuser']);
            $resrmeta = $getreportermeta->executesql('selectone',$chksqlrmeta,$chkargrmeta);
            //var_dump($resrmeta);
        }catch(Exception $e){
            return 'An error occured at Reporter Meta stage'.$e;
        }



        try{
            $getsuspectmeta = new Database();
            $chksqlsusmeta = "SELECT tbl_users.id as suspectuserid, tbl_users.username as suspectusername FROM tbl_users
            WHERE tbl_users.id = :id";
            $chkargsusmeta = array('id'=>$resam['byuserid']);
            $ressusmeta = $getreportermeta->executesql('selectone',$chksqlsusmeta,$chkargsusmeta);
            //var_dump($ressusmeta);
        }catch(Exception $e){
            return 'An error occured at Suspect Meta stage'.$e;
        }


    break;
    default:
        echo 'Unknown Report Type.. exiting';

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
    <title>Preview Report</title>
</head>
<body>


<br>
<br>

<div class="container">
    <div class="row">
        <div class="col-sm-1"><a class="btn btn-primary" href="../ReportsDashboard.php"><=</a></div>
        <div class="col-sm-11 d-flex justify-content-center"><h1>Preview Report</h1></div>
        <div class="col-sm-12">


<?php


switch($clreporttype){


    case 'comment':        
        echo 
        "
        <br>
        <br>
        <div class='card'>
            <div class='card-header'>
                Overview
            </div>
            <div class='card-body'>
                <p>On the date of <b>".$resrm['date']."</b> the user <b>".$resrmeta['reporterusername']."</b> (User ID: ".$resrmeta['reporteruserid'].") filed a report, stating the following: 
                </p>
                <br>
                <p>[' ".$resrm['remarks']." ']</p>
                <br>
                <br>
                <p>on the following comment by the user <b>".$ressusmeta['suspectusername']."</b> (User ID: ".$ressusmeta['suspectuserid'].") that was posted on the article <b>".$resam['title']."</b> (Article ID: ".$resam['articleid'].").</p>
                <br>
            </div>
        </div>
        <br>
        <br>
        <div class='card'>
            <div class='card-header'>
                Reported Content Preview
            </div>
            <div class='card-body'>

            <div class='card m-4'>
                <p class='h5 m-3'>".$rescm['content']."</p>
            </div>


            </div>
        </div>
        <br>
        <br>
        ";
        if($resrm['status'] == 0){ 
            echo "
            <div class='card'>
            <div class='card-header'>
                Recommended Actions
            </div>
            <div class='card-body'>
            <form method='POST' action='HandleReportComment.php' class='row g-3 needs-validation' novalidate>
                
            <div class='col-md-12'>
            <p><b>User Actions:</b></p>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='blockuser' name='user-action' checked required>
                <label class='form-check-label' for='validationFormCheck2'>Set Responsible user to Blocked</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>
            <div class='col-md-12'>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='pendinguser' name='user-action' required>
                <label class='form-check-label' for='validationFormCheck2'>Set Responsible user to Pending</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>
            <div class='col-md-12'>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='noaction' name='user-action' required>
                <label class='form-check-label' for='validationFormCheck2'>Take no Action against User</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
          </div>
        </div>


            <div class='col-md-12'>
            <p><b>Content Actions:</b></p>
            <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='takedowncontent' name='contentaction' checked required>
                <label class='form-check-label' for='validationFormCheck2'>Take-down the Reported Content</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>

            <div class='col-md-12'>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='noaction' name='contentaction' required>
                <label class='form-check-label' for='validationFormCheck2'>Take No Action</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>
<br>
<br>
<br>
<br>
<input style='visibility:hidden;' type='text' value='".$clreportid."' name='clreportid' required>
<input style='visibility:hidden;' type='text' value='".$clreporttype."' name='clreporttype' required>
            <div class='col-12'>
            <div class='form-check'>
              <input class='form-check-input' type='checkbox' value=' id='invalidCheck' required>
              <label class='form-check-label' for='invalidCheck'>
                Agree to terms and conditions
              </label>
              <div class='invalid-feedback'>
                You must agree before submitting.
              </div>
            </div>
          </div>

            </div>
        </div>
            <div class='col-sm-12 d-flex justify-content-end mt-2'>
            <a class='btn btn-info m-2' href='../ReportsDashboard.php'>Cancel</a>
            <input class='btn btn-primary m-2' type='submit' href='HandleReportComment.php' name='submit'></input>
            ";

        }else{
            echo "
            <div class='card'>
            <div class='card-header'>
                Remarks
            </div>
            <div class='card-body'>
                <p> This report was handled by Admin ID: ".$resrm['handledbyuserid']."</p>
            </div>
            ";
        }
        "
        </div>

        </form>
        ";

    break;
    case 'article':
        echo 
        "
        <br>
        <br>
        <div class='card'>
            <div class='card-header'>
                Overview
            </div>
            <div class='card-body'>
                <p>On the date of <b>".$resrm['date']."</b> the user <b>".$resrmeta['reporterusername']."</b> (User ID: ".$resrmeta['reporteruserid'].") filed a report, stating the following: 
                </p>
                <br>
                <p>[' ".$resrm['remarks']." ']</p>
                <br>
                <br>
                <p>on the following article <b>".$resam['title']."</b> (Article ID: ".$resam['articleid'].") written by the user by the user <b>".$ressusmeta['suspectusername']."</b> (User ID: ".$ressusmeta['suspectuserid'].") .</p>
                <br>
            </div>
        </div>
        <br>
        <br>
        <div class='card'>
            <div class='card-header'>
                Reported Content Preview
            </div>
            <div class='card-body'>

            <div class='card m-4'>
                <img src=".$resam['thumbnail']." class='img-fluid d-flexjustify-content-center'/>
                <p class='h1 m-3 d-flex justify-content-center'>".$resam['title']."</p>
                <p class='h3 m-3 d-flex justify-content-center'>".$resam['subtitle']."</p>
                <br>
                <p class='h6 m-3'>".$resam['content']."</p>
            </div>


            </div>
        </div>
        <br>
        <br>
        ";
        if($resrm['status'] == 0){ 
            echo "
            <div class='card'>
            <div class='card-header'>
                Recommended Actions
            </div>
            <div class='card-body'>
            <form method='POST' action='HandleReportComment.php' class='row g-3 needs-validation' novalidate>
                
            <div class='col-md-12'>
            <p><b>User Actions:</b></p>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='blockuser' name='user-action' checked required>
                <label class='form-check-label' for='validationFormCheck2'>Set Responsible user to Blocked</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>
            <div class='col-md-12'>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='pendinguser' name='user-action' required>
                <label class='form-check-label' for='validationFormCheck2'>Set Responsible user to Pending</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>
            <div class='col-md-12'>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='noaction' name='user-action' required>
                <label class='form-check-label' for='validationFormCheck2'>Take no Action against User</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
          </div>
        </div>


            <div class='col-md-12'>
            <p><b>Content Actions:</b></p>
            <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='takedowncontent' name='contentaction' checked required>
                <label class='form-check-label' for='validationFormCheck2'>Take-down the Reported Content</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>

            <div class='col-md-12'>
                <div class='form-check'>
                <input type='radio' class='form-check-input' id='validationFormCheck2' value='noaction' name='contentaction' required>
                <label class='form-check-label' for='validationFormCheck2'>Take No Action</label>
                <div class='invalid-feedback'>More example invalid feedback text</div>
              </div>
            </div>
<br>
<br>
<br>
<br>
<input style='visibility:hidden;' type='text' value='".$clreportid."' name='clreportid' required>
<input style='visibility:hidden;' type='text' value='".$clreporttype."' name='clreporttype' required>
            <div class='col-12'>
            <div class='form-check'>
              <input class='form-check-input' type='checkbox' value=' id='invalidCheck' required>
              <label class='form-check-label' for='invalidCheck'>
                Agree to terms and conditions
              </label>
              <div class='invalid-feedback'>
                You must agree before submitting.
              </div>
            </div>
          </div>

            </div>
        </div>
            <div class='col-sm-12 d-flex justify-content-end mt-2'>
            <a class='btn btn-info m-2' href='../ReportsDashboard.php'>Cancel</a>
            <input class='btn btn-primary m-2' type='submit' href='HandleReportComment.php' name='submit'></input>
            ";

        }else{
            echo "
            <div class='card'>
            <div class='card-header'>
                Remarks
            </div>
            <div class='card-body'>
                <p> This report was handled by Admin ID: ".$resrm['handledbyuserid']."</p>
            </div>
            ";
        }
        "
        </div>

        </form>

        ";
    break;
    default:
        echo 'Unknown Report Type';
        exit();
}

?>

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