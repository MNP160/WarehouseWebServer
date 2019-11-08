<?php
include("authenticate.php");
?>
<?php
  include("credentials.php");
  include("utility.php");

  if($_SERVER["REQUEST_METHOD"] == "POST"){
      if(is_Numeric($_POST["id"])){
    $id=$_POST["id"];
  }
  sanitizeInput($id);

    try{
        $connection=new PDO($dsn, $username,  $pass);

        $sql = "DELETE FROM products WHERE id = '$id'";
        $connection->exec($sql);
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
    <title>Delete Record</title>
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
                        <h1>Delete Record</h1>
                    </div>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger fade in">
                             <p>Enter id of record to delete</p>
                            <input type="text" name="id" value=""/>
                            <p>Are you sure you want to delete this record?</p><br>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="adminPage.php" class="btn btn-default">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>