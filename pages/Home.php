<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="pages.css">
</head>

<body>
    <?php
    include 'db_connection.php';
    $conn = OpenCon();
    if ($conn == true) {
        echo '<p class="text-center">';
        echo 'Connection Established';
        echo '</p>';
    }

    ?>
    <p class="text-center">Home : Press the above buttons to access their respective tables</p>

</body>

</html>