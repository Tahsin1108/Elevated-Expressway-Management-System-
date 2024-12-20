
<?php

function getVehicles($conn) {
    // Define SQL query to retrieve vehicles
    $sql = "SELECT * FROM vehicles";

    // Parse the SQL query
    $stmt = oci_parse($conn, $sql);

    // Execute the query
    oci_execute($stmt);

    // Initialize an empty array to store fetched rows
    $array = [];

    // Fetch rows one by one and append them to the array
    while ($row = oci_fetch_assoc($stmt)) {
        $array[] = $row;
    }

    // Free statement resources
    oci_free_statement($stmt);

    return $array;
}



// Process form submission for adding a new vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_vehicle"])) {
    $user_id = $_POST["user_id"];
    $vehicle_id = $_POST["vehicle_id"];
    $vehicle_type = $_POST["vehicle_type"];
    $owner_name = $_POST["owner_name"];

    // Define SQL query to insert a new vehicle record
    $sql = "INSERT INTO vehicles (vehicle_id, user_id, vehicle_type, owner_name) VALUES (:vehicle_id, :user_id, :vehicle_type, :owner_name)";

    // Parse the SQL query
    $stmt = oci_parse($conn, $sql);

    // Bind parameters
    oci_bind_by_name($stmt, ':user_id', $user_id);
    oci_bind_by_name($stmt, ':vehicle_id', $vehicle_id);
    oci_bind_by_name($stmt, ':vehicle_type', $vehicle_type);
    oci_bind_by_name($stmt, ':owner_name', $owner_name);

    // Execute the query
    $success = oci_execute($stmt);

    // Free statement resources
    oci_free_statement($stmt);

    if ($success) {
        echo "<br><center><strong>*Vehicle added successfully</strong></center>";
    } else {
        echo "<br><center><strong>*Failed to add vehicle</strong></center>";
    }
}

// Process form submission for updating a vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_vehicle"])) {
    $vehicle_id = $_POST["vehicle_id"];
    $vehicle_type = $_POST["vehicle_type"];
    $owner_name = $_POST["owner_name"];

    // Define SQL query to update the vehicle record
    $sql = "UPDATE vehicles SET vehicle_type = :vehicle_type, owner_name = :owner_name WHERE vehicle_id = :vehicle_id";

    // Parse the SQL query
    $stmt = oci_parse($conn, $sql);

    // Bind parameters
    oci_bind_by_name($stmt, ':vehicle_type', $vehicle_type);
    oci_bind_by_name($stmt, ':owner_name', $owner_name);
    oci_bind_by_name($stmt, ':vehicle_id', $vehicle_id);

    // Execute the query
    $success = oci_execute($stmt);

    // Free statement resources
    oci_free_statement($stmt);

    if ($success) {
        echo "<br><center><strong>*Vehicle updated successfully</strong></center>";
    } else {
        echo "<br><center><strong>*Failed to update vehicle</strong></center>";
    }
}

// Process form submission for deleting a vehicle
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_vehicle"])) {
    $vehicle_id = $_POST["vehicle_id"];

    // Define SQL query to delete the vehicle record
    $sql = "DELETE FROM vehicles WHERE vehicle_id = :vehicle_id";

    // Parse the SQL query
    $stmt = oci_parse($conn, $sql);

    // Bind parameters
    oci_bind_by_name($stmt, ':vehicle_id', $vehicle_id);

    // Execute the query
    $success = oci_execute($stmt);

    // Free statement resources
    oci_free_statement($stmt);

    if ($success) {
        echo "<br><center><strong>*Vehicle deleted successfully</strong></center>";
    } else {
        echo "<br><center><strong>*Failed to delete vehicle</strong></center>";
    }
}

// Retrieve vehicles from the database
$vehicles = getVehicles($conn);

// Close the connection

?>