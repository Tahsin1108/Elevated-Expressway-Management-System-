
<?php
session_start();
ob_start();

if (!isset($_SESSION['y'])) 
{
	header("Location: login.php");
}	
include "db_con.php";
	
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/design.css">
</head>

<body>
    <div class="dashboard-top">
        <h1>Dhaka Elevated Expressway</h1>

        <h2>User Dashboard</h2>
    </div>

    <div class="dashboard">

  




        
<div class="form-section">
    <br><br>
    <hr>
    <br><br>
    <h3>Toll Rates</h3>
</div>
<div class="table-section">
    <br>
    <h4>Rate List</h4>
    <br>
    <table>
        <thead>
            <tr>
                <th>Toll ID</th>
                <th>Vehicle Type</th>
                <th>Toll Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Assuming you have already established a database connection and have the necessary query
            $query = "SELECT * FROM toll_rates"; // Query to fetch toll rates data from the database
            $stmt = oci_parse($conn, $query);
            oci_execute($stmt);

            // Loop through the fetched rows and display each toll rate record
            while ($row = oci_fetch_assoc($stmt)) {
                echo "<tr>";
                echo "<td>" . $row['TOLL_ID'] . "</td>";
                echo "<td>" . $row['VEHICLE_TYPE'] . "</td>";
                echo "<td>" . $row['TOLL_AMOUNT'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>




        <div class="form-section">
            <br><br>
            <hr>
            <br><br>
            <h3>Toll Collections</h3>

            
        </div>
        <div class="table-section">
            <br>
            <h4>collection List</h4>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Collection ID</th>
                        <th>Collection Date</th>
                        
                      
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td>
                            3001
                        </td>
                        <td>
                        2024-02-01
                        </td>
 
                    </tr>
                    <tr>
                        <td>
                            3002
                        </td>
                        <td>
                        2024-02-03
                        </td>
 
                    </tr>
                    <tr>
                        <td>
                            3003
                        </td>
                        <td>
                        2024-02-07
                        </td>
 
                    </tr>
                    <tr>
                        <td>
                            3004
                        </td>
                        <td>
                        2024-02-13
                        </td>
 
                    </tr>
                    <tr>
                        <td>
                            3005
                        </td>
                        <td>
                        2024-02-16
                        </td>
 
                    </tr>
                </tbody>
            </table>
        </div>



    <?php    include "user_prof.php" ?>



       

    </div>

 

    <a href="logout.php" class="logout"> Logout </a>

</body>

</html>

<?php
oci_close($conn);

?>