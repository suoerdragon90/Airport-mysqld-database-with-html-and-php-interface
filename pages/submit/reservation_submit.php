<?php
include 'db_connection.php';
$conn = OpenCon();

$Reservation_id = "";
$Customer_name = "";
$Phone = "";
$Seat_number = "";
$Leg_instance_id = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Reservation_id = $_POST["reservation_id"];
    $Customer_name = $_POST["customer_name"];
    $Phone = $_POST["phone"];
    $Seat_number = $_POST["seat_number"];
    $Leg_instance_id = $_POST["leg_instance_id"];
    $errorMessage = "";
    $successMessage = "";

    do {
        if (empty($Reservation_id) || empty($Customer_name) || empty($Phone) || empty($Seat_number) || empty($Leg_instance_id)) {
            $errorMessage = "All fields are required.";
            break;
        }

        // Check if the Reservation ID already exists
        $checkQuery = "SELECT * FROM Reservation WHERE Reservation_id = '$Reservation_id'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Reservation ID already exists. Please use a different ID.";
            break;
        }

        // Insert the new record if no duplicate Reservation ID found
        $insertQuery = "INSERT INTO Reservation (Reservation_id, Customer_name, Phone, Seat_number, Leg_instance_id) 
                        VALUES ('$Reservation_id', '$Customer_name', '$Phone', '$Seat_number', '$Leg_instance_id')";

        if ($conn->query($insertQuery) === TRUE) {
            $successMessage = "Record added successfully";
            header("Location: ../reservation.php");
            exit;
        } else {
            $errorMessage = "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Reservation</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label for="reservation_id">Reservation ID:</label>
                <input type="text" class="form-control" id="reservation_id" name="reservation_id" placeholder="Enter Reservation ID" value="<?php echo $Reservation_id; ?>">
            </div>
            <div class="form-group">
                <label for="customer_name">Customer Name:</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Enter Customer Name" value="<?php echo $Customer_name; ?>">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone Number" value="<?php echo $Phone; ?>">
            </div>
            <div class="form-group">
                <label for="seat_number">Seat Number:</label>
                <input type="text" class="form-control" id="seat_number" name="seat_number" placeholder="Enter Seat Number" value="<?php echo $Seat_number; ?>">
            </div>
            <div class="form-group">
                <label for="leg_instance_id">Leg Instance ID:</label>
                <input type="text" class="form-control" id="leg_instance_id" name="leg_instance_id" placeholder="Enter Leg Instance ID" value="<?php echo $Leg_instance_id; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../reservation.php" role="button">Cancel</a>
        </form>
    </div>
</body>
</html>