<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="style.css" />
</head>

<body>
<?php
include "credentials.php";
include "utility.php";
session_start();

if(isset($_POST["submit"])){

  if(is_string($_POST["email"])){
    $email=$_POST["email"];
  }
sanitizeInput($email);

$pw=$_POST["pw"];
sanitizeInput($pw);
$Hash=md5($pw);
try{
    $connection=new PDO($dsn, $username,  $pass);
    $sql="SELECT * FROM users  WHERE email='$email' AND passwordHash='$Hash'";
    //$sql="SELECT * FROM users WHERE email=$email";
    //$sql="SELECT * FROM users";
    $result=$connection->query($sql);

     

    /*echo $email;
    echo "<br/>";
    echo $Hash;
    echo "<br/>";
    echo $pw;*/

        $rows=$result->fetchAll();
       

       if($email=="admin@gmail.com"&&$pw=="admin"){
        $_SESSION["email"]=$email;
          
        header("location: adminPage.php");
        exit();
       }

      else{
             if($rows!==NULL){
                 $_SESSION["email"]=$email;
          
                   header("location: Catalogue.php");
                   exit();
      }
                  else{
                  echo "<div class='loginForm'>
                  <h3>Username/password is incorrect.</h3>
                  br/>Click here to <a href='login.php'>Login</a></div>";
        
      }
    }

    }
    catch(Exception $e){
      echo $e->getMessage();  
    }
    

}


else{
?>
<div class="form">
<h1>Login</h1>
<form name=login action="" method="post">
<input type="text" name="email" placeholder="Email" required />
<input type="password" name="pw" placeholder="Password" required />
<input name="submit" type="submit" value="Login" />

</form>
</div>
<?php } ?>


</body>
</html>