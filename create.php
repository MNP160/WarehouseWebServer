<?php
include("authenticate.php");
?>
<?php

include("credentials.php");
include("utility.php"); 

$name = $description = $price=$manufacturer = "";

 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
  
    if(is_string($_POST["name"])){

  
        $name=$_POST["name"];
       }
     sanitizeInput($name);
      
     if(is_string($_POST["description"])){

  
        $description=$_POST["description"];
       }
     sanitizeInput($name);

     if(is_Numeric($_POST["price"])){

  
        $price=$_POST["price"];
       }
     sanitizeInput($price);

     if(is_string($_POST["manufacturer"])){

  
        $manufacturer=$_POST["manufacturer"];
       }
     sanitizeInput($manufacturer);
    
  
    if(!empty($name) && !empty($description) && !empty($price)&& !empty($manufacturer)){
       
        try{
        $connection=new PDO($dsn, $username,  $pass);

        $sql = "INSERT INTO products (name, description, price, manufacturer) VALUES (?, ?, ?, ?)";
        $statement=$connection->prepare($sql);
        $statement->bindValue(1, $name);
        $statement->bindValue(2, $description);
        $statement->bindValue(3, $price);
        $statement->bindValue(4, $manufacturer);
        
        $statement->execute();
        
        
        
        }
        catch(Exception $e){
            echo $e->getMessage();  
          }
      
    }
}

   

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add product record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group ">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="">
                            
                        </div>
                        <div class="form-group ">
                            <label>Description</label>
                            <textarea name="description" class="form-control"></textarea>
                            
                        </div>
                        <div class="form-group ">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="">
                            
                        </div>
                        <div class="form-group ">
                            <label>Manufacturer</label>
                            <input type="text" name="manufacturer" class="form-control" value="">
                            
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="adminPage.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>