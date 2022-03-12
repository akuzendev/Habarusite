<?php
session_start();
require_once('checkstate.php');
include_once('../../php/Database.php');








$clreportid = filter_var(htmlspecialchars($_POST['clreportid']),FILTER_SANITIZE_STRING);
$clreporttype = filter_var(htmlspecialchars($_POST['clreporttype']),FILTER_SANITIZE_STRING);
$cluseraction = filter_var(htmlspecialchars($_POST['user-action']),FILTER_SANITIZE_STRING);
$clcontentaction = filter_var(htmlspecialchars($_POST['contentaction']),FILTER_SANITIZE_STRING);

echo 'report ID:';
echo $clreportid;
echo '<br>';
echo 'User Action:';
echo $cluseraction;
echo '<br>';
echo 'Content Action:';
echo $clcontentaction;
echo '<br>';
echo 'Report Type:';
echo $clreporttype;
echo '<br>';
echo '<br>';




if($clreporttype == 'comment'){



    try{
        $getreportmeta = new Database();
        $chksqlrm = "SELECT tbl_reports.id as reportid, tbl_reports.reportbyuser, tbl_reports.targetid, tbl_reports.remarks, tbl_reports.date, tbl_reports.status, tbl_reports.handledbyuserid
        FROM tbl_reports
        WHERE tbl_reports.id = :id";
        $chkargrm = array('id'=>$clreportid);
        $resrm = $getreportmeta->executesql('selectone',$chksqlrm,$chkargrm);
        var_dump($resrm);
    }catch(Exception $e){
        return 'An error occured at Report Meta stage'.$e;
    }

    echo '<br>';
    echo '<br>';

    try{
        $getcommentmeta = new Database();
        $chksqlcm = "SELECT tbl_comments.id as commentid, tbl_comments.content, tbl_comments.timestamp, tbl_comments.byuserid, tbl_comments.onarticleid FROM tbl_comments
        WHERE tbl_comments.id = :id";
        $chkargcm = array('id' =>$resrm['targetid']);
        $rescm = $getcommentmeta->executesql('selectone',$chksqlcm,$chkargcm);
        var_dump($rescm);
    }catch(Exception $e){
        return 'An error occured at Comment Meta stage'.$e;
    }

    echo '<br>';
    echo '<br>';

    try{
        $getsuspectmeta = new Database();
        $chksqlsusmeta = "SELECT tbl_users.id as suspectuserid, tbl_users.username as suspectusername FROM tbl_users
        WHERE tbl_users.id = :id";
        $chkargsusmeta = array('id'=>$rescm['byuserid']);
        $ressusmeta = $getsuspectmeta->executesql('selectone',$chksqlsusmeta,$chkargsusmeta);
        var_dump($ressusmeta);
    }catch(Exception $e){
        return 'An error occured at Suspect Meta stage'.$e;
    }

    echo '<br>';
    echo '<br>';

    try{
        $getarticlemeta = new Database();
        $chksqlam = "SELECT tbl_articles.id as articleid, tbl_articles.title FROM tbl_articles
        WHERE tbl_articles.id = :id";
        $chkargam = array('id'=>$rescm['onarticleid']);
        $resam = $getarticlemeta->executesql('selectone',$chksqlam,$chkargam);
        var_dump($resam);
    }catch(Exception $e){
        return 'An error occured at Article Meta stage'.$e;
    }


    echo '<br>';
    echo '<br>';

    
    echo 'Proceed with Comment Report Handling';
    echo '<br>';
    echo '<br>';
    echo '<br>';
    switch($cluseraction){
        case 'blockuser':
            try{
                $setusertoblocked = new Database();
                $chksql1 = "UPDATE tbl_users SET tbl_users.status = 3 WHERE tbl_users.id = :id";
                $chkarg1 = array(
                    'id'=>$ressusmeta['suspectuserid']
                );
                $res1 = $setusertoblocked->executesql('crud',$chksql1,$chkarg1);
                var_dump($ressusmeta);
            }catch(Exception $e){
                echo 'An Error occured in the Blocking process'.$e;
            }
        break;
        case 'pendinguser':
    
            try{
                $setusertopending = new Database();
                $chksql1 = "UPDATE tbl_users SET tbl_users.status = 2 WHERE tbl_users.id = :id";
                $chkarg1 = array(
                    'id'=>$ressusmeta['suspectuserid']
                );
                $res1 = $setusertopending->executesql('crud',$chksql1,$chkarg1);
                var_dump($res1);
            }catch(Exception $e){
                echo 'An Error occured in the User Pending process'.$e;
            }
    
        break;
        case 'noaction':
            echo 'No action against the user was taken';
        break;
        default:
            echo 'Unknown Response to User Action.... exiting';
        
    }
    
    
    
    switch($clcontentaction){
        case 'takedowncontent':
    
            try{
                $takedowncontent = new Database();
                $chksql1 = "UPDATE tbl_comments SET tbl_comments.status = 2 WHERE tbl_comments.id = :id";
                $chkarg1 = array(
                    'id'=>$rescm['commentid']
                );
                $res1 = $takedowncontent->executesql('crud',$chksql1,$chkarg1);
                var_dump($res1);
            }catch(Exception $e){
                echo 'An Error occured in the Content Pending process'.$e;
            }
        break;
    
        case 'noaction':
    
            try{
                echo 'Test Message: No action was taken against the offending content';
            }catch(Exception $e){
                echo 'An Error occured in the db process';
            }
    
        break;
        default:
            echo 'Unknown Response to Content Action.... exiting';
    }



    try{
        $resolvereportc = new Database();
        $chksql2 = "UPDATE tbl_reports SET tbl_reports.status = :status, tbl_reports.handledbyuserid = :handledbyuserid WHERE tbl_reports.id = :id";
        $chkarg2 = array(
            'status' => 1,
            'id'=> $clreportid,
            'handledbyuserid' => $_SESSION['userid']
        );
        $res3 = $resolvereportc->executesql('crud',$chksql2,$chkarg2);
        var_dump($res3);
    }catch(Exception $e){
        return 'An error occured with Report Resolving'.$e;
    }




}else if($clreporttype == 'article'){
    echo '<br>';
    echo 'Proceed with Article Report Handling';



    try{
        $getreportmeta = new Database();
        $chksqlrm = "SELECT tbl_reports.id as reportid, tbl_reports.reportbyuser, tbl_reports.targetid, tbl_reports.remarks, tbl_reports.date, tbl_reports.status, tbl_reports.handledbyuserid
        FROM tbl_reports
        WHERE tbl_reports.id = :id";
        $chkargrm = array('id'=>$clreportid);
        $resrm = $getreportmeta->executesql('selectone',$chksqlrm,$chkargrm);
        var_dump($resrm);
    }catch(Exception $e){
        return 'An error occured at Report Meta stage'.$e;
    }


    echo '<br>';
    echo '<br>';

    try{
        $getarticlemeta = new Database();
        $chksqlam = "SELECT tbl_articles.id as articleid, tbl_articles.byuserid, tbl_articles.title FROM tbl_articles
        WHERE tbl_articles.id = :id";
        $chkargam = array('id'=>$resrm['targetid']);
        $resam = $getarticlemeta->executesql('selectone',$chksqlam,$chkargam);
        var_dump($resam);
    }catch(Exception $e){
        return 'An error occured at Article Meta stage'.$e;
    }


    echo '<br>';
    echo '<br>';


    try{
        $getsuspectmeta = new Database();
        $chksqlsusmeta = "SELECT tbl_users.id as suspectuserid, tbl_users.username as suspectusername FROM tbl_users
        WHERE tbl_users.id = :id";
        $chkargsusmeta = array('id'=>$resam['byuserid']);
        $ressusmeta = $getsuspectmeta->executesql('selectone',$chksqlsusmeta,$chkargsusmeta);
        var_dump($ressusmeta);
    }catch(Exception $e){
        return 'An error occured at Suspect Meta stage'.$e;
    }


    echo '<br>';
    echo '<br>';








echo '<br>';
echo '<br>';
echo '<br>';



switch($cluseraction){
    case 'blockuser':
        try{
            $setusertoblocked = new Database();
            $chksql1 = "UPDATE tbl_users SET tbl_users.status = 3 WHERE tbl_users.id = :id";
            $chkarg1 = array('id' => $ressusmeta['suspectuserid']);
            $res1 = $setusertoblocked->executesql('crud',$chksql1,$chkarg1);
            var_dump($res1);
        }catch(Exception $e){
            echo 'An Error occured in the Blocking process'.$e;
        }
    break;
    case 'pendinguser':

        try{
            $setusertopending = new Database();
            $chksql1 = "UPDATE tbl_users SET tbl_users.status = 2 WHERE tbl_users.id = :id";
            $chkarg1 = array(
                'id'=>$ressusmeta['suspectuserid']
            );
            $res1 = $setusertoblocked->executesql('crud',$chksql1,$chkarg1);
            var_dump($res1);
        }catch(Exception $e){
            echo 'An Error occured in the User Pending process'.$e;
        }

    break;
    case 'noaction':
        echo 'No action against the user was taken';
    break;
    default:
        echo 'Unknown Response to User Action.... exiting';
    
}



switch($clcontentaction){
    case 'takedowncontent':


        try{
            $contenttakedown = new Database();
            $chksql1 = "UPDATE tbl_articles SET tbl_articles.status = :status, tbl_articles.approvedbyuserid = 0 WHERE tbl_articles.id = :id";
            $chkarg1 = array(
                'status'=>2,
                'id'=>$resam['articleid']
            );
            $res1 = $contenttakedown->executesql('crud',$chksql1,$chkarg1);
            var_dump($res1);
        }catch(Exception $e){
            echo 'An Error occured in the Content Pending process'.$e;
        }
    break;

    case 'noaction':

        try{
            echo 'Test Message: No action was taken against the offending content';
         }catch(Exception $e){
            echo 'An Error occured in the db process';
        }

    break;
    default:
        echo 'Unknown Response to Content Action.... exiting';
        echo '<br>';
        header('Location: ../ReportsDashboard.php');
}



try{
    $resolvereportc = new Database();
    $chksql2 = "UPDATE tbl_reports SET tbl_reports.status = :status, tbl_reports.handledbyuserid = :handledbyuserid WHERE tbl_reports.id = :id";
    $chkarg2 = array(
        'status' => 1,
        'id'=> $clreportid,
        'handledbyuserid' => $_SESSION['userid']
    );
    $res3 = $resolvereportc->executesql('crud',$chksql2,$chkarg2);
    var_dump($res3);
    echo '<br>';
    header('Location: ../ReportsDashboard.php');
    //header('Location: ../ReportsDashboard.php');
}catch(Exception $e){
    return 'An error occured with Report Resolving'.$e;
}


header('Location: ../ReportsDashboard.php');



}else{
    echo 'Unknown content type detected';
    exit();
}

