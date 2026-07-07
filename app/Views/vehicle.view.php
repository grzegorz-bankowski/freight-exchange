<?php

namespace App\Views;

$env = parse_ini_file('../.env');

if(isset($_POST['SaveAsPdf'])) {
    require_once '../Helpers/SaveVehicleAsPdf.php';
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $env['GOOGLE_MAP_API_KEY']; ?>"></script>
    <link rel="stylesheet" href="css/vehicle.css">
    <script src="<?php echo $env['FONTAWESOME_LINK']; ?>" crossorigin="anonymous"></script>
    <script>
        function initMap() {
            var address = <?php echo json_encode($origin) ?>
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({ 'address': address }, function(results, status) {
                if (status === 'OK') {
                    var map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 15,
                        center: results[0].geometry.location
                    });
                    var marker = new google.maps.Marker({
                        map: map,
                        position: results[0].geometry.location
                    });
                } else {
                    alert('Geocode was not successful for the following reason: ' + status);
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
        <a href="./find-load"><i class="fas fa-pallet"></i>Find load</a>
        <a href="./find-vehicle" class="active"><i class="fas fa-truck"></i>Find vehicle</a>
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
                    <i class="far fa-user-circle fa-2x" style="margin: 0 10px 0 10px; align;"></i><?php echo htmlspecialchars($_SESSION['name']) ?>
                </li>
            </ul>
        </div>
        <main class="general">
            <h1 class="settings">Vehicle order #<?php echo $vehicle['id'] ?></h1>
            <div class="form">
                <form action="" method="post">
                    <div class="left">
                        <label for="name">Origin</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['places']) . "<br>" . htmlspecialchars($vehicle['streets']) . "<br>" . htmlspecialchars($vehicle['codes']) . ' ' . htmlspecialchars($vehicle['citys']) . ', ' . htmlspecialchars($vehicle['countrys']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="street">Date & time of loading</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['dates']) . ', ' . htmlspecialchars($vehicle['times']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="city">Destination</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['countryd']) . ', ' . htmlspecialchars($vehicle['coded']) . ' ' . htmlspecialchars($vehicle['cityd']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="street">Date and time of arrival</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['dated']) . ', ' . htmlspecialchars($vehicle['timed']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="code">Trailer</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['trailer']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="country">Max weight</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['weight']) . ' ' . 'kg' ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="vat">Distance</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['distance']) . ' ' . 'km' ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="vat">Payrate</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['payrate']) . ' ' . htmlspecialchars($vehicle['currency']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="vat">Rate per km</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['rate_per_km']) . ' ' . htmlspecialchars($vehicle['currency']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="vat">Description</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['description']) ?></p>
                    </div>
            </div>
            <h1 class="settings">Vehicle owner</h1>
            <h2>Below are the contact details of the vehicle owner</h2>
            <div class="form">
                <form action="/password/change" method="post">
                    <div class="left">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['phone']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['email']) ?></p>
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="website">Website</label>
                    </div>
                    <div class="right">
                        <p><?php echo htmlspecialchars($vehicle['website']) ?></p>
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
            <h1 class="drive">Truck origin map</h1>
            <div id="map"></div>
        </main>
    </div>
</div>
</body>
</html>