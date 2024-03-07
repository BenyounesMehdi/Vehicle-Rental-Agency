<?php
    require_once 'database.php' ;

    function countRableRows($pdo, $tableName) {
        // Prepare the SQL query
        $query = "SELECT COUNT(*) FROM $tableName";

        // Prepare and execute the statement
        $statement = $pdo->prepare($query);
        $statement->execute();

        // Fetch the result
        $rowCount = $statement->fetchColumn();

        return $rowCount;
    }

    function getData ($pdo, $tableName) {
        // Prepare the SQL query
        $query = "SELECT * FROM $tableName";

        // Prepare and execute the statement
        $statement = $pdo->prepare($query);
        $statement->execute();

        // Fetch the result
        $data = $statement->fetchAll();

        return $data;
    }

?>