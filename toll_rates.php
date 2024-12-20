<?php

// Function to fetch toll rates from the database
function getTollRates($conn) {
    // Define SQL query to retrieve toll rates
    $sql = "SELECT * FROM toll_rates";

    // Parse the SQL query
    $stmt = oci_parse($conn, $sql);

    // Execute the query
    oci_execute($stmt);

    // Initialize an array to store fetched toll rates
    $tollRates = [];

    // Fetch rows one by one and append them to the array
    while ($row = oci_fetch_assoc($stmt)) {
        $tollRates[] = $row;
    }

    // Free statement resources
    oci_free_statement($stmt);

    return $tollRates;
}

// Fetch toll rates data from the database
$tollRates = getTollRates($conn);
?>
