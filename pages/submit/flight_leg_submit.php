<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}
$Leg_number = "";
$scheduled_Departure_time = "";
$scheduled_Arrival_time = "";
$Departure_Airport = "";
$Flight_number = "";
$Arrival_Airport = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Leg_number = $_POST["Leg_number"];
    $scheduled_Departure_time = $_POST["scheduled_Departure_time"];
    $scheduled_Arrival_time = $_POST["scheduled_Arrival_time"];
    $Departure_Airport = $_POST["Departure_Airport"];
    $Flight_number = $_POST["Flight_number"];
    $Arrival_Airport = $_POST["Arrival_Airport"];
    
    $errorMessage = "";
    $successMessage = "";

    do {
        if (empty($Leg_number) || empty($scheduled_Departure_time) || empty($scheduled_Arrival_time) || empty($Departure_Airport) || empty($Flight_number) || empty($Arrival_Airport)) {
            $errorMessage = "All fields are required.";
            break;
        }

        // Check if the Leg_number already exists
        $checkQuery = "SELECT * FROM flight_leg WHERE Leg_number = '$Leg_number'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Leg_number already exists. Please use a different Leg_number.";
            break;
        }

        // Insert the new record if no duplicate Leg_number found
        $insertQuery = "INSERT INTO flight_leg (Leg_number, scheduled_Departure_time, scheduled_Arrival_time, Departure_Airport, Flight_number, Arrival_Airport) VALUES ('$Leg_number', '$scheduled_Departure_time', '$scheduled_Arrival_time', '$Departure_Airport', '$Flight_number', '$Arrival_Airport')";

        if ($conn->query($insertQuery) === TRUE) {
            $successMessage = "Record added successfully";
            header("Location: ../flight_leg.php");
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flight leg</title>
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
            <div class="form-group">
            <label for="Leg_number">Leg Number:</label>
            <input type="text" class="form-control" id="Leg_number" name="Leg_number" placeholder="Enter Leg Number" value="<?php echo $Leg_number; ?>">
            </div>
            <div class="form-group">
            <label for="scheduled_Departure_time">Scheduled Departure Time:</label>
            <input type="text" class="form-control" id="scheduled_Departure_time" name="scheduled_Departure_time" placeholder="Enter Scheduled Departure Time" value="<?php echo $scheduled_Departure_time; ?>">
            </div>
            <div class="form-group">
            <label for="scheduled_Arrival_time">Scheduled Arrival Time:</label>
            <input type="text" class="form-control" id="scheduled_Arrival_time" name="scheduled_Arrival_time" placeholder="Enter Scheduled Arrival Time" value="<?php echo $scheduled_Arrival_time; ?>">
            </div>
            <div class="form-group">
            <label for="Departure_Airport">Departure Airport:</label>
            <input type="text" class="form-control" id="Departure_Airport" name="Departure_Airport" placeholder="Enter Departure Airport" value="<?php echo $Departure_Airport; ?>">
            </div>
            <div class="form-group">
            <label for="Flight_number">Flight Number:</label>
            <input type="text" class="form-control" id="Flight_number" name="Flight_number" placeholder="Enter Flight Number" value="<?php echo $Flight_number; ?>">
            </div>
            <div class="form-group">
            <label for="Arrival_Airport">Arrival Airport:</label>
            <input type="text" class="form-control" id="Arrival_Airport" name="Arrival_Airport" placeholder="Enter Arrival Airport" value="<?php echo $Arrival_Airport; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../airplane.php" role="button">Cancel</a>
        </form>

    </div>

</body>

</html>