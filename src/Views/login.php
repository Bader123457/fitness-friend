<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitnessBro - Login</title>
</head>
<body>
    <h1>Login</h1>
    <?php if ($error_display === True) {include_once __DIR__ . '/error_msg_template.php';}?>
    <form action=<?php echo $validate_uri; ?> method="POST">
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>

            <button type="submit">Login</button>

            <label>
            <input type="checkbox" checked="checked" name="remember"> Remember me
            </label>
        </div>

    </form>
    <div class="container" style="background-color:#f1f1f1">
        <button onclick="window.location.href = <?php echo $home_uri; ?>;">Cancel</button>
    </div>
</body>
</html>