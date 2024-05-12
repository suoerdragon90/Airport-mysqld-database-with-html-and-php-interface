<?php
include 'db_connection.php';
$conn = OpenCon();
if ($conn == true) {
    echo '<p class="text-center">Connection Established</p>';
}
$conn = OpenCon();
$Airline_code = "";
$Name = "";
$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (!empty($_GET['Airline_code'])) {
        $Airline_code = $_GET["Airline_code"];
        $sql = "SELECT * FROM airline WHERE Airline_code = '$Airline_code'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $Airline_code = $row["Airline_code"];
            $Name = $row["Name"];
        } else {
            header("Location: ../airline.php");
            exit;
        }
    } else {
        header("Location: ../airline.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $Airline_code = $_POST["Airline_code"];
    $Name = $_POST["Name"];
    if (empty($Name) ) {
        $errorMessage = "All fields are required.";
    } else {
        $sql = "UPDATE airline SET Name = '$Name' WHERE Airline_code = '$Airline_code'";
        if ($conn->query($sql) === TRUE) {
            $successMessage = "Record updated successfully";
            header("Location: ../airline.php");
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
    <title>airline</title>
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
            <input type="hidden" name="Airline_code" value="<?php echo $Airline_code; ?>">
            <div class="form-group">
                <label for="Airline_code">Airline code:</label>
                <input type="text" class="form-control" Airline_code="Airline_code" name="Airline_code" placeholder="Enter Airline code" value="<?php echo $Airline_code; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="Name">Name:</label>
                <input type="text" class="form-control" airportcode="Name" name="Name" placeholder="Enter Name" value="<?php echo $Name; ?>">
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