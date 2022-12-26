<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Controllers\TaskController;

class TaskControllerTest extends TestCase
{
    public $taskController;

    public function __construct()
    {
        parent::__construct();
        $this->taskController = new TaskController();
    }

    public function testAddTask()
    {
        $this->taskController = new TaskController();
        $newTask = array(
            'name'         => 'Test_Add_Task',
            'startingDate' => '01-12-2022',
            'endingDate'   => '02-12-2022',
            'status'       => 'Planning'
        );
        $result = $this->taskController->addTask($newTask);
        $this->assertEquals('New task has been successfully added', $result['success']);
    }
}
