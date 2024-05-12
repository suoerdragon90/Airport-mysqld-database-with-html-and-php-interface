<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">';
    echo 'Connection Established';
    echo '</p>';
}
$Airplane_id = "";
$Total_num_of_seats = "";
$Airplane_type_id = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Airplane_id = $_POST["Airplane_id"];
    $Total_num_of_seats = $_POST["Total_num_of_seats"];
    $Airplane_type_id = $_POST["Airplane_type_id"];
    $errorMessage = "";
    $successMessage = "";

    do {
        if (empty($Airplane_id) || empty($Total_num_of_seats) || empty($Airplane_type_id)) {
            $errorMessage = "All fields are required.";
            break;
        }

        // Check if the Airplane Type Name already exists
        $checkQuery = "SELECT * FROM Airplane WHERE Airplane_id = '$Airplane_id'";
        $checkResult = $conn->query($checkQuery);

        if ($checkResult->num_rows > 0) {
            $errorMessage = "Airplane_id already exists. Please use a different name.";
            break;
        }

        // Insert the new record if no duplicate Airplane_id found
        $insertQuery = "INSERT INTO Airplane (Airplane_id, Total_num_of_seats, Airplane_type_id) VALUES ('$Airplane_id', '$Total_num_of_seats', '$Airplane_type_id')";

        if ($conn->query($insertQuery) === TRUE) {
            $successMessage = "Record added successfully";
            header("Location: ../airplane.php");
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
    <title>Airplane</title>
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
                <label for="Airplane_id">Airplane id:</label>
                <input type="text" class="form-control" id="Airplane_id" name="Airplane_id" placeholder="Enter Airplane id" value="<?php echo $Airplane_id; ?>">
            </div>
            <div class="form-group">
                <label for="Total_num_of_seats">Total num of seats:</label>
                <input type="text" class="form-control" id="Total_num_of_seats" name="Total_num_of_seats" placeholder="Enter Total number of seats" value="<?php echo $Total_num_of_seats; ?>">
            </div>
            <div class="form-group">
                <label for="Airplane_type_id">Airplane type id:</label>
                <input type="text" class="form-control" id="Airplane_type_id" name="Airplane_type_id" placeholder="Enter Airplane type id" value="<?php echo $Airplane_type_id; ?>">
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