<?php

// Database connection details
define('DB_HOST', 'localhost'); // Usually 'localhost' or '127.0.0.1'
define('DB_USER', 'root');      // Your MySQL username
define('DB_PASS', '');          // Your MySQL password (leave empty if none)
define('DB_NAME', 'ai_documentation'); // The name of the database

/**
 * Creates a new database connection using MySQLi.
 *
 * @return mysqli|false The mysqli connection object on success, or false on error.
 */
function connectDB() {
    // Attempt to create a new connection
    $connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Check for a connection error
    if ($connection->connect_error) {
        // Stop script execution and display an error message
        die("Database connection error: " . $connection->connect_error);
    }

    // Set the character set to utf8mb4 to support special characters and emoji
    $connection->set_charset("utf8mb4");

    // Return the connection object
    return $connection;
}

?>