<?php
// Function to fetch nutrition facts
function trackFoodIntake($query) {
    $app_id = "6162cfda";  
    $api_key = "6e9dec43afa3bf540f5bf0ea6d56cb41"; 

    $url = "https://trackapi.nutritionix.com/v2/natural/nutrients";

    $headers = [
        "Content-Type: application/json",
        "x-app-id: $app_id",
        "x-app-key: $api_key"
    ];

    $data = json_encode(["query" => $query]);

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Handle API errors
    if ($http_code !== 200) {
        return ["error" => "Failed to fetch nutrition data", "status" => $http_code];
    }

    return json_decode($response, true);
}

// Handle user input
$result = null;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['food'])) {
    $food = trim(htmlspecialchars($_POST['food']));
    $result = trackFoodIntake($food);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Nutrition Tracker</title>
</head>
<body>
    <h2>Enter Food to See Nutrition Facts</h2>
    <form method="POST">
        <input type="text" name="food" placeholder="e.g., 1 banana, 2 eggs" required>
        <button type="submit">Get Nutrition Facts</button>
    </form>

    <?php if (!empty($result) && !isset($result["error"])): ?>
        <h3>Nutrition Facts for: <?= htmlspecialchars($food) ?></h3>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Food Item</th>
                <th>Calories</th>
                <th>Protein (g)</th>
                <th>Fats (g)</th>
                <th>Carbs (g)</th>
            </tr>
            <?php foreach ($result["foods"] as $foodItem): ?>
                <tr>
                    <td><?= htmlspecialchars($foodItem["food_name"]) ?></td>
                    <td><?= $foodItem["nf_calories"] ?></td>
                    <td><?= $foodItem["nf_protein"] ?></td>
                    <td><?= $foodItem["nf_total_fat"] ?></td>
                    <td><?= $foodItem["nf_total_carbohydrate"] ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (!empty($result["error"])): ?>
        <p style="color: red;">Error: <?= $result["error"] ?> (HTTP <?= $result["status"] ?>)</p>
    <?php endif; ?>
</body>
</html>