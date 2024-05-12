<?php
include 'db_connection.php';
$conn = OpenCon();
if (isset($_GET["airportcode"])) {
    $airportcode = $_GET["airportcode"];
    $sql = "DELETE FROM airport WHERE Airport_code = '$airportcode'";
    $conn->query($sql);
    header("Location:airport.php");
    exit;
}
if (isset($_GET["airlinecode"])) {
    $airlinecode = $_GET["airlinecode"];
    $sql = "DELETE FROM airline WHERE Airline_code = '$airlinecode'";
    $conn->query($sql);
    header("Location:airline.php");
    exit;
}
if (isset($_GET["flightnumber"])) {
    $flightnumber = $_GET["flightnumber"];
    $sql = "DELETE FROM flight WHERE Flight_number	 = '$flightnumber'";
    $conn->query($sql);
    header("Location:flight.php");
    exit;
}
if (isset($_GET["legnumber"])) {
    $legnumber = $_GET["legnumber"];
    $sql = "DELETE FROM flight_leg WHERE Leg_number = '$legnumber'";
    $conn->query($sql);
    header("Location:flight_leg.php");
    exit;
}
if (isset($_GET["AirplaneTypename"])) {
    $AirplaneTypename = $_GET["AirplaneTypename"];
    $sql = "DELETE FROM airplane_type WHERE Airplane_Type_name = '$AirplaneTypename'";
    $conn->query($sql);
    header("Location:airplane_type.php");
    exit;
}
if (isset($_GET["airplaneid"])) {
    $airplaneid = $_GET["airplaneid"];
    $sql = "DELETE FROM airplane WHERE Airplane_id = '$airplaneid'";
    $conn->query($sql);
    header("Location:airplane.php");
    exit;
}
if (isset($_GET["Leginstanceid"])) {
    $Leginstanceid = $_GET["Leginstanceid"];
    $sql = "DELETE FROM leg_instance WHERE Leg_instance_id = '$Leginstanceid'";
    $conn->query($sql);
    header("Location:leg_instance.php");
    exit;
}
if (isset($_GET["Reservationid"])) {
    $Reservationid = $_GET["Reservationid"];
    $sql = "DELETE FROM reservation WHERE Reservation_id = '$Reservationid'";
    $conn->query($sql);
    header("Location:reservation.php");
    exit;
}
