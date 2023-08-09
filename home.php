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
            background-color: #FBEAEB;
        }

        #main {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #alert_div {
            margin-top: 2rem;
            border-radius: 1rem;
        }

        form {
            border-radius: 1rem;
            margin: 6rem;
            background-color: #2F3C7E;
            padding: 2rem;
            color: #FBEAEB;
        }
    </style>
</head>

<body>

    <div id="main">

        <?php
        if (isset($_SESSION['logged_in'])) {
            ?>
            <div class="alert alert-success alert-dismissible fade show" id="alert_div" role="alert">
                <span class="px-5">
                    <strong><i class="bi bi-check-circle px-2"></i></strong> Logged In Successfully</span>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <?Php
        }
        unset($_SESSION['logged_in']); ?>

        <h1> Course Enrollment Form</h1>
        <form action="" method="Post">
            Roll no : <select name="roll" id="roll_select">
                <option value="Roll" disabled selected>Select your roll no</option>
                <?php
                $query = "SELECT roll FROM student_data";
                $rquery = mysqli_query($conn, $query);
                if (mysqli_num_rows($rquery) > 0) {
                    foreach ($rquery as $result) {
                        ?>
                        <option value='<?Php echo $result['roll'] ?>' name="roll">
                            <?Php echo $result['roll'] ?>
                        </option>
                        <?php
                    }
                } ?>
            </select>
            <input type="submit" name="get_data">
            <?php
            if (isset($_POST['get_data'])) {
                $query = "SELECT * FROM student_data where `roll`=$_POST[roll]";
                $rquery = mysqli_query($conn, $query);
                print_r($rquery);
            }
            ?>
        </form>

    </div>

</body>

</html>