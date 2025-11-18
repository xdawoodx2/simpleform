<?php
// Azure SQL Database Configuration

$server   = "tcp:newdb1.database.windows.net,1433";
$database = "new";
$username = "habib"; 
$password = "paki.123";

// SQL Server connection settings
$connectionOptions = [
    "Database" => $database,
    "Uid"      => $username,
    "PWD"      => $password,
    "Encrypt"  => true,
    "TrustServerCertificate" => false
];

// Connect
$conn = sqlsrv_connect($server, $connectionOptions);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true));
}
echo "✔ Connected to Azure SQL successfully!";
?>
