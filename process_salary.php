<?php
/**
 * In this file we are going to process all the records
 * that we receive from the request
 */


//first require this by checking the database connection connection
require('databaseConnection.php');

/**
 * use php function isset to check
 * if the process button is clicked
 */
if (isset($_POST['processData'])) {
    /**
     * use php mysqli_real_escape_string to get data from specif fields
     * also the mysqli_real_escape_string avoid someone from mysql injections
     */
    $bookSalary = mysqli_real_escape_string($connection, $_POST['bookSalary']);
    $houseAllowance = mysqli_real_escape_string($connection, $_POST['houseAllowance']);
    $medicalAllowance = mysqli_real_escape_string($connection, $_POST['medicalAllowance']);
    $NHIF = mysqli_real_escape_string($connection, $_POST['NHIF']);
    $NSSF = mysqli_real_escape_string($connection, $_POST['NSSF']);


    /**
     * after getting all inputs insert the data to our table
     * table_salary
     */
    $sql_statement = "INSERT INTO table_salary 
         (bookSalary,houseAllowance,medicalAllowance,NHIF,NSSF)"
        . " VALUES(' $bookSalary','$houseAllowance','$medicalAllowance','$NHIF','$NSSF')";

    //process the sq;_statement using mysql_query
    $new_data = mysqli_query($connection, $sql_statement);

    //check if the data query successful
    if ($new_data) {
        //close the database connection
        mysqli_close($connection);

        //redirect back to this file
        require './index.php';
    }
}

