<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <link rel="stylesheet" href="css/find-load.css">
    <script src="<?php echo $env['FONTAWESOME_LINK']; ?>" crossorigin="anonymous"></script>
    <script>
        function setColspan() {
            const cell = document.getElementById('myCell');
            if (window.innerWidth <= 1350) { // Mobile devices
                cell.setAttribute('colspan', '6'); // Set colspan for mobile
            } else {
                cell.setAttribute('colspan', '9'); // Set colspan for larger screens
            }
        }
        window.addEventListener('resize', setColspan);
    </script>
</head>
<body onload="setColspan()">
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
                    <i class="far fa-user-circle fa-2x" style="margin: 0 10px 0 10px; align;"></i><p style="display: inline-block; font-size: 16px; line-height: 16px; vertical-align: middle"><?php $name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; echo htmlspecialchars($name); ?></p>
                </li>
            </ul>
        </div>
        <main class="general">
            <h1 class="settings">Find vehicle</h1>
            <section class="main-content">
                <form action="./find-vehicle" class="form">
                    <div class="form-group">
                            <label class="right-inline" for="country">Country</label>
                                <select class="input-control" id="country" name="origin">
                                    <?php
                                    require_once PATH . 'app/Helpers/countries.php';
                                    $country = '';
                                    foreach($countries as $country) {
                                        if ($country == $origin) {
                                            echo "<option value='$country' selected>$country</option>";
                                        } else {
                                            echo "<option value='$country'>$country</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            <label class="right-inline" for="start_city">City</label>
                            <input class="input-control" type="text" name="start_city" value="<?php if (isset($_GET['start_city'])) { echo $_GET['start_city']; } ?>" />
                            <label class="right-inline" for="destination">Country</label>
                                <select class="input-control" id="country" name="destination">
                                    <?php
                                    require_once PATH . 'app/Helpers/countries.php';
                                    $country = '';
                                    foreach($countries as $country) {
                                        if ($country == $destination) {
                                            echo "<option value='$country' selected>$country</option>";
                                        } else {
                                            echo "<option value='$country'>$country</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            <label class="right-inline" for="start_city">City</label>
                            <input class="input-control" type="text" name="end_city" value="<?php if (isset($_GET['end_city'])) { echo $_GET['end_city']; } ?>" />
                    </div>
                        <div class="form-group">
                            <label class="right-inline" for="weight_min">Weight min</label>
                            <input class="input-control" type="number" name="weight_min" value="<?php if (isset($_GET['weight_min'])) { echo $_GET['weight_min']; } ?>" />
                            <label class="right-inline" for="weight_max">Weight max</label>
                            <input class="input-control" type="number" name="weight_max" value="<?php if (isset($_GET['weight_max'])) { echo $_GET['weight_max']; } ?>" />
                            <label class="right-inline" for="trailer">Trailer</label>
                            <select class="input-control" d="trailer" name="trailer">
                                <?php
                                require_once PATH . 'app/Helpers/trailers.php';
                                $trailer_type = '';
                                foreach ($trailers as $trailer_type) {
                                    if ($trailer_type == $trailer) {
                                        echo "<option value='$trailer_type' selected>$trailer_type</option>";
                                    } else {
                                        echo "<option value='$trailer_type'>$trailer_type</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <button style="font-size:0.875rem; line-height:1;">Search</button>
                        </div>
                </form>
            </section>
            <h1 class="settings">All vehicle offers</h1>
            <?php
            use App\Classes\Paginator;
            if ($vehicles !== 0) {
                define('PERPAGE', 5);
                define('OFFSET', 'offset');
                $offset = @$_GET[OFFSET];
                if (!isset($offset)) {
                    $totaloffset = 0;
                } else {
                    $totaloffset = $offset * PERPAGE;
                }
                $totalcount = $total;
                $numpages = ceil($totalcount / PERPAGE);
                $pagename = basename($_SERVER['PHP_SELF']);
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
                foreach ($vehicles as $vehicle) {
                    echo "<tr>";
                    echo "<td>" . $vehicle['id'] . "</td>";
                    echo "<td>" . $vehicle['codes'] . " " . $vehicle['citys'] . ", " . $vehicle['countrys'] . "<br /><span class=\"light\" style=\"color: #FF9900;\">" . $vehicle['dates'] . "</span>" . "<span class=\"light\" style=\"color:#04AA6D\">" . ", " . $vehicle['times'] . "</span></td>";
                    echo "<td>" . $vehicle['coded'] . " " . $vehicle['cityd'] . ", " . $vehicle['countryd'] . "<br /><span class=\"light\" style=\"color: #FF9900;\">" . $vehicle['dated'] . "</span>" . "<span class=\"light\" style=\"color:#04AA6D\">" . ", " . $vehicle['timed'] . "</span></td>";
                    echo "<td>" . $vehicle['trailer'] . "</td>";
                    echo "<td class=\"weight\">" . $vehicle['weight'] . "</td>";
                    echo "<td class=\"distance\">" . $vehicle['distance'] . "</td>";
                    echo "<td>" . $vehicle['payrate'] . "</td>";
                    echo "<td class=\"rpk\">" . $vehicle['rate_per_km'] . "</td>";
                    echo "<td><a href=/vehicle?id=" . $vehicle['id'] . "&action=more><span class=show>More</span></a><a href=/vehicle?id=" . $vehicle['id'] . "&action=reserve><span class=edit>Reserve</span></a></td>";
                    echo "</tr>";
                }
                echo "<tr style=\"border:0; background-color: white\">";
                echo "<td colspan=\"9\" id=\"myCell\" class=\"paginator\" style=\"border:0;background-color: white\">";
                if ($numpages > 1) {
                    $paginator = new Paginator($pagename, $totalcount, PERPAGE, $totaloffset);
                    $paginator->SetFirstParamName(OFFSET);
                    $paginator->origin = $origin;
                    $paginator->start_city = $start_city;
                    $paginator->destination = $destination;
                    $paginator->end_city = $end_city;
                    $paginator->weight_min = $weight_min;
                    $paginator->weight_max = $weight_max;
                    $paginator->trailer = $trailer;
                    echo $paginator->getNavigator();
                }
                echo "</td>";
                echo "</tr>";
                echo "</table>";
            } else {
                echo "<h4 style=\"color:red; margin:50px 0 50px 50px;\">We not have any vehicle offers</h4>";
            }
            ?>
        </main>
    </div>
</div>
</body>
</html>