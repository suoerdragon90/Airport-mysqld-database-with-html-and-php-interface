document.addEventListener('DOMContentLoaded', function () {
    const buttons = document.querySelectorAll('button');

    buttons.forEach(button => {
        button.addEventListener('click', function () {

            const activeButton = document.querySelector('button.active');
            if (activeButton) {
                activeButton.classList.remove('active');
            }


            this.classList.add('active');
        });
    });
});



document.getElementById("Airport").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/airport.php");
}
document.getElementById("Airline").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/airline.php");
}
document.getElementById("Flight").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/flight.php");
}
document.getElementById("FlightLeg").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/flight_leg.php");
}
document.getElementById("Airplane_Type").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/airplane_type.php");
}
document.getElementById("Airplane").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/airplane.php");
}
document.getElementById("LegInstance").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/leg_instance.php");
}
document.getElementById("Reservation").onclick = function () {
    document.getElementById("frame").setAttribute("src", "pages/reservation.php");
}



