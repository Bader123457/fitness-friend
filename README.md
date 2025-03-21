# FitnessBro website - First year team project 2025 - Tutor Group Z14

This is a PHP website that:
- Calculates daily calorie expenditure
- Searches the Nutritionix API to get food nutrition data
- Lets users store a record of their meal plans/food eaten
- Provide guides on how a meal plan should look like
- Searches the Compendium of Physical Activities to calculate calories burned from performing certain Activities
- Provide guides on workout plans and videos
- Allows users to login and record their body information (e.g. weight, height) that could be used by the functions above

Team members:
- Elliot Holbrook
- Akshit Palamthody
- Yi Xuan Phoon
- Badreldin
- Armaan Ahmed
- Youssef Abouelnasr

Tech stack:
- Backend:
    - PHP (vanilla)
    - MySQL Database
    - Nutritionix API (for fetching nutrition data)
- Web server
    - Apache HTTP server
- Frontend:
    - HTML
    - CSS
    - JavaScript (vanilla)

Directory structure:
- assets - Where we put assets and images
- config - Where we put credentials to the database and Nutritionix API
- database - Where we put the schema for MySQL database
- public - Where the main page index.php is
    - This file handles every requests to the server and reroutes all URL to the correct controllers
- src - Source code, its split into Models (backend logic), Views (frontend html and display), Controllers (links frontend and backend)
