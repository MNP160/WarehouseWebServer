<!DOCTYPE html>
<html>
<head>

</head>

<body>
<?php
function sanitizeInput($data){
    stripslashes($data);
    htmlspecialchars($data);
    trim($data);
   return $data;
}
?>

</body>
</html>
