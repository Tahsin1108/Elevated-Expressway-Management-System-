<?php
// Check if the admin session is set
if (isset($_SESSION['admin'])) {
    // Retrieve admin information from the database based on the username stored in the session
    $admin_username = $_SESSION['admin'];
    $sql = "SELECT * FROM admin WHERE username = :username";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':username', $admin_username);
    oci_execute($stmt);
    $admin = oci_fetch_assoc($stmt);

    // Display admin details
    if ($admin) {
        echo "<div class=\"form-section\">";
        echo "<br><br>";
        echo "<hr>";
        echo "<br><br>";
        echo "<h3>Admin</h3>";
        echo "<h4>Manage Admin</h4>";
        echo "<br>";
        echo "<form action=\"#\" method=\"post\">";
        echo "<label for=\"admin_id\">Admin ID:</label>";
        echo "<input type=\"text\" id=\"admin_id\" name=\"admin_id\" value=\"" . $admin['ADMIN_ID'] . "\" required disabled>";
        echo "<label for=\"username\">Username:</label>";
        echo "<input type=\"text\" id=\"username\" name=\"username\" value=\"" . $admin['USERNAME'] . "\" required disabled>";
        
        // Display current password and allow admin to enter new password
        echo "<label for=\"current_password\">Current Password:</label>";
        echo "<input type=\"text\" id=\"current_password\" name=\"current_password\" value=\"" . $admin['PASSWORD'] . "\" required disabled>";
        echo "<label for=\"new_password\">New Password:</label>";
        echo "<input type=\"password\" id=\"new_password\" name=\"new_password\" required>";
        echo "<button type=\"submit\" name=\"update_password\">Update Password</button>";
        echo "</form>";
        echo "</div>";
    } else {
        echo "Admin not found.";
    }
} else {
    echo "Admin not logged in.";
}

// Handle password update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_password"])) {
    
    $new_password = $_POST["new_password"];

    // Update the admin's password in the database
    $sql = "UPDATE admin SET password = :new_password WHERE username = :username";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':new_password', $new_password);
    oci_bind_by_name($stmt, ':username', $admin_username);
    $success = oci_execute($stmt);

    if ($success) {
        echo "<p>Password updated successfully.</p>";
    } else {
        echo "<p>Failed to update password.</p>";
    }
}
?>
