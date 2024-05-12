<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airplane</title>
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
        <h2>Airplane records</h2>
        <a class="btn btn-primary" href="submit/airplane_submit.php">New record</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Airplane id</th>
                    <th>Total number of seats</th>
                    <th>Airplane type id</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql ="SELECT * FROM airplane;";
                $result = $conn->query($sql);
                if (!$result){
                    die("Invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Airplane_id]</td>
                    <td>$row[Total_num_of_seats]</td>
                    <td>$row[Airplane_type_id]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit/airplane_edit.php?Airplane_id=$row[Airplane_id]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?airplaneid=$row[Airplane_id]'>Delete</a>
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