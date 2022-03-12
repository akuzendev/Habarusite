<?php

require_once('Writer.php');
require_once('Article.php');
require_once('Database.php');


class Admin extends Writer {

//article functions
/*
    public function getArticlesInApproval(){
        try{
            $newdb1 = new Database();
            $chksql1 = 'SELECT * FROM tbl_articles WHERE status = :status';
            $chkarg1 = array('status'=> 0);
            $res = $newdb1->executesql('selectall',$chksql1,$chkarg1);
            var_dump($res);
        }catch(Exception $e){
            return 'An error occured in returning articles in approval' .$e;
        }
    }
*/

    public function returnallarticles(){
        try{
            $newdb0 = new Database();
            $chksql0 = "SELECT tbl_articles.id,`istimeline`, `timelineid`, `title`, `subtitle`, app_catergories.name AS catergory, `thumbnail`, `byuserid`, `timestamp`, `content`, `relcommentid`, `status`, `approvedbyuserid` FROM `tbl_articles` INNER JOIN app_catergories ON tbl_articles.catergory = app_catergories.id";
            $chkarg0 = null;
            $res0 = $newdb0->executesql('selectall',$chksql0,$chkarg0);
            return $res0;
        }catch(Exception $e){
            return 'An error occured in Returning Articles' .$e;
        }
    }
    

    public function returnallcatergories(){
        try{
            $newdb99 = new Database();
            $chksql99 = "SELECT * FROM app_catergories";
            $chkargs99 = null;
            $res99 = $newdb99->executesql('selectall',$chksql99,$chkargs99);
            return $res99;
        }catch(Exception $e){
            return 'An error occured in the catergory'.$e;
        }
    }


    public function approveArticle($articleid, $userid){
        try{
            $newdb1 = new Database();
            $chksql1 = "UPDATE `tbl_articles` SET `status`= 1, `approvedbyuserid`= $articleid WHERE id=$userid";
            $chkarg1 = null;
            $res = $newdb1->executesql('crud',$chksql1,$chkarg1);
            return $res;
        }catch(Exception $e){
            return 'An error occured with Article approval' .$e;
        }     
    }



    public function deleteArticle($articleid){
        try{
            $newdb2 = new Database();
            $chksql2 = "DELETE FROM `tbl_articles` WHERE id =:id";
            $chkarg2 = array('id' => $articleid);
            $res = $newdb2->executesql('crud',$chksql2,$chkarg2);
            return $res;    
        }catch(Exception $e){
            return 'An Error occured with Article Deletion' .$e;
        }
    }


//user functions

    public function returnallusers(){
        try{
            $newdb0 = new Database();
            $chksql0 = "SELECT * FROM `tbl_users`";
            $chkarg0 = null;
            $res1 = $newdb0->executesql('selectall',$chksql0,$chkarg0);
            return $res1;
        }catch(Exception $e){
            return 'An error occured in Returning Articles' .$e;
        }

    }


    public function deleteUser($targetuserid){
        try{
            $newdb3 = new Database();
            $chksql3 = "DELETE FROM `tbl_users` WHERE id =$targetuserid";
            $chkarg3 = null;
            $res = $newdb3->executesql('crud',$chksql3,$chkarg3);
            return $res;    
        }catch(Exception $e){
            return 'An Error occured with User Deletion' .$e;
        }
    }


//comments functions

    public function returnallcomments(){
        try{
            $newdb0 = new Database();
            $chksql0 = "SELECT 
            tbl_comments.id as commentid,
            tbl_comments.content,
            tbl_comments.timestamp,
            tbl_users.id as userid,
            tbl_users.username,
            tbl_comments.onarticleid,
            tbl_comments.status,
            tbl_articles.id as articleid,
            tbl_articles.title
            FROM `tbl_comments` 
            INNER JOIN tbl_articles ON tbl_comments.onarticleid = tbl_articles.id
            INNER JOIN tbl_users ON tbl_comments.byuserid = tbl_users.id";
            $chkarg0 = null;
            $res0 = $newdb0->executesql('selectall',$chksql0,$chkarg0);
            return $res0;
        }catch(Exception $e){
            return 'An error occured in Returning Articles' .$e;
        }
    }


    public function returncommentsofusers($userid){
        try{
            $newdb0 = new Database();
            $chksql0 = "SELECT 
            tbl_comments.id as commentid,
            tbl_comments.content,
            tbl_comments.timestamp,
            tbl_users.id as userid,
            tbl_users.username,
            tbl_comments.onarticleid,
            tbl_comments.status,
            tbl_articles.id as articleid,
            tbl_articles.title
            FROM `tbl_comments` 
            INNER JOIN tbl_articles ON tbl_comments.onarticleid = tbl_articles.id
            INNER JOIN tbl_users ON tbl_comments.byuserid = tbl_users.id WHERE tbl_users.id = :userid";
            $chkarg0 = array('userid' =>$userid);
            $res0 = $newdb0->executesql('selectall',$chksql0,$chkarg0);
            return $res0;
        }catch(Exception $e){
            return 'An error occured in Returning Articles' .$e;
        }
    }



    public function returncommentsofarticle($articleid){
        try{
            $newdb1 = new Database();
            $chksql1 = "SELECT 
            tbl_comments.id as commentid,
            tbl_comments.content,
            tbl_comments.timestamp,
            tbl_users.id as userid,
            tbl_users.username,
            tbl_comments.onarticleid,
            tbl_comments.status,
            tbl_articles.id as articleid,
            tbl_articles.title
            FROM `tbl_comments` 
            INNER JOIN tbl_articles ON tbl_comments.onarticleid = tbl_articles.id
            INNER JOIN tbl_users ON tbl_comments.byuserid = tbl_users.id WHERE tbl_articles.id = :articleid";
            $chkarg1 = array('articleid' =>$articleid);
            $res1 = $newdb1->executesql('selectall',$chksql1,$chkarg1);
            return $res1;
        }catch(Exception $e){
            return 'An error occured in Returning Articles' .$e;
        }
    
    }   


    public function delcomment($targetcommentid){
        try{
            $newdb3 = new Database();
            $chksql3 = "DELETE FROM `tbl_comments` WHERE id =$targetcommentid";
            $chkarg3 = null;
            $res = $newdb3->executesql('crud',$chksql3,$chkarg3);
            return $res;    
        }catch(Exception $e){
            return 'An Error occured with Comment Deletion' .$e;
        }

    }
    public function editcomment(){

    }
    public function setCommentToBlocked($targetcomment, $userid){}
    public function setCommentToActive($targetcomment, $userid){}


//timelines functions

    public function returnalltimelines(){
        try{
            $newdb4 = new Database();
            $chksql4 = "SELECT tbl_timelines.id, tbl_timelines.title, tbl_timelines.subtitle, tbl_timelines.thumbnailurl,tbl_timelines.createddate,tbl_timelines.byuserid,tbl_timelines.status,  tbl_users.username as createdbyusername  FROM `tbl_timelines`
            INNER JOIN tbl_users ON tbl_users.id = tbl_timelines.byuserid";
            $chkarg4 = null;
            $res1 = $newdb4->executesql('selectall',$chksql4,$chkarg4);
            return $res1;
        }catch(Exception $e){
            return 'An error occured in Returning Timelines' .$e;
        }
    }


    public function deletetimeline($timelineid){
        try{
            $newdb5 = new Database();
            $chksql5 = "DELETE FROM `tbl_timelines` WHERE id =$timelineid";
            $chkarg5 = null;
            $res = $newdb5->executesql('crud',$chksql5,$chkarg5);
            return $res;    
        }catch(Exception $e){
            return 'An Error occured with User Deletion' .$e;
        }
    }

//Counts
    public function countTotalArticles(){
        try{
            $newdb = new Database();
            $sql = 'SELECT COUNT(id) FROM tbl_articles';
            $args = null;
            $res = $newdb->executesql('selectone',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Counting'. $e;
        }
    }


    public function countTotalArticlesOfUser($userid){
        try{
            $newdb = new Database();
            $sql = 'SELECT COUNT(id) FROM tbl_articles WHERE byuserid=:byuserid';
            $args = array('byuserid'=>$userid);
            $res = $newdb->executesql('selectone',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Counting'. $e;
        }
    }




    public function countTotalUsers(){
        try{
            $newdb = new Database();
            $sql = 'SELECT COUNT(id) FROM tbl_users';
            $args = null;
            $res = $newdb->executesql('selectone',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Counting'. $e;
        }
    }

    public function countTimelines(){
        try{
            $newdb = new Database();
            $sql = 'SELECT COUNT(id) FROM tbl_timelines';
            $args = null;
            $res = $newdb->executesql('selectone',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Counting'. $e;
        }

    }


    public function countComments(){
        try{
            $newdb = new Database();
            $sql = 'SELECT COUNT(id) FROM tbl_comments';
            $args = null;
            $res = $newdb->executesql('selectall',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Counting'. $e;
        }
    }

    public function countArticlesInApproval(){
        try{
            $newdb = new Database();
            $sql = 'SELECT COUNT(id) FROM tbl_articles WHERE status = 0';
            $args = null;
            $res = $newdb->executesql('selectone',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Counting'. $e;
        }
    }


//Reports


    public function countReports(){

        try{
            $newdb = new Database();
            $sql = 'SELECT COUNT(id) FROM tbl_reports';
            $args = null;
            $res = $newdb->executesql('selectall',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Counting'. $e;
        }
        
    }


    public function returnallreports(){
        try{
            $newdb = new Database();
            $sql = 'SELECT * FROM tbl_reports';
            $args = null;
            $res = $newdb->executesql('selectall',$sql,$args);
            return $res;
        }catch(Exception $e){
            return 'Error occured with Reports'. $e;
        }
    }



    //Configuration Settings:

    public function returncurrentconfig(){
        try{
            $newdb = new Database();
            $sql = 'SELECT app_settings.id, app_settings.breakingnewsid, tbl_articles.title, tbl_articles.subtitle ,app_settings.row1cat, app_settings.row2cat,app_settings.row3cat,app_settings.row4cat FROM `app_settings` 
            INNER JOIN tbl_articles ON app_settings.breakingnewsid = tbl_articles.id
            WHERE app_settings.id = 1';
            $args = null;
            $configcurrent = $newdb->executesql('selectone',$sql,$args);
            return $configcurrent;
        }catch(Exception $e){
            return 'An error occured with current config'.$e;
        }
    }


    public function returnrow1config(){
        try{
            $newdb = new Database();
            $sql = 'SELECT app_settings.row1cat,app_catergories.name FROM `app_settings`
            INNER JOIN app_catergories ON app_settings.row1cat = app_catergories.id
            WHERE app_settings.id = 1';
            $args = null;
            $configrow1 = $newdb->executesql('selectone',$sql,$args);
            return $configrow1;
        }catch(Exception $e){
            return 'An error occured with returning to row1 config'.$e;
        }
    }

    public function returnrow2config(){
        try{
            $newdb = new Database();
            $sql = 'SELECT app_settings.row2cat, app_catergories.name FROM `app_settings`
            INNER JOIN app_catergories ON app_settings.row2cat = app_catergories.id
            WHERE app_settings.id = 1';
            $args = null;
            $configrow2 = $newdb->executesql('selectone',$sql,$args);
            return $configrow2;
        }catch(Exception $e){
            return 'An error occured with returning to row2 config'.$e;
        }
    }

    public function returnrow3config(){
        try{
            $newdb = new Database();
            $sql = 'SELECT app_settings.row3cat,app_catergories.name FROM `app_settings`
            INNER JOIN app_catergories ON app_settings.row3cat = app_catergories.id
            WHERE app_settings.id = 1';
            $args = null;
            $configrow3 = $newdb->executesql('selectone',$sql,$args);
            return $configrow3;
        }catch(Exception $e){
            return 'An error occured with returning to row3 config'.$e;
        }
    }

    public function returnrow4config(){
        try{
            $newdb = new Database();
            $sql = 'SELECT app_settings.row4cat,app_catergories.name FROM `app_settings`
            INNER JOIN app_catergories ON app_settings.row4cat = app_catergories.id
            WHERE app_settings.id = 1';
            $args = null;
            $configrow4 = $newdb->executesql('selectone',$sql,$args);
            return $configrow4;
        }catch(Exception $e){
            return 'An error occured with returning to row4 config'.$e;
        }
    }





}