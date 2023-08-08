<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        * {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        }

        #wrapper {
            width: 100dvw;
            height: 100dvh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        #wrapper>form {
            display: flex;
            flex-direction: column;
            padding: 100px;
            border: 4px solid black;
            border-radius: 20px;
            background-color: #eeeeee;
        }

        #wrapper>form>input {
            padding: 5px;
            margin: 10px;
        }

        #reg_btn {
            background-color: black;
            color: white;
            border-radius: 10px;
            font-size: 1rem;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div id="wrapper">
        <h2>Sign up Form</h2>
        <form action="log.php" method="Post">
            <label>Enter Your Name</label>
            <input type="text" name="sname">
            <label>Enter Roll no</label>
            <input type="text" name="sroll">
            <label>Enter Your Email</label>
            <input type="email" name="semail">
            <label>Set A Password</label>
            <input type="text" name="password">
            <input type="submit" name="reg_btn" id="reg_btn">
            <h5>Already Have An Account? <a href="login.php" style="font-size: 1.2rem;"> Login</a></h5>
        </form>
    </div>
</body>

</html>