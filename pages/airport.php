<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airport</title>
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
        <h2>Airport records</h2>
        <a class="btn btn-primary" href="submit/airport_submit.php">New record</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Airport code</th>
                    <th>Airport name</th>
                    <th>City</th>
                    <th>State</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql ="SELECT * FROM airport;";
                $result = $conn->query($sql);
                if (!$result){
                    die("Invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Airport_code]</td>
                    <td>$row[Airport_name]</td>
                    <td>$row[City]</td>
                    <td>$row[State]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit/airport_edit.php?airportcode=$row[Airport_code]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?airportcode=$row[Airport_code]'>Delete</a>
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