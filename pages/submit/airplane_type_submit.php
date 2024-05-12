<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}
$airplaneTypeName = "";
$manufacturingName = "";
$maxNumOfSeats = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $airplaneTypeName = $_POST["airplaneTypeName"];
    $manufacturingName = $_POST["manufacturingName"];
    $maxNumOfSeats = $_POST["maxNumOfSeats"];
    $errorMessage = "";
    $successMessage = "";

    do {
        if (empty($airplaneTypeName) || empty($manufacturingName) || empty($maxNumOfSeats)) {
            $errorMessage = "All fields are required.";
            break;
        }

        // Check if the Airplane Type Name already exists
        $checkQuery = "SELECT * FROM Airplane_type WHERE Airplane_Type_name = '$airplaneTypeName'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Airplane Type Name already exists. Please use a different name.";
            break;
        }

        // Insert the new record if no duplicate Airplane Type Name found
        $insertQuery = "INSERT INTO Airplane_type (Airplane_Type_name, Manufacturing_name, Max_num_of_seats) 
                        VALUES ('$airplaneTypeName', '$manufacturingName', '$maxNumOfSeats')";

        if ($conn->query($insertQuery) === TRUE) {
            $successMessage = "Record added successfully";
            header("Location: ../airplane_type.php");
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
    <title>Airplane Type</title>
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
                <label for="airplaneTypeName">Airplane Type Name:</label>
                <input type="text" class="form-control" id="airplaneTypeName" name="airplaneTypeName" placeholder="Enter Airplane Type Name" value="<?php echo $airplaneTypeName; ?>">
            </div>
            <div class="form-group">
                <label for="manufacturingName">Manufacturing Name:</label>
                <input type="text" class="form-control" id="manufacturingName" name="manufacturingName" placeholder="Enter Manufacturing Name" value="<?php echo $manufacturingName; ?>">
            </div>
            <div class="form-group">
                <label for="maxNumOfSeats">Max Number of Seats:</label>
                <input type="text" class="form-control" id="maxNumOfSeats" name="maxNumOfSeats" placeholder="Enter Maximum Number of Seats" value="<?php echo $maxNumOfSeats; ?>">
            </div>
            <br>
            <?php
            if (!empty($successMessage)) {
                echo $successMessage;
            }
            ?>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a class="btn btn-outline-primary" href="../airplane_type.php" role="button">Cancel</a>
        </form>

    </div>

</body>

</html>