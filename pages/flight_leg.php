<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight leg</title>
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
        <h2>Flight leg records</h2>
        <a class="btn btn-primary" href="submit/flight_leg_submit.php">New record</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Leg number</th>
                    <th>scheduled Departure time</th>
                    <th>scheduled Arrival time</th>
                    <th>Departure Airport</th>
                    <th>Flight number</th>
                    <th>Arrival Airport</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql ="SELECT * FROM flight_leg;";
                $result = $conn->query($sql);
                if (!$result){
                    die("Invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Leg_number]</td>
                    <td>$row[scheduled_Departure_time]</td>
                    <td>$row[scheduled_Arrival_time]</td>
                    <td>$row[Departure_Airport]</td>
                    <td>$row[Flight_number]</td>
                    <td>$row[Arrival_Airport]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit/flight_leg_edit.php?Leg_number=$row[Leg_number]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?legnumber=$row[Leg_number]'>Delete</a>
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