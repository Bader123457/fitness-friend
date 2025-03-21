<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Bro - Workout</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#search_compendium").on("submit", function(event) {
                event.preventDefault(); // Prevent form submission

                // Get the value from the input field
                var activityName = $("#activity_search").val();
                var category = $("#category").val();
                var weight = $("#weight").val();
                var time = $("#time").val();

                // Send AJAX request to the server
                $.ajax({
                    url: <?php echo $search_compendium_uri?>,  // Your PHP file handling the request
                    type: "POST",
                    data: { activity_search: activityName, category: category },
                    success: function(response) {
                        // Handle the response (e.g., update the message div)
                        var data = JSON.parse(response);
                        displayTable(data, weight, time);
                    },
                    error: function() {
                        // Handle any errors that might occur
                        $("#message").html("<p>Error occurred while fetching data.</p>");
                    }
                });
            });
        });

        // Function to display data in a table
        function displayTable(data, weight, time) {
            var table = document.getElementById("dataTable");
            var tbody = table.getElementsByTagName("tbody")[0];
            var headerCell = document.querySelector("#dataTable thead tr th:nth-child(6)");
            headerCell.textContent = "Calories burned (" + time + " min)";
            tbody.innerHTML = ""; // Clear existing rows

            // Loop through the first 10 items of the data array
            var maxRows = Math.min(data.length, 10); // Limit to a maximum of 10 rows
            for (var i = 0; i < maxRows; i++) {
                var item = data[i]; // Get the item for this row
                var row = document.createElement("tr");

                var cell1 = document.createElement("td");
                cell1.textContent = item.activity_code;
                row.appendChild(cell1);

                var cell2 = document.createElement("td");
                cell2.textContent = item.category;
                row.appendChild(cell2);

                var cell3 = document.createElement("td");
                cell3.textContent = item.met_value;
                row.appendChild(cell3);

                var cell4 = document.createElement("td");
                cell4.textContent = item.description;
                row.appendChild(cell4);

                var cell5 = document.createElement("td");
                var calories_minute = ((Number(item.met_value) * 3.5 * Number(weight)) / 200).toFixed(1);
                cell5.textContent = calories_minute.toString() + ' kcal';
                row.appendChild(cell5);

                var cell6 = document.createElement("td");
                cell6.textContent = (Number(calories_minute) * Number(time)).toFixed(1).toString() + ' kcal';
                row.appendChild(cell6);

                tbody.appendChild(row);
            }
        }
    </script>
</head>
<body>
    <h2> Physical Exercise Compendium search</h2>
    <form id="search_compendium">
        <label for="category">Category:</label>
        <select name="category" id="category">
            <option value="*" selected="selected">Any</option>
            <option value="Bicycling">Bicycling</option>
            <option value="Dancing">Dancing</option>
            <option value="Inactivity">Inactivity</option>
            <option value="Miscellaneous">Miscellaneous</option>
            <option value="Occupation">Occupation</option>
            <option value="Running">Running</option>
            <option value="Sports">Sports</option>
            <option value="Transportation">Transportation</option>
            <option value="Walking">Walking</option>
        </select>
        <label for="activity_search" >Activity search:</label>
        <input type="text" id="activity_search" name="activity_search" required><br><br>
        <label for="weight">Weight (kg)</label>
        <input type="number" id="weight" name="weight" min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->weight . '\''; ?> required>
        <label for="time">Time (min)</label>
        <input type="number" id="time" name="time" min="0" step="1" value=60 required>
        <input type="submit" value="Search">
    </form>

    <div class="message"></div>
    
    <table id="dataTable" border="1" style="max-width: 60%;">
        <thead>
            <tr>
                <th>Activity Code</th>
                <th>Category</th>
                <th>MET Value</th>
                <th>Description</th>
                <th>Calories burned (per minute)</th>
                <th>Calories burned (time)</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data rows will be inserted here -->
        </tbody>
    </table>

</body>