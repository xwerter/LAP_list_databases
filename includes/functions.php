<?php

function db_connect()
{
    $servername = "localhost";
    $username = "root";
    $password = "";

    // Create connection
    $conn = new mysqli($servername, $username, $password);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function db_close($conn)
{
    $conn->close();
}

function get_data_from_base(mysqli $conn, string $database)
{
    
}

?>