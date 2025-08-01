# Change Log

## [10/03/2025] Added initial backend code for Foodtracker page - Badr

### Added

- Added testing code for Foodtracker page's backend to connect to Nutritionix API

## [08/03/2025] Added frontend for Login and Register page - Yi Xuan, Akshit

### Added

- Added frontend for Login and Register page
    - Frontend implemented into the website at 10/03/2025

## [04/03/2025] Fixed wrong error display for Register page, Fixed button being swapped for Home page - Yi Xuan

### Fixed

- When email/password does not fit requirements, Register page now display what requirements are not met instead of a generic Database error
- The redirect links for Sign-In and Log-In button in Home page were swapped. This is fixed, and the Sign-In button has been renamed to Register to match the Register page

## [03/03/2025] Added Nutritionix API, Fixed URL requesting for assets being redirected to index.php - Yi Xuan, Badr

### Added

- Added Nutritionix API
    - We now have a function that can pull food data from Nutritionix API
    - nutritionix-credentials.env, which contains app ID and API key from Badr's account, **CANNOT** be saved in Git
    - Go to the Google Drive for the API key
- Added nutritionix-credentials.env to .gitignore

### Fixed

- Fixed URL requesting for assets being redirected to index.php instead of serving the correct assets
    - Images and stuff within assets/ can now be directly accessed with URL
    - The imgaes for home page is not broken anymore

## [27/02/2025] Added Profile page, Profile and dashboard page can now read user information, Added HTML for home page - Yi Xuan, Akshit

### Added

- Added Profile page
    - This is where users come to edit personal information
    - Profile page can retrieve information from database and display it
    - As of now users can only chnage their password
    - Error messages for the change password function are **not** implemented yet
- Dashboard page can now read and display user information as well
- Added HTML for home page

## [25/02/2025] Session handling, Register page error handling, Logout function, Dashboard page, New exception handling - Yi Xuan

### Added

- Added session handling for logged in users
    - Session stores the values 'user' and 'logged_in', user being an instance of User class and logged_in being a boolean to confirm that the user logged in properly
    - session_set_cookie_params have the following settings:
        - 'lifetime' => 86400, // 1 day
        - 'secure' => true,   // Only send over HTTPS
        - 'httponly' => true,  // Prevent JavaScript access
        - 'samesite' => 'Strict' // Prevent CSRF attacks
- Added logout function to LoginController
    - This function destroys session data before kicking user back to the home page
- Added dashboard.php and DashboardController.php
    - This page is only accessible when a session exists that says that the user is logged in
    - The view dashboard.php is a placeholder, replace with frontend later
- Added error message display for Register page
    - Same as login page

### Fixed

- Added new exception handling for if 'uname' and 'psw' is missing from the login POST request.
- Login page now redirects user to Dashboard if they're already logged in
- Changed all instance of 'window.location.pathname' to 'window.location.href'
    - Previously, redirecting with 'window.location.pathname' preserves GET requests for some reason

## [24/02/2025] Added error message display for login page, fixed index.php breaking when GET values are added - Yi Xuan

### Added

- Added error message display for login page for:
    - When the credentials is wrong
    - When the 'uname' and 'psw' is missing from POST
    - When something went wrong while querying the database

### Fixed

- Fixed index.php not finding the correct controller when GET values are added to the URI link

## [20/02/2025] Hooked up the back end Login and Register functions to front end POST request - Elliot

### Added

- Added functions for validating credentials
    - User objects have the validatePassword function which takes one argument and returns whether that is the correct password for the user
    - User::checkIDInDB() is a static function that returns True if the ID is in use in the database and False otherwise

### Changed

- Moved the user-db functions into the user class
    - User::getUser() is a static function that can take any of the three unique identifiers and return the user object relating to that user.
    - $user->saveToDB() is a function that updates the database so that the DB user has the same parameters as the object user


## [20/02/2025] Added ability for Login and Register controllers to handle POST request - Yi Xuan

### Added

- Added the ability for Login and Register controllers to read and handle POST requests from the login and register websites.
    - The actual login verification and user registration part is not in place yet

## [18/02/2025] Added User class and DBConnection class - Elliot

### Added

- Added User class
    - Use the User class to store user information in session data
- Added DBConnection class
    - The DBConnection class manages all conections to the database
    - The DBConnection class also contains a couple of functions that automates the creation and execution of prepared statements
    - Database credentials are stored in config/db-credentials.env, which **CANNOT** be stored in this repositiory for security reasons. Get the credentials from the database folder in the shared Google Drive instead
    - The MySQL Database itself is created and managed by Elliot. Check with him if you need help with it
- Added .gitignore to never save db-credentials.env into repo

## [17/02/2025] Added Login and Register pages - Yi Xuan

### Added

- Added placeholder login page, register page and their corresponding controllers in preparation for adding login and register functions to the website

## [13/02/2025] Modified index.php and all redirect links to work when hosting on web.cs.manchester.ac.uk - Yi Xuan

### Fixed

- Added a special case in index.php which processes the URLs differently when the host is web.cs.manchester.ac.uk
    - Previously, the extra parts of the URL e.g. '/p14930yp/fitness_bro/' would mess with index.php since it originally assumed that anything after the HTTP host (anything after the first / ) is the request to a controller
    - Now, index.php discards the first two parts of the URI when looking for the controller for web.cs.manchester.ac.uk
- Any website redirect links are now dynamically constructed in the functions of the controller classes instead of being hard-coded in HTML
    - The redirect links can now automatically include extra parts (i.e. '/p14930yp/fitness_bro/') so that they work when the website is hosted on web.cs.manchester.ac.uk

## [10/02/2025] Created index.php to redirect all traffic to controllers in src - Yi Xuan

The website can now run on local XAMPP Apache server without issue. We need to check if we can host it on the school website as well.

### Added

- .htaccess files in root folder and in public/ that redirects all links to index.php files
    - This also results in user not being to access anything outside the public folder, which is intended behaviour
- Created index.php which redirects all traffic to controllers in src depending on the URL
- Created home.php and second.php to be used as testing - Replace these files and their controllers later

## [04/02/2025] Renamed MVC files - Yi Xuan

### Changed

- Renamed the files Models, Controllers and Views to be capitalised in the src folder to follow convention

## [03/02/2025] Added PHP directory structure for the project + README.md - Yi Xuan

### Added

Added the directories:

- assets - Where we put .css stuff and images
- config - Where we put variables like db usernames and passwords
- lib - If we need libraries - i think we're using bootstrap for frontend so put that there
- public - Where index.php is - basiclally the landing page that rerouts all traffic to the correct functions and stuff
- src - Source code, its split into Models (backend logic), Views (frontend html and display), Controllers (links frontend and backend)
    - models - Backend php code
    - views - Frontend php/html code
    - controllers - Manages the calling of functions and including the frontend code to connect both views and models together
- tests - Put unit tests here

Added the files:
- README.md for basic information about the repository
- CHANGELOG.md - this one

# WIP keywords to be used for formatting the changelog
Added
Changed
Deprecated
Removed
Fixed 
Security
