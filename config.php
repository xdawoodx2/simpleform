<?php
// Database Configuration
// Azure Database for MySQL Configuration
// Replace these values with your Azure MySQL server details

$host = 'newdb1.database.windows.net'; // e.g., newdb1.mysql.database.azure.com
$dbname = 'new'; // Your database name
$username = 'habb'; // Format: username@servername (without .mysql.database.azure.com)
$password = 'paki.123'; // Your Azure MySQL password
$port = 3306; // Default MySQL port

// Azure MySQL requires SSL connection
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::MYSQL_ATTR_SSL_CA => true, // Enable SSL
    PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false // Set to true in production with proper certificate
];

try {
    $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    $conn = new PDO($dsn, $username, $password, $options);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to Azure MySQL.");
    die(print_r($e));
}
?>



