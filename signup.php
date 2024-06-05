<?php
    if(isset($_POST['submit'])){
        include "connection.php";
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $cpassword = mysqli_real_escape_string($conn, $_POST['cpass']);

        $sql = "select * from users where username='$username'";
        $result = mysqli_query($conn, $sql);
        $count_user = mysqli_num_rows($result);

        $sql = "select * from users where email='$email'";
        $result = mysqli_query($conn, $sql);
        $count_email = mysqli_num_rows($result);

        if($count_user==0 || $count_email==0){
            if($password==$cpassword){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "insert into users(username, email, password) values('$username', '$email', '$hash')";
                $result = mysqli_query($conn, $sql);
            }
            else{
                echo '<script>
                alert("password does not match!!");
                window.location.href = "signup.php";
                </script>';
            }
        }
        else{
            echo '<script>
            alert("user already exists!!!");
            window.location.href ="home.php"
            </script>';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Centre/Register</title>
    <link rel="stylesheet" href="css/style1.css"/>
</head>
<body>
    <center>
        <div class="header">
       <h1> Food Center Welcomes You!</h1>
       </div>
    </center>
    <center>
        <h1>Create a new account</h1>
        <form name="form" action="signup.php" method="POST">
            <table>
                <tr>
                    <td><label>Enter Username</label></td>
                    <td><input type="text" id="user" name="user" required><br></td>
                </tr>
                <tr>
                    <td><label>Enter Email</label></td>
                    <td><input type="email" id="email" name="email" required><br></td>
                </tr>
                <tr>
                    <td><label>Enter Password</label></td>
                    <td><input type="password" id="pass" name="pass" required><br></td>
                </tr>
                <tr>
                    <td><label>Retype Password</label></td>
                    <td><input type="password" id="cpass" name="cpass" required><br></td>
                </tr>
                <tr>
                    <td><input type="submit" id="btn" value="Signup" name="submit"/></td>
                </tr>
            </table>
            <p>
                Already have an account? <a class="click" href="signin.php">sign in</a>
            </p> 
        </center>       
        </form>    
</body>
</html>