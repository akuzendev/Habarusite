<?php
session_start();
require_once('inc/checkstate.php');
include_once('../php/Admin.php');


try{
    $getcurrentconfig = new Admin();
    $res99 = $getcurrentconfig->returncurrentconfig();
}catch(Exception $e){
    return 'An error occurs in Config'.$e;
}



try{
    $getrow1config = new Admin();
    $res1000 = $getrow1config->returnrow1config();
}catch(Exception $e){
    return 'An error occurs in row 1 Config'.$e;
}


try{
    $getrow2config = new Admin();
    $res1001 = $getrow2config->returnrow2config();
}catch(Exception $e){
    return 'An error occurs in row 2 Config'.$e;
}


try{
    $getrow3config = new Admin();
    $res1002 = $getrow3config->returnrow3config();
}catch(Exception $e){
    return 'An error occurs in row 3 Config'.$e;
}


try{
    $getrow4config = new Admin();
    $res1003 = $getrow4config->returnrow4config();
}catch(Exception $e){
    return 'An error occurs in row 4 Config'.$e;
}



try{
    $newcounter  = new Admin();
    $res1 = $newcounter->countTotalArticles();
    $result1 = $res1['COUNT(id)'];
    //return $result['int'];
}catch(Exception $e){
    return 'Error occured with counting' .$e;
}


try{
    $acarticle = new Admin();
    $acreturnarticles = $acarticle->returnallarticles();
}catch(Exception $e){
    return 'An error with returning articles'.$e;
}



try{
    $accatergories = new Admin();
    $acreturncatergories = $accatergories->returnallcatergories();
}catch(Exception $e){
    return 'An error with returning articles'.$e;
}



try{
    $res2 = $newcounter->countTotalUsers();
    $result2 = $res2['COUNT(id)'];
    //return $result['int'];
}catch(Exception $e){
    return 'Error occured with counting' .$e;
}



try{
    $res3 = $newcounter->countTimelines();
    $result3 = $res3['COUNT(id)'];
    //return $result['int'];
}catch(Exception $e){
    return 'Error occured with counting' .$e;
}



try{
    $res4 = $newcounter->countComments();
    $result4 = $res4['COUNT(id)'];
    //return $result['int'];
}catch(Exception $e){
    return 'Error occured with counting' .$e;
}



try{
    $res6 = $newcounter->countArticlesInApproval();
    $result6 = $res6['COUNT(id)'];
    //return $result['int'];
}catch(Exception $e){
    return 'Error occured with counting' .$e;
}




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
<?php
    include_once('inc/admin-navbar.php');
?>
<br>

<div class="container">
    <div class="row">
        <div class="col-sm-12 d-flex justify-content-center">
            <h1>Admin Dashboard</h1>
        </div>
        <div class="col-sm-7">
        <br>
            <div class="card text-center">
                <div class="card-header">
                    <h4>Change Homepage Configuration</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="inc/updateBreaking.php">
                    <div class="">
                    <label for="validationCustom04" class="form-label d-flex justify-content-start">Set Article to Breaking News:</label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><b>Current Breaking News:</b></label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><?php if($res99['breakingnewsid'] == null){ echo 'No Active Breaking News';}else{echo $res99['title'].'--'.$res99['subtitle'];}  ?></label>
                        <select class="form-select" id="validationCustom04" name="breakingnewsarticle">
                        <option selected value="0">No Breaking News...</option>    
                        <?php
                            foreach($acreturnarticles as $acres){
                                echo '<option value='.$acres['id'].'>'.$acres['title'].'----'.$acres['subtitle'].'</option>';
                            }
                        ?> 
                        </select>
                    </div>
                    <br>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-success" type="submit" name="updatebreakingnews">Set Breaking News</button>
                    </div>
                    </form>
                </div>
            </div>

            <div class="card text-center">
                <div class="card-header">
                    <h4>Change Homepage Rows</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="inc/updateRowConfig.php">

                    <div class="">
                    <label for="validationCustom04" class="form-label d-flex justify-content-start">Set Catergory of Row 1 </label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><b>Current Catergory:</b></label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><?php if($res1000['name'] == null){ echo 'No Catergory';}else{echo $res1000['name'];}  ?></label>
                        <select class="form-select" id="validationCustom04" name="setrow1">
                        <option selected value="">No Catergory...</option>    
                        <?php
                            foreach($acreturncatergories as $acrescat){
                                echo '<option value='.$acrescat['id'].'>'.$acrescat['name'].'</option>';
                            }
                        ?> 
                        </select>
                    </div>
<br>
                    <div class="">
                    <label for="validationCustom04" class="form-label d-flex justify-content-start">Set Catergory of Row 2 </label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><b>Current Catergory:</b></label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><?php if($res1001['name'] == null){ echo 'No Catergory';}else{echo $res1001['name'];}  ?></label>
                        <select class="form-select" id="validationCustom04" name="setrow2">
                        <option selected value="">No Catergory...</option>    
                        <?php
                            foreach($acreturncatergories as $acrescat){
                                echo '<option value='.$acrescat['id'].'>'.$acrescat['name'].'</option>';
                            }
                        ?> 
                        </select>
                    </div>
<br>
                    <div class="">
                    <label for="validationCustom04" class="form-label d-flex justify-content-start">Set Catergory of Row 3 </label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><b>Current Catergory:</b></label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><?php if($res1002['name'] == null){ echo 'No Catergory';}else{echo $res1002['name'];}  ?></label>
                        <select class="form-select" id="validationCustom04" name="setrow3">
                        <option selected value="">No Catergory...</option>    
                        <?php
                            foreach($acreturncatergories as $acrescat){
                                echo '<option value='.$acrescat['id'].'>'.$acrescat['name'].'</option>';
                            }
                        ?> 
                        </select>
                    </div>
<br>
                    <div class="">
                    <label for="validationCustom04" class="form-label d-flex justify-content-start">Set Catergory of Row 4 </label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><b>Current Catergory:</b></label>
                    <label for="validationCustom04" class="form-label d-flex justify-content-end"><?php if($res1003['name'] == null){ echo 'No Catergory';}else{echo $res1003['name'];}  ?></label>
                        <select class="form-select" id="validationCustom04" name="setrow4">
                        <option selected value="">No Catergory...</option>    
                        <?php
                            foreach($acreturncatergories as $acrescat){
                                echo '<option value='.$acrescat['id'].'>'.$acrescat['name'].'</option>';
                            }
                        ?> 
                        </select>
                    </div>
<br>
                    <div class="col-sm-12 d-flex justify-content-end">
                        <button class="btn btn-success" type="submit" name="updaterowconfig">Update Row Catergories</button>
                    </div>
                    </form>
                </div>
            </div>

            



        </div>
        <div class="col-sm-5">
<br>
        <div class="">
        <div class="card text-center">
            <div class="card-header">
                Total No. of Articles
            </div>
            <div class="card-body">
                <p class="card-text"><?php if($result1 == 0 ){echo '0'; }else{echo $result1;};?></p>
            </div>
            <div class="card-footer text-muted">
                <a href="ArticleDashboard.php" class="btn btn-primary">Go to Articles</a>
            </div>
        </div>
<br>
        <div class="">
            <div class="card text-center">
                <div class="card-header">
                    Total No. of Users
                </div>
                <div class="card-body">
                    <p class="card-text"><?php if($result2 == 0 ){echo '0'; }else{echo $result2;};?></p>
                </div>
                <div class="card-footer text-muted">
                    <a href="UsersDashboard.php" class="btn btn-primary">Go to Users</a>
                </div>
            </div>
        </div>
<br>
        <div class="">
                <div class="card text-center">
                    <div class="card-header">
                        Total No. of Timelines
                    </div>
                    <div class="card-body">
                        <p class="card-text"><?php if($result3 == 0 ){echo '0'; }else{echo $result3;}; ?></p>
                    </div>
                    <div class="card-footer text-muted">
                        <a href="TimelineDashboard.php" class="btn btn-primary">Go to Timelines</a>
                    </div>
                </div>
<br>
        <div class="">
                    <div class="card text-center">
                        <div class="card-header">
                            Total No. of Comments
                        </div>
                        <div class="card-body">
                            <p class="card-text"><?php if($result4 == 0 ){echo '0'; }else{echo $result4;}; ?></p>
                        </div>
                        <div class="card-footer text-muted">
                            <a href="ACommentsDashboard.php" class="btn btn-primary">Go to Comments</a>
                        </div>
                    </div>
                </div>
<br>
            <div class="">
                        <div class="card text-center">
                                <div class="card-header">
                                    No. of Articles in Approval
                                </div>
                                <div class="card-body">
                                    <p class="card-text"><?php if($result6 == 0 ){echo '0'; }else{echo $result6;}; ?></p>
                                </div>
                                <div class="card-footer text-muted">
                                    <a href="AArticleDashboard.php" class="btn btn-primary">Go to Articles</a>
                                </div>
                            </div>
                    </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>