<?php

require_once('User.php');
require_once('Database.php');

class Writer extends User{


    private $fname;
    private $lname;
    private $username;
    private $gender;
    private $designation;
    private $status;
    private $countrycode;
    private $phoneno;
    private $email;
    private $pssword;


    public function getterUser(){
        return array(
            "Fname"  => $this->fname,
            "Lname"  => $this->lname,
            "Username" =>$this->username,
            "Gender" => $this->gender,
            "Designation" => $this->designation,
            "Status" => $this->status,
            "CountryCode" => $this->countrycode,
            "PhoneNo" => $this->phoneno,
            "Email" => $this->email,
            "Pssword" => $this->pssword
        );
    }


    public function setFname($fname){
        return $this->fname = $fname;
    }
    public function setLname($lname){
        return $this->lname = $lname;
    }
    public function setUsername($username){
        return $this->username = $username;
    }
    public function setGender($gender){
        return $this->gender = $gender;
    }
    public function setDesignation($designation){
        return $this->designation = $designation;
    }
    public function setStatus($status){
        return $this->status = $status;
    }
    public function setCountrycode($countrycode){
        return $this->countrycode = $countrycode;
    }
    public function setPhoneno($phoneno){
        return $this->phoneno = $phoneno;
    }
    public function setEmail($email){
        return $this->email = $email;
    }
    public function setPassword($pssword){
        return $this->password = $pssword;
    }



    public function returnallyourarticles($userid){
        try{
            $newdb4 = new Database();
            $chksql4 = "SELECT tbl_articles.id as articleid, tbl_articles.istimeline, tbl_articles.timelineid, tbl_articles.title, tbl_articles.subtitle, app_catergories.name, tbl_articles.thumbnail, tbl_articles.byuserid as articlebyuserid, tbl_articles.timestamp, tbl_articles.content, tbl_articles.relcommentid, tbl_articles.status, tbl_articles.approvedbyuserid FROM `tbl_articles`
            INNER JOIN app_catergories ON tbl_articles.catergory = app_catergories.id WHERE tbl_articles.byuserid =:byuserid";
            $chkarg4 = array('byuserid'=>$userid);
            $res = $newdb4->executesql('crud',$chksql4,$chkarg4);
            return $res;
        }catch(Exception $e){
            return 'An error occured in Returning Timelines' .$e;
        }
    }

    



}