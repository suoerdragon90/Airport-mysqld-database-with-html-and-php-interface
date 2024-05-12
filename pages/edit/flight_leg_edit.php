<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">Connection Established</p>';
}
$Leg_number = "";
$scheduled_Departure_time = "";
$scheduled_Arrival_time = "";
$Departure_Airport = "";
$Flight_number = "";
$Arrival_Airport = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['Leg_number'])) {
        $Leg_number = $_GET["Leg_number"];
        $sql = "SELECT * FROM flight_leg WHERE Leg_number = '$Leg_number'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Leg_number = $row["Leg_number"];
            $scheduled_Departure_time = $row["scheduled_Departure_time"];
            $scheduled_Arrival_time = $row["scheduled_Arrival_time"];
            $Departure_Airport = $row["Departure_Airport"];
            $Flight_number = $row["Flight_number"];
            $Arrival_Airport = $row["Arrival_Airport"];
        } else {
            header("Location: ../flight_leg.php");
            exit;
        }
    } else {
        header("Location: ../flight_leg.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Leg_number = $_POST["Leg_number"];
    $scheduled_Departure_time = $_POST["scheduled_Departure_time"];
    $scheduled_Arrival_time = $_POST["scheduled_Arrival_time"];
    $Departure_Airport = $_POST["Departure_Airport"];
    $Flight_number = $_POST["Flight_number"];
    $Arrival_Airport = $_POST["Arrival_Airport"];
    if (empty($scheduled_Departure_time) || empty($scheduled_Arrival_time) || empty($Departure_Airport) ||empty($Flight_number) || empty($Arrival_Airport)) {
        $errorMessage = "All fields are required.";
    } else {
        $sql = "UPDATE flight_leg SET scheduled_Departure_time = '$scheduled_Departure_time', scheduled_Arrival_time = '$scheduled_Arrival_time', Departure_Airport = '$Departure_Airport',Flight_number = '$Flight_number', Arrival_Airport = '$Arrival_Airport' WHERE Leg_number = '$Leg_number'";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Record updated successfully";
            header("Location: ../flight_leg.php");
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
    <title>flight_leg</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New Record</h2>
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
            <input type="hidden" name="Leg_number" value="<?php echo $Leg_number; ?>">
            <div class="form-group">
                <label for="Leg_number">Leg number:</label>
                <input type="text" class="form-control" Leg_number="Leg_number" name="Leg_number" placeholder="Enter Leg number" value="<?php echo $Leg_number; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="scheduled_Departure_time">scheduled Departure time:</label>
                <input type="text" class="form-control" Leg_number="scheduled_Departure_time" name="scheduled_Departure_time" placeholder="Enter scheduled Departure time" value="<?php echo $scheduled_Departure_time; ?>" >
            </div>
            <div class="form-group">
                <label for="scheduled_Arrival_time">scheduled_Arrival_time:</label>
                <input type="text" class="form-control" Leg_number="scheduled_Arrival_time" name="scheduled_Arrival_time" placeholder="Enter scheduled Arrival time" value="<?php echo $scheduled_Arrival_time; ?>">
            </div>
            <div class="form-group">
                <label for="Departure_Airport">Departure Airport:</label>
                <input type="text" class="form-control" Leg_number="Departure_Airport" name="Departure_Airport" placeholder="Enter Departure Airport" value="<?php echo $Departure_Airport; ?>">
            </div>
            <div class="form-group">
                <label for="Flight_number">Flight_number:</label>
                <input type="text" class="form-control" Leg_number="Flight_number" name="Flight_number" placeholder="Enter Flight number" value="<?php echo $Flight_number; ?>">
            </div>
            <div class="form-group">
                <label for="Arrival_Airport">Arrival Airport:</label>
                <input type="text" class="form-control" Leg_number="Arrival_Airport" name="Arrival_Airport" placeholder="Enter Arrival Airport" value="<?php echo $Arrival_Airport; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../flight_leg.php" role="button">Cancel</a>
        </form>

    </div>

</body>

</html>