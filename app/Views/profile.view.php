<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <link rel="stylesheet" href="css/profile.css">
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
<div class="kontener">
    <div class="sidebar">
        <header>
            <a class="logo"><img src="img/1.jpg" style="max-width:100%; max-height:100%;"></a>
        </header>
        <a href="./orders"><i class="fas fa-home"></i>Orders</a>
        <a href="./offers"><i class="fas fa-address-card"></i>Offers</a>
        <a href="./find-load"><i class="fas fa-pallet"></i>Find load</a>
        <a href="./find-vehicle"><i class="fas fa-truck"></i>Find vehicle</a>
        <a href="./profile" class="active"><i class="fas fa-user-circle"></i>Profile</a>
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
            <h1 class="settings">Personal information</h1>
            <h2>This information will be displayed publicly so be careful what you share.</h2>
            <div class="form">
                <form action="./profile" method="post">
                    <input type="hidden" name="action" value="update">
                    <div class="left">
                        <label for="name">Full name</label>
                    </div>
                    <div class="right">
                        <input type="text" id="name" name="name" value="<?php $name = isset($_SESSION['name']) ? $_SESSION['name'] : ''; echo htmlspecialchars($name); ?>">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="street">Street</label>
                    </div>
                    <div class="right">
                        <input type="text" id="street" name="street" value="<?php $street = isset($_SESSION['street']) ? $_SESSION['street'] : ''; echo htmlspecialchars($street); ?>">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="city">City</label>
                    </div>
                    <div class="right">
                        <input type="text" id="city" name="city" value="<?php $city = isset($_SESSION['city']) ? $_SESSION['city'] : ''; echo htmlspecialchars($city); ?>">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="code">Postal code</label>
                    </div>
                    <div class="right">
                        <input type="text" id="code" name="code" value="<?php $code = isset($_SESSION['code']) ? $_SESSION['code'] : ''; echo htmlspecialchars($code); ?>">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="country">Country</label>
                    </div>
                    <div class="right">
                        <input type="text" id="country" name="country" value="<?php $country = isset($_SESSION['country']) ? $_SESSION['country'] : ''; echo htmlspecialchars($country); ?>">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="vat">VAT ID</label>
                    </div>
                    <div class="right">
                        <input type="text" id="vat" name="vat" value="<?php $vat = isset($_SESSION['vat']) ? $_SESSION['vat'] : ''; echo htmlspecialchars($vat); ?>">
                    </div>
            <h1 class="settings">Contact</h1>
            <h2>This information will be displayed publicly so be careful what you share.</h2>
                    <div class="left">
                        <label for="phone">Phone</label>
                    </div>
                    <div class="right">
                        <input type="text" id="phone" name="phone" value="<?php $phone = isset($_SESSION['phone']) ? $_SESSION['phone'] : ''; echo htmlspecialchars($phone); ?>">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="email">E-mail</label>
                    </div>
                    <div class="right"><input type="text" id="email" name="email" value="<?php $email = isset($_SESSION['email']) ? $_SESSION['email'] : ''; echo htmlspecialchars($email); ?>" disabled></div>
                    <hr class="form" />
                    <div class="left">
                        <label for="website">Website</label>
                    </div>
                    <div class="right">
                        <input type="text" id="website" name="website" value="<?php $website = isset($_SESSION['website']) ? $_SESSION['website'] : ''; echo htmlspecialchars($website); ?>">
                    </div>
                    <input type="submit" class="delete" style="font-size:0.875rem; line-height:1;" value="Save">
                </form>
            </div>
            <hr class="main" />
        </main>
    </div>
</div>
</body>
</html>
