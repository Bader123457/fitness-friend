<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - FitnessBro </title>
    <style>
        body {
            font-family: Arial, sans-serif;

            background-image: url('/assets/imgs/gymphoto2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            display: flex;

            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #121212;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.0.5);
            width: 350px;
            text-align: center;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #f5c518;
        }

        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #444;
            background-color: #1a1a1a;
            color: white;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s;

        }
        input[type=text]:focus, 
        input[type=email]:focus, 
        input[type=password]:focus {
            border-color: #f5c518;
            box-shadow: 0 0 15px rgba(245, 197, 24, 0.5);
        }

        label {
            color: #f5c518;
        }

        button {
            background-color: #f5c518;
            color: #000000;
            border: none;
            padding: 12px;
            margin-top: 10px;
            width: 100%;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s;
            font-size: 16px;
        }
        button:hover {
            background-color:#d4a316;
        }
 
        .sign-up {
            margin-top: 10px;
        }
        .sign-up a{
            color: #f5c518;
            text-decoration: none;
        }
        .sign-up a:hover {
            text-decoration: underline;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0); 
            }
        }

        .page-animation {
            animation: fadeIn 0.4s ease-out
        }
    </style>
</head>
<body>

<div class="container page-animation">
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