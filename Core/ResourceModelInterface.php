<?php

namespace MVC\Core;

interface ResourceModelInterface
{
 
    function _init($table, $id, $model);
    function add($model);
    function edit($model);
    function delete($model);

}