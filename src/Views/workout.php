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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #FFD700;
            margin: 0px;
        }
        .content {
            text-align: center;
            margin: 20px;
        }
        .content h2 {
            color: #FFD700;
        }
        form, .button-container {
            background: #222;
            padding: 20px;
            border-radius: 8px;
            display: inline-block;
            margin-top: 20px;
        }
        label, input, select {
            color: #FFD700;
            margin: 5px;
        }
        input, select {
            background: #333;
            border: 1px solid #FFD700;
            padding: 5px;
        }
        input[type="submit"], .btn {
            background: #FFD700;
            color: black;
            font-weight: bold;
            cursor: pointer;
            border: none;
            padding: 10px;
            margin: 5px;
            border-radius: 5px;
        }
        table {
            margin: 20px auto;
            border-collapse: collapse;
            width: 80%;
            background: #222;
        }
        th, td {
            border: 1px solid #FFD700;
            padding: 10px;
            text-align: center;
        }
        th {
            background: #333;
        }
        .workout-table {
            display: none;
            margin-top: 20px;
            width: 80%;
        }

        .sidebar {
            background: #111;
            color: gold;
            padding: 20px;
            max-width: 228px;
            height: 1800px;
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
<body style="display: flex;">
    <div class="sidebar">
        <img src="/assets/imgs/Logo.png" alt="FitnessBro Logo">
        <h2> <?php echo $welcome_display; ?></h2>
        <ul>
            <li><a href=<?php echo $dashboard_uri; ?>>Dashboard</a></li>
            <li><a href=<?php echo $calorie_uri; ?>>Calorie Calculator</a></li>
            <li><a href=<?php echo $food_uri; ?>>Meal Plans</a></li>
            <li><a href=<?php echo $profile_uri; ?>>Profile</a></li>
            <li><a href=<?php echo $logout_uri; ?>>Logout</a></li>
        </ul>
    </div>
    <div class='content' style="display: block;">
    <h2>Physical Exercise Compendium Search</h2>
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
        <label for="activity_search">Activity search:</label>
        <input type="text" id="activity_search" name="activity_search" required><br><br>
        <label for="weight">Weight (kg)</label>
        <input type="number" id="weight" name="weight" min="0" step="1" value=<?php echo '\'' . $_SESSION['user']->weight . '\''; ?> required>
        <label for="time">Time (min)</label>
        <input type="number" id="time" name="time" min="0" step="1" value="60" required>
        <input type="submit" value="Search">
    </form>
    <table id="dataTable">
        <thead>
            <tr>
                <th>Activity Code</th>
                <th>Category</th>
                <th>MET Value</th>
                <th>Description</th>
                <th>Calories burned (per min)</th>
                <th>Calories burned (total)</th>
            </tr>
        </thead>
        <tbody>
            <!-- Data rows will be inserted here -->
        </tbody>
    </table>
    <p style="color: rgb(193, 20, 20); font-weight: bold;">Disclaimer: Always consult a professional before starting any workout program. We are not responsible for any injury that occurs when following the plan below.</p>
    <h2>Choose the weekly plan that you are interested in.</h2>
    <div class="button-container">
        <button class="btn" onclick="showWorkout('2-day')">2 Day Plan</button>
        <button class="btn" onclick="showWorkout('3-day')">3 Day Plan</button>
        <button class="btn" onclick="showWorkout('5-day')">5 Day Plan</button>
    </div>

    <table id="workout-table" class="workout-table">
        <thead>
            <tr>
                <th>Day</th>
                <th>Muscle Focus</th>
                <th>Exercises</th>
                <th>Sets x Reps</th>
            </tr>
        </thead>
        <tbody id="workout-body">
        </tbody>
    </table>
    </div>
    

    <script>
        const exerciseLinks = {
            "Pull-ups": "https://youtube.com/shorts/dvG8B2OjfWk?si=vf5KWdcpCGidueYj",
            "Incline SM Press": "https://youtube.com/shorts/lYoSmkd-vOQ?si=OVJbA8xuSDrgP5fD",
            "SM Rows": "https://www.youtube.com/watch?v=6mR1nIVPd5I",
            "DB Shoulder Press": "https://youtube.com/shorts/OLePvpxQEGk?si=du68NAZUpO3bpHGe",
            "Leg Press": "https://www.youtube.com/watch?v=IZxyjW7MPJQ",
            "Hip Thrusts": "https://www.youtube.com/watch?v=G3HxeBO2Rzg",
            "Bulgarian Split Squats": "https://youtube.com/shorts/uODWo4YqbT8?si=3kDntCeSd0IfOJb0",
            "Calf Raises": "https://youtube.com/shorts/xK6DoHBXTdw?si=zIDKZnr6izrcZNFb",
            "Bench Press": "https://www.youtube.com/watch?v=rT7DgCr-3pg",
            "Lateral Raises": "https://youtube.com/shorts/Kl3LEzQ5Zqs?si=VmKXmNCqspxC1afY",
            "DB Row": "https://www.youtube.com/watch?v=roCP6wCXPqo",
            "Lat Pulldown": "https://youtube.com/shorts/5s6KGLTMgoI?si=BMVsouZMN_DNbTxj",
            "Squats": "https://youtube.com/shorts/MLoZuAkIyZI?si=n91K6umKGQ-Lg-nD",
            "Romanian Deadlifts": "https://www.youtube.com/watch?v=R7jscG9s3fU",
            "Leg Extensions": "https://youtube.com/shorts/d3d2yz7V26c?si=rYFI7WE0Kia_0lMB",
            "Incline Smith": "https://www.youtube.com/watch?v=GY1xfTWSvys",
            "Tricep Pushdown": "https://youtube.com/shorts/u36jNfqh8_U?si=4XJp6yakAs9KPLWy",
            "Barbell Row": "https://youtube.com/shorts/Nqh7q3zDCoQ?si=JOgVOFz5p4kOYApw",
            "Seated Leg Curl": "https://www.youtube.com/watch?v=1Tq3QdYUuHs",
            "Cable Row": "https://youtube.com/shorts/vqPY3fDessY?si=S34JgeO4Ra1tphv0",
            "Bicep Curl": "https://youtube.com/shorts/UXJNuq6zWLs?si=QUc0j5rwT1N0QG-B"
        };

        const workoutPlans = {
            "3-day": [
                ["Monday", "Push", "Barbell Bench Press, Incline DB Press, DB Lateral Raise, Overhead Rope Ext., Single Arm Cable Pushdown", "3x6, 2x10, 2x10, 2x to failure, 2x to failure"],
                ["Tuesday", "Pull", "Single Arm Lat Pulldown, DB Row, Lat Prayers, Incline DB Curls, Crossbody Hammer Curls", "2x15, 3x10, 2x to failure, 2x to failure, 3x10"],
                ["Wednesday", "Legs", "Seated Leg Curl, Leg Extension, Squats, Romanian Deadlifts", "2x15, 1x15, 2x to failure, 4x6, 3x10"],
                ["Thursday", "Rest", "-", "-"]
            ],
            "2-day": [
                ["Friday", "Upper", "Pull-ups, Incline SM Press, SM Rows, DB Shoulder Press, Pec Deck, Bicep Curl, Tricep Pushdown", "3x10, 3x8, 3x8, 3x10, 2x10, 3x10, 3x10"],
                ["Saturday", "Lower", "Leg Press (Quads), Hip Thrusts, Bulgarian Split Squats, Calf Raises, Ab Rope Crunches", "2x to failure, 3x10, 2x15, 4x15, 4x30"],
                ["Sunday", "Rest", "-", "-"]
            ],
            "5-day": [
                ["Monday", "Push", "Incline Smith, DB Shoulder Press, Cable Lateral Raise, High to Low Cable Fly, Tricep Pushdown", "3x6, 3x10, 3x10, 2x to failure, 3x10"],
                ["Tuesday", "Pull", "Pull-ups, Lat Pulldown, Barbell Row, Cable Row, Incline Bicep Curl", "3x10, 2x to failure, 3x8, 2x to failure, 2x to failure"],
                ["Wednesday", "Legs + Abs", "Seated Leg Curl, Pendulum or Hack Squat, Leg Extension, Bulgarian Split Squats, Calf Raises", "2x15, 3x6-8, 2x15, 3x10, 4x15"],
                ["Thursday", "Rest", "-", "-"],
                ["Friday", "Chest + Back", "Incline DB Press Superset Chest Supported Row, Pec Deck Superset Reverse Pec Deck, Machine Chest Press", "2x6, 2x8, 2x12, 1 RiR, 2x12, 1 RiR, 3x10"],
                ["Saturday", "Shoulders + Arms", "Machine Shoulder Press, DB Lateral Raise Superset DB Rear Delt, 1 Arm Cable Pushdown Superset Cable Curl, Crossbody Hammer Curl, Katana Tricep Extension", "1x8, 2x to failure, 3x12, 3x12, 3x10, 3x10, 4x10, 2x to failure"],
                ["Sunday", "Rest", "-", "-"]
            ]
        };

        function showWorkout(plan) {
            const tableBody = document.getElementById('workout-body');
            tableBody.innerHTML = "";
            
            workoutPlans[plan].forEach(row => {
                const tr = document.createElement('tr');
                row.forEach((cell, index) => {
                    const td = document.createElement('td');
                    if (index === 2 && cell !== "-") {
                        td.innerHTML = cell.split(', ').map(exercise => {
                            return exerciseLinks[exercise] 
                                ? `<a href='${exerciseLinks[exercise]}' target='_blank'>${exercise}</a>` 
                                : exercise;
                        }).join(', ');
                    } else {
                        td.textContent = cell;
                    }
                    tr.appendChild(td);
                });
                tableBody.appendChild(tr);
            });
            document.getElementById('workout-table').style.display = 'table';
        }
    </script>
</body>