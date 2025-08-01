<?php
    //class for controlling direct access to the database
    class DBConnection {
        //set all the default properties required for connecting to the database
        static protected $servername = "localhost";
        static protected $username = "root";
        static protected $password = "";
        static protected $dbname = "fitness_bro";
        static protected $charset = "utf8mb4";

        public function __toString() {
            return "DBConnection Class Object: dbInteract.php";
        }

        //call function to get database object as seen in below functions
        //EXAMPLE:
        //DBConnection::create("INSERT INTO account_data (email, username, id) VALUES (:email, :username, :id)" , ["testEmail@mail.com", "TestUsername", 123123], [":email", ":username", ":id"]);
        private static function dbConnect() {
            //Update the connection constants to being the values in the db-credentials.env file
            require "db-credential-extraction.php";
            self::$servername = $env["SERVER_NAME"];
            self::$username = $env["USERNAME"];
            self::$password = $env["PASSWORD"];
            self::$dbname = $env["DB_NAME"];
            
            try {
                //get the db object and set error mode
                $db = new PDO("mysql:host=" . self::$servername . ";dbname=" . self::$dbname . ";charset=" . self::$charset, self::$username, self::$password);
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                //This error checking is for development and should be removed in the final solution
                echo "Error connecting to the database: " . $e->getMessage();
                exit(1);
            }
            return $db;
        }

            //the SQL and any bound parameters should be inputted when calling the function
            //The $bound_parameters are the variables that you wish to insert
            //The $parameter_aliases are the locations where each parameter will be inserted
            //This protects againt SQL injection and so it is not always necessary. If you don't want to use a bound parameter then only enter an SQL Statement
        public static function create($sql, $bound_parameters = [], $parameter_aliases = []) {
            $stmt = self::dbConnect()->prepare($sql);
            //This is likely to be an INSERT INTO statement so it will probably need multiple bound parameters.
            //This inserts the parameters into the statement. It takes the minimum value so that it won't report an index error
            for ($i = 0; $i < min(count($bound_parameters), count($parameter_aliases)); $i++) {
                $stmt->bindParam($parameter_aliases[$i], $bound_parameters[$i]);
            }
            $stmt->execute();
            unset($db);
        }

        //This method will take care of all the other annoying parts of getting data from the database.
        public static function read($sql, $bound_parameters = [], $parameter_aliases = []) {
            $stmt = self::dbConnect()->prepare($sql);
            for ($i = 0; $i < min(count($bound_parameters), count($parameter_aliases)); $i++) {
                $stmt->bindParam($parameter_aliases[$i], $bound_parameters[$i]);
            }
            $stmt->execute();
            //unlike the other CRUD operations, this has to return the data that it gets
            $data = $stmt->fetch();
            unset($db);
            return $data;
        }

        //readMany is for reading multiple values into an array
        public static function readMany($sql, $bound_parameters = [], $parameter_aliases = []) {
            $stmt = self::dbConnect()->prepare($sql);
            for ($i = 0; $i < min(count($bound_parameters), count($parameter_aliases)); $i++) {
                $stmt->bindParam($parameter_aliases[$i], $bound_parameters[$i]);
            }
            $stmt->execute();
            
            $returnData = [];
            while($value = $stmt->fetch()) {
                array_push($returnData, $value);
            }

            
            unset($db);
            return $returnData;
        }

        //Example:
        //DBConnection::update("UPDATE account_data SET username = :username, email = :email WHERE id = :id", [$username, $email, $id], [":username", ":email", ":id"]);
        public static function update($sql, $bound_parameters = [], $parameter_aliases = []) {
            //Limit the update to only affect one record so you cannot accidentally update the whole table
            $sql = $sql . " LIMIT 1";
            $stmt = self::dbConnect()->prepare($sql);
            //This is likely to be an UPDATE statement so it will probably need multiple bound parameters.
            //This inserts the parameters into the statement. It takes the minimum value so that it won't report an index error
            for ($i = 0; $i < min(count($bound_parameters), count($parameter_aliases)); $i++) {
                $stmt->bindParam($parameter_aliases[$i], $bound_parameters[$i]);
            }
            //There should always be a where clause otherwise it will just delete the top entry (because we have limited it to 1)
            if (str_contains($sql, "WHERE")) {
                $stmt->execute();
            }
            unset($db);
        }

        //There shouldn't be any bound parameters for this as the user should only be deleting items from a list of options like messages or blocked users
        public static function delete($sql) {
            //Protecting against deleting all records
            $sql = $sql . " LIMIT 1";
            $stmt = self::dbConnect()->prepare($sql);
            //Preventing unspecified deletions
            if (str_contains($sql, "WHERE")) {
                $stmt->execute();
            }
            unset($db);
        }
    }

    