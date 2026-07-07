<!doctype html>
<html lang="en" class="login">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <link rel="stylesheet" href="css/login.css">
    <script src="<?php echo $env['FONTAWESOME_LINK']; ?>" crossorigin="anonymous"></script>
    <script src="js/zephyr-toast.js"></script>
    <link rel="stylesheet" href="js/zephyr-toast.css">
    <link rel="stylesheet" href="js/zephyr-toast-animate.css">
</head>
<body class="login">
<div class="container-login">
    <div class="image">
        <img src="img/1.jpg">
    </div>
    <div class="form-login">
        <form method="post" action="./orders">
            <input type="hidden" name="action" value="login" />
            <h1>Sign in to your account</h1>
            <div>
                <span style="font-size: 0.875rem; line-height: 1.25rem; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';">Don't have an account?</span>
                <a class="login" href="./register">Sign up</a>
            </div>
            <div style="margin-top: 1.5rem; margin-bottom: 1rem;">
                <label style="display:block; margin-bottom:0.5rem; font-weight: 600; font-size: 0.875rem; line-height: 1.25rem; color: rgb(55 65 81); font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';" for="email">Email</label>
                <input class="login" id="email" name="email" type="text" value="" />
            </div>
            <div>
                <label style="display:block; margin-bottom:0.5rem; font-weight: 600; font-size: 0.875rem; line-height: 1.25rem; color: rgb(55 65 81); font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';" for="password">Password</label>
                <input class="login" id="password" name="password" type="password" value="" />
                <a style="margin-top:1rem; margin-bottom:1rem" class="login" href="./forgot-password">Forgot Password?</a>
            </div>
            <div>
                <button style="padding:0.75rem; border-radius:0.5rem; background-color: rgb(31 41 55); color:white; font-size:0.875rem; line-height:1; width:100%;" type="submit">Sign in</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>