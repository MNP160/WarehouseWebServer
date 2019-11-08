<?php
include("authenticate.php");
?>
<?php
include("credentials.php");
include("utility.php");
//session_start();

$name = $description = $price=$manufacturer = "";

 
$id="";
if(isset($_POST["idSubmit"])){
   
    if(is_Numeric($_POST["id"])&&!empty($_POST["id"]))
    $id = $_POST["id"];
    $_SESSION["id"]=$id;
    sanitizeInput($id);

    try{
        $connection=new PDO($dsn, $username,  $pass);

        $sql = "SELECT * FROM products WHERE id = '$id'";
        $result=$connection->query($sql);
        while($row=$result->fetch()){
            $name=$row['name'];
            $description=$row['description'];
            $price=$row['price'];
            $manufacturer=$row['manufacturer'];
            $id=$row['id'];
        }
        $connection=null;
    }
    catch(Exception $e){
        echo $e->getMessage();  
      }

  
}

if(isset($_POST["submit"])){
    if(is_string($_POST["name"])){
        $name=$_POST["name"];
        sanitizeInput($name);
    }

    if(is_string($_POST["description"])){
        $description=$_POST["description"];
        sanitizeInput($description);
    }

    if(is_Numeric($_POST["price"])){
        $price=$_POST["price"];
        sanitizeInput($price);
    }
    if(is_string($_POST["manufacturer"])){
        $manufacturer=$_POST["manufacturer"];
        sanitizeInput($manufacturer);
    }


    try{
    echo $id . " " . $name . " " . $description . " " . $price . " " . $manufacturer;
    $connection=new PDO($dsn, $username,  $pass);
    $sql="UPDATE products SET name=?, description=?, price=?, manufacturer=? WHERE id=?";
    $statement=$connection->prepare($sql);

    $statement->bindValue(1, $name);
    $statement->bindValue(2, $description);
    $statement->bindValue(3, $price);
    $statement->bindValue(4, $manufacturer);
    $statement->bindValue(5, $_SESSION["id"]);
   
    $statement->execute();
    header("location: adminPage.php");
    }
    catch(Exception $e){
        echo $e->getMessage();  
      }
}
    
   

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please enter id of record you wish to update.</p>
                    <form action="" method="post">
                      <input type="text" name="id" required>
                      <input type="submit" name="idSubmit">
                    </form>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group ">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">
                            
                        </div>
                        <div class="form-group ">
                            <label>Description</label>
                            <textarea name="description" class="form-control"><?php echo $description; ?></textarea>
                           
                        </div>
                        <div class="form-group ">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" value="<?php echo $price; ?>">
                            
                        </div>
                        <div class="form-group ">
                            <label>Manufacturer</label>
                            <input type="text" name="manufacturer" class="form-control" value="<?php echo $manufacturer; ?>">
                            
                        </div>
                       
                        <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        <a href="adminPage.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>