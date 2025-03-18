<?php
// Function to fetch nutrition facts
function trackFoodIntake($query) {
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

    <form>
        <input type="date" id="date_selector">
        <select name="entry_type" id="entry_type_selector">
            <option value="brk">Breakfast</option>
            <option value="lnc">Lunch</option>
            <option value="dnr">Dinner</option>
            <option value="snk">Snak</option>
        </select>
    </form>

    <h2>Enter Food to See Nutrition Facts</h2>
    <form method="POST" id="entry_form">
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
                <th></th>
            </tr>
            <?php foreach ($result["foods"] as $foodItem): ?>
                <tr>
                    <td><?= htmlspecialchars($foodItem["serving_weight_grams"] . "g of " . $foodItem["food_name"]) ?></td>
                    <td><?= $foodItem["nf_calories"] ?></td>
                    <td><?= $foodItem["nf_protein"] ?></td>
                    <td><?= $foodItem["nf_total_fat"] ?></td>
                    <td><?= $foodItem["nf_total_carbohydrate"] ?></td>
                    <td><button onclick="transfer_food_item(this)">+</button></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php elseif (!empty($result["error"])): ?>
        <p style="color: red;">Error: <?= $result["error"] ?> (HTTP <?= $result["status"] ?>)</p>
    <?php endif; ?>
    <br>
    <h3>Your Food:</h3>
    <table border="1" cellpadding="5" cellspacing="0" id="eaten_table">
            <tr>
                <th>Food Item</th>
                <th>Calories (cal)</th>
                <th>Protein (g)</th>
                <th>Fats (g)</th>
                <th>Carbs (g)</th>
                <th></th>
            </tr>
            <tr id="total_row">
                <td>Total</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    </table>
    <br>
    <span style="display: none;" id="loading">loading...</span>

    <table style="display: none;" id="template_row_table">
    <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    </table>

</body>
<footer>
    <script src="../../assets/js/cookies.js"></script>
    <script>
        let entry_type_selector = document.getElementById("entry_type_selector");
        entry_type_selector.addEventListener("change", get_entry);

        let date_selector = document.getElementById("date_selector");
        date_selector.addEventListener("change", get_entry);

        let eaten_table = document.getElementById("eaten_table");
        let total_row = document.getElementById("total_row");

        let template_row = document.getElementById("template_row_table").children[0].children[0];
        let loading = document.getElementById("loading");

        if(getCookie("food_date") === null) {
            date_selector.valueAsDate = new Date();
        } else {
            date_selector.value = getCookie("food_date")
        }

        if(getCookie("food_entry_type") !== null) {
            entry_type_selector.value = getCookie("food_entry_type")
        }

        get_entry();

        function get_entry() {
            while(total_row.parentNode.children.length > 2) {
                total_row.previousElementSibling.remove();
            }
            loading.style.display = "block";
            
            url = "foodtracker/get_entry";

            setCookie("food_date", date_selector.value, 0.1);
            setCookie("food_entry_type", entry_type_selector.value, 0.1)

            fetch(url, {
                method: "POST", // or 'POST' if sending data
                headers: {
                    "Content-Type": 'application/json',
                },
                body: JSON.stringify({"Date": date_selector.value, "Type": entry_type_selector.value})  // Convert the object to a JSON string  
            })
                .then(entry => entry.json())
                .then(data => display_entry(data))
                .then(err => console.log("There was an error loading this food entry"));
        }

        function save_entry() {
            url = "foodtracker/save_entry";

            queries = [];

            for(let r = 1;r < rows.length - 1; r++) {
                queries.push(rows[r].children[0].innerHTML);
            }

            fetch(url, {
                method: "POST", // or 'POST' if sending data
                headers: {
                    "Content-Type": 'application/json',
                },
                body: JSON.stringify({"Date": date_selector.value, "Type": entry_type_selector.value, "Queries": queries})  // Convert the object to a JSON string  
            })
                .then(entry => entry.json())
                .then(data => console.log(data))
                .then(err => console.log("There was an error saving this food entry"));
        }

        function display_entry(data) {
            loading.style.display = "none";
            console.log(data);
            console.log(template_row);
            table_body = eaten_table.children[0];
            for(food of data) {
                clone = template_row.cloneNode(true);
                clone.children[0].innerHTML = food["query"];
                food_data = food["data"];
                clone.children[1].innerHTML = food_data["nf_calories"];
                clone.children[2].innerHTML = food_data["nf_protein"];
                clone.children[3].innerHTML = food_data["nf_total_fat"];
                clone.children[4].innerHTML = food_data["nf_total_carbohydrate"];

                button = document.createElement("button");
                button.innerHTML = "-";
                button.onclick = (event) => {
                    event.target.parentNode.parentNode.remove();
                    calculate_totals();
                    save_entry();
                };
                clone.children[5].appendChild(button)
                total_row.parentNode.insertBefore(clone, total_row);
            }
            calculate_totals();
        }

        function transfer_food_item(button) {
            item = button.parentNode;
            row = item.parentNode;
            row_clone = row.cloneNode(true);
            clone_button = row_clone.children[5].children[0];
            clone_button.innerHTML = "-";
            clone_button.onclick = (event) => {
                event.target.parentNode.parentNode.remove();
                calculate_totals();
                save_entry();
            };
            total_row.parentNode.insertBefore(row_clone, total_row);
            calculate_totals();
            save_entry();
        }

        function calculate_totals() {
            table_body = eaten_table.children[0];
            rows = table_body.children;
            total_children = total_row.children;

            for(let i = 1;i < 5; i++) {
                total = 0;
                for(let r = 1;r < rows.length - 1; r++) {
                    total += parseFloat(rows[r].children[i].innerHTML);
                }
                total_children[i].innerHTML = total.toFixed(2);
            }
        }
    </script>
</footer>
</html>