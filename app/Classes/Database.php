<?php

namespace App\Classes;

use PDO;

class Database
{
    private $env;
    public $connection;

    public function __construct()
    {
        $this->env = parse_ini_file('../.env');
        $dsn = "mysql:host=" . $this->env['DB_HOST'] . ";port=" . $this->env['DB_PORT'] . ";dbname=" . $this->env['DB_NAME'] . ";charset=" . $this->env['DB_CHARSET'];
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        $this->connection = new \PDO($dsn, $this->env['DB_USERNAME'], $this->env['DB_PASSWORD'], $options);
    }
}
