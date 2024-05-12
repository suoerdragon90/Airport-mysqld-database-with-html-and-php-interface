<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight</title>
    <?php
    include 'db_connection.php';
    $conn = OpenCon();
    if ($conn==true) {
        echo '<p class="text-center">';
        echo 'Connection Established';
        echo '</p>';
    }

    ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
</head>

<body>
    <div class="container my-5">
        <h2>Flight records</h2>
        <a class="btn btn-primary" href="submit/flight_submit.php">New record</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Flight number</th>
                    <th>weekdays</th>
                    <th>Airline code</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql ="SELECT * FROM flight;";
                $result = $conn->query($sql);
                if (!$result){
                    die("Invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Flight_number]</td>
                    <td>$row[weekdays]</td>
                    <td>$row[Airline_code]</td>
                    <td>
                    <a class='btn btn-primary btn-sm' href='edit/flight_edit.php?flight_number=$row[Flight_number]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?flightnumber=$row[Flight_number]'>Delete</a>
                    </td>
                </tr>
                    ";
                }

                ?>
            </tbody>
        </table>

    </div>
</body>

</html>