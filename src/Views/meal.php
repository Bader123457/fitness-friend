<?php
function displayMealPlan($gender, $goal) {
    // Convert input to lowercase to avoid case sensitivity issues
    $gender = strtolower($gender);
    $goal = strtolower($goal);

    echo "<h2>Meal Plan for " . ucfirst($gender) . " - " . ucfirst($goal) . "</h2>";

    if ($gender == "male" && $goal == "MNTN") {
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
    elseif ($gender == "male" && $goal == "weight gain") {
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
    elseif ($gender == "male" && $goal == "intensive weight gain") {
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
    elseif ($gender == "male" && $goal == "weight loss") {
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
    elseif ($gender == "male" && $goal == "intensive weight loss") {
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
    elseif ($gender == "female" && $goal == "MNTN") {
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
    elseif ($gender == "female" && $goal == "weight gain") {
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
    elseif ($gender == "female" && $goal == "intensive weight gain") {
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
    elseif ($gender == "female" && $goal == "weight loss") {
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
    elseif ($gender == "female" && $goal == "intensive weight loss") {
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
?>