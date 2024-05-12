<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">Connection Established</p>';
}
$airportcode = "";
$airportname = "";
$city = "";
$state = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['airportcode'])) {
        $airportcode = $_GET["airportcode"];
        $sql = "SELECT * FROM airport WHERE Airport_code = '$airportcode'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $airportcode = $row["Airport_code"];
            $airportname = $row["Airport_name"];
            $city = $row["City"];
            $state = $row["State"];
        } else {
            header("Location: ../airport.php");
            exit;
        }
    } else {
        header("Location: ../airport.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $airportcode = $_POST["airportcode"];
    $airportname = $_POST["airportname"];
    $city = $_POST["city"];
    $state = $_POST["state"];

    if (empty($airportname) || empty($city) || empty($state)) {
        $errorMessage = "All fields are required.";
    } else {
        $sql = "UPDATE airport SET Airport_name = '$airportname', City = '$city', State = '$state' WHERE Airport_code = '$airportcode'";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Record updated successfully";
            header("Location: ../airport.php");
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
    <title>Airport</title>
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
            <input type="hidden" name="airportcode" value="<?php echo $airportcode; ?>">
            <div class="form-group">
                <label for="airportcode">Airport Code:</label>
                <input type="text" class="form-control" airportcode="airportcode" name="airportcode" placeholder="Enter Airport Code" value="<?php echo $airportcode; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="airportname">Airport name:</label>
                <input type="text" class="form-control" airportcode="airportname" name="airportname" placeholder="Enter Airport name" value="<?php echo $airportname; ?>">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" airportcode="city" name="city" placeholder="Enter city name" value="<?php echo $city; ?>">
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" airportcode="state" name="state" placeholder="Enter state name" value="<?php echo $state; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../airport.php" role="button">Cancel</a>
        </form>

    </div>

</body>

</html>