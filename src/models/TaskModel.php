<?php

namespace App\Models;

class TaskModel extends Connection
{
    /**
     * Constructor.
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * List task.
     * 
     * @return array|null
     */
    public function list()
    {
        $select_sql = "SELECT * FROM tasks";
        $query      = mysqli_query($this->database, $select_sql);
        $tasks      = mysqli_fetch_all($query, MYSQLI_ASSOC);

        return $tasks;
    }

    /**
     * Add task
     * 
     * @param $task
     * @return bool
     */
    public function add($task)
    {
        $name         = $task['name'];
        $startingDate = date('Y-m-d', strtotime($task['startingDate']));
        $endingDate   = date('Y-m-d', strtotime($task['endingDate']));
        $status       = $task['status'];
        $sql_insert   = "INSERT INTO `tasks` (`name`, `starting_date`, `ending_date`, `status`) VALUES ('$name', '$startingDate', '$endingDate', '$status')";

        return mysqli_query($this->database, $sql_insert);
    }

    /**
     * Update task
     * 
     * @param $task
     * @return bool
     */
    public function update($task)
    {
        $id           = $task['id'];
        $name         = $task['name'];
        $startingDate = date('Y-m-d', strtotime($task['startingDate']));
        $endingDate   = date('Y-m-d', strtotime($task['endingDate']));
        $status       = $task['status'];
        $sql_update   = "UPDATE `tasks` SET `name`='$name', `starting_date`='$startingDate', `ending_date`='$endingDate', `status`='$status' WHERE `id`='$id'";

        return mysqli_query($this->database, $sql_update);
    }

    /**
     * Delete a task.
     * 
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $sql_delete = "DELETE FROM `tasks` WHERE `id`='$id'";

        return mysqli_query($this->database, $sql_delete);
    }

    /**
     * Get a task by name.
     *
     * @param $name
     * @return array|null
     */
    public function getByName($name) {
        $select_sql = "SELECT * FROM tasks WHERE `name`='$name' LIMIT 1";
        $query      = mysqli_query($this->database, $select_sql);

        return mysqli_fetch_assoc($query);
    }

    /**
     * Get a task by id.
     * 
     * @param $id
     * @return array|null
     */
    public function get($id) {
        $select_sql = "SELECT * FROM tasks WHERE `id`='$id'";
        $query      = mysqli_query($this->database, $select_sql);

        return mysqli_fetch_assoc($query);
    }
}