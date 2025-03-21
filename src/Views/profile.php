<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            background-color: #1a1a1a;
            margin: 0;
            padding: 0px;
            color: #fff;
            position: relative;
            overflow-y: auto; /* Enables vertical scrolling */
            overflow-x: hidden;
            height: 100%; /* Ensures the body takes up full viewport height */
        }

        body::before {
            left: 0;
        }
        body::after {
            right: 0;
            transform: scaleX(-1);
        }
        
        .container {
            background: #1e1e1e;
            width: 100%;
            padding: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            margin-left: 15%;
            margin-right: 15%;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(255, 215, 0, 0.6);
            border: 2px solid gold;
            position: relative;
            z-index: 1;
        }
        h2 {
            text-align: center;
            color: gold;
        }
        h3 {
            margin-top: 10px;
            font-weight: bold;
            color: gold;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 10px;
            font-weight: bold;
            color: gold;
        }
        input, select {
            padding: 8px;
            margin-top: 5px;
            border: 1px solid gold;
            border-radius: 4px;
            background: #222;
            color: #fff;
        }
        button {
            margin-top: 15px;
            background: gold;
            color: black;
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 4px;
            font-weight: bold;
        }
        button:hover {
            background: #d4af37;
        }
        .error, .success {
            text-align: center;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
        }
        .error { background: #721c24; color: #f8d7da; }
        .success { background: #155724; color: #d4edda; }
        .message h3 { margin-top: 20px ; margin-bottom: 0px;}
        .sidebar {
            background: #111;
            color: gold;
            padding: 20px;
            width: 30.2%;
            height: 1180px;
        }

        .sidebar h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            padding-left: 60px;
            text-align: left;
            color: gold;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 0;
        }

        .sidebar ul li a {
            color: gold;
            text-decoration: none;
            font-weight: bold;
            font-size: 16px;
            transition: 0.3s;
            display: block;
            padding: 10px;
        }

        .sidebar ul li a:hover {
            background: gold;
            color: black;
            border-radius: 5px;
        }

        .sidebar img{
            display: flex;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <img src="/assets/imgs/Logo.png" alt="FitnessBro Logo">
        <h2> <?php echo $welcome_display; ?></h2>
        <ul>
            <li><a href=<?php echo $dashboard_uri; ?>>Dashboard</a></li>
            <li><a href=<?php echo $calorie_uri; ?>>Calorie Calculator</a></li>
            <li><a href=<?php echo $food_uri; ?>>Meal Plans</a></li>
            <li><a href=<?php echo $workout_uri; ?>>Workout Plans</a></li>
            <li><a href=<?php echo $logout_uri; ?>>Logout</a></li>
        </ul>
    </div>
    <div class="container">

        <h2>Edit Profile</h2>
        
        <div class="message">
            <?php if ($enable_error_display === "g") {include_once __DIR__ . '/error_msg_template.php';}?>
            <?php if ($enable_success_display === "g") {include_once __DIR__ . '/success_msg_template.php';}?>
        </div>

        <h3>Email: <span style="color: white; font-weight: normal;"><?php echo $_SESSION['user']->email; ?></span></h3>
        
        <form action=<?php echo $change_username_uri; ?> method="POST" id="usernameForm">
            <div class="message">
                <?php if ($enable_error_display === "u") {include_once __DIR__ . '/error_msg_template.php';}?>
                <?php if ($enable_success_display === "u") {include_once __DIR__ . '/success_msg_template.php';}?>
            </div>
            <label for="username">Change Username</label>
            <input type="text" placeholder='Enter New Username' value=<?php echo '\'' . $_SESSION['user']->username . '\''; ?> id="username" name="new_uname" required>
            <button type="submit">Change Username</button>
        </form>

        <form action=<?php echo $change_password_uri; ?> method="POST" id="passwordForm">
            <div class="message">
                <?php if ($enable_error_display === "p") {include_once __DIR__ . '/error_msg_template.php';}?>
                <?php if ($enable_success_display === "p") {include_once __DIR__ . '/success_msg_template.php';}?>
            </div>
            <label for="oldPassword">Old Password</label>
            <input type="password" placeholder="Enter Old Password" id="oldPassword" name="old_psw" required>
            <label for="newPassword">New Password</label>
            <input type="password" placeholder="Enter New Password" id="newPassword" name="new_psw" required>
            <label for="confirmPassword">Confirm New Password</label>
            <input type="password" placeholder="Confirm New Password" id="confirmPassword" name="conf_psw" required>
            <button type="submit">Change Password</button>
        </form>

        <form action=<?php echo $change_personal_information_uri; ?> method="POST" id="infoForm">
            <div class="message">
                <?php if ($enable_error_display === "i") {include_once __DIR__ . '/error_msg_template.php';}?>
                <?php if ($enable_success_display === "i") {include_once __DIR__ . '/success_msg_template.php';}?>
            </div>
            <label for="firstName">First Name</label>
            <input type="text" placeholder="Enter First Name" value=<?php echo '\'' . $_SESSION['user']->first_name . '\'' ?> id="firstName" name="first_name" required>
            <label for="lastName">Last Name</label>
            <input type="text" placeholder="Enter Last Name" value=<?php echo '\'' . $_SESSION['user']->last_name . '\'' ?> id="lastName" name="last_name" required>
            <label for="dob">Date of Birth</label>
            <input type="date" id="dob" value=<?php echo '\'' . $_SESSION['user']->dob . '\'';?> name="dob">
            <label for="gender">Gender</label>
            <select name="gender" id="gender">
                <option value="MALE" <?php if ($_SESSION['user']->gender == "MALE") echo "selected='selected'";?>>Male</option>
                <option value="FEMALE" <?php if ($_SESSION['user']->gender == "FEMALE") echo "selected='selected'";?>>Female</option>
                <option value="OTHER" <?php if ($_SESSION['user']->gender == "OTHER") echo "selected='selected'";?>>Others</option>
                <option value="PNTS" <?php if ($_SESSION['user']->gender == "PNTS") echo "selected='selected'";?>>Prefer Not To Say</option>
            </select>
            <label for="height">Height (cm)</label>
            <input type="number" id="height" name="height" min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->height . '\''; ?> required>
            <label for="weight">Weight (kg)</label>
            <input type="number" id="weight" name="weight" min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->weight . '\''; ?> required>
            <label for="bfp">Body Fat Percentage (%)</label>
            <input type="number" id="bfp" name="bfp" min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->body_fat_percent . '\''; ?> required>
            <label for="activity">Activity Level</label>
            <select name="activity" id="activity">
                <option value="SED" <?php if ($_SESSION['user']->activity_level == "SED") echo "selected='selected'";?>>Sedentary</option>
                <option value="LIGHT" <?php if ($_SESSION['user']->activity_level == "LIGHT") echo "selected='selected'";?>>Light Activity</option>
                <option value="MEDIUM" <?php if ($_SESSION['user']->activity_level == "MEDIUM") echo "selected='selected'";?>>Medium Activity</option>
                <option value="HEAVY" <?php if ($_SESSION['user']->activity_level == "HEAVY") echo "selected='selected'";?>>High Activity</option>
                <option value="ATHL" <?php if ($_SESSION['user']->activity_level == "ATHL") echo "selected='selected'";?>>Athlete</option>
            </select>
            <label for="weight_preference">Weight Preference</label>
            <select name="weight_preference" id="weight_preference">
                <option value="XLOSE" <?php if ($_SESSION['user']->weight_preference == "XLOSE") echo "selected='selected'";?>>Intensive Weight Loss</option>
                <option value="LOSE" <?php if ($_SESSION['user']->weight_preference == "LOSE") echo "selected='selected'";?>>Lose Weight</option>
                <option value="MNTN" <?php if ($_SESSION['user']->weight_preference == "MNTN") echo "selected='selected'";?>>Maintain Weight</option>
                <option value="GAIN" <?php if ($_SESSION['user']->weight_preference == "GAIN") echo "selected='selected'";?>>Gain Weight</option>
                <option value="XGAIN" <?php if ($_SESSION['user']->weight_preference == "XGAIN") echo "selected='selected'";?>>Intensive Weight Gain</option>
            </select>
            <button type="submit">Update Info</button>
        </form>
    </div>
</body>
</html>
