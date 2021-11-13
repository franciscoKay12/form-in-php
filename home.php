<?php require_once "controllerDataCo.php"; ?>
<?php

$email=$_SESSION['email'];
$password=$_SESSION['password'];
if ($email != false && $password != false) {
    $sql="SELECT * FROM users1  WHERE email='$email' ";
    $run_sql=mysqli_query($conn, $sql);
    if ($run_sql) {
        $fetch_info=mysqli_fetch_assoc($run_sql);
        $status=$fetch_info['status'];
        $code=$fetch_info['code'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: resetCode.php');
            }
        } else {
            header('Location: verifyCode.php');
        }
    }
} else {
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
    <title><?php echo $fetch_info['name'] ?> | Home</title>
</head>
<body>

  <nav class="navbar">
  <a class="navbar-brand" href="">My name</a>
  <button type="button" class="btn btn-light"><a href="logout.php">Logout</a></button>
  </nav>
  <h1>Welcome:<?php echo $fetch_info['name'] ?></h1>
    
</body>
</html>