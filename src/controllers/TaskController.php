<?php

namespace App\Controllers;

use App\Models\TaskModel;

class TaskController
{
    private $taskModel;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->taskModel = new TaskModel();
    }

    /**
     * Handle all requests.
     */
    public function handleRequest()
    {
        $action = !empty($_REQUEST['action']) ? $_REQUEST['action'] : "index";

        switch ($action) {
            case 'addTask':
                if (empty($_POST['name'])
                    || empty($_POST['startingDate'])
                    || empty($_POST['endingDate'])
                    || empty($_POST['status'])
                ) {
                    $result['error'] = "Please fill up all required fields";
                } else {
                    $result = $this->addTask($_POST);
                }

                $this->setSessionMsg($result);
                $this->callRedirect();
                break;

            case 'updateTask':
                if (empty($_POST['id'])
                    || empty($_POST['name'])
                    || empty($_POST['startingDate'])
                    || empty($_POST['endingDate'])
                    || empty($_POST['status'])
                ) {
                    $result['error'] = "Please fill up all required fields";
                } else {
                    $result = $this->updateTask($_POST);
                }

                $this->setSessionMsg($result);
                $this->callRedirect();
                break;

            case 'deleteTask':
                if (empty($_GET['id'])) {
                    $result['error'] = "task id not found";
                } else {
                    $result = $this->deleteTask($_GET['id']);
                }

                $this->setSessionMsg($result);
                $this->callRedirect();
                break;

            case 'openCalendar':
                $this->openCalendar();
                break;

            default:
                $this->index();
                break;
        }
    }

    /**
     * Homepage.
     */
    public function index()
    {
        $result = array();
        $tasks  = $this->taskModel->list();

        if ($tasks === false) {
            $result['error'] = "Fail to fetch all works, an unknown error occurred";
        } elseif (empty($tasks)) {
            $result['success'] = "Start adding your task by using form above";
        }

        $this->setSessionMsg($result);
        include 'src/views/todo-list.php';
    }

    /**
     * Add new task.
     * @param $task
     * @return array of messages
     */
    public function addTask($task)
    {
        if ($this->taskModel->add($task)) {
            $result['success'] = "New task has been successfully added";
        } else {
            $result['error'] = "Fail to add new task, an unknown error occurred";
        }

        return $result;
    }

    /**
     * Delete task by id.
     * @param $id
     * @return array of messages
     */
    public function deleteTask($id)
    {
        if ($this->taskModel->delete($id)) {
            $result['success'] = "The task has been successfully removed";
        } else {
            $result['error'] = "Fail to delete task, an unknown error occurred";
        }

        return $result;
    }

    /**
     * Update task by id.
     * @param $task
     * @return array of messages
     */
    public function updateTask($task)
    {
        if ($this->taskModel->update($task)) {
            $result['success'] = "The task has been successfully updated";
        } else {
            $result['error'] = "Fail to save task, an unknown error occurred";
        }

        return $result;
    }

    /**
     * Open Calendar.
     */
    public function openCalendar()
    {
        $result  = array();
        $events  = array();
        $tasks   = $this->taskModel->list();

        if ($tasks === false) {
            $result['error'] = "Fail to fetch all works, an unknown error occurred";
        } elseif (empty($tasks)) {
            $result['success'] = "Start adding your task in homepage to show it here";
        } else {
            foreach ($tasks as $task) {
                $events[] = array(
                    'title'       => $task['name'],
                    'start'       => date('Y-m-d', strtotime($task['starting_date'])),
                    'end'         => date('Y-m-d', strtotime('+1 day', strtotime($task['ending_date']))),
                    'description' => $task['status'],
                    'allDay'      => true,
                    'color'       => ($task['status'] === 'Planning') ? '#3f9a8d' : (($task['status'] === 'Doing') ? '#939393' : '#d599a2')
                );
            }
        }

        $this->setSessionMsg($result);

        include 'src/views/calendar.php';
    }

    /**
     * Redirect to homepage.
     */
    private function callRedirect()
    {
        header('location: index.php');
        exit();
    }

    /**
     * Set session message.
     * @param $message
     */
    private function setSessionMsg($message) {
        if (isset($message['error'])) {
            $_SESSION['error'] = $message['error'];
        } elseif (isset($message['success'])) {
            $_SESSION['success'] = $message['success'];
        }
    }

    /**
     * Get a task by name - for unit test.
     * @param $name
     * @return array
     */
    // public function getWorkByName($name)
    // {
    //     return $this->taskModel->getByName($name);
    // }

    /**
     * Get a task by id - for unit test.
     * @param $id
     * @return array
     */
    public function getWork($id)
    {
        return $this->taskModel->get($id);
    }
}