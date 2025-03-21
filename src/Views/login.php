<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitnessBro - Login</title>
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
        .login-container {
            background-color: #121212;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            width: 350px;
            text-align: center;
        }
        .login-container img {
            position: relative;
            left: 4px;
            width: 250px;
            margin-bottom: 10px;
        }
        .login-container h2 {
            color: #f5c518;
            margin-bottom: 30px;
        }
        .login-container h3 {
            color: #f5c518;
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        .login-container label {
            color: #f5c518;
            display: block;
            margin-bottom: 6px;
            text-align: left;
        }
        
        .login-container input[type=text],
        .login-container input[type=password] {
            width: 100%;
            padding: 12px;
            border: 1px solid #444;
            background-color: #1a1a1a;
            color: white;
            border-radius: 5px;
            outline: none;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        .login-container input[type=text]:focus,
        .login-container input[type=password]:focus {
            border-color: #f5c518;
            box-shadow: 0 0 15px rgba(245, 197, 24, 0.5);
        }
        
        .login-container button[type=button] {
            background-color: #f5c518;
            color: #000;
            border: none;
            margin-top: 16px;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }
        
        .login-container button[type=submit] {
            background-color: #f5c518;
            color: #000;
            border: none;
            padding: 12px;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
            margin-bottom: 10px;
        }
        
        .login-container button:hover {
            background-color: #d4a316;
        }
        
        .login-container .forgot-password,
        .login-container .sign-up {
            margin-top: 20px;
            text-align: center;
        }
        
        .login-container a {
            color: #f5c518;
            text-decoration: none;
        }
        
        .login-container a:hover {
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

<div class="login-container page-animation">
    <img src="/assets/imgs/Logo.png" alt="FitnessBro Logo">
    <h2>Login to FitnessBro</h2>
    <?php if ($error_display === True) {include_once __DIR__ . '/error_msg_template.php';}?>
    <?php if ($success_display === True) {include_once __DIR__ . '/success_msg_template.php';}?>
    <form action=<?php echo $validate_uri; ?> method="POST">
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="uname" id="username" placeholder="Enter your username" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="psw" id="password" placeholder="Enter your password" required>
        </div>

        <button type="submit">Login</button>

        <button type="button" onclick="window.location.href = <?php echo $home_uri; ?>;">Back</button>

        <div class="sign-up">
            <a href=<?php echo $register_uri; ?>>Don't have an account? Register now</a>
        </div>
    </form>
</div>

</body>
</html>