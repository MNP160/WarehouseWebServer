<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="style.css" />

</head>

<body>
<?php
include "credentials.php";
include "utility.php";


if(isset($_POST["submit"])){

  if(is_string($_POST["email"])){

  
   $email=$_POST["email"];
  }
sanitizeInput($email);
 if(is_string($_POST["address"])){
 $address=$_POST["address"];
 }
sanitizeInput($address);

$password=$_POST["password"];
sanitizeInput($password);
$passwordHash=md5($password);

try{
$connection=new PDO($dsn, $username,  $pass);

$sql="INSERT INTO users (email, password, address) VALUES(?,?,?)";

$statement=$connection->prepare($sql);

$statement->bindValue(1, $email);
$statement->bindValue(2, $passwordHash);
$statement->bindValue(3, $address);

$statement->execute();

//$connection->NULL;
}
catch(Exception $e){
  echo $e->getMessage();  
}

}
else{


?>
<div class="form">
<h1>Registration</h1>
<form name="registration" action="" method="post">
<input type="email" name="email" placeholder="Email" required />
<input type="text" name="address" placeholder="Address" required maxlength=50 />
<input type="password" name="password" placeholder="Password" required min=2 />
<input type="submit" name="submit" value="Register" />
<h6>Already have an account? <a href="login.php">Log in</a></h6> 
</form>
<?php } ?>
</div>


</body>




</html>