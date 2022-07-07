<?php

class Airport
{
    public $id;
    public $name;
    public $code;
    public $lat;
    public $lng;

    public function __construct($id, $name, $code, $lat, $lng)
    {
        $this->id = $id;
        $this->name = $name;
        $this->code = $code;
        $this->lat = $lat;
        $this->lng = $lng;
    }
}

class Flight
{
    public $code_departure;
    public $code_arrival;
    public $price;

    public function __construct($code_departure, $code_arrival, $price)
    {
        $this->code_departure = $code_departure;
        $this->code_arrival = $code_arrival;
        $this->price = $price;
    }
}

$flightsArray = [];

for ($i = 0; $i <= 4; $i++) {

    $flightRand = new Flight('JFK' . '-' . rand(1, 20), 'LAX' . '-' . rand(1, 20), rand(20, 100));

    array_push($flightsArray, $flightRand);
}

$airportArray = [];

$nyAirport = new Airport('1', 'John F. Kennedy International Airport', 'JFK', 40.641766, 73.780968);

$laAirport = new Airport('2', 'Los Angeles International Airport', 'LAX', 33.942791, 118.410042);

array_push($airportArray, $nyAirport, $laAirport);

$prices = [];

foreach ($flightsArray as $flightPrice) {
    array_push($prices, $flightPrice->price);
}


$cheapestPrice = min($prices);

$bestPrice = array_filter(
    $flightsArray,
    function ($flight) use ($cheapestPrice) {
        return $flight->price == $cheapestPrice;
    }
);

$codeDeparture;
$codeArrival;

foreach ($bestPrice as $el) {
    $codeDeparture = $el->code_departure;
    $codeArrival = $el->code_arrival;
}

$departureName;
$arriveName;

foreach ($airportArray as $el) {
    if ($codeDeparture == strpos($codeDeparture, $el->code)) {
        $departureName = $el->name;
    } else {
        $arriveName = $el->name;
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>LT-FLIGHTS</title>
</head>

<body>

    <div class="d-flex">
        <div class="container p-5">
            <div>
                <div>
                    <h3 class="text-center">Departures/Arrives List</h3>
                </div>
            </div>

            <div>
                <table class="table table-sm table-dark my-4">
                    <thead>
                        <tr>
                            <th scope="col">Departure Name</th>
                            <th scope="col">Airport Code</th>
                            <th scope="col">Arrive Name</th>
                            <th scope="col">Arrival Code</th>
                            <th scope="col">Price</th>
                    </thead>
                    <tbody>
                        <tr>
                            <?php
                            foreach ($flightsArray as $oneFlight) {
                            ?>
                            <td> <?php echo $departureName ?></th>
                            <td> <?php echo $oneFlight->code_departure ?></th>
                            <td><?php echo $arriveName ?></td>
                            <td><?php echo $oneFlight->code_arrival ?></td>
                            <td><?php echo $oneFlight->price . '$' ?></td>
                        </tr>
                        <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="container p-5">
            <div>
                <div>
                    <h3 class="text-center">Lowest Price</h3>
                </div>
            </div>
            <div>
                <table class="table table-sm table-dark my-4">
                    <thead>
                        <tr>
                            <th scope="col">Departure Name</th>
                            <th scope="col">Airport Code</th>
                            <th scope="col">Arrive Name</th>
                            <th scope="col">Arrival Code</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <?php
                            foreach ($bestPrice as $flight) {
                            ?>
                            <td> <?php echo $departureName ?></th>
                            <td><?php echo $flight->code_departure ?></td>
                            <td><?php echo $arriveName ?></td>
                            <td><?php echo $flight->code_arrival ?></td>
                            <td><?php echo $flight->price . '$' ?> </td>
                        </tr>
                        <?php
                            }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>