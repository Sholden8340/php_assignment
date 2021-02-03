<?php
// Base Controller
// Load model and view
class Controller
{
    public function model($model)
    {
        require_once '../private/models/' . $model . '.php';
        //instantiate model
        return new $model;
    }

    public function view($view, $data = [])
    {
        //Load view, Check if exists
        if (file_exists('../private/views/' . $view . '.php')) {
            require_once '../private/views/' . $view . '.php';
        } else {
            die("View does not exist");
        }
    }
}
