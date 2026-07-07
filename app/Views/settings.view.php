<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <link rel="stylesheet" href="css/settings.css">
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
            <a href="#" class="logo"><img src="img/1.jpg" style="max-width:100%; max-height:100%;"></a>
        </header>
        <a href="./orders"><i class="fas fa-home"></i>Orders</a>
        <a href="./offers"><i class="fas fa-address-card"></i>Offers</a>
        <a href="./find-load"><i class="fas fa-pallet"></i>Find load</a>
        <a href="./find-vehicle"><i class="fas fa-truck"></i>Find vehicle</a>
        <a href="./profile"><i class="fas fa-user-circle"></i>Profile</a>
        <a href="./settings" class="active"><i class="fas fa-cog"></i>Settings</a>
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
            <h1 class="settings">Change email</h1>
            <h2>After adress email change we will send confirmation link.</h2>
            <div class="form">
                <form action="./settings" method="post">
                    <input type="hidden" name="action" value="email">
                    <div class="left">
                        <label for="name">Current email</label>
                    </div>
                    <div class="right">
                        <input type="text" id="name" name="name" value="<?php echo $_SESSION['email'] ?>">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="newemail">New email</label>
                    </div>
                    <div class="right">
                        <input type="text" id="newemail" name="newemail" value="">
                    </div>
                    <hr class="form" />
                    <input type="submit" style="background-color: #FF9900; font-size:0.875rem; line-height:1;" value="Change email" disabled="disabled">
                </form>
            </div>
            <hr class="main" />
            <h1 class="settings">Change password</h1>
            <h2>The password must have 8 characters, one capital letter, one number and one special character.</h2>
            <div class="form">
                <form action="./settings" method="post">
                    <input type="hidden" name="action" value="password">
                    <div class="left">
                        <label for="phone">Current password</label>
                    </div>
                    <div class="right">
                        <input type="password" id="phone" name="phone" value="">
                    </div>
                    <hr class="form" />
                    <div class="left">
                        <label for="newpassword">New password</label>
                    </div>
                    <div class="right"><input type="password" id="newpassword" name="newpassword" value=""></div>
                    <hr class="form" />
                    <div class="left">
                        <label for="repeatpassword">Repeat new password</label>
                    </div>
                    <div class="right">
                        <input type="password" id="website" name="website" value="">
                    </div>
                    <hr class="form" />
                    <input type="submit" style="background-color: #FF9900; font-size:0.875rem; line-height:1;" value="Change password" disabled="disabled">
                </form>
            </div>
            <hr class="main" />
            <h1 class="settings">Delete account</h1>
            <h2>Remember! After delete account all your load & vehicle offers will be deleted immediately too.</h2>
            <div class="form">
                <form action="./settings" method="post">
                    <input type="hidden" name="action" value="delete">
                    <div class="left">
                        <label for="current_password">Current password</label>
                    </div>
                    <div class="right">
                        <input type="password" id="current_password" name="current_password" value="">
                    </div>
                    <hr class="form" />
                    <input type="submit" style="background-color: red; font-size:0.875rem; line-height:1;" class="delete" value="Delete account" disabled="disabled">
                </form>
            </div>
            <hr class="main" />
        </main>
    </div>
</div>
</body>
</html>