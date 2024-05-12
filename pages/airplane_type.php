<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Airplane_type</title>
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
        <h2>Airplane type records</h2>
        <a class="btn btn-primary" href="submit/airplane_type_submit.php">New record</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Airplane Type name</th>
                    <th>Manufacturing name</th>
                    <th>Max number of seats</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql ="SELECT * FROM airplane_type;";
                $result = $conn->query($sql);
                if (!$result){
                    die("Invalid query:" . $conn->error);
                }
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <tr>
                    <td>$row[Airplane_Type_name]</td>
                    <td>$row[Manufacturing_name]</td>
                    <td>$row[Max_num_of_seats]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='edit/airplane_type_edit.php?airplaneTypeName=$row[Airplane_Type_name]'>Edit</a>
                        <a class='btn btn-primary btn-sm' href='delete.php?AirplaneTypename=$row[Airplane_Type_name]'>Delete</a>
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