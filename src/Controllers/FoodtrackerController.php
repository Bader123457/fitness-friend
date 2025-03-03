<?php
class FoodtrackerController {

    function index() {
        // Example usage: Get user input from a form (if applicable)
        $food = isset($_GET['food']) ? htmlspecialchars($_GET['food']) : "1 banana";
        $result = FoodtrackerController::trackFoodIntake($food);

        // Display the result in a user-friendly format
        if (isset($result["error"])) {
            echo "<p>Error: {$result["error"]} (HTTP {$result["status"]})</p>";
        } else {
            echo "<h2>Nutrition Facts for: $food</h2>";
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        }
    }
    
    static function trackFoodIntake($query) {
        // Use environment variables for security (set in your server or .env file)
        $env = parse_ini_file(__DIR__ . '/../../config/nutritionix-credentials.env') or exit("Exited Script: Unable to access db-credentials.env file");
        $app_id = getenv("NUTRITIONIX_APP_ID") ?: $env['APP_ID'];  
        $api_key = getenv("NUTRITIONIX_API_KEY") ?: $env['API_KEY'];  

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

}
?>