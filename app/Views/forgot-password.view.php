<!doctype html>
<html lang="en" class="login">
<head>
    <title>Freight Exchange</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta name="author=" content="Grzegorz Bańkowski"><!-- Website : bankowski.dev -->
    <link rel="stylesheet" href="css/forgot-password.css">
    <script src="js/zephyr-toast.js"></script>
    <link rel="stylesheet" href="js/zephyr-toast.css">
    <link rel="stylesheet" href="js/zephyr-toast-animate.css">
</head>
<body class="login">
<div class="container-login">
    <div class="image">
        <img src="img/4.jpg">
    </div>
    <div class="form-login">
        <form method="post" action="./forgot-password">
            <h1>Forgot your password?</h1>
            <input type="hidden" name="recover" value="1" />
            <div>
                <span style="font-size: 0.875rem; line-height: 1.25rem; font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';">Enter your email. We will send you a link.</span>
            </div>
            <div>
                <label style="display:block; margin:1.5rem 0 1.5rem 0; font-weight: 600; font-size: 0.875rem; line-height: 1.25rem; color: rgb(55 65 81); font-family: ui-sans-serif, system-ui, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol', 'Noto Color Emoji';" for="email">Email</label>
                <input class="login" id="email" name="email" type="text" value="" autofocus/>
            </div>
            <div>
                <button style="padding:0.75rem; border-radius:0.5rem; background-color: rgb(31 41 55); color:white; font-size:0.875rem; line-height:1; width:100%; margin-top:1.5rem;" type="submit">Reset password</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>