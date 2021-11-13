<?php require_once "controllerDataCo.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scales=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Login form</title>
</head>
<body>

 <div class="container">
 <div class="row">
 <div class="col-md-4 offset-md-4 form">
     <form action="login.php" method="post">
     <h2 class="text-center">Login form</h2>
     <p class="text-center">Login with your email</p>

       <?php if (count($errors) > 0) {?>
       <div class="alert alert-danger text-center">
       <?php foreach ($errors as $showerror) {
           echo $showerror;
       } ?>
       </div>
       <?php } ?>

     <div class="form-group">
       <input class="form-control" type="email" name="email" placeholder="Email" required>
     </div>

     <div class="form-group">
       <input class="form-control" type="password" name="password" placeholder="Password" required>
     </div>

     <div class="link forget-pass text-left"><a href="forgetpassword.php">Forgot password?</a></div>

     <div class="form-group">
       <input class="form-control button" type="submit" name="login_btn" value="Login">
     </div>

     <div class="link login-link text-center">Not a member?<a href="signup.php">Signup</a></div>

     </form>
 </div>
 </div>
 </div>
    
</body>
</html>