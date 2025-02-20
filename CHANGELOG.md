# Change Log

## [20/02/2025] Made Login and Register controllers handle POST request

### Added

- Added the ability for Login and Register controllers to read and handle POST requests from the login and register websites.
    - The actual login verification and user registration part is not in place yet

## [18/02/2025] Added User class and DBConnection class (Thanks Elliot)

### Added

- Added User class
    - Use the User class to store user information in session data
- Added DBConnection class
    - The DBConnection class manages all conections to the database
    - The DBConnection class also contains a couple of functions that automates the creation and execution of prepared statements
    - Database credentials are stored in config/db-credentials.env, which **CANNOT** be stored in this repositiory for security reasons. Get the credentials from the database folder in the shared Google Drive instead
- Added .gitignore to never save db-credentials.env into repo

## [17/02/2025] Added Login and Register pages

### Added

- Added placeholder login page, register page and their corresponding controllers in preparation for adding login and register functions to the website

## [13/02/2025] Modified index.php and all redirect links to work when hosting on web.cs.manchester.ac.uk

### Fixed

- Added a special case in index.php which processes the URLs differently when the host is web.cs.manchester.ac.uk
    - Previously, the extra parts of the URL e.g. '/p14930yp/fitness_bro/' would mess with index.php since it originally assumed that anything after the HTTP host (anything after the first / ) is the request to a controller
    - Now, index.php discards the first two parts of the URI when looking for the controller for web.cs.manchester.ac.uk
- Any website redirect links are now dynamically constructed in the functions of the controller classes instead of being hard-coded in HTML
    - The redirect links can now automatically include extra parts (i.e. '/p14930yp/fitness_bro/') so that they work when the website is hosted on web.cs.manchester.ac.uk

## [10/02/2025] Created index.php to redirect all traffic to controllers in src

The website can now run on local XAMPP Apache server without issue. We need to check if we can host it on the school website as well.

### Added

- .htaccess files in root folder and in public/ that redirects all links to index.php files
    - This also results in user not being to access anything outside the public folder, which is intended behaviour
- Created index.php which redirects all traffic to controllers in src depending on the URL
- Created home.php and second.php to be used as testing - Replace these files and their controllers later

## [04/02/2025] Renamed MVC files

### Changed

- Renamed the files Models, Controllers and Views to be capitalised in the src folder to follow convention

## [03/02/2025] Added PHP directory structure for the project + README.md

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
