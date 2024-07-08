<?php

    include("connect.php");

    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $address = $_POST['address'];
    $image = $_FILES['photo']['name'];
    $temp_name = $_FILES['photo']['name'];
    $role = $_POST['role'];
    if($password == $cpassword){
        $targetDir = "../uploads/";
        $fileName = basename($_FILES["photo"]["name"]);
        $_SESSION['filename']=$fileName;
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
        move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFilePath);
        // move_uploaded_file($temp_name, "../uploads/$image");
        $insert = mysqli_query($connect, "INSERT INTO users (name, mobile, address, password, photo, role, status, votes)VALUES ('$name', '$mobile', '$address', '$password', '$image', '$role', 0, 0)");
        if($insert){
            echo '
            <script>
                alert("Registration successfull");
                window.location = "../";
            </script>
        '; 
        }
        else{
            echo '
            <script>
                alert("Error occured");
                window.location = "../routes/register.html";
            </script>
        '; 
        }
    }
    else{
        echo '
            <script>
                alert("password and confirm password did not match!");
                window.location = "../routes/register.html";
            </script>
        ';

    }




?>