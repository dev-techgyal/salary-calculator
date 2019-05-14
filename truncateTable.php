<?php
/**
 * In this file we are going to truncate table
 * to empty every record that was saved
 */

//first require this by checking the database connection connection
require('databaseConnection.php');

/**
 * use php function isset to check
 * if the truncateTable button is clicked
 */
if (isset($_POST['truncateTable'])) {
    $sql_statement = "TRUNCATE TABLE table_salary";
    $truncate = mysqli_query($connection, $sql_statement);

    //check if the truncate query successful
    if ($truncate) {
        //close the database connection
        mysqli_close($connection);

        //redirect back to this file
        require './index.php';
    }
}