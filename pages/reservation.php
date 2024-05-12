<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation</title>
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
        <h2>Reservation records</h2>
        <a class="btn btn-primary" href="submit/reservation_submit.php">New record</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Reservation id</th>
                    <th>customer name</th>
                    <th>Phone</th>
                    <th>Seat number</th>
                    <th>Leg instance id</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql ="SELECT * FROM Reservation;";
                $result = $conn->query($sql);
                if (!$result){
                    die("Invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Reservation_id]</td>
                    <td>$row[customer_name]</td>
                    <td>$row[Phone]</td>
                    <td>$row[Seat_number]</td>
                    <td>$row[Leg_instance_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit/reservation_edit.php?Reservation_id=$row[Reservation_id]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?Reservationid=$row[Reservation_id]'>Delete</a>
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