<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}

$Reservation_id = "";
$Customer_name = "";
$Phone = "";
$Seat_number = "";
$Leg_instance_id = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['Reservation_id'])) {
        $Reservation_id = $_GET["Reservation_id"];
        $sql = "SELECT * FROM Reservation WHERE Reservation_id = '$Reservation_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Reservation_id = $row["Reservation_id"];
            $Customer_name = $row["customer_name"];
            $Phone = $row["Phone"];
            $Seat_number = $row["Seat_number"];
            $Leg_instance_id = $row["Leg_instance_id"];
        } else {
            header("Location: ../reservation.php");
            exit;
        }
    } else {
        header("Location: ../reservation.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Reservation_id = $_POST["Reservation_id"];
    $Customer_name = $_POST["Customer_name"];
    $Phone = $_POST["Phone"];
    $Seat_number = $_POST["Seat_number"];
    $Leg_instance_id = $_POST["Leg_instance_id"];

    if (empty($Reservation_id) || empty($Customer_name) || empty($Phone) || empty($Seat_number) || empty($Leg_instance_id)) {
        $errorMessage = "All fields are required.";
    } else {
        $sql = "UPDATE Reservation 
                SET Customer_name = '$Customer_name', 
                    Phone = '$Phone', 
                    Seat_number = '$Seat_number', 
                    Leg_instance_id = '$Leg_instance_id' 
                WHERE Reservation_id = '$Reservation_id'";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Record updated successfully";
            header("Location: ../reservation.php");
            exit;
        } else {
            $errorMessage = "Error updating record: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Update Reservation</h2>
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
                <label for="Reservation_id">Reservation ID:</label>
                <input type="text" class="form-control" id="Reservation_id" name="Reservation_id" placeholder="Enter Reservation ID" value="<?php echo $Reservation_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Customer_name">Customer Name:</label>
                <input type="text" class="form-control" id="Customer_name" name="Customer_name" placeholder="Enter Customer Name" value="<?php echo $Customer_name; ?>">
            </div>
            <div class="form-group">
                <label for="Phone">Phone:</label>
                <input type="text" class="form-control" id="Phone" name="Phone" placeholder="Enter Phone Number" value="<?php echo $Phone; ?>">
            </div>
            <div class="form-group">
                <label for="Seat_number">Seat Number:</label>
                <input type="text" class="form-control" id="Seat_number" name="Seat_number" placeholder="Enter Seat Number" value="<?php echo $Seat_number; ?>">
            </div>
            <div class="form-group">
                <label for="Leg_instance_id">Leg Instance ID:</label>
                <input type="text" class="form-control" id="Leg_instance_id" name="Leg_instance_id" placeholder="Enter Leg Instance ID" value="<?php echo $Leg_instance_id; ?>">
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
