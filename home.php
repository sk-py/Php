<?php
session_start();
include 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
    <style>
        * {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        #main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: #FBEAEB;
            height: 100vh;
        }

        #alert_div {
            margin-top: 2rem;
            border-radius: 1rem;
        }

        form {
            margin: 1rem;
            padding: 2rem;
            color: #FBEAEB;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .wrapper {
            background-color: #2F3C7E;
            border-radius: 1rem;
            padding: 2rem;
            box-shadow: 6px 8px 13px darkblue;
            gap: 1rem;
        }



        select {
            margin: 11px;
        }

        span {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 1rem;
        }
    </style>
</head>

<body>

    <div id="main">
        <?php
        if (isset($_SESSION['logged_in'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show  d-flex flex-row align-items-center justify-content-center"
                id="alert_div" role="alert">
                <span class="px-5 d-flex flex-row align-items-center justify-content-center mt-1">
                    <strong><i
                            class="bi bi-check-circle px-2 d-flex flex-row align-items-center justify-content-center mt-1"></i></strong>
                    Logged In Successfully
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span class="mt-0" aria-hidden="true">&times;</span>
                    </button></span>
            </div>

            <?Php
        }
        unset($_SESSION['logged_in']); ?>

        <div class="wrapper d-flex flex-column align-items-center justify-content-center px-5">
            <h2 class="text-light text-center text-uppercase"> Course Enrollment Form</h2>
            <form action="log.php" method="post">
                <?php


                $query = "SELECT * FROM student_data where `roll`=$_SESSION[roll]";
                $rquery = mysqli_query($conn, $query);
                foreach ($rquery as $sdata) {
                    $sname = $sdata['name'];
                    $semail = $sdata['email'];
                }
                ?>
                <span>
                    Student's Name : <input type="text" name="name" value="<?Php echo $sname ?>" readonly>

                </span>
                <span>
                    Student's Email :
                    <input type="text" name="email" value="<?Php echo $semail ?>" readonly><br><br>
                </span>
                <span>
                    Courses Available : <select name="course" id="sel">
                        <option value="none" disabled selected>Select Course</option>
                        <?Php
                        $cquery = "SELECT * FROM course";
                        $rcquery = mysqli_query($conn, $cquery);
                        foreach ($rcquery as $cdata) {
                            $cname = $cdata['course_n'];
                            $cfees = $cdata['fees'];
                            echo "<option name='opt' id='copt' value='$cname'>$cname</option>";
                        }
                        ?>
                    </select>
                    Fees for the selected Course :<input type="text" name="fees" id="fees" placeholder="Fees">

                </span>
                <button type="submit" name="payment" class="btn btn-outline-light mt-3 ">Proceed to payment</button>
                <?Php



                ?>
            </form>
            <script>
                $(document).ready(function () {
                    $('#sel').change(function () {
                        var crs = $('#sel').val();
                        if (crs !== "none") {
                            $.ajax({
                                url: '../Php/log.php',
                                method: 'POST',
                                data: { course: crs },
                                success: function (res) {
                                    $('#fees').val(res);
                                }
                            })

                        }
                    })
                })
            </script>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>

</html>