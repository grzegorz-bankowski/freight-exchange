<?php

namespace App\Views;

$env = parse_ini_file('../.env');

if(isset($_POST['SaveAsPdf'])) {
    require_once "../Helpers/SaveLoadAsPdf.php";
}
?>
<!DOCTYPE html>
<html lang="pl" xmlns="http://www.w3.org/1999/html">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $env['GOOGLE_MAP_API_KEY']; ?>"></script>
    <link rel="stylesheet" href="css/load.css">
    <script src="<?php echo $env['FONTAWESOME_LINK']; ?>" crossorigin="anonymous"></script>
    <script>
        function initMap() {
            const addresses = <?php echo json_encode($addresses) ?>;

            const geocoder = new google.maps.Geocoder();
            const results = [];
            const map = new google.maps.Map(document.getElementById('map'), {
                center: { lat: 37.422, lng: -122.084 }, // Default center
                zoom: 10
            });

            let geocodeCount = 0;

            addresses.forEach((address, index) => {
                geocoder.geocode({ 'address': address }, function(geocodeResults, status) {
                    if (status === 'OK') {
                        const location = geocodeResults[0].geometry.location;
                        results[index] = location;

                        // Create markers with titles indicating if it's origin or destination
                        new google.maps.Marker({
                            map: map,
                            position: location,
                            title: index === 0 ? 'A' : 'B'
                        });

                        geocodeCount++;

                        // Once both addresses are geocoded, calculate the route
                        if (geocodeCount === addresses.length) {
                            calculateRoute(results[0], results[1], map);
                        }
                    } else {
                        console.error('Geocode was not successful for:', address, 'Reason:', status);
                    }
                });
            });
        }

        function calculateRoute(startLocation, endLocation, map) {
            const directionsService = new google.maps.DirectionsService();
            const directionsRenderer = new google.maps.DirectionsRenderer();

            directionsRenderer.setMap(map);

            const request = {
                origin: startLocation,
                destination: endLocation,
                travelMode: google.maps.TravelMode.DRIVING
            };

            directionsService.route(request, function(result, status) {
                if (status === google.maps.DirectionsStatus.OK) {
                    directionsRenderer.setDirections(result);
                } else {
                    console.error('Directions request failed due to', status);
                }
            });
        }
    </script>
</head>
<body id="body" onload="initMap();">
<div id="navbar">
    <a href="./orders">Orders</a>
    <a href="./offers">Offers</a>
    <a href="./find-load">Find load</a>
    <a href="./find-vehicle">Find vehicle</a>
    <a href="./profile">Profile</a>
    <a href="./settings">Settings</a>
    <a href="./logout">Sign out</a>
</div>
<div class="kontener">
    <div class="sidebar">
        <header>
            <a href="#" class="logo"><img src="img/1.jpg" style="max-width:100%; max-height:100%;"></a>
        </header>
        <a href="./orders"><i class="fas fa-home"></i>Orders</a>
        <a href="./offers"><i class="fas fa-address-card"></i>Offers</a>
        <a href="./find-load" class="active"><i class="fas fa-pallet"></i>Find load</a>
        <a href="./find-vehicle"><i class="fas fa-truck"></i>Find vehicle</a>
        <a href="./profile"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="./settings"><i class="fas fa-cog"></i>Settings</a>
        <a href="./logout"><i class="fas fa-sign-out-alt"></i>Sign out</a>
    </div>
    <div class="content">
        <div class="navbar">
            <ul>
                <li class="cargo">
                    <a href="./add-load"><i class="fas fa-pallet"></i>Add load</a>
                </li>
                <li class="vehicle">
                    <a href="./add-vehicle"><i class="fas fa-truck"></i>Add vehicle</a>
                </li>
                <li class="company">
                    <i class="far fa-user-circle fa-2x" style="margin: 0 10px 0 10px; align;"></i><?php echo $_SESSION['name'] ?>
                </li>
            </ul>
        </div>
        <main class="general">
            <h1 class="settings">Load order #<?php echo $load['id'] ?></h1>
            <h2>All details about this load are below.</h2>
            <div class="form">
                <form action="" method="post">
                    <div class="left">
                        <p>Origin</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['places'] . "<br>" . $load['streets'] . "<br>" . $load['codes'] . ' ' . $load['citys'] . ', ' . $load['countrys'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Load date & time</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['dates'] . "<span style=\"color:red\"> | </span>" . $load['times'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Destination</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['placed'] . "<br>" . $load['streetd'] . "<br>" . $load['coded'] . ' ' . $load['cityd'] . ', ' . $load['countryd'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p for="street">Arrival date & time</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['dated'] . "<span style=\"color:red\"> | </span>" . $load['timed'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Trailer</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['trailer'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Weight</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['weight'] . ' ' . 'kg' ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Type of good</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['type_of_good'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Number of packages</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['number_of_package'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Type of packages</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['type_of_package'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Distance</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['distance'] . ' ' . 'km' ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Payrate</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['payrate'] . ' ' . $load['currency'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Rate per km</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['rate_per_km'] . ' ' . $load['currency']; ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Description</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['description'] ?></p>
                    </div>
            </div>
            <h1 class="settings">Load owner</h1>
            <h2>If you have any questions, you can contact with owner of this load.</h2>
            <div class="form">
                <form action="/password/change" method="post">
                    <div class="left">
                        <label for="phone">Phone</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['phone'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>E-mail</p>
                    </div>
                    <div class="right">
                        <p><?php echo $load['email'] ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <p>Website</p>
                    </div>
                    <div class="right" style="page-break-after: always;">
                        <p><?php echo $load['website'] ?></p>
                    </div>
                    <hr class="form" />
                    <a href="javascript:history.back()" class="back" style="background-color: red; text-decoration: none;">Back</a>
                    <form method="post">
                        <input type="submit" name="SaveAsPdf" style="background-color: #FF9900" value="Save as pdf">
                    </form>
                    <a class="print" onclick="window.print();">Print</a>
                </form>
            </div>
        </main>
        <main class="route">
            <h1 class="drive">Drive map</h1>
            <div id="map"></div>
        </main>
    </div>
</div>
</body>
</html>