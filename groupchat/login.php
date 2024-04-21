<?php
    session_start();
    if(isset($_POST["submit"])){
        $username= $_POST["username"];
        $password=$_POST["password"];
        $_SESSION["username"] = $username;
        $con=mysqli_connect("localhost","root","","three_d","3307");
        $result= mysqli_query($con,"SELECT * FROM users WHERE username='$username'  and password='$password'");
        $count=mysqli_num_rows($result);
        if($count>0){
            header("location:index.php");
        }else{
            echo "<script>alert('Wrong username or password')</script>";
        }

    }
    if(isset($_POST["guest"])){
        $username="guest";
        $password="geust";
        $_SESSION["username"] = $username;
        $con=mysqli_connect("localhost","root","","three_d","3307");
        $result= mysqli_query($con,"SELECT * FROM users WHERE username='$username'  and password='$password'");
        $count=mysqli_num_rows($result);
        if($count>0){
            header("location:index.php");
        }else{
            echo "Mali";
        }

    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .guest-button {
            background-color: #28a745;
        }

        .guest-button:hover {
            background-color: #218838;
        }

        .error {
            color: red;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <h1>Login</h1>
        <input type="text" name="username" placeholder="username" >
        <input type="password" name="password" placeholder="password">
        <button type="submit" name="submit" >login</button>

        <button type="submit" name="guest" >login as guest</button>

    </form>

</body>
</html>