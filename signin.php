<?php
    if(isset($_POST['submit'])){
        include "connection.php";
        $username = mysqli_real_escape_string($conn, $_POST['user']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);

        $sql = "select * from users where username = '$username' or email = '$username'";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        if($row){
            if(password_verify($password, $row["password"])){
                header("Location: welcome.php");
            }
        }
        else{
            echo '<script>
                    alert("Invalid username or password!!");
                    window.location.href = "signin.php"
                 </script>';
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Food Centre/login</title>
    <link rel="stylesheet" href="css/style2.css"/>
</head>
<body>
    <center>
        <div class="header">
        <h1> Welcome Back!!</h1>
        </div>
     </center>
     <center>
         <h1>Log in account</h1>
         <form name="form" action="signin.php" method="POST">
            <table>
                <tr>
                    <td><label>Enter Username/Email</label></td>
                    <td><input type="text" id="user" name="user" required><br></td>
                </tr>
                <tr>
                    <td><label>Enter Password</label></td>
                    <td><input type="password" id="pass" name="pass" required><br></td>
                </tr>
                <tr>
                    <td><input type="submit" id="btn" value="Login" name="submit"/></td>
                </tr>
            </table>
             <p>
                Doesn't have an account? <a class="click" href="signup.php">sign up</a>
            </p>  
        </form>
    </center>   
</body>
</html>
