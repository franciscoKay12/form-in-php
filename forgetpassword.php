<?php require_once "controllerDataCo.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scales=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Forgot password form</title>
</head>
<body>

 <div class="container">
 <div class="row">
 <div class="col-md-4 offset-md-4 form">
     <form action="forgetpassword.php" method="post">
     <h2 class="text-center">Forgot password form</h2>
     <p class="text-center">Enter with your email.</p>
        
     <?php if (count($errors) > 0) { ?>
        <div class="alert alert-danger text-center">
        <?php foreach ($errors as $error) {
            echo $error;
        } ?>
        </div>
     <?php } ?>

     <div class="form-group">
       <input class="form-control" type="email" name="email" placeholder="Enter your email address" required>
     </div>

     <div class="form-group">
       <input class="form-control button" type="submit" name="forgetpassword_btn" value="Continue">
     </div>

     </form>
 </div>
 </div>
 </div>
    
</body>
</html>