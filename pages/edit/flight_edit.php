<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">Connection Established</p>';
}

$flight_number = "";
$weekdays = "";
$airline_code = "";
$errorMessage = "";
$successMessage = "";

// Fetch original record data if flight_number is provided via GET
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['flight_number'])) {
        $flight_number = $_GET["flight_number"];
        $sql = "SELECT * FROM flight WHERE Flight_number = '$flight_number'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $flight_number = $row["Flight_number"];
            $weekdays = $row["weekdays"];
            $airline_code = $row["Airline_code"];
        } else {
            header("Location: ../flight.php");
            exit;
        }
    } else {
        header("Location: ../flight.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flight_number = $_POST["flight_number"];
    $weekdays = $_POST["weekdays"];
    $airline_code = $_POST["airline_code"];

    if (empty($weekdays) || empty($airline_code)) {
        $errorMessage = "All fields are required.";
    } else {
        $sql = "UPDATE flight SET Weekdays = '$weekdays', Airline_code = '$airline_code' WHERE Flight_number = '$flight_number'";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Record updated successfully";
            header("Location: ../flight.php");
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
    <title>Flight</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Edit Record</h2>
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
            <input type="hidden" name="flight_number" value="<?php echo $flight_number; ?>">
            <div class="form-group">
                <label for="flight_number">Flight Number:</label>
                <input type="text" class="form-control" id="flight_number" name="flight_number" placeholder="Enter Flight Number" value="<?php echo $flight_number; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="weekdays">Weekdays:</label>
                <input type="text" class="form-control" id="weekdays" name="weekdays" placeholder="Enter Weekdays" value="<?php echo $weekdays; ?>">
            </div>
            <div class="form-group">
                <label for="airline_code">Airline Code:</label>
                <input type="text" class="form-control" id="airline_code" name="airline_code" placeholder="Enter Airline Code" value="<?php echo $airline_code; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../flight.php" role="button">Cancel</a>
        </form>

    </div>

</body>

</html>
