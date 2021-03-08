<?php

namespace MVC\Core;

class Model
{
    function getProperties()
    {
        return get_object_vars($this);
    }
}