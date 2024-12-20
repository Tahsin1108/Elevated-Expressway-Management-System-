<?php
session_start();
ob_start();

if (!isset($_SESSION['x'])) 
{
	header("Location: login.php");
}	

include "db_con.php";

include "vehicles.php";

include "toll_rates.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/design.css">
</head>


<body>
    <div class="dashboard-top">
        <h1>Dhaka Elevated Expressway</h1>
        <h2>Admin Dashboard</h2>
    </div>

    <div class="dashboard">
        <div class="content-1">
            <div class="form-section">
                <h3>Vehicles</h3>
                <h4>Manage Vehicles</h4>
                <br>
                <form action="#" method="post">
                    <label for="vehicle_id">Vehicle ID:</label>
                    <input type="text" id="vehicle_id" name="vehicle_id" required>
                    <label for="user_id">User ID:</label>
                    <input type="text" id="user_id" name="user_id" required>
                    <label for="vehicle_type">Vehicle Type:</label>
                    <input type="text" id="vehicle_type" name="vehicle_type" required>
                    <label for="owner_name">Owner Name:</label>
                    <input type="text" id="owner_name" name="owner_name" required>
                    <button type="submit" name="add_vehicle">Add</button>
                    
                </form>
            </div>
            <div class="table-section">
                <br>
                <h4>Vehicle List</h4>
                <br>
                <table>
                    <thead>
                        <tr>
                            <th>Vehicle ID</th>
                            <th>User ID</th>
                            <th>Vehicle Type</th>
                            <th>Owner Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($vehicles as $vehicle) : ?>
                            <tr>
                                <td><?php echo $vehicle['VEHICLE_ID']; ?></td>
                                <td><?php echo $vehicle['USER_ID']; ?></td>
                                <td><?php echo $vehicle['VEHICLE_TYPE']; ?></td>
                                <td><?php echo $vehicle['OWNER_NAME']; ?></td>
                                <td>
                                    <form action="#" method="post">
                                        <input type="hidden" name="vehicle_id" value="<?php echo $vehicle['VEHICLE_ID']; ?>">
                                        <input type="hidden" name="user_id" value="<?php echo $vehicle['USER_ID']; ?>">
                                        <input type="text" name="vehicle_type" value="<?php echo $vehicle['VEHICLE_TYPE']; ?>" required>
                                        <input type="text" name="owner_name" value="<?php echo $vehicle['OWNER_NAME']; ?>" required>
                                        <button type="submit" name="update_vehicle">Edit</button>
                                        <button class="delete" type="submit" name="delete_vehicle">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

       
        <div class="content-1">
        <div class="form-section">
            <br><br>
            <hr>
            <br><br>
            <h3>Toll Rates</h3>

            <h4>Manage Rate</h4>
            <br>
            <form action="#" method="post">
                <label for="toll_id">Toll ID:</label>
                <input type="text" id="toll_id" name="toll_id" required>
                <label for="vehicle_type">Vehicle Type:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" required>
                <label for="total_amount">Toll Amount:</label>
                <input type="text" id="toll_amount" name="toll_amount" required>
                <button type="submit" name="add_toll_rate">Add</button>
                
            </form>
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
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tollRates as $tollRate) : ?>
                        <tr>
                            <td><?php echo $tollRate['TOLL_ID']; ?></td>
                            <td><?php echo $tollRate['VEHICLE_TYPE']; ?></td>
                            <td><?php echo $tollRate['TOLL_AMOUNT']; ?></td>
                            <td>
                                <button type="submit">Edit</button>
                                <button class="delete" type="submit">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="form-section">
            <br><br>
            <hr>
            <br><br>
            <h3>Toll Collections</h3>

            <h4>Manage Collection</h4>
            <br>
            <form action="#" method="post">
                <label for="vehicle_id">Collection ID:</label>
                <input type="text" id="vehicle_id" name="vehicle_id" value="3000" required>
                <label for="vehicle_type">Collection Date:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" value="2024-02-01" required>
                <!-- <label for="owner_name">Total Amount:</label>
                <input type="text" id="owner_name" name="owner_name" value="80" required> -->
                <button type="submit">Add</button>
                
            </form>
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
                        <!-- <th>Total Amount</th> -->
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            3000
                        </td>
                        <td>
                        2024-02-01
                        </td>
                        <!-- <td>
                            80
                        </td> -->
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            3001
                        </td>
                        <td>
                        2024-02-03
                        </td>
                        <!-- <td>
                            100
                        </td> -->
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-section">
            <br><br>
            <hr>
            <br><br>
            <h3>Expressway Traffic</h3>

            <h4>Manage Traffic</h4>
            <br>
            <form action="#" method="post">
                <label for="vehicle_id">Traffic ID:</label>
                <input type="text" id="vehicle_id" name="vehicle_id" value="4000" required>
                <label for="vehicle_type">Traffic Date:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" value="2024-02-01" required>
                <label for="owner_name">Vehicle Count:</label>
                <input type="text" id="owner_name" name="owner_name" value="3652" required>
                <button type="submit">Add</button>
               
            </form>
        </div>
        <div class="table-section">
            <br>
            <h4>Traffic List</h4>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Traffic ID</th>
                        <th>Traffic Date</th>
                        <th>Vehicle Count</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            4000
                        </td>
                        <td>
                        2024-02-01
                        </td>
                        <td>
                            3652
                        </td>
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            4001
                        </td>
                        <td>
                        2024-02-03
                        </td>
                        <td>
                            2212
                        </td>
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-section">
            <br><br>
            <hr>
            <br><br>
            <h3>Investors</h3>

            <h4>Manage Investors</h4>
            <br>
            <form action="#" method="post">
                <label for="vehicle_id">Investor ID:</label>
                <input type="text" id="vehicle_id" name="vehicle_id" value="5000" required>
                <label for="vehicle_type">Investor Name:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" value="Italian Thai Development Public Company Limited" required>
                <label for="owner_name">Share Percentage:</label>
                <input type="text" id="owner_name" name="owner_name" value="51" required>
                <button type="submit">Add</button>
                
            </form>
        </div>
        <div class="table-section">
            <br>
            <h4>Investor List</h4>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Investor ID</th>
                        <th>Investor Name</th>
                        <th>Share Percentage</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            5000
                        </td>
                        <td>
                        Italian Thai Development Public Company Limited
                        </td>
                        <td>
                            51
                        </td>
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5001
                        </td>
                        <td>
                        China Shandong International Economic and Technical Cooperation 
                        </td>
                        <td>
                            34
                        </td>
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            5002
                        </td>
                        <td>
                        Sinohydro Corporation Limited
                        </td>
                        <td>
                            15
                        </td>
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="form-section">
            <br><br>
            <hr>
            <br><br>
            <h3>Expressway Section</h3>

            <h4>Manage Section</h4>
            <br>
            <form action="#" method="post">
                <label for="vehicle_id">Section ID:</label>
                <input type="text" id="vehicle_id" name="vehicle_id" value="6000" required>
                <label for="vehicle_type">Section Name:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" value="Kawla to Tejgaon" required>
                <label for="owner_name">Length(km):</label>
                <input type="text" id="owner_name" name="owner_name" value="11.5" required>
                <label for="owner_name">Inauguration Date:</label>
                <input type="text" id="owner_name" name="owner_name" value="2023-09-2" required>
                <button type="submit">Add</button>
                
            </form>
        </div>
        <div class="table-section">
            <br>
            <h4>Section List</h4>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>Section ID</th>
                        <th>Section Name</th>
                        <th>Length(km)</th>
                        <th>Inauguration Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            6000
                        </td>
                        <td>
                        Kawla to Tejgaon
                        </td>
                        <td>
                            11.5
                        </td>
                        <td>
                            2023-09-2
                        </td>
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            6001
                        </td>
                        <td>
                        Tejgaon to Mohakhali
                        </td>
                        <td>
                            4.23
                        </td>

                        <td>
                        2023-09-2
                        </td>
                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="form-section">
            <br><br>
            <hr>
            <br><br>
            <h3>Users</h3>

            <h4>Manage Users</h4>
            <br>
            <form action="#" method="post">
                <label for="vehicle_id">User ID:</label>
                <input type="text" id="vehicle_id" name="vehicle_id" value="7000" required>
                <label for="vehicle_type">User Name:</label>
                <input type="text" id="vehicle_type" name="vehicle_type" value="Amzad Khan" required>
                <label for="owner_name">Password:</label>
                <input type="text" id="owner_name" name="owner_name" value="pass123" required>
                
                <button type="submit">Add</button>
                
            </form>
        </div>
        <div class="table-section">
            <br>
            <h4>User List</h4>
            <br>
            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Password</th>
                    
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            7000
                        </td>
                        <td>
                        Amzad Khan
                        </td>
                        <td>
                        pass123
                        </td>

                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            7001
                        </td>
                        <td>
                        Tariq Aziz
                        </td>
                        <td>
                            abc456
                        </td>

                        <td>
                            <button type="submit">Edit</button>
                            <button class="delete" type="submit">Delete</button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>

        <div class="content-1">
            <div class="admin-details">

            <?php include "admin_prof.php"; ?>  
             </div>
         
         </div>
        <!-- Add other sections of the dashboard below -->
    



    </div>



    <a href="logout.php" class="logout"> Logout </a>
</body>

</html>

<?php
oci_close($conn);

?>
	



