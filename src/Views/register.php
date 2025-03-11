<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - FitnessBro</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #4a2900, #b88929);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            width: 350px;
        }
        input[type=text], input[type=email], input[type=password] {
            width: 95%;
            padding: 10px;
            margin: 5px 0 15px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: all 0.3s;
        }
        input[type=text]:focus, 
        input[type=email]:focus, 
        input[type=password]:focus {
            border-color: #4CAF50;
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
            outline: none;
        }
        button[type=button] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            margin-top: 6px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        button:hover {
            background-color: #388e3c;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .sign-up {
            margin-top: 10px;
        }
        .sign-up a{
            text-decoration: none;
        }
        .sign-up a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register</h2>
    <?php if ($error_display === True) {include_once __DIR__ . '/error_msg_template.php';}?>
    <form action=<?php echo $validate_uri; ?> method="POST">
        <label for="username">Username</label>
        <input type="text" name="uname" id="username" required>

        <label for="email">Email</label>
        <input type="email" name="email" id="email" required>   

        <label for="password">Password</label>
        <input type="password" name="psw" id="password" required>

        <label for="confirm_password">Confirm Password</label>
        <input type="password" name="cnfm-psw" id="confirm_password" required>

        <button type="submit">Register</button>

        <button type="button" onclick = "window.location.href = <?php echo $home_uri; ?>;">Back</button>
        <div class="sign-up">
            <a href= <?php echo $login_uri; ?>>Have an account? Log In</a>
        </div>
    </form>
</div>

</body>
</html>