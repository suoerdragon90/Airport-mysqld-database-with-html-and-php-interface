<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}

$airlineCode = "";
$airlineName = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $airlineCode = $_POST["airlineCode"];
    $airlineName = $_POST["airlineName"];
    
    $errorMessage = "";
    $successMessage = "";

    do {
        if (empty($airlineCode) || empty($airlineName)) {
            $errorMessage = "Both the Airline Code and Name are required.";
            break;
        }

        // Check if the Airline Code already exists
        $checkQuery = "SELECT * FROM Airline WHERE Airline_code = '$airlineCode'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Airline Code already exists. Please use a different code.";
            break;
        }

        // Insert the new record if no duplicate Airline Code found
        $insertQuery = "INSERT INTO Airline (Airline_code, name) VALUES ('$airlineCode', '$airlineName')";

        if ($conn->query($insertQuery) === TRUE) {
            $successMessage = "Record added successfully";
            header("Location: ../airline.php");
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
    <title>Airline</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New Airline Record</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <div class="form-group">
                <label for="airlineCode">Airline Code:</label>
                <input type="text" class="form-control" id="airlineCode" name="airlineCode" placeholder="Enter Airline Code" value="<?php echo $airlineCode; ?>">
            </div>
            <div class="form-group">
                <label for="airlineName">Airline Name:</label>
                <input type="text" class="form-control" id="airlineName" name="airlineName" placeholder="Enter Airline Name" value="<?php echo $airlineName; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../airline.php" role="button">Cancel</a>
        </form>

    </div>

</body>

</html>