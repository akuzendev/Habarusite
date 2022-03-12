<?php
session_start();
require_once('Database.php');


class User {    
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



//User Account Management
    public function registerUser($fname, $lname, $username, $gender, $countrycode, $phoneno, $email, $password){
      
        try{
            $newDb = new Database();
            $chksql = 'SELECT COUNT(email) FROM tbl_users WHERE email = :email';
            $chkarg = array('email'=> $email);
            $chk4email = $newDb->executesql('selectone',$chksql,$chkarg);    
        }catch(Exception $e){
            return $e. 'A Problem occured At Email Verification';
        }

            
        if($chk4email > 0){
            //echo 'No Duplicate Email found';
            $hashpwd = PASSWORD_HASH($password,PASSWORD_DEFAULT);
            $designation = 1;
            $status = 1;
        try{
      
             $query = 'INSERT INTO tbl_users (fname, lname, username, gender, designation, status, countrycode, phoneno, email, pssword ) VALUES (:fname, :lname, :username, :gender, :designation, :status, :countrycode, :phoneno, :email, :pssword)';
             $args = array(
                 'fname' => $fname,
                 'lname' => $lname,
                 'username' => $username,
                 'gender' => $gender,
                 'email' => $email,
                 'countrycode' => $countrycode,
                 'phoneno' => $phoneno,
                 'email' => $email,
                 'pssword' => $hashpwd,
                 'status' => $status,
                 'designation' =>$designation
             );
             $newDb->executesql('crud',$query,$args);
             return 'User Registration Successful';    
          }catch(Exception $e){
             return $e . 'An Error Occured in Use Registration';
          }

        }else{
            return 'Registration Failed.';
        }



    }


    public function loginUser($logemail, $logpassword){
        try{
            $newDb = new Database();
            $chksql = 'SELECT COUNT(email) FROM tbl_users WHERE email = :email';
            $chkarg = array('email'=> $logemail);
            $chk4email = $newDb->executesql('selectone',$chksql,$chkarg);    
        }catch(Exception $e){
            return $e. 'A Problem occured At Email Verification';
            exit();
        }

        if($chk4email['COUNT(email)'] !== 0) {
            //var_dump($chk4email);
            try{
                $newDb = new Database();
                $chksql = 'SELECT * FROM tbl_users WHERE email = :email';
                $chkarg = array('email'=> $logemail);
                $chk4pass = $newDb->executesql('selectone',$chksql,$chkarg); 
                $res = $chk4pass['pssword'];   
            }catch(Exception $e){
                return $e. 'A Problem occured At Password Verification Stage 1';
                exit();
            }
            if($res !== NULL){

                if(password_verify($logpassword,$res) == true){
                                    

                        session_start();
                        $_SESSION['userid'] = $chk4pass['id'];
                        $_SESSION['username'] = $chk4pass['username'];
                        $_SESSION['userstate'] = $chk4pass['status'];
                        $_SESSION['designation'] = $chk4pass['designation'];
                        header('Location: ../index.php');

                }else{
                    echo "Password Incorrect";
                    exit();
                }
            }else{
                echo "An Error occured during Password Verfication Stage 2";
                exit();
            }
        }else{
             echo "No Account was found!";
             exit();
        }
    
    }



    public function changeUserPassword($userid, $oldpass, $newpass){
        //check if user id's password is == old passwordhash
        //else incorrect password
        //if true UPDATE password with new password
        
        try{
            $newDb = new Database();
            $chksql = 'SELECT * FROM tbl_users WHERE id = :id';
            $chkarg = array('id'=> $userid);
            $chk4pass = $newDb->executesql('selectone',$chksql,$chkarg); 
            $userpass = $chk4pass['pssword'];
     
            $chkifsame = password_verify($oldpass,$userpass);

            if($chkifsame == true){
                echo 'Old and New pass match';
                $newhashpwd = password_hash($newpass,PASSWORD_DEFAULT);
                try{
                    $newDb2 = new Database();
                    $chksql2 = 'UPDATE `tbl_users` SET `pssword`=:pssword WHERE id='.$userid;
                    $chkarg2 = array('pssword' => $newhashpwd);
                    
                    $res = $newDb2->executesql('crud',$chksql2,$chkarg2);
                    var_dump($res);
                }catch(Exception $e){
                    return 'An Error occurs in Change User' .$e;
                }
            }else{
                echo 'Passwords dont match';
            }

        }catch(Exception $e){
            return $e. 'A Problem occured At Password Verification Stage 1';
            exit();
        }
    }



    public function setUserToDeletion($userid){

        try{
            $newDb = new Database();
            $chksql = 'SELECT * FROM tbl_users WHERE id = :id';
            $chkarg = array('id'=> $userid);
            $chk4pass = $newDb->executesql('selectone',$chksql,$chkarg); 
            $userstatus = $chk4pass['status'];
     
            if($userstatus == 0){

                try{
                    $newDb2 = new Database();
                    $chksql2 = 'UPDATE `tbl_users` SET `status`=:status WHERE id='.$userid;
                    $chkarg2 = array('status' => 2);
                    
                    $res = $newDb2->executesql('crud',$chksql2,$chkarg2);
                    var_dump($res);
                }catch(Exception $e){
                    return 'An Error occurs in Change User' .$e;
                }
            }else{
                echo 'Passwords dont match';
            }

        }catch(Exception $e){
            return $e. 'A Problem occured At Password Verification Stage 1';
            exit();
        }
    }


    
    public function revokeUserDeletion($userid){


        try{
            $newdb = new Database();
            $chksql1 = "SELECT * FROM tbl_users WHERE tbl_users.id = :id AND tbl_users.status = 2";
            $chkarg1 = array('id'=>$userid);
            $resp = $newdb->executesql('selectone',$chksql1,$chkarg1);
        }catch(Exception $e){
            return "An error occured with User".$e;
        }


        if($resp['status'] == 2){

            try{
                $newDb2 = new Database();
                $chksql2 = 'UPDATE `tbl_users` SET `status`=:status WHERE id='.$userid;
                $chkarg2 = array('status' => 0);
                $res = $newDb2->executesql('crud',$chksql2,$chkarg2);
                return $res;
            }catch(Exception $e){
                return 'An Error occurs in Revoking' .$e;
            }
    
        }else{
            return false;
        }




    }


       
        


//Comment Management System
    public function addcomment(){}
    public function deletecomment(){}


//Report Content System
    public function reportComment(){}
    public function reportArticle(){}

    














/*
    
    public function RegisterUser($fname, $lname, $username, $gender, $countrycode, $phoneno, $email, $pass){
        //Adds a user to the Database.
        //Set Designation = 
        //Set Status =
            $clfname = filter_var(htmlspecialchars($fname), FILTER_SANITIZE_STRING);
            $cllname = filter_var(htmlspecialchars($lname), FILTER_SANITIZE_STRING);
            $clusername = filter_var(htmlspecialchars($username), FILTER_SANITIZE_STRING);
            $clgender = filter_var(htmlspecialchars($gender), FILTER_SANITIZE_NUMBER_INT);
            $clcountrycode = filter_var(htmlspecialchars($countrycode), FILTER_SANITIZE_NUMBER_INT);
            $clphoneno = filter_var(htmlspecialchars($phoneno), FILTER_SANITIZE_NUMBER_INT);
            $clemail = filter_var(htmlspecialchars($email), FILTER_SANITIZE_EMAIL);
            $clpass = filter_var(htmlspecialchars($pass), FILTER_SANITIZE_STRING);            
            $userdesignation = 1;
            $userstatus = 1;
    
    
            try{
                $newDb = new Database();
                $chksql = 'SELECT COUNT(email) FROM tbl_users WHERE email = :email';
                $chkarg = array('email'=> $clemail);
                $chk4email = $newDb->executesql('selectone',$chksql,$chkarg);    
            }catch(Exception $e){
                return $e. 'A Problem occured At Email Verification';
            }
    
                
            if($chk4email > 0){
                //echo 'No Duplicate Email found';
                $hashpwd = PASSWORD_HASH($clpass,PASSWORD_DEFAULT);
            try{
          
                 $query = 'INSERT INTO tbl_users (fname, lname, username, gender, designation, status, countrycode, phoneno, email, pssword ) VALUES (:fname, :lname, :username, :gender, :designation, :status, :countrycode, :phoneno, :email, :pssword)';
                 $args = array(
                     'fname' => $clfname,
                     'lname' => $cllname,
                     'username' => $clusername,
                     'gender' => $clgender,
                     'email' => $email,
                     'countrycode' => $clcountrycode,
                     'phoneno' => $clphoneno,
                     'email' => $clemail,
                     'pssword' => $hashpwd,
                     'status' => $userstatus,
                     'designation' =>$userdesignation
                 );
                 $newDb->executesql('crud',$query,$args);
                 return 'User Registration Successful';    
              }catch(Exception $e){
                 return $e . 'An Error Occured in Use Registration';
              }
    
            }else{
                return 'Registration Failed.';
            }
    
        }


        public function LoginUser($email, $password){
            //Check if Email and Password is 
        
                $clemail = filter_var(htmlspecialchars($email), FILTER_SANITIZE_EMAIL);
                $clpass = filter_var(htmlspecialchars($password), FILTER_SANITIZE_STRING);
                
                try{
                    $newDb = new Database();
                    $chksql = 'SELECT COUNT(email) FROM tbl_users WHERE email = :email';
                    $chkarg = array('email'=> $clemail);
                    $chk4email = $newDb->executesql('selectone',$chksql,$chkarg);    
                }catch(Exception $e){
                    return $e. 'A Problem occured At Email Verification';
                    exit();
                }
        
        
                if($chk4email['COUNT(email)'] !== 0) {
                    var_dump($chk4email);
                    try{
                        $newDb = new Database();
                        $chksql = 'SELECT * FROM tbl_users WHERE email = :email';
                        $chkarg = array('email'=> $clemail);
                        $chk4pass = $newDb->executesql('selectone',$chksql,$chkarg); 
                        $res = $chk4pass['pssword'];   
                    }catch(Exception $e){
                        return $e. 'A Problem occured At Password Verification Stage 1';
                        exit();
                    }
                    if($res !== NULL){
        
                        if(password_verify($clpass,$res) == true){
                                            

                                session_start();
                                $_SESSION['userid'] = $chk4pass['id'];
                                $_SESSION['userstate'] = $chk4pass['status'];
                                $_SESSION['designation'] = $chk4pass['designation'];
                                header('Location: ../index.php');
        
                        }else{
                            return "Password Incorrect";
                        }
                    }else{
                        return "An Error occured during Password Verfication Stage 2";
                        exit();
                    }
                }else{
                     return "No Account was found!";
                     exit();
                }
            }
        
 

    
            public function RequestDeletion($id){
                try{
                    $query ='UPDATE tbl_users SET stat = 4 WHERE id = :id;';
                    $args = array('id' => $id );
                    $newDb = new Database();
                    $res = $newDb->executesql('crud',$query,$args);
                    return $res;    
                }catch(Exception $e){
                    return $e. "<br> An Error Occured in Request Deletion";
                }
            }
        
        
        
        
            public function getUserState($usersn){
            try{
                $newDb = new Database();
                $chksql = 'SELECT * FROM tbl_users WHERE id = :id';
                $chkarg = array('usersn'=> $usersn);
                $chk4state = $newDb->executesql('selectone',$chksql,$chkarg); 
                $res1 = $chk4state['status'];
                $res2 = $chk4state['designation'];
                $res3 = $chk4state['username'];
                return array(
                    'State' => $res1,
                    'Designation' => $res2,
                    'Username'=>$res3
                );   
            }catch(Exception $e){
                return $e. 'A Problem occured At Returning user state';
                exit();
            }
            }
        
        
        

*/

            


}