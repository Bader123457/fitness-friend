<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website 2 - Redirect Button</title>
</head>
<body>
    <h1>Welcome to Website 2</h1>
    <p>Click the button below to go to Website 1:</p>
    <button onclick="window.location.pathname = <?php echo $home_uri; ?>;">Go to Website 1</button>
</body>
</html>