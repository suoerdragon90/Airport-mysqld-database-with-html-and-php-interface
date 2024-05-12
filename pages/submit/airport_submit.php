<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}
$airportcode = "";
$airportname = "";
$city = "";
$state = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $airportcode = $_POST["airportcode"];
    $airportname = $_POST["airportname"];
    $city = $_POST["city"];
    $state = $_POST["state"];
    $errorMessage = "";
    $successMessage = "";

    do {
        if (empty($airportcode) || empty($airportname) || empty($city) || empty($state)) {
            $errorMessage = "All fields are required.";
            break;
        }

        
        $checkQuery = "SELECT * FROM airport WHERE Airport_code = '$airportcode'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Airport Code already exists. Please use a different code.";
            break;
        }

        
        $insertQuery = "INSERT INTO airport (Airport_code, Airport_name, City, State) VALUES ('$airportcode', '$airportname', '$city', '$state')";

        if ($conn->query($insertQuery) === TRUE) {
            $successMessage = "Record added successfully";
            header("Location: ../airport.php");
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
            <div class="form-group">
                <label for="airportcode">Airport Code:</label>
                <input type="text" class="form-control" id="airportcode" name="airportcode" placeholder="Enter Airport Code" value="<?php echo $airportcode; ?>">
            </div>
            <div class="form-group">
                <label for="airportname">Airport name:</label>
                <input type="text" class="form-control" id="airportname" name="airportname" placeholder="Enter Airport name" value="<?php echo $airportname; ?>">
            </div>
            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Enter city name" value="<?php echo $city; ?>">
            </div>
            <div class="form-group">
                <label for="state">State:</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Enter state name" value="<?php echo $state; ?>">
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