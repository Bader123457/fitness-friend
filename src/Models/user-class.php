<?php
    //Simple class to hold all the information of a user

    //Object behaviour
    //All the user's information can be inputted into the object using the constructor
    //The userID and email cannot be changed after this
    //If you try to set the password using "$user->password = $password;" it will automatically be hashed and put into $user->password_checksum and the original password deleted
    //All the values have validation on them to prevent them being set to the wrong things so operations using the user block should be completed in a try catch to catch any unexpected exceptions

    require_once "db-llf.php";

    class User {
        private readonly ?int $user_id; //must never be changed
        private string $username;
        private readonly string $email;  //should never be changed
        private string $first_name;
        private string $last_name;
        private string $password_checksum = "";
        private string $password = "";             //should only ever be used when creating an account
        private int $height;
        private int $weight;
        private string $gender;
        private string $dob;
        private string $activity_level;
        private int $body_fat_percent;
        private string $weight_preference;


        const ACTIVITY_LEVELS = ["LOW", "MEDIUM", "HIGH"];
        const GENDERS = ["MALE", "FEMALE", "OTHER", "PNTS"]; 
        const WEIGHT_PREFERENCES = ["XLOSE", "LOSE", "MNTN", "GAIN", "XGAIN"];

        const DEFAULT_HEIGHTS = array(
            "MALE"      =>  170,
            "FEMALE"    =>  160,
            "OTHER"     =>  165,
            "PNTS"      =>  165,
        );
        
        public function __construct(
            ?int $user_id = null,  //must never be changed other than when set in the constructor
            ?string $username = null,
            string $email,  //should never be changed
            string $first_name = "John",
            string $last_name = "Doe",
            ?string $password_checksum = null,
            ?string $password = null,             //should only ever be used when creating an account
            int $height = 165,
            int $weight = 70,
            string $gender = "PNTS",
            ?string $dob = "0000-00-00",
            string $activity_level = "MEDIUM",
            int $body_fat_percent = 30,
            string $weight_preference = "MNTN",
            ) {
                $this->dob = (new DateTime())->modify("-27 years")->format("Y-m-d");

                //if email has been set to an invalid value then throw an error
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidArgumentException("Invalid Email");
                } else {
                    $this->email = $email;
                }

                //set attribtues using __set validation
                $this->__set("first_name", $first_name);
                $this->__set("last_name", $last_name);
                $this->__set("height", $height);
                $this->__set("weight", $weight);
                $this->__set("gender", $gender);
                $this->__set("dob", $dob);
                $this->__set("activity_level", $activity_level);
                $this->__set("body_fat_percent", $body_fat_percent);
                $this->__set("weight_preference", $weight_preference);

                //hash and delete password automatically if required
                if(isset($password)) {
                    $this->__set("password", $password);    //this auto updates the password checksum
                } else {
                    $this->password_checksum = $password_checksum;
                }

                //assign a new user_id if required
                if(!isset($user_id)) {
                    do {
                        $generated_user_id = random_int(10000000, 99999999);
                    } while ($this->checkIDInDB(user_id: $generated_user_id));
                    $this->user_id = $generated_user_id;

                    $this->__set("username", $username);
                } else {
                    //if user_id has been set to an invalid value then throw an error
                    if(gettype($user_id) !== "integer" && isset($user_id)) {
                        throw new InvalidArgumentException("User ID must be an integer");


                    } else {
                        $this->user_id = $user_id;
                        $this->username = $username;
                    }
                }

        }

        //getters
        public function __get(string $property) {
            if (property_exists($this, $property) and ($property !== "password")) {
                if($property == "password") {
                    throw new InvalidArgumentException("Password cannot be accessed. Only the hash of the password may be accessed");
                } else {
                    return $this->$property;
                }
            }
            throw new Exception("Property $property does not exist");
        }

        //set validation
        public function __set(string $property, mixed $value) {
            switch($property) {
//Username Validation
                case "username":
                    if(gettype($value) !== "string") {
                        throw new InvalidArgumentException("Username must be a string");
                    } elseif((strlen($value) > 32) || (strlen($value)) < 4) {
                        throw new InvalidArgumentException("Username must be less than 32 characters long and more than 4 characters long");
                    } elseif (($this->checkIDInDB(username: $value))) {
                        throw new InvalidArgumentException("Username is already in use");
                    }
                    $this->username = $value;
                    break;
//First Name Validation
                case "first_name":
                    if(gettype(value: $value) !== "string") {
                        throw new InvalidArgumentException(message: "First Name must be a string");
                    }
                    if((strlen(string: $value) > 32) || (strlen(string: $value)) < 2) {
                        throw new InvalidArgumentException(message: "First Name must be less than 32 characters long and more than 1 character long");
                    }
                    $this->first_name = $value;
                    break;
//Last Name Validation                
                case "last_name":
                    if(gettype(value: $value) !== "string") {
                        throw new InvalidArgumentException(message: "Last Name must be a string");
                    }
                    if((strlen(string: $value) > 32) || (strlen(string: $value)) < 2) {
                        throw new InvalidArgumentException(message: "Last Name must be less than 32 characters long and more than 1 character long");
                    }
                    $this->last_name = $value;
                    break;
//Password Validation
                case "password":
                    if(gettype(value: $value) !== "string") {
                        throw new InvalidArgumentException(message: "Password must be a string.");
                    }
                    if((strlen(string: $value) > 32) || (strlen(string: $value)) < 6) {
                        throw new InvalidArgumentException(message: "Password must be at least 6 characters long.");
                    }
                    if (!preg_match(pattern: '/[a-z]/', subject: $value)) {
                        throw new InvalidArgumentException(message: "Password must contain at least one lowercase letter.");
                    }
                    if (!preg_match(pattern: '/[A-Z]/', subject: $value)) {
                        throw new InvalidArgumentException("Password must contain at least one uppercase letter.");
                    }
                    if (!preg_match(pattern: '/[0-9]/', subject: $value)) {
                        throw new InvalidArgumentException(message: "Password must contain at least one number.");
                    }
                    if (!preg_match('/[!@#$%^&*()_\-+=\[\]{};:\'"\\|,.<>?`~]/', $value)) {
                        throw new InvalidArgumentException("Password must contain at least one special character.");
                    }
                    if (preg_match(pattern: '/[^\x20-\x7E]/', subject: $value)) {
                        throw new InvalidArgumentException(message: "Password contains invalid Unicode characters.");
                    }
                    $this->password_checksum = password_hash(password: $value, algo: PASSWORD_DEFAULT);
                    break;
//Height Validation
                case "height":
                    if(gettype(value: $value) !== "integer") {
                        throw new InvalidArgumentException(message: "Height must be an integer.");
                    }
                    if(($value < 60) || ($value) > 260) {
                        throw new InvalidArgumentException(message: "Height must be between 60cm and 260cm.");
                    }
                    $this->height = $value;
                    break;
//Weight Validation
                case "weight":
                    if(gettype(value: $value) !== "integer") {
                        throw new InvalidArgumentException(message: "Weight must be an integer.");
                    }
                    if(($value < 35) || $value > 200) {
                        throw new InvalidArgumentException(message: "Weight must be between 35kg and 200kg.");
                    }
                    $this->weight = $value;
                    break;
//Gender Validation
                case "gender":
                    if(!in_array(needle: $value, haystack: self::GENDERS)) {
                        throw new InvalidArgumentException(message: "Invalid Gender Entered");
                    }
                    $this->gender = $value;
                    break;
//Date of Birth Validation
                case "dob":
                    $this->dob = $value;
                    break;
//Gender Validation
                case "activity_level":
                    if(!in_array(needle: $value, haystack: self::ACTIVITY_LEVELS)) {
                        throw new InvalidArgumentException(message: "Invalid Activity Level Entered");
                    }
                    $this->activity_level = $value;
                    break;
//Percentage Body Fat Validation
                case "body_fat_percent":
                    if(gettype(value: $value) !== "integer") {
                        throw new InvalidArgumentException(message: "Body Fat Percentage must be an integer.");
                    }
                    if(($value < 0) || $value > 100) {
                        throw new InvalidArgumentException(message: "Body Fat Percentage must be between 0% and 100%.");
                    }
                    $this->body_fat_percent = $value;
                    break;
//Gender Validation
                case "weight_preference":
                    if(!in_array(needle: $value, haystack: self::WEIGHT_PREFERENCES)) {
                        throw new InvalidArgumentException(message: "Invalid Weight Preference Entered");
                    }
                    $this->weight_preference = $value;
                    break;
            }
        }

        function saveToDB(){
            //This function will update the information in the database to match this data
            if(self::checkIDInDB(user_id: $this->user_id)) {
                DBConnection::update(
                    sql: "  UPDATE users 
                            SET username = :username, first_name = :first_name, last_name = :last_name, password = :password, height = :height, weight = :weight, gender = :gender, dob = :dob, activity_level = :activity_level, body_fat_percent = :body_fat_percent, weight_preference = :weight_preference
                            WHERE user_id = :user_id;",
                    bound_parameters: [$this->user_id, $this->username, $this->first_name, $this->last_name, $this->password_checksum, $this->height, $this->weight, $this->gender, $this->dob, $this->activity_level, $this->body_fat_percent, $this->weight_preference],
                    parameter_aliases: [":user_id", ":username", ":first_name", ":last_name", ":password", ":height", ":weight", ":gender", ":dob", ":activity_level", ":body_fat_percent", ":weight_preference"]
                );

                return;
            }
            DBConnection::create(
                sql: "  INSERT INTO users (user_id, username, email, first_name, last_name, password, height, weight, gender, dob, activity_level, body_fat_percent, weight_preference) 
                        VALUES (:user_id, :username, :email, :first_name, :last_name, :password_checksum, :height, :weight, :gender, :dob, :activity_level, :body_fat_percent, :weight_preference)",
                bound_parameters: [$this->user_id, $this->username, $this->email, $this->first_name, $this->last_name, $this->password_checksum, $this->height, $this->weight, $this->gender, $this->dob, $this->activity_level, $this->body_fat_percent, $this->weight_preference],
                parameter_aliases: [":user_id", ":username", ":email", ":first_name", ":last_name", ":password_checksum", ":height", ":weight", ":gender", ":dob", ":activity_level", ":body_fat_percent", ":weight_preference"]
            );
        }

        function validatePassword($password) {
            //will check that the entered password is correct for this account
            return password_verify($password, $this->password_checksum);
        }

        static function checkIDInDB($user_id = null, $username = null): bool {
            if ($user_id !== null) {
                $result = DBConnection::read(
                    sql: "SELECT user_id FROM users WHERE user_id = :user_id",
                    bound_parameters: [$user_id],
                    parameter_aliases: [":user_id"],
                );
                
                if($result === False) {
                    return False;
                } else {
                    return True;
                }
            } else if($username !== null) {
                $result = DBConnection::read(
                    sql: "SELECT user_id FROM users WHERE username = :username",
                    bound_parameters: [$username],
                    parameter_aliases: [":username"],
                );
                
                if($result === False) {
                    return False;
                } else {
                    return True;
                }
            } else {
                throw new InvalidArgumentException("You must specify a username or user_id");
            }
        }

        static function getUser($user_id = null, $email = null, $username = null): User{
            if(isset($user_id)) {
                $userData = DBConnection::read(
                    sql: "SELECT * FROM users WHERE user_id = :user_id",
                    bound_parameters: [$user_id],
                    parameter_aliases: [":user_id"]
                );
            } elseif (isset($email)) {
                $userData = DBConnection::read(
                    sql: "SELECT * FROM users WHERE email = :email",
                    bound_parameters: [$email],
                    parameter_aliases: [":email"]
                );
            } elseif (isset($username)) {
                $userData = DBConnection::read(
                    sql: "SELECT * FROM users WHERE username = :username",
                    bound_parameters: [$username],
                    parameter_aliases: [":username"]
                );
            } else {
                throw new InvalidArgumentException(message: "A unique key is required");
            }
    
            try {
                if ($userData === False){
                    throw new ErrorException(message: "no values");
                } else {
                    $user =  new User(
                        user_id: $userData["user_id"],
                        username: $userData["username"],
                        email: $userData["email"],
                        first_name: $userData["first_name"],
                        last_name: $userData["last_name"],
                        password_checksum: $userData["password"],
                        height: $userData["height"],
                        weight: $userData["weight"],
                        gender: $userData["gender"],
                        dob: $userData["dob"],
                        activity_level: $userData["activity_level"],
                        body_fat_percent: $userData["body_fat_percent"],
                        weight_preference: $userData["weight_preference"],
                    );
                }
                
                return $user;
            } catch (Exception $e) {
                if ($e->getMessage() == 'no values') {
                    throw new ErrorException(message: "Database returned no values");
                } else {
                    throw new ErrorException(message: "Database Contains Invalid Data in Record: $user_id");
                }
            }
        }
    
    }