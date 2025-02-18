<?php
    require_once "user-class.php";
    require_once "db-llf.php";

    //only one of the following arguments is required
    function getUser($user_id, $email, $username): User{
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
        } catch (Exception $e) {
            throw new ErrorException(message: "Database Contains Invalid Data in Record: $user_id");
        }
    }