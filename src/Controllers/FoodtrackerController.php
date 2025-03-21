<?php

require_once __DIR__ . "/../Models/user-class.php";
require_once __DIR__ ."/../Models/db-llf.php";
class FoodtrackerController {
    public $appendUri = '';
    function index() {
        // Include class
        require_once __DIR__ . '/../Models/user-class.php';

        // Get session
        session_set_cookie_params([
            'lifetime' => 86400, // 1 day
            'secure' => true,   // Only send over HTTPS
            'httponly' => true,  // Prevent JavaScript access
            'samesite' => 'Strict' // Prevent CSRF attacks
        ]);
        session_start();

        // Create link
        $dashboard_uri = $this->appendUri . '/dashboard';
        $logout_uri = '\''. $this->appendUri . '/login/logout'. '\'';
        $profile_uri = '\''. $this->appendUri . '/profile'. '\'';
        $calorie_uri = '\'' . $this->appendUri . '/calorie' . '\'';
        $workout_uri = '\'' . $this->appendUri . '/workout' . '\'';

        // Check if login session already exists
        if (isset($_SESSION['user']) && $_SESSION['logged_in'] === true) {
            // Refresh user information
            $_SESSION['user'] = User::getUser(user_id: $_SESSION['user']->user_id);

            $welcome_display = $_SESSION['user']->username;
            require_once __DIR__ . '/../Views/foodtracker.php';
        } else {
            header('Location: '. $dashboard_uri);
            die();
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

    public static function displayMealPlan() {
        try {

        } catch (Exception $e) {

        }
        $gender = $_SESSION['user']->gender;
        $goal = $_SESSION['user']->weight_preference;

        $GENDERS = ["MALE"=>'Male', "FEMALE"=>'Female', "OTHER"=>'Other', "PNTS"=>'Prefer Not To Say']; 
        $WEIGHT_PREFERENCES = ["XLOSE"=>'Intensive Weight Loss', "LOSE"=>'Weight Loss', "MNTN"=>'Weight Maintain', "GAIN"=>'Weight Gain', "XGAIN"=>'Intensive Weight Gain'];

        $gender_display = $GENDERS[$gender];
        $goal_display = $WEIGHT_PREFERENCES[$goal];

        echo "<h2>Sample Meal Plan for " . ucfirst($gender_display) . " - " . ucfirst($goal_display) . "</h2>";
        echo "<p>Use the below meal plan as a template for how your own meal plan should look like. This is not medical advice.</p>";
        if ($gender == 'OTHER' or $gender == 'PNTS') {
            echo "<p style='color:red;'>We only have sample meal plans for male and female. The plan below are designed for males. Please choose your sex assigned as birth as your gender or ask a doctor if your current gender does not fit within male or female.</p>";
        }
        if ($goal == 'XLOSE' or $goal == 'XGAIN') {
            echo "<p style='color:red;'>Follow the meal plan for " . $goal_display . " at your own risk. We do not provide medical advice. Please consult a doctor before pursuing any intensive diets.</p>";
        }

        if (($gender == "MALE" or $gender == 'OTHER' or $gender == 'PNTS') && $goal == "MNTN") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>Oatmeal with Banana & Peanut Butter</li>
                <li>2 Boiled Eggs</li>
                <li>Black Coffee or Green Tea</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Grilled Chicken Wrap</li>
                <li>Greek Yogurt with Honey & Nuts</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Salmon with Quinoa & Roasted Vegetables</li>
                <li>Dark Chocolate (85%) Square</li>
            </ul>";
        } 
        elseif (($gender == "MALE" or $gender == 'OTHER' or $gender == 'PNTS') && $goal == "GAIN") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>High-Protein Banana Pancakes</li>
                <li>Greek Yogurt with Nuts & Berries</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Grilled Chicken Rice Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Salmon with Quinoa & Roasted Vegetables</li>
            </ul>";
        } 
        elseif (($gender == "MALE" or $gender == 'OTHER' or $gender == 'PNTS') && $goal == "XGAIN") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>High-Calorie Protein Oatmeal Bowl</li>
                <li>3 Scrambled Eggs with Cheese</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Chicken & Sweet Potato Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Salmon with Brown Rice & Vegetables</li>
            </ul>";
        } 
        elseif (($gender == "MALE" or $gender == 'OTHER' or $gender == 'PNTS') && $goal == "LOSE") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>Protein Oatmeal with Fruits</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Grilled Chicken & Brown Rice Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Salmon with Sweet Potato & Spinach</li>
            </ul>";
        } 
        elseif (($gender == "MALE" or $gender == 'OTHER' or $gender == 'PNTS') && $goal == "XLOSE") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>High-Protein Banana Oatmeal</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Grilled Chicken & Sweet Potato Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Salmon with Brown Rice & Vegetables</li>
            </ul>";
        } 
        elseif ($gender == "FEMALE" && $goal == "MNTN") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>Greek Yogurt & Granola Bowl</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Turkey & Quinoa Power Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Grilled Salmon with Sweet Potato & Green Beans</li>
            </ul>";
        } 
        elseif ($gender == "FEMALE" && $goal == "GAIN") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>High-Protein Oatmeal Bowl</li>
                <li>2 Boiled Eggs</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Grilled Chicken & Brown Rice Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Salmon with Quinoa & Roasted Vegetables</li>
            </ul>";
        } 
        elseif ($gender == "FEMALE" && $goal == "XGAIN") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>Protein-Packed Oatmeal Bowl</li>
                <li>3 Scrambled Eggs with Cheese</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Chicken & Sweet Potato Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Salmon with Brown Rice & Vegetables</li>
            </ul>";
        } 
        elseif ($gender == "FEMALE" && $goal == "LOSE") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>Scrambled Eggs with Whole Wheat Toast & Avocado</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Grilled Chicken & Brown Rice Bowl</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Baked Salmon with Quinoa & Roasted Vegetables</li>
            </ul>";
        } 
        elseif ($gender == "FEMALE" && $goal == "XLOSE") {
            echo "<h3>Breakfast</h3>
            <ul>
                <li>Greek Yogurt with Berries & Honey</li>
            </ul>";

            echo "<h3>Lunch</h3>
            <ul>
                <li>Grilled Chicken & Quinoa Salad</li>
            </ul>";

            echo "<h3>Dinner</h3>
            <ul>
                <li>Scrambled Egg & Whole Wheat Toast</li>
            </ul>";
        } else {
            echo "<p>No meal plan available for the selected gender and goal.</p>";
        }
    }
}
?>