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
    <div class="content" style="max-width: 100%;">
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
            <h1 class="settings">Add load offer</h1>
            <section class="main-content">
                <form action="./add-load" method="post" class="form">
                    <h2>Origin details</h2>
                        <div class="form-group">
                            <label class="right-inline" for="places">Name of place <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="places" id="places" value="<?php if (isset($_POST['times'])) { echo htmlspecialchars($_POST['places']); } ?>" required autofocus />
                            <label class="right-inline" for="countrys">Country <span style="color:red">*</span></label>
                            <select class="input-control" id="countrys" name="countrys" required>
                                <?php
                                require_once '../Helpers/countries.php';
                                $countrys = '';
                                foreach($countries as $countrys) {
                                    if ($countrys == htmlspecialchars($_POST['countrys'])) {
                                        echo "<option value='$countrys' selected>$countrys</option>";
                                    } else {
                                        echo "<option value='$countrys'>$countrys</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="right-inline" for="citys">City <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="citys" id="citys" value="<?php if (isset($_POST['citys'])) { echo htmlspecialchars($_POST['citys']); } ?>" required />
                            <label class="right-inline" for="codes">Postal code <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="codes" id="codes" value="<?php if (isset($_POST['codes'])) { echo htmlspecialchars($_POST['codes']); } ?>" required>
                        </div>
                        <div class="form-group">
                            <label class="right-inline" for="streets">Street</label>
                            <input class="input-control" type="text" name="streets" id="streets" value="<?php if (isset($_POST['streets'])) { echo htmlspecialchars($_POST['streets']); } ?>">
                            <label class="right-inline" for="dates">Date of loading <span style="color:red">*</span></label>
                            <input class="input-control" type="date" name="dates" id="dates" value="<?php if (isset($_POST['dates'])) { echo htmlspecialchars($_POST['dates']); } ?>" required>
                            <label class="right-inline" for="times">Time of loading <span style="color:red">*</span></label>
                            <input class="input-control" type="time" name="times" id="times" value="<?php if (isset($_POST['times'])) { echo htmlspecialchars($_POST['times']); } ?>" required>
                        </div>
                    <h2>Destination details</h2>
                    <div class="form-group">
                            <label class="right-inline" for="placed">Name of place <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="placed" id="placed" value="<?php if (isset($_POST['placed'])) { echo htmlspecialchars($_POST['placed']); } ?>" required/>
                            <label class="right-inline" for="countryd">Country <span style="color:red">*</span></label>
                            <select class="input-control" id="countryd" name="countryd" required>
                                <?php
                                require_once '../Helpers/countries.php';
                                $countryd = '';
                                foreach($countries as $countryd) {
                                    if ($countryd == $_POST['countryd']) {
                                        echo "<option value='$countryd' selected>$countryd</option>";
                                    } else {
                                        echo "<option value='$countryd'>$countryd</option>";
                                    }
                                }
                                ?>
                            </select>
                            <label class="right-inline" for="cityd">City <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="cityd" id="cityd" value="<?php if (isset($_POST['cityd'])) { echo htmlspecialchars($_POST['cityd']); } ?>" required/>
                            <label class="right-inline" for="coded">Postal code <span style="color:red">*</span></label>
                            <input class="input-control" type="text" name="coded" id="coded" value="<?php if (isset($_POST['coded'])) { echo htmlspecialchars($_POST['coded']); } ?>" required />
                    </div>
                    <div class="form-group">
                            <label class="right-inline" for="streetd">Street</label>
                            <input class="input-control" type="text" name="streetd" id="streetd" value="<?php if (isset($_POST['streetd'])) { echo htmlspecialchars($_POST['streetd']); } ?>">
                            <label class="right-inline" for="dated">Date of arrival <span style="color:red">*</span></label>
                            <input class="input-control" type="date" name="dated" id="dated" value="<?php if (isset($_POST['dated'])) { echo htmlspecialchars($_POST['dated']); } ?>" required />
                            <label class="right-inline" for="timed">Time of arrival <span style="color:red">*</span></label>
                            <input class="input-control" type="time" name="timed" id="timed" value="<?php if (isset($_POST['timed'])) { echo htmlspecialchars($_POST['timed']); } ?>" required />
                    </div>
                    <h2>Load details</h2>
                    <div class="form-group">
                            <label class="right-inline" for="weight">Weight <span style="color:red">*</span></label>
                            <input class="input-control" type="number" name="weight" id="weight" step="1" min="0" max="50000" value="<?php if (isset($_POST['weight'])) { echo htmlspecialchars($_POST['weight']); } ?>" required />
                            <label class="right-inline" for="type_of_good">Type of goods</label>
                            <input class="input-control" type="text" name="type_of_good" id="type_of_good" value="<?php if (isset($_POST['type_of_good'])) { echo htmlspecialchars($_POST['type_of_good']); } ?>" />
                            <label class="right-inline" for="number_of_package">Number of packages</label>
                            <input class="input-control" type="number" name="number_of_package" id="number_of_package" step="1" min="0" max="1000000" value="<?php if (isset($_POST['rate_per_km'])) { echo htmlspecialchars($_POST['rate_per_km']); } ?>" />
                            <label class="right-inline" for="type_of_package">Type of packages</label>
                            <select class="input-control" id="type_of_package" name="type_of_package">
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
                            <label class="right-inline" for="payrate">Payrate <span style="color:red">*</span></label>
                            <input class="input-control" type="number" name="payrate" id="payrate" step="0.1" min="1" max="1000000" value="<?php if (isset($_GET['payrate'])) { echo htmlspecialchars($_GET['payrate']); } ?>" required />
                    </div>
                    <div class="form-group">
                            <label class="right-inline" for="currency">Currency <span style="color:red">*</span></label>
                                <select class="input-control" id="currency" name="currency" required>
                                    <?php
                                    require_once '../Helpers/currencies.php';
                                    $currency = '';
                                    foreach ($currencies as $currency) {
                                        if ($currency == $_POST['currency']) {
                                            echo "<option value='$currency' selected>$currency</option>";
                                        } else {
                                            echo "<option value='$currency'>$currency</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            <label class="right-inline" for="distance">Distance <span style="color:red">*</span></label>
                            <input class="input-control" id="distance" type="number" step="1" min="0" max="1000000" name="distance" value="<?php if (isset($_POST['distance'])) { echo htmlspecialchars($_POST['distance']); } ?>" required />
                            <label class="right-inline" for="rpk">Rate per km <span style="color:red">*</span></label>
                            <input class="input-control" id="rpk" step="0.1" type="number" min="0" max="1000000" name="rate_per_km" value="<?php if (isset($_POST['rate_per_km'])) { echo htmlspecialchars($_POST['rate_per_km']); } ?>" required />
                            <label class="right-inline" for="trailer">Trailer <span style="color:red">*</span></label>
                            <select class="input-control" id="trailer" name="trailer" required>
                                <?php
                                require_once '../Helpers/trailers.php';
                                $trailer = '';
                                foreach ($trailers as $trailer) {
                                    if ($trailer == htmlspecialchars($_POST['trailer'])) {
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
                        <input class="input-control" name="description" id="description" value="<?php if (isset($_POST['description'])) { echo htmlspecialchars($_POST['descriprtion']); } ?>">
                    </div>
                    <div class="form-group">
                    <button>Add offer</button>
                    </div>
                </form>
            </section>
        </main>
    </div>
</div>
</body>
</html>