<?php require_once "controllerDataCo.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scales=1.0">
    <title>Signup</title>
</head>
<body>

 <div class="container">
 <div class="row">
 <div class="col-md-4 offset-md-4 form">
     <form action="signup.php" method="post">
     <h2 class="text-center">Signup form</h2>

     <?php if (count($errors) == 1) { ?>
        <div class="alert alert-danger text-center">
        <?php foreach ($errors as $showerror) {
           echo $showerror;
        } ?>
        </div>
     <?php } elseif (count($errors) > 1) { ?>
        <div class="alert alert-danger">
        <?php foreach ($errors as $showerror) { ?>
           <h1><?php echo $showerror; ?></h1>
        <?php } ?>
        </div>
     <?php } ?>

     <div class="form-group">
       <input class="form-control" type="name" name="name" placeholder="Your full name" required>
     </div>

     <div class="form-group">
       <input class="form-control" type="username" name="username" placeholder="Username" required>
     </div>

     <div class="form-group">
       <input class="form-control" type="email" name="email" placeholder="Email" required>
     </div>

     <div class="form-group">
       <input class="form-control" type="password" name="password" placeholder="Password" required>
     </div>

     <div class="form-group">
       <input class="form-control" type="password" name="password2" placeholder="Confirm password" required>
     </div>

     <div class="form-group">
       <input class="form-control button" type="submit" name="signup_btn" value="Signup">
     </div>
     
     <div class="link login-link text-center">Already a member?<a href="login.php">Login</a></div>

     </form>
 </div>
 </div>
 </div>
    
</body>
</html>