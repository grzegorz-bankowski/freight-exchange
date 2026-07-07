<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <link rel="stylesheet" href="css/add-load.css">
    <script src="<?php echo $env['FONTAWESOME_LINK']; ?>" crossorigin="anonymous"></script>
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
<div class="kontener">
    <div class="sidebar">
        <header>
            <a href="#" class="logo"><img src="img/1.jpg" style="max-width:100%; max-height:100%;"></a>
        </header>
        <a href="./orders"><i class="fas fa-home"></i>Orders</a>
        <a href="./offers" class="active"><i class="fas fa-address-card"></i>Offers</a>
        <a href="./find-load"><i class="fas fa-pallet"></i>Find load</a>
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
                    <i class="far fa-user-circle fa-2x" style="margin: 0 10px 0 10px; align;"></i><p style="display: inline-block; font-size: 16px; line-height: 16px; vertical-align: middle"><?php $name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; echo htmlspecialchars($name); ?></p>
                </li>
            </ul>
        </div>
        <main class="general">
            <h1 class="settings">Edit vehicle offer</h1>
            <section class="main-content">
                <form action="./offers?id=<?php echo $vehicle['id']; ?>&action=update-vehicle" method="post" class="form">
                    <h2>Origin details</h2>
                        <div class="form-group">
                            <label class="right-inline" for="places">Name of place <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="places" id="places" value="<?php if (isset($vehicle['places'])) { echo $vehicle['places']; } ?>" autofocus required>
                            <label class="right-inline" for="countrys">Country <span style="color:red">*</span></label>
                            <select class="input-control" id="countrys" name="countrys" required>
                                <?php
                                require_once '../Helpers/countries.php';
                                $countrys = '';
                                foreach($countries as $countrys) {
                                    if ($countrys == $vehicle['countrys']) {
                                        echo "<option value='$countrys' selected>$countrys</option>";
                                    } else {
                                        echo "<option value='$countrys'>$countrys</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="right-inline" for="citys">City <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="citys" id="citys" value="<?php if (isset($vehicle['citys'])) { echo htmlspecialchars($vehicle['citys']); } ?>" required>
                            <label class="right-inline" for="codes">Postal code <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="codes" id="codes" value="<?php if (isset($vehicle['codes'])) { echo htmlspecialchars($vehicle['codes']); } ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="right-inline" for="streets">Street</label>
                            <input class="input-control" type="text" name="streets" id="streets" "<?php if (isset($vehicle['streets'])) { echo htmlspecialchars($vehicle['streets']); } ?>">
                            <label class="right-inline" for="dates" >Date of loading <span style="color:red">*</span></label>
                            <input class="input-control" type="date" name="dates" id="dates" value="<?php if (isset($vehicle['dates'])) { echo htmlspecialchars($vehicle['dates']); } ?>" required>
                            <label class="right-inline" for="times">Time of loading <span style="color:red">*</span></label>
                            <input class="input-control" type="time" name="times" id="times" value="<?php if (isset($vehicle['times'])) { echo htmlspecialchars($vehicle['times']); } ?>" required>
                        </div>
                    <h2>Destination details</h2>
                        <div class="form-group">
                            <label class="right-inline" for="placed">Name of place</label>
                            <input class="input-control" name="placed" id="placed" value="<?php if (isset($vehicle['placed'])) { echo $vehicle['placed']; } ?>" />
                            <label class="right-inline" for="countryd">Country</label>
                            <select class="input-control" id="countryd" name="countryd">
                                <?php
                                require_once '../Helpers/countries.php';
                                $countryd = '';
                                foreach($countries as $countryd) {
                                    if ($countryd == $vehicle['countryd']) {
                                        echo "<option value='$countryd' selected>$countryd</option>";
                                    } else {
                                        echo "<option value='$countryd'>$countryd</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="right-inline" for="cityd">City</label>
                            <input class="input-control" type="text" name="cityd" id="cityd" value="<?php if (isset($vehicle['cityd'])) { echo htmlspecialchars($vehicle['cityd']); } ?>">
                            <label class="right-inline" for="coded">Postal code</label>
                            <input class="input-control" type="text" name="coded" id="coded" value="<?php if (isset($vehicle['coded'])) { echo htmlspecialchars($vehicle['coded']); } ?>">
                        </div>
                        <div class="form-group">
                            <label class="right-inline" for="streetd">Street</label>
                            <input class="input-control" type="text" name="streetd" id="streetd" value="<?php if (isset($vehicle['streed'])) { echo htmlspecialchars($vehicle['streed']); } ?>">
                            <label class="right-inline" for="dated">Date of arrival</label>
                            <input class="input-control" type="date" name="dated" id="dated" value="<?php if (isset($vehicle['dated'])) { echo htmlspecialchars($vehicle['dated']); } ?>">
                            <label class="right-inline" for="timed">Time of arrival</label>
                            <input class="input-control" type="time" name="timed" id="timed" value="<?php if (isset($vehicle['timed'])) { echo htmlspecialchars($vehicle['timed']); } ?>">
                        </div>
                    <h2>Load details</h2>
                        <div class="form-group">
                            <label class="right-inline" for="weight">Max weight <span style="color:red">*</span></label>
                            <input class="input-control" id="weight" type="number" name="weight" step="1" min="0" max="50000" value="<?php if (isset($vehicle['weight'])) { echo htmlspecialchars($vehicle['weight']); } ?>" required>
                            <label class="right-inline" for="type_of_good">Type of goods</label>
                            <input class="input-control" type="text" id="type_of_good" name="type_of_good" value="<?php if (isset($vehicle['type_of_good'])) { echo htmlspecialchars($vehicle['type_of_good']); } ?>" />
                            <label class="right-inline" for="number_of_package">Number of packages</label>
                            <input class="input-control" type="number" name="number_of_package" id="number_of_package" step="1" min="0" max="1000000" value="<?php if (isset($vehicle['number_of_package'])) { echo htmlspecialchars($vehicle['number_of_package']); } ?>" />
                            <label class="right-inline" for="type_of_package">Type of packages</label>
                            <select class="input-control" id="package" name="package">
                                <?php
                                require_once '../Helpers/packages.php';
                                $package = '';
                                foreach($packages as $package) {
                                    if ($package == $_POST['type_of_package']) {
                                        echo "<option value='$package' selected>$package</option>";
                                    } else {
                                        echo "<option value='$package'>$package</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="right-inline" for="payrate">Payrate</label>
                            <input class="input-control" step="0.1" min="1" max="1000000" type="number" name="payrate" id="payrate" value="<?php if (isset($vehicle['payrate'])) { echo htmlspecialchars($vehicle['payrate']); } ?>" />
                        </div>
                        <div class="form-group">
                            <label class="right-inline" for="currency">Currency <span style="color:red">*</span></label>
                                <select class="input-control" id="currency" name="currency" required>
                                    <?php
                                    require_once '../Helpers/currencies.php';
                                    foreach ($currencies as $currency) {
                                        if ($currency == $vehicle['currency']) {
                                            echo "<option value='$currency' selected>$currency</option>";
                                        } else {
                                            echo "<option value='$currency'>$currency</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            <label class="right-inline" for="distance">Distance</label>
                            <input class="input-control" type="number" step="1" min="0" max="1000000" name="distance" id="distance" value="<?php if (isset($vehicle['distance'])) { echo htmlspecialchars($vehicle['distance']); } ?>" />
                            <label class="right-inline" for="rate_per_km">Rate per km <span style="color:red">*</span></label>
                            <input class="input-control" step="0.1" type="number" min="0" max="1000000" name="rate_per_km" id="rate_per_km" value="<?php if (isset($vehicle['rate_per_km'])) { echo htmlspecialchars($vehicle['rate_per_km']); } ?>" required/>
                            <label class="right-inline" for="trailer">Trailer <span style="color:red">*</span></label>
                                <select class="input-control" id="trailer" name="trailer" required>
                                    <?php
                                    require_once '../Helpers/trailers.php';
                                    $trailer = '';
                                    foreach ($trailers as $trailer) {
                                        if ($trailer == $vehicle['trailer']) {
                                            echo "<option value='$trailer' selected>$trailer</option>";
                                        } else {
                                            echo "<option value='$trailer'>$trailer</option>";
                                        }
                                    }
                                    ?>
                                </select>
                        </div>
                            <div class="form-group">
                                <label class="right-inline" for="description">Description</label>
                                <input class="input-control" id="description" value="<?php if (isset($vehicle['description'])) { echo htmlspecialchars($vehicle['description']); } ?>">
                    </div>
                    <div class="form-group">
                        <button>Save changes</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>
</body>
</html>