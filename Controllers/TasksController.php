<?php

namespace MVC\Controllers;

use MVC\Core\Controller;
use MVC\Models\TaskModel;
use MVC\Models\TaskRepository;

class TasksController extends Controller
{
    function index()
    {
        $tasks = new TaskRepository();

        $d['tasks'] = $tasks->getAll();
        $this->set($d);
        $this->render("index");
    }
    
    // Create
    function create()
    {
        if (isset($_POST["title"]) && isset($_POST["description"])) {
            $task = new TaskRepository();
            $taskModel = new TaskModel();
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            if ($task->add($taskModel)) {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->render("add");
    }

    // Edit
    function edit($id)
    {
        $task = new TaskRepository();
        $d["task"] = $task->get($id);
        if (isset($_POST["title"]) && isset($_POST["description"])) {
            $taskModel = new TaskModel();
            $taskModel->setId($id);
            $taskModel->setTitle($_POST["title"]);
            $taskModel->setDescription($_POST["description"]);
            if ($task->edit($taskModel))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    // Delete
    function delete($id)
    {
        $task = new TaskRepository();
        $taskModel = new TaskModel();
        $taskModel->setId($id);
        if ($task->delete($taskModel))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}