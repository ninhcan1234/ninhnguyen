<?php

namespace MVC\Models;

use MVC\Models\TaskResourceModel;

class TaskRepository
{
    public function add($model)
    {
        $taskResource = new TaskResourceModel();
        return $taskResource->add($model);
    }

    public function edit($model)
    {
        $taskResource = new TaskResourceModel();
        return $taskResource->edit($model);
    }

    public function get($id)
    {
        $taskResource = new TaskResourceModel();
        return $taskResource->get($id);
    }

    public function delete($model)
    {
        $taskResource = new TaskResourceModel();
        return $taskResource->delete($model);
    }

    public function getAll()
    {
        $taskResource = new TaskResourceModel();
        return $taskResource->getAll();
    }
}