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
    <button onclick="window.location.href = <?php echo $dashboard_uri; ?>;">Dashboard</button>
    <hr>
    <h3>Edit Username and Email</h3>
    <p>Username: <?php echo $_SESSION['user']->username; ?></p>
    <p>Email: <?php echo $_SESSION['user']->email; ?></p>
    <hr>

    <h3>Edit Password</h3>
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