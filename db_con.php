<?php
$db_user = 'system';
$db_pass = 'system';
$db_host = 'DESKTOP-V4T1J3K';
$db_service = 'XE';

// Establish connection
$conn = oci_connect($db_user, $db_pass, "(DESCRIPTION=(ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = $db_host)(PORT = 1521)))(CONNECT_DATA=(SID=$db_service)))");

// Check if connection was successful
if (!$conn) {
    $m = oci_error(); // Fetch error details
    echo $m['message'], "\n";
    exit;
} else {
    echo "Connection successful<br>";
}





