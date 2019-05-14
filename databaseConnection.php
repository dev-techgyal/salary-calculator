<?php
/**
 *This file connects to the database or simple terms
 * It is used to acquire the connection to the database
 */


$host = "localhost";//define the host to the database for our case is localhost
$user = "root";//define the user who own the database or has privilege to access it thats his or her role
$password = "";//define the password to access the database for our case we have none
$database_name = "salary";//Here we give the name of our database we want to connect to


/**
 * In this connection we try to connect the if it
 * fails we terminate by using die(connection)
 */
$connection = mysqli_connect($host, $user, $password, $database_name) or die($connection);
