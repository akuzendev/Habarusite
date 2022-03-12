<?php
 session_start();

class Article{
    private $title;
    private $subtitle;
    private $catergory;
    private $istimeline;
    private $timelineid;
    private $thumbnail;
    private $datetime;
    private $byuserid;
    private $content;
    private $commentsecid;


    public function getterArticle(){
        return array(
            "title"  => $this->title,
            "subtitle"  => $this->subtitle,
            "catergory" =>$this->catergory,
            "istimeline" => $this->istimeline,
            "timelineid" => $this->timelineid,
            "thumbnail" => $this->thumbnail,
            "datetime" => $this->datetime,
            "byuserid" => $this->byuserid,
            "content" => $this->content,
            "commentsecid" => $this->commentsecid,
        );
    }



    public function settitle($title){
        return $this->title = $title;
    }
    public function setsubtitle($subtitle){
        return $this->subtitle = $subtitle;
    }
    public function setcatergory($catergory){
        return $this->catergory = $catergory;
    }
    public function setistimeline($istimeline){
        return $this->istimeline = $istimeline;
    }
    public function settimelineid($timelineid){
        return $this->timelineid = $timelineid;
    }
    public function setthumbnail($thumbnail){
        return $this->thumbnail = $thumbnail;
    }
    public function setdatetime($datetime){
        return $this->datetime = $datetime;
    }
    public function setbyuserid($byuserid){
        return $this->byuserid = $byuserid;
    }
    public function setcontent($content){
        return $this->content = $content;
    }
    public function setcommentsecid($commentsecid){
        return $this->commentsecid = $commentsecid;
    }


    
    public function addArticle($istimeline, $timelineid, $title, $subtitle, $catergory, $thumbnail, $content, $relcommentid,$userid){
        $timestamp = date_create()->format('Y-m-d H:i:s');

            try{
                $newdb = new Database();
                $query = 'INSERT INTO tbl_articles (istimeline, timelineid, title, subtitle, catergory, thumbnail, byuserid, timestamp, content, relcommentid, status, approvedbyuserid) VALUES (:istimeline, :timelineid, :title, :subtitle, :catergory, :thumbnail, :byuserid, :timestamp, :content, :relcommentid, :status, :approvedbyuserid)';
                $args = array(
                    'istimeline' => $istimeline,
                    'timelineid' => $timelineid,
                    'title' => $title,
                    'subtitle' => $subtitle,
                    'catergory'=> $catergory,
                    'thumbnail' =>$thumbnail,
                    'byuserid' => $userid,
                    'timestamp' => $timestamp,
                    'content' => $content,
                    'relcommentid' => $relcommentid,
                    'status' => 0,
                    'approvedbyuserid' => 0,
                );                
                $newdb->executesql('crud',$query,$args);
                return 'Article Registration Successful';
            }catch(Exception $e){
                return 'article insertion failed' .$e;
            }
        
    }



    public function approveArticle($articleid){

        if(empty($_SESSION['userid'])){
            echo 'No userid, therefore no article approval';
            exit();
        }else{   
            try{
                $newdb = new Database();
                $query = 'UPDATE tbl_articles SET status = 1, approvedbyuserid ='.$_SESSION['userid'].'WHERE id = :id';
                $args = array(
                    'id' => $articleid,
                );                
                $newdb->executesql('crud',$query,$args);
                return 'Article has been Approved';
            }catch(Exception $e){
                return 'article insertion failed' .$e;
            }
        }        
    }



}