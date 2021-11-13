<?php require_once "controllerDataCo.php"; ?>
<?php

$email=$_SESSION['email'];
if ($email == false) {
    header('Location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scales=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Create a new password</title>
</head>
<body>

 <div class="container">
 <div class="row">
 <div class="col-md-4 offset-md-4 form">
     <form action="newpassword.php" method="post">
     <h2 class="text-center">Create a new password</h2>

     <?php if (isset($_SESSION['info'])) { ?>
        <div class="alert alert-success text-center">
          <?php echo $_SESSION['info']; ?>
        </div>
     <?php } ?>

     <?php if (count($errors) > 0) { ?>
        <div class="alert alert-danger">
        <?php foreach ($errors as $showerror) { ?>
           <?php echo $showerror; ?>
        <?php } ?>
        </div>
     <?php } ?>

     <div class="form-group">
       <input class="form-control" type="password" name="password" placeholder="New a password" required>
     </div>

     <div class="form-group">
       <input class="form-control" type="password" name="password2" placeholder="Confirm your password" required>
     </div>

     <div class="form-group">
       <input class="form-control button" type="submit" name="newpassword_btn" value="Continue">
     </div>
     
     </form>
 </div>
 </div>
 </div>
    
</body>
</html>