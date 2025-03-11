<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FitnessBro - Profile Page</title>
</head>
<body>
    <h1>Profile Page</h1>
    <p>Waiting for frontend html</p>
    <?php if ($enable_error_display === "g") {include_once __DIR__ . '/error_msg_template.php';}?>
    <?php if ($enable_success_display === "g") {include_once __DIR__ . '/success_msg_template.php';}?>
    <button onclick="window.location.href = <?php echo $dashboard_uri; ?>;">Dashboard</button>
    <hr>
    <h3>Edit Username</h3>
    <?php if ($enable_error_display === "u") {include_once __DIR__ . '/error_msg_template.php';}?>
    <?php if ($enable_success_display === "u") {include_once __DIR__ . '/success_msg_template.php';}?>
    <form action=<?php echo $change_username_uri; ?>; method="POST">
        <label for="new_uname"><b>Username</b></label>
        <input type="text" placeholder='Enter New Username' value=<?php echo '\'' . $_SESSION['user']->username . '\''; ?> name="new_uname" required>
        <br>
        <button type="submit">Change Username</button>
    </form>
    <hr>

    <h3>Edit Email</h3>
    <p>Email: <?php echo $_SESSION['user']->email; ?></p>
    <hr>

    <h3>Edit Password</h3>
    <?php if ($enable_error_display === "p") {include_once __DIR__ . '/error_msg_template.php';}?>
    <?php if ($enable_success_display === "p") {include_once __DIR__ . '/success_msg_template.php';}?>
    <form action=<?php echo $change_password_uri; ?>; method="POST">
        <label for="old_psw"><b>Old Password</b></label>
        <input type="password" placeholder="Enter Old Password" name="old_psw" required>
        <br>

        <label for="new_psw"><b>New Password</b></label>
        <input type="password" placeholder="Enter New Password" name="new_psw" required>
        <br>

        <label for="conf_psw"><b>Confirm Password</b></label>
        <input type="password" placeholder="Confirm New Password" name="conf_psw" required>
        <br>
        &nbsp; <br>

        <button type="submit">Change Password</button>
    </form>
    <hr>

    <h3>Edit Personal Information</h3>
    <p>First Name: <?php echo $_SESSION['user']->first_name; ?></p>   
    <p>Last Name: <?php echo $_SESSION['user']->last_name; ?></p>
    <p>Date of Birth: <?php echo $_SESSION['user']->dob; ?></p>
    <p>Gender: <?php echo $_SESSION['user']->gender; ?></p>
    <p>Height: <?php echo $_SESSION['user']->height; ?></p>
    <p>Weight: <?php echo $_SESSION['user']->weight; ?></p>
    <p>Body Fat Percentage: <?php echo $_SESSION['user']->body_fat_percent; ?></p>
    <p>Activity Level: <?php echo $_SESSION['user']->activity_level; ?></p>
</body>
</html>