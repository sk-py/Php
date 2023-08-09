<?php
session_start();
require('conn.php');

if (isset($_POST['reg_btn'])) {
    $roll = $_POST['sroll'];
    $name = $_POST['sname'];
    $email = $_POST['semail'];
    $password = $_POST['password'];

    $chq_query = "SELECT email,roll FROM `student_data` WHERE email='$email' OR roll='$roll'";
    $rquery = mysqli_query($conn, $chq_query);

    if (mysqli_num_rows($rquery) > 0) {
        echo "<center style='margin:20rem'><h2>Record Already Exists</h2><br><br><br><br><a href='login.php'><h4>Click Here To Login <h4></a></center>";
    } else {
        $query = "INSERT INTO `student_data`(`roll`, `name`, `email`, `password`) VALUES ('$roll','$name','$email','$password')";

        $rquery = mysqli_query($conn, $query);

        if ($rquery) {
            header("Location:../Php/login.php");
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
        foreach ($response as $resp) {
            echo $_SESSION['roll'] = $resp['roll'];
        }
        $_SESSION['logged_in'] = "Logged In Succesfully";
        header("Location:../Php/home.php");
    } else {
        echo "Wrong Password";
    }
}

if (isset($_POST['course'])) {
    $chq_query = "SELECT fees FROM course WHERE course_n='$_POST[course]'";
    $rquery = mysqli_query($conn, $chq_query);
    foreach ($rquery as $respons) {
        echo $respons['fees'];
    }
}
if (isset($_POST['payment'])) {
    $query = "INSERT INTO `enrolled_student`(`roll`, `name`, `email`, `course`, `total_fee`,`rem_fee`) VALUES ('$_SESSION[roll]','$_POST[name]','$_POST[email]','$_POST[course]','$_POST[fees]','$_POST[fees]')";

    $rquery = mysqli_query($conn, $query);

    if ($rquery) {
        header('location:../Php/payment.php');
    } else {
        echo "Error in cdata";
    }
}
if (isset($_POST['txn_btn'])) {
    $query = "UPDATE `enrolled_student` SET `paid_fees`='$_POST[paidfee]',`rem_fee`='$_POST[remfee]' WHERE roll='$_SESSION[roll]'";

    $rquery = mysqli_query($conn, $query);

    if ($rquery) {
        $_SESSION['txn'] = true;
        header('location:../Php/main.php');
    } else {
        echo "Transaction Failed";
    }
}

?>