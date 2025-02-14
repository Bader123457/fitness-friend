<?php
    //Simple class to hold all the information of a user
    class User {
        public function __construct(
            public readonly int $user_id, //must never be changed
            public string $username,
            public readonly string $email,  //should never be changed
            public string $first_name,
            public string $last_name,
            public string $password_checksum = "",
            string $password = null,             //should only ever be used when creating an account
            public int $height,
            public int $weight,
            public string $gender,
            public $dob,
            public string $activity_level,
            public int $body_fat_percent,
            public string $weight_preference,
            ) {
                //if email has been set to an invalid value then throw an error
                if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidArgumentException("Invalid Email");
                }

                //hash and delete password automatically
                if($password !== null) {
                    $this->password_checksum = password_hash(PASSWORD_DEFAULT, $password);
                    $this->password = null;
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
                case "username":
                    if(gettype($value) !== "string") {
                        break;
                    }
                    if((strlen($value) > 32) || (strlen($value)) < 4) {
                        break;
                    }
                    $this->username = $value;
                    break;
                case "first_name":
                    if(gettype($value) !== "string") {
                        break;
                    }
                    if((strlen($value) > 32) || (strlen($value)) < 4) {
                        break;
                    }
                    $this->username = $value;
                    break;

            }
        }
    }