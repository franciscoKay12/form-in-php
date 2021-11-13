<?php require_once "controllerDataCo.php"; ?>
<?php

if ($_SESSION['info'] == false ) {
    header('Location: login.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scales=1.0">
    <title>Reset code verification</title>
</head>
<body>

 <div class="container">
 <div class="row">
 <div class="col-md-4 offset-md-4 form">
     
     <?php if (isset($_SESSION['info'])) { ?>
        <div class="alert alert-success text-center">
        <?php echo $_SESSION['info'] ?>
        </div>
     <?php } ?>

     <form action="login.php" method="post">
     <h2 class="text-center">Ready</h2>
     <div class="form-group">
       <input class="form-control button" type="submit" name="passwordchanged_btn" value="Login now">
     </div>

     </form>
 </div>
 </div>
 </div>
    
</body>
</html>