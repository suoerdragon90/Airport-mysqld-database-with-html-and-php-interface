<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}
$flight_number = "";
$weekdays = "";
$airline_code = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $flight_number = $_POST["flight_number"];
    $weekdays = $_POST["weekdays"];
    $airline_code = $_POST["airline_code"];
    $errorMessage = "";
    $successMessage = "";

    do {
        if (empty($flight_number) || empty($weekdays) || empty($airline_code)) {
            $errorMessage = "All fields are required.";
            break;
        }

        // Check if the Flight Number already exists
        $checkQuery = "SELECT * FROM flight WHERE Flight_number = '$flight_number'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Flight Number already exists. Please use a different number.";
            break;
        }

        // Insert the new record if no duplicate Flight Number found
        $insertQuery = "INSERT INTO flight (Flight_number, Weekdays, Airline_code) VALUES ('$flight_number', '$weekdays', '$airline_code')";

        if ($conn->query($insertQuery) === TRUE) {
            $successMessage = "Record added successfully";
            header("Location: ../flight.php");
            exit;
        } else {
            $errorMessage = "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    } while (false);
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>flight</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
</head>

<body>
    <div class="container">
        <form method="post">
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
            <div class="form-group">
                <label for="flight_number">Flight Number:</label>
                <input type="text" class="form-control" id="flight_number" name="flight_number" placeholder="Enter Flight Number" value="<?php echo $flight_number; ?>">
            </div>
            <div class="form-group">
                <label for="weekdays">Weekdays:</label>
                <input type="text" class="form-control" id="weekdays" name="weekdays" placeholder="Enter Weekdays" value="<?php echo $weekdays; ?>">
            </div>
            <div class="form-group">
                <label for="airline_code">Airline Code:</label>
                <input type="text" class="form-control" id="airline_code" name="airline_code" placeholder="Enter Airline Code" value="<?php echo $airline_code; ?>">
            </div>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../airline.php" role="button">Cancel</a>
        </form>
    </div>
</body>

</html>