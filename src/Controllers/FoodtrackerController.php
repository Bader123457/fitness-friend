<?php

require_once __DIR__ . "/../Models/user-class.php";
require_once __DIR__ ."/../Models/db-llf.php";
class FoodtrackerController {

    function index() {
        require_once __DIR__ . '/../Views/foodtracker.php';
    }
    function old_index() {
        // Example usage: Get user input from a form (if applicable)
        $food = isset($_GET['food']) ? htmlspecialchars($_GET['food']) : "1 banana";
        $result = FoodtrackerController::trackFoodIntake($food);

        // Display the result in a user-friendly format
        if (isset($result["error"])) {
            echo "<p>Error: {$result["error"]} (HTTP {$result["status"]})</p>";
        } else {
            echo "<h2>Nutrition Facts for: $food</h2>";
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

    function get_entry() {
        session_start();

        $user_id = $_SESSION["user"]->user_id;

        $input = file_get_contents('php://input');

        // Decode the JSON data
        $data = json_decode($input, true); // The `true` parameter converts it to an associative array

        // Now, you can access the data
        if ($data) {
            $date = $data['Date'];
            $type = $data['Type'];
        } else {
            echo json_encode(["error" => "Invalid JSON data"]);
        }
        
        $entry_id = DBConnection::read("SELECT food_entry_id FROM food_entries WHERE user_id = :user_id AND entry_type = :entry_type AND date = :date", [$user_id, $type, $date], [":user_id", ":entry_type", ":date"]);
        $queries = DBConnection::readMany("SELECT query FROM food_entry_items WHERE food_entry_id = :food_entry_id", [$entry_id[0]], [":food_entry_id"]);
        if($queries === False) {
            return;
        }

        $queriesWithData = [];
        foreach($queries as $query) {
            $data = FoodtrackerController::trackFoodIntake($query["query"]);
            array_push($queriesWithData, array("query"=>$query["query"], "data"=>array_intersect_key($data["foods"][0], array_flip(["nf_calories","nf_protein","nf_total_fat","nf_total_carbohydrate"]))));
        }

        echo json_encode($queriesWithData);
    }

    function save_entry() {
        session_start();

        $input = file_get_contents('php://input');

        // Decode the JSON data
        $data = json_decode($input, true); // The `true` parameter converts it to an associative array

        // Now, you can access the data
        if ($data) {
            $date = $data['Date'];
            $type = $data['Type'];
            $queries = $data['Queries'];
            print_r($queries);
        } else {
            echo json_encode(["error" => "Invalid JSON data"]);
        }

        $queriesWithID = [];
        foreach($queries as $query) {
            do {
                $queryID = random_int(10000000, 99999999);
            } while (DBConnection::read("SELECT food_entry_item_id FROM food_entry_items WHERE food_entry_item_id = :entry_id", [$queryID], [":entry_id"]) !== False);
            array_push($queriesWithID, array("id"=>$queryID, "query"=>$query));
        }


        $id = DBConnection::read("SELECT food_entry_id FROM food_entries WHERE user_id = :user_id AND entry_type = :entry_type", [$_SESSION["user"]->user_id, $type], [":user_id", ":entry_type"]);
        if ($id !== False) {
            $id = $id[0];
            $itemIDs = DBConnection::readMany("SELECT food_entry_item_id FROM food_entry_items WHERE food_entry_id = :id", [$id], [":id"]);
            foreach($itemIDs as $itemID) {
                DBConnection::delete("DELETE FROM food_entry_items WHERE food_entry_item_id = " . $itemID[0]);
            }
        } else {
            do {
                $id = random_int(10000000, 99999999);
            } while (DBConnection::read("SELECT food_entry_id FROM food_entries WHERE food_entry_id = :entry_id", [$id], [":entry_id"]) !== False);
            DBConnection::create("INSERT INTO food_entries (food_entry_id, user_id, entry_type, date) VALUES (:food_entry_id, :user_id, :entry_type, :date)", [$id, $_SESSION["user"]->user_id, $type, $date], [":food_entry_id", ":user_id", ":entry_type", ":date"]);
        }

        foreach($queriesWithID as $query) {
            DBConnection::create("INSERT INTO food_entry_items (food_entry_item_id, food_entry_id, query) VALUES (:food_entry_item_id, :food_entry_id, :query)", [$query["id"], $id, $query["query"]], [":food_entry_item_id", ":food_entry_id", ":query"]);
        }

        
    }
}
?>