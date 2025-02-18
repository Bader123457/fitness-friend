<?php
    //Simple class to hold all the information of a user

    //Object behaviour
    //All the user's information can be inputted into the object using the constructor
    //The userID and email cannot be changed after this
    //If you try to set the password using "$user->password = $password;" it will automatically be hashed and put into $user->password_checksum and the original password deleted
    //All the values have validation on them to prevent them being set to the wrong things so operations using the user block should be completed in a try catch to catch any unexpected exceptions

    class User {
        private readonly int $user_id; //must never be changed
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
        
        public function __construct(
            int $user_id, //must never be changed
            string $username,
            string $email,  //should never be changed
            string $first_name,
            string $last_name,
            string $password_checksum = "",
            string $password = "",             //should only ever be used when creating an account
            int $height,
            int $weight,
            string $gender,
            string $dob,
            string $activity_level,
            int $body_fat_percent,
            string $weight_preference,
            ) {
                //if email has been set to an invalid value then throw an error
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidArgumentException("Invalid Email");
                } else {
                    $this->email = $email;
                }

                //if user_id has been set to an invalid value then throw an error
                if(gettype($user_id) !== "int") {
                    throw new InvalidArgumentException("User ID must be an integer");
                } else {
                    $this->user_id = $user_id;
                }

                $this->username = $username;
                $this->first_name = $first_name;
                $this->last_name = $last_name;
                $this->password_checksum = $password_checksum;
                $this->height = $height;
                $this->weight = $weight;
                $this->gender = $gender;
                $this->dob = $dob;
                $this->activity_level = $activity_level;
                $this->body_fat_percent = $body_fat_percent;
                $this->weight_preference;

                //hash and delete password automatically if required
                if($password !== "") {
                    $this->password_checksum = password_hash(PASSWORD_DEFAULT, $password);
                    $this->password = "";
                }
        }

        //getters
        public function __get(string $property) {
            if (property_exists($this, $property) and ($property !== "password")) {
                return $this->$property;
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
                    $this->username = $value;
                    break;
//Last Name Validation                
                case "last_name":
                    if(gettype(value: $value) !== "string") {
                        throw new InvalidArgumentException(message: "Last Name must be a string");
                    }
                    if((strlen(string: $value) > 32) || (strlen(string: $value)) < 2) {
                        throw new InvalidArgumentException(message: "Last Name must be less than 32 characters long and more than 1 character long");
                    }
                    $this->username = $value;
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
                    if (!preg_match(pattern: '/[!@#$%^&*()_\-+=\[\]{};:\'"\\|,.<>?/`~]/', subject: $value)) {
                        throw new InvalidArgumentException(message: "Password must contain at least one special character.");
                    }
                    if (preg_match(pattern: '/[^\x20-\x7E]/', subject: $value)) {
                        throw new InvalidArgumentException(message: "Password contains invalid Unicode characters.");
                    }
                    $this->password_checksum = password_hash(password: PASSWORD_DEFAULT, algo: $value);
                    break;
//Height Validation
                case "height":
                    if(gettype(value: $value) !== "int") {
                        throw new InvalidArgumentException(message: "Height must be an integer.");
                    }
                    if(($value < 60) || ($value) > 260) {
                        throw new InvalidArgumentException(message: "Height must be between 60cm and 260cm.");
                    }
                    $this->height = $value;
                    break;
//Weight Validation
                case "weight":
                    if(gettype(value: $value) !== "int") {
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
                    $this->gender = $value;
                    break;
//Percentage Body Fat Validation
                case "body_fat_percent":
                    if(gettype(value: $value) !== "int") {
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
    }