<?php
session_start();
require('conn.php');

if (isset($_POST['reg_btn'])) {
    $roll = $_POST['sroll'];
    $name = $_POST['sname'];
    $email = $_POST['semail'];
    $password = $_POST['password'];

    $chq_query = "SELECT * FROM `student_data` WHERE email='$email' OR roll='$roll'";
    $rquery = mysqli_query($conn, $chq_query);

    if (mysqli_num_rows($rquery) > 0) {
        echo "<center style='margin:20rem'><h2>Record Already Exists</h2><br><br><br><br><a href='login.php'><h4>Click Here To Login <h4></a></center>";
    } else {
        $query = "INSERT INTO `student_data`(`roll`, `name`, `email`, `password`) VALUES ('$roll','$name','$email','$password')";

        $rquery = mysqli_query($conn, $query);

        if ($rquery) {
            header("Location:../student/login.php");
        } else {
            echo "Unknow Error Occurred While Uploading Data Into Database";
        }

    }
}

if (isset($_POST['log_btn'])) {
    $email = $_POST['semail'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT * FROM `student_data` WHERE email= ? AND password= ? ");
    $query->bind_param("ss", $email, $password);
    $query->execute();
    $response = $query->get_result()->fetch_all(MYSQLI_ASSOC);

    if ($response == true) {
        $_SESSION['logged_in'] = "Logged In Succesfully";
        header("Location:../student/home.php");
    } else {
        echo "Wrong Password";
    }
}
?>