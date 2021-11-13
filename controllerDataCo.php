<?php

session_start();

require "connectiondb.php";

$name="";
$username="";
$email="";
$errors=array();

if (isset($_POST['signup_btn'])) {
    $name=mysqli_real_escape_string($conn, $_POST['name']);
    $username=mysqli_real_escape_string($conn, $_POST['username']);
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);
    $password2=mysqli_real_escape_string($conn, $_POST['password2']);

    if (empty($name)) {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $errors['name']="letter and spaced allowed.";
       }
    }

    if (empty($email)) {
        if (!filter_var($name,FILTER_VALIDATE_EMAIL)) {
        $errors['name']="Invalid email format.";
       }
    }

    if ($password !== $password2) {
        $errors['password']="Confirm password not matched.";
    }

    $email_check="SELECT * FROM users1 WHERE email='$email' ";
    $check=mysqli_query($conn, $email_check);
    if (mysqli_num_rows($check) > 0) {
        $errors['email']="This email is already exit.";
    }
    
    if (count($errors) === 0) {
        $newpassword=password_hash($password, PASSWORD_BCRYPT);
        $code=rand(99999,11111);
        $status="notverified";
        $insert_data="INSERT INTO users1(name, username, email, password, code, status) 
        VALUES('$name', '$username', '$email', '$newpassword', '$code', '$status')";
        $check_data=mysqli_query($conn, $insert_data);
        if ($check_data) {
            $subject="Verification code";
            $message="Your verification code is $code";
            $sender="From: javieritorrox12@gmail.com";
            if (mail($email,$subject,$message,$sender)) {
                $info="we ve sent a verification code to your email $email";
                $_SESSION['info']=$info;
                $_SESSION['email']=$email;
                $_SESSION['password']=$password;
                header('location: verifyCode.php');
                exit();
            } else {
                $errors['code-error']="Error while sending code.";
            }
        } else {
            $errors['db-error']="Error while inserting datas into database.";
        }
    }
   
}

//Code to veryfy yor account recently created.
if (isset($_POST['code_btn'])) {
    $_SESSION['info']="";
    $first_code=mysqli_real_escape_string($conn, $_POST['codebtn']);
    $check_code="SELECT * FROM users1 WHERE code='$first_code' ";
    $finish_code=mysqli_query($conn, $check_code);
    if (mysqli_num_rows($finish_code) > 0) {
        $fetch_data=mysqli_fetch_assoc($finish_code);
        $fetch_code=$fetch_data['code'];
        $email=$fetch_data['email'];
        $code=0;
        $status='verified';
        
        $update_code="UPDATE users1 SET code='$code',status='$status' WHERE code='$fetch_code' ";
        $update_end=mysqli_query($conn, $update_code);
        if ($update_end) {
            $_SESSION['name']=$name;
            $_SESSION['email']=$email;
            header('Location: home.php');
            exit();
        } else {
            $errors['code-error']="Error while sending code.";
        }
    } else {
        $errors['code-error']="You have entered a wrong code.";
    }
}

//If user wants to login.
if (isset($_POST['login_btn'])) {
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $password=mysqli_real_escape_string($conn, $_POST['password']);

    if ($email) {
        if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $errors['email']="Invalid email format.";
       }
    }

    $check_email="SELECT * FROM users1 WHERE email='$email' ";
    $login_data=mysqli_query($conn, $check_email);
    if (mysqli_num_rows($login_data) > 0) {
        $fetch=mysqli_fetch_assoc($login_data);
        $fetch_password=$fetch['password'];
        if (password_verify($password,$fetch_password)) {
            $_SESSION['email']=$email;
            $status=$fetch['status'];
            if ($status == 'verified') {
                $_SESSION['email']=$email;
                $_SESSION['password']=$password;
                header('Location: home.php');
            } else {
                $info="Your account haven t been verified with your email: $email";
                $_SESSION['info']=$info;
                header('Location: verifyCode.php');
            }
        } else {
            $errors['email']="Incorrect email or password.";
        }
    } else {
        $errors['email']="It looks like you are not a member, please create a account with the button signup.";
    }

}

//This will be the code to change the password.
if (isset($_POST['resetCode_btn'])) {
    $_SESSION['info']="";
    $reset_code=mysqli_real_escape_string($conn, $_POST['codebtn']);
    $check_code="SELECT * FROM users1 WHERE code='$reset_code' ";
    $check_end=mysqli_query($conn, $check_code);
    if (mysqli_num_rows($check_end) > 0) {
        $fetch_data=mysqli_fetch_assoc($check_end);
        $email=$fetch_data['email'];
        $_SESSION['email']=$email;
        $info="Please create a new password.";
        $_SESSION['info']=$info;
        header('Location: newpassword.php');
        exit();
    } else {
        $errors['code-error']="You have entered the wrong code.";
    }

}

//If user accepts the change password with the button.
if (isset($_POST['forgetpassword_btn'])) {
    $email=mysqli_real_escape_string($conn, $_POST['email']);
    $check_email="SELECT * FROM users1 WHERE email='$email' ";
    $run_sql=mysqli_query($conn, $check_email);
    if (mysqli_num_rows($run_sql) > 0) {
        $code=rand(999999,111111);
        $insert_code="UPDATE users1 SET code='$code' WHERE email='$email' ";
        $run_query=mysqli_query($conn, $insert_code);
        if ($run_query) {
            $subject="Reset password code";
            $message="Your verification code is $code";
            $sender="From: javieritorrox12@gmail.com";
            if (mail($email,$subject,$message,$sender)) {
                $info="We sent code to $email to reset your password";
                $_SESSION['info']=$info;
                $_SESSION['email']=$email;
                header('Location: resetCode.php');
                exit();
            } else {
                $errors['code-error']="Failed while sending code.";
            }
        } else {
         $errors['db-error']="Something went wrong.";
        }
    } else {
     $errors['email']="This email does not exist.";
    }
}

//If user creates a new password.
if (isset($_POST['newpassword_btn'])) {
    $_SESSION['info']="";
    $password=mysqli_real_escape_string($conn, $_POST['password']);
    $password2=mysqli_real_escape_string($conn, $_POST['password2']);
    
    if ($password !== $password2) {
        $errors['password']="Confirm password not matched.";
    } else {
        $code=0;
        $email=$_SESSION['email'];//This will import to this session.
        $newpass=password_hash($password,PASSWORD_BCRYPT);
        $update_password="UPDATE users1 SET password='$newpass', code='$code' WHERE email='$email'";
        $update_end=mysqli_query($conn, $update_password);
        if ($update_end) {
            $info="You have changed your password, please login to your account.";
            $_SESSION['info']=$info;
            header('Location: newpasswordset.php');
        } else {
            $errors['code']="Failed to change your password.";
        }
    }

}

//When my new password is done.
if (isset($_POST['passwordchanged_btn'])) {
    header('Location: login.php');
} 


?>