<?php

use App\Classes\Notify;

if (isset($_GET['load'])) {
    if ($_GET['load'] == 'reserved') {
        require_once "../Classes/Notify.php";
        $info = new Notify();
        $info->Info('You have successfully reserved load');
    }
} elseif (isset($_GET['vehicle'])) {
    if ($_GET['vehicle'] == 'reserved') {
        require_once "../Classes/Notify.php";
        $info = new Notify();
        $info->Info('You have successfully reserved vehicle');
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <link rel="stylesheet" href="css/orders.css">
    <script src="<?php echo $env['FONTAWESOME_LINK']; ?>" crossorigin="anonymous"></script>
    <script src="js/zephyr-toast.js"></script>
    <link rel="stylesheet" href="js/zephyr-toast.css">
    <link rel="stylesheet" href="js/zephyr-toast-animate.css">
</head>
<body>
<div id="navbar">
    <a href="./orders">Orders</a>
    <a href="./offers">Offers</a>
    <a href="./find-load">Find load</a>
    <a href="./find-vehicle">Find vehicle</a>
    <a href="./profile">Profile</a>
    <a href="./settings">Settings</a>
    <a href="./logout">Sign out</a>
</div>
<div id="toast-container"></div>
<div class="kontener">
    <div class="sidebar">
        <header>
            <a href="#" class="logo"><img src="img/1.jpg" style="max-width:100%; max-height:100%;"></a>
        </header>
        <a href="./orders" class="active"><i class="fas fa-home"></i>Orders</a>
        <a href="./offers"><i class="fas fa-address-card"></i>Offers</a>
        <a href="./find-load"><i class="fas fa-pallet"></i>Find load</a>
        <a href="./find-vehicle"><i class="fas fa-truck"></i>Find vehicle</a>
        <a href="./profile"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="./settings"><i class="fas fa-cog"></i>Settings</a>
        <a href="./logout"><i class="fas fa-sign-out-alt"></i>Sign out</a>
    </div>
        <div class="navbar">
            <ul>
                <li class="cargo">
                    <a href="./add-load"><i class="fas fa-pallet"></i>Add load</a>
                </li>
                <li class="vehicle">
                    <a href="./add-vehicle"><i class="fas fa-truck"></i>Add vehicle</a>
                </li>
                <li class="company">
                    <i class="far fa-user-circle fa-2x" style="margin: 0 10px 0 10px; align;"></i><p style="display: inline-block; font-size: 16px; line-height: 16px; vertical-align: middle"><?php $name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; echo htmlspecialchars($name); ?></p>
                </li>
            </ul>
        </div>
        <main class="general">
            <h1 class="settings">Your load orders</h1>
            <h2>Here you will find your load reservations.</h2>
            <?php
            if ($loads !== 0) {
                echo "<table class=\"mobile\">
                        <tr class=\"desc\">
                            <th>#</th>
                            <th class=\"location\">Origin</th>
                            <th class=\"destination\">Destination</th>
                            <th>Trailer</th>
                            <th class=\"weight\">Weight</th>
                            <th class=\"distance\">Distance</th>
                            <th>Payrate</th>
                            <th class=\"rpk\">Rate per km</th>
                            <th>Manage</th>
                        </tr>";
                        foreach ($loads as $load) {
                            echo "<tr>";
                            echo "<td class=\"id\">" . $load['id'] . "</td>";
                            echo "<td>" . $load['codes'] . " " . $load['citys'] . ", " . $load['countrys'] . "<br /><span class=\"light\" style=\"color: #FF9900;\">" . $load['dates'] . "</span>" . "<span class=\"light\" style=\"color:#04AA6D\">" . ", " . $load['times'] . "</span></td>";
                            echo "<td>" . $load['coded'] . " " . $load['cityd'] . ", " . $load['countryd'] . "<br /><span class=\"light\" style=\"color: #FF9900;\">" . $load['dated'] . "</span>" . "<span class=\"light\" style=\"color:#04AA6D\">" . ", " . $load['timed'] . "</span></td>";
                            echo "<td>" . $load['trailer'] . "</td>";
                            echo "<td class=\"weight\">" . $load['weight'] . ' ' . 'kg' . "</td>";
                            echo "<td class=\"distance\">" . $load['distance'] . ' ' . 'kg' . "</td>";
                            echo "<td>" . $load['payrate'] . ' ' . $load['currency'] . "</td>";
                            echo "<td class=\"rpk\">" . $load['rate_per_km'] . ' ' . $load['currency'] . "</td>";
                            echo "<td><a href=./load?id=" . $load['id'] . "&action=more><span class=\"show\">More</span></a><a href=./orders?id=" . $load['id'] . "&action=load-cancel><span class=\"delete\">Cancel</span></a></td>";
                            echo "</tr>";
                        }
                echo "</table>";
            } else {
                echo "<h4 class=\"alert\">You not have any loads reservations</h4>";
            }
            ?>
            <h1 class="settings">Your vehicle orders</h1>
            <h2>Here you will find your vehicle reservations.</h2>
            <?php
            if($vehicles !== 0) {
                echo "<table class=\"mobile\">
                        <tr class=\"desc\">
                            <th>#</th>
                            <th class=\"location\">Starting location</th>
                            <th class=\"destination\">Destination</th>
                            <th>Trailer type</th>
                            <th class=\"weight\">Weight</th>
                            <th class=\"distance\">Distance</th>
                            <th>Payrate</th>
                            <th class=\"rpk\">Rate per km</th>
                            <th>Manage</th>
                        </tr>";
                foreach ($vehicles as $vehicle) {
                    echo "<tr>";
                    echo "<td class=\"id\">" . $vehicle['id'] . "</td>";
                    echo "<td>" . $vehicle['codes'] . " " . $vehicle['citys'] .  ", " . $vehicle['countrys'] . "<br /><span class=\"light\" style=\"color: #FF9900;\">" . $vehicle['dates'] . "</span>" . "<span class=\"light\" style=\"color:#04AA6D\">" . ", " . $vehicle['times'] . "</span></td>";
                    echo "<td>" . $vehicle['coded'] . " " . $vehicle['cityd'] .  ", " . $vehicle['countryd'] . "<br /><span class=\"light\" style=\"color: #FF9900;\">" . $vehicle['dated'] . "</span>" . "<span class=\"light\" style=\"color:#04AA6D\">" . ", " . $vehicle['timed'] . "</span></td>";
                    echo "<td>" . $vehicle['trailer'] . "</td>";
                    echo "<td class=\"weight\">" . $vehicle['weight'] . ' ' . 'kg' . "</td>";
                    echo "<td class=\"distance\">" . $vehicle['distance'] . ' ' . 'kg' . "</td>";
                    echo "<td>" . $vehicle['payrate'] . ' ' . $vehicle['currency'] . "</td>";
                    echo "<td class=\"rpk\">" . $vehicle['rate_per_km'] . ' ' . $vehicle['currency'] . "</td>";
                    echo "<td><a href=./vehicle?id=" . $vehicle['id'] . "&action=more><span class=\"show\">More</span></a><a href=./orders?id=" . $vehicle['id'] . "&action=vehicle-cancel><span class=\"delete\">Cancel</span></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<h4 class=\"alert\">You not have any vehicle reservations</h4>";
            }
            ?>
        </main>
    </div>
</body>
</html>