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
            padding: 0;
            margin: 0;
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
            margin: 8px;
            border: 4px solid black;
            border-radius: 20px;
            background-color: #eeeeee;
        }

        #wrapper>form>input {
            padding: 5px;
            margin: 10px;
        }

        #logbtn {
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
        <h2>Login Form</h2>
        <form action="log.php" method="Post">

            <label>Enter Your Email</label>
            <input type="email" name="semail">
            <label>Enter Password</label>
            <input type="text" name="password">
            <input type="submit" name="log_btn" id="logbtn">

            <a href="register.php">
                <h5>Create An Account If You Don't Have one</h5>
            </a>
        </form>
    </div>
</body>

</html>