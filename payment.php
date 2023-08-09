<?php
session_start();
include 'conn.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        #pform {
            border: 3px solid black;
            border-radius: 1.5rem;
            box-shadow: 3px 3px 17px black;
        }
    </style>
</head>

<body>
    <div class="h-100 w-100 d-flex flex-column justify-content-center align-items-center p-4">
        <h1>Payment Details</h1>
        <form action="log.php" method="Post" class="m-5 p-5 d-flex flex-column" id="pform">
            <?php
            $chq_query = "SELECT * FROM enrolled_student WHERE roll='$_SESSION[roll]'";
            $rquery = mysqli_query($conn, $chq_query);
            while ($pdata = mysqli_fetch_assoc($rquery)) {
                echo <<<paydata
                       <span>Name : <input name="name" type="text" value="$pdata[name]" readonly><br><br></span>
                        <span>Course : <input name="course" type="text" value="$pdata[course]" readonly ><br><br></span>
                       <span>Total Fees : <input name="fees" type="text" id="tfees" value="$pdata[total_fee]" readonly></span>
                  paydata;
            }
            ?>
            <br>
            <span>
                Amount :<input type="text" class="m-2" placeholder="Enter the amount" id="amount" name="paidfee">
            </span>
            <small class="text-danger">Minimum 10k should be paid initially</small>
            <label id="warn" class="text-danger"></label>
            <br>
            <span>
                Pending Amount :<input type="text" id="pamount" class="m-2" placeholder="" name="remfee">
            </span>
            <button class="btn bg-dark text-white mt-3" id="hbtn" name="txn_btn">Confirm Payment</button>
        </form>
        <?php
        $chq_query = "SELECT rem_fee FROM enrolled_student WHERE roll='$_SESSION[roll]'";
        $rquery = mysqli_query($conn, $chq_query);
        foreach ($rquery as $fee) {
            echo "<input type='text' value='$fee[rem_fee]' id='remfee' style='display:none'>";
        }
        ?>
        <script>

            var pend = document.getElementById("amount");
            var main = document.getElementById("remfee");
            var pam = document.getElementById("pamount")
            var sm = document.getElementById("warn");
            pend.addEventListener("input", function (e) {
                if (parseInt(e.target.value) > parseInt(main.value)) {
                    sm.innerHTML = "You can't Pay more than " + main.value;

                    document.getElementById("hbtn").disabled = true;
                }
                else {
                    document.getElementById("hbtn").disabled = false;

                    sm.innerHTML = "";
                }
                var otp = ((main.value) - (e.target.value));
                pam.value = otp;
            })

        </script>
    </div>
</body>

</html>