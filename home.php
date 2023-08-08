<?php
session_start()
    ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <nav>
        <center>
            <h3>
                <?php
                if (isset($_SESSION['logged_in'])) {
                    echo "Logged in Successfully";
                }
                unset($_SESSION['logged_in']); ?>
            </h3>
            <h1> Student Course Enrollment</h1>
        </center>
    </nav>
</body>

</html>