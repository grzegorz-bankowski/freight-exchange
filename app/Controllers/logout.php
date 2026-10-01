<?php

namespace App\Controllers;

session_start();
$_SESSION = [];
session_destroy();
header('Location: ./?a=logout');
exit();
