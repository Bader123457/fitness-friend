<?php

    require_once "db-llf.php";

    class PhysicalActivity {
        public readonly int $activity_code;
        public readonly string $category;
        public readonly float $met_value;
        public readonly string $description;

        function __construct($activity_code) {
            $activity_data = $this->get_activity_data($activity_code);

            if ($activity_data === false) {
                throw new InvalidArgumentException("Invalid Activity Code Supplied");
            }

            $this->activity_code = $activity_code;
            $this->category = $activity_data["category"];
            $this->met_value = $activity_data["met_value"];
            $this->description = $activity_data["description"];
        
        }

        function get_activity_data($activity_code) {
            $data = DBConnection::read(
                sql: "SELECT * FROM compendium_of_physical_activities WHERE activity_code = :activity_code",
                bound_parameters: [$activity_code],
                parameter_aliases: [":activity_code"]
            );
            return $data;
        }

    }

    function search_physical_activities($category, $search_string) {
        $data = DBConnection::readMany(
            sql: "  SELECT *, MATCH(description) AGAINST(:search_string WITH QUERY EXPANSION) AS relevance 
                    FROM compendium_of_physical_activities 
                    WHERE category = :category 
                    AND (MATCH(description) AGAINST(:search_string WITH QUERY EXPANSION) OR description LIKE CONCAT('%', :search_string, '%'))
                    ORDER BY relevance DESC",
            bound_parameters: [$category, $search_string],
            parameter_aliases: [":category", ":search_string"]
        );

        return $data;
    }

    function calculate_calories_burned($physical_activity, $user, $duration) {
        return round($physical_activity->met_value * $user->weight * ($duration / 3600));
    }