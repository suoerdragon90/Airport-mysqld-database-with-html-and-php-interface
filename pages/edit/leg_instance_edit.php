<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}

$Leg_instance_id = "";
$Date = ""; 
$Departure_time = "";
$Arrival_Airport = "";
$Arrival_time = "";
$Leg_number = "";
$Airplane_id = "";
$Number_of_available_seats = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['Leg_instance_id'])) {
        $Leg_instance_id = $_GET["Leg_instance_id"];
        $sql = "SELECT * FROM Leg_instance WHERE Leg_instance_id = '$Leg_instance_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Leg_instance_id = $row["Leg_instance_id"];
            $Date = $row["Date"];
            $Departure_time = $row["Departure_time"];
            $Arrival_Airport = $row["Arrival_Airport"];
            $Arrival_time = $row["Arrival_time"];
            $Leg_number = $row["Leg_number"];
            $Airplane_id = $row["Airplane_id"];
            $Number_of_available_seats = $row["Number_of_available_seats"];
        } else {
            header("Location: ../leg_instance.php");
            exit;
        }
    } else {
        header("Location: ../leg_instance.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Leg_instance_id = $_POST["Leg_instance_id"];
    $Date = $_POST["Date"];
    $Departure_time = $_POST["Departure_time"];
    $Arrival_Airport = $_POST["Arrival_Airport"];
    $Arrival_time = $_POST["Arrival_time"];
    $Leg_number = $_POST["Leg_number"];
    $Airplane_id = $_POST["Airplane_id"];
    $Number_of_available_seats = $_POST["Number_of_available_seats"];

    if (empty($Leg_instance_id) || empty($Date) || empty($Departure_time) || empty($Arrival_Airport) || empty($Arrival_time) || 
        empty($Leg_number) || empty($Airplane_id) || empty($Number_of_available_seats)) {
        $errorMessage = "All fields are required.";
    } else {
        $sql = "UPDATE Leg_instance 
                SET Date = '$Date', 
                    Departure_time = '$Departure_time', 
                    Arrival_Airport = '$Arrival_Airport', 
                    Arrival_time = '$Arrival_time', 
                    Leg_number = '$Leg_number', 
                    Airplane_id = '$Airplane_id', 
                    Number_of_available_seats = '$Number_of_available_seats' 
                WHERE Leg_instance_id = '$Leg_instance_id'";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Record updated successfully";
            header("Location: ../leg_instance.php");
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
    <title>Leg Instance</title>
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
                <label for="Leg_instance_id">Leg Instance ID:</label>
                <input type="text" class="form-control" id="Leg_instance_id" name="Leg_instance_id" placeholder="Enter Leg Instance ID" value="<?php echo $Leg_instance_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Date">Date:</label>
                <input type="date" class="form-control" id="Date" name="Date" placeholder="Select Date" value="<?php echo $Date; ?>">
            </div>
            <div class="form-group">
                <label for="Departure_time">Departure Time:</label>
                <input type="time" class="form-control" id="Departure_time" name="Departure_time" placeholder="Select Departure Time" value="<?php echo $Departure_time; ?>">
            </div>
            <div class="form-group">
                <label for="Arrival_Airport">Arrival Airport:</label>
                <input type="text" class="form-control" id="Arrival_Airport" name="Arrival_Airport" placeholder="Enter Arrival Airport" value="<?php echo $Arrival_Airport; ?>">
            </div>
            <div class="form-group">
                <label for="Arrival_time">Arrival Time:</label>
                <input type="time" class="form-control" id="Arrival_time" name="Arrival_time" placeholder="Select Arrival Time" value="<?php echo $Arrival_time; ?>">
            </div>
            <div class="form-group">
                <label for="Leg_number">Leg Number:</label>
                <input type="number" class="form-control" id="Leg_number" name="Leg_number" placeholder="Enter Leg Number" value="<?php echo $Leg_number; ?>">
            </div>
            <div class="form-group">
                <label for="Airplane_id">Airplane ID:</label>
                <input type="text" class="form-control" id="Airplane_id" name="Airplane_id" placeholder="Enter Airplane ID" value="<?php echo $Airplane_id; ?>">
            </div>
            <div class="form-group">
                <label for="Number_of_available_seats">Number of Available Seats:</label>
                <input type="number" class="form-control" id="Number_of_available_seats" name="Number_of_available_seats" placeholder="Enter Number of Available Seats" value="<?php echo $Number_of_available_seats; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../leg_instance.php" role="button">Cancel</a>
        </form>
