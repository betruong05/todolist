<?php

namespace App\Models;

define("DB_HOST", "todolist-db");
define("DB_DATABASE", "todolist");
define("DB_USERNAME", "root");
define("DB_PASSWORD", "password");
class Connection
{
    protected $database;

    /**
     * Constructor.
     */
    function __construct()
    {
        $this->database = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
    }
}
