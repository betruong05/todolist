<?php
require_once __DIR__.'/vendor/autoload.php';

use App\Controllers\TaskController;

try {
    $taskController = new TaskController();
    $taskController->handleRequest();
} catch (Exception $e) {
    echo 'Error: ',  $e->getMessage();
}
