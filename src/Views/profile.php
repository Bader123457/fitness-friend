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
        <input type="text" id='new_uname' placeholder='Enter New Username' value=<?php echo '\'' . $_SESSION['user']->username . '\''; ?> name="new_uname" required>
        <br>
        <button type="submit">Change Username</button>
    </form>
    <hr>

    <h3>Email</h3>
    <p>Email: <?php echo $_SESSION['user']->email; ?></p>
    <hr>

    <h3>Edit Password</h3>
    <?php if ($enable_error_display === "p") {include_once __DIR__ . '/error_msg_template.php';}?>
    <?php if ($enable_success_display === "p") {include_once __DIR__ . '/success_msg_template.php';}?>
    <form action=<?php echo $change_password_uri; ?>; method="POST">
        <label for="old_psw"><b>Old Password</b></label>
        <input type="password" id='old_psw' placeholder="Enter Old Password" name="old_psw" required>
        <br>

        <label for="new_psw"><b>New Password</b></label>
        <input type="password" id='new_psw' placeholder="Enter New Password" name="new_psw" required>
        <br>

        <label for="conf_psw"><b>Confirm Password</b></label>
        <input type="password" id="conf_psw" placeholder="Confirm New Password" name="conf_psw" required>
        <br>
        &nbsp; <br>

        <button type="submit">Change Password</button>
    </form>
    <hr>

    <h3>Edit Personal Information</h3>
    <?php if ($enable_error_display === "i") {include_once __DIR__ . '/error_msg_template.php';}?>
    <?php if ($enable_success_display === "i") {include_once __DIR__ . '/success_msg_template.php';}?>

    <form action=<?php echo $change_personal_information_uri; ?>; method="POST">
        <label for="first_name"><b>First Name</b></label>
        <input type="text" id="first_name" placeholder="Enter First Name" value=<?php echo '\'' . $_SESSION['user']->first_name . '\'' ?> name="first_name" required>
        <br>

        <label for="last_name"><b>Last Name</b></label>
        <input type="text" id='last_name' placeholder="Enter Last Name" value=<?php echo '\'' . $_SESSION['user']->last_name . '\'' ?> name="last_name" required>
        <br>

        <label for="dob"><b>Date of Birth</b></label>
        <input type="date" id="dob" value=<?php echo '\'' . $_SESSION['user']->dob . '\'';?> name="dob">
        <br>

        <label for="gender"><b>Gender</b></label>
        <select name="gender" id="gender">
            <option value="MALE" <?php if ($_SESSION['user']->gender == "MALE") echo "selected='selected'";?>>Male</option>
            <option value="FEMALE" <?php if ($_SESSION['user']->gender == "FEMALE") echo "selected='selected'";?>>Female</option>
            <option value="OTHER" <?php if ($_SESSION['user']->gender == "OTHER") echo "selected='selected'";?>>Others</option>
            <option value="PNTS" <?php if ($_SESSION['user']->gender == "PNTS") echo "selected='selected'";?>>Prefer Not To Say</option>
        </select>
        <br>

        <label for="height"><b>Height</b></label>
        <input type="number" id='height' min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->height . '\''; ?> name="height" required>cm
        <br>

        <label for="weight"><b>Weight</b></label>
        <input type="number" id='weight' min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->weight . '\''; ?> name="weight" required>kg
        <br>

        <label for="bfp"><b>Body Fat Percentage</b></label>
        <input type="number" id='bfp' min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->body_fat_percent . '\''; ?> name="bfp" required>%
        <br>

        <label for="activity"><b>Activity Level</b></label>
        <select name="activity" id="activity">
            <option value="SED" <?php if ($_SESSION['user']->activity_level == "SED") echo "selected='selected'";?>>Sedentary</option>
            <option value="LIGHT" <?php if ($_SESSION['user']->activity_level == "LIGHT") echo "selected='selected'";?>>Light Activity</option>
            <option value="MEDIUM" <?php if ($_SESSION['user']->activity_level == "MEDIUM") echo "selected='selected'";?>>Medium Activity</option>
            <option value="HEAVY" <?php if ($_SESSION['user']->activity_level == "HEAVY") echo "selected='selected'";?>>High Activity</option>
            <option value="ATHL" <?php if ($_SESSION['user']->activity_level == "ATHL") echo "selected='selected'";?>>Athlete</option>
        </select>
        <br>

        <label for="weight_preference"><b>Weight Preference</b></label>
        <select name="weight_preference" id="weight_preference">
            <option value="XLOSE" <?php if ($_SESSION['user']->weight_preference == "XLOSE") echo "selected='selected'";?>>Intensive Weight Loss</option>
            <option value="LOSE" <?php if ($_SESSION['user']->weight_preference == "LOSE") echo "selected='selected'";?>>Lose Weight</option>
            <option value="MNTN" <?php if ($_SESSION['user']->weight_preference == "MNTN") echo "selected='selected'";?>>Maintain Weight</option>
            <option value="GAIN" <?php if ($_SESSION['user']->weight_preference == "GAIN") echo "selected='selected'";?>>Gain Weight</option>
            <option value="XGAIN" <?php if ($_SESSION['user']->weight_preference == "XGAIN") echo "selected='selected'";?>>Intensive Weight Gain</option>
        </select>
        <br>

        &nbsp; <br>
        <button type="submit">Change Personal Information</button>
    </form>
</body>
</html>