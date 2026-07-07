<?php

namespace App\Controllers;

session_start();
$_SESSION = [];
session_destroy();
header('Location: ./?logout=1');
exit();
