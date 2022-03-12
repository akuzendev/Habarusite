
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $pwd = htmlspecialchars($_POST['hashpassword']);
    $hashedpwd = PASSWORD_HASH($pwd,PASSWORD_DEFAULT);
}else{
    $hashedpwd = null;
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hasher</title>
</head>
<body>
    <h1 styles="color:red;"><?php echo $hashedpwd ?></h1>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
        <input type="text" placeholder="Enter your pass" name="hashpassword" required/>
        <button type="submit" name="submit">Submit</button>
    </form>

    
</body>
</html>