<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leg instance</title>
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
        <h2>Leg instance records</h2>
        <a class="btn btn-primary" href="submit/leg_instance_submit.php">New record</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Leg instance id</th>
                    <th>Date</th>
                    <th>Departure time</th>
                    <th>Arrival Airport</th>
                    <th>Arrival time</th>
                    <th>Leg number</th>
                    <th>Airplane id</th>
                    <th>Number of available seats</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql ="SELECT * FROM Leg_instance;";
                $result = $conn->query($sql);
                if (!$result){
                    die("Invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Leg_instance_id]</td>
                    <td>$row[Date]</td>
                    <td>$row[Departure_time]</td>
                    <td>$row[Arrival_Airport]</td>
                    <td>$row[Arrival_time]</td>
                    <td>$row[Leg_number]</td>
                    <td>$row[Airplane_id]</td>
                    <td>$row[Number_of_available_seats]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit/leg_instance_edit.php?Leg_instance_id=$row[Leg_instance_id]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?Leginstanceid=$row[Leg_instance_id]'>Delete</a>
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