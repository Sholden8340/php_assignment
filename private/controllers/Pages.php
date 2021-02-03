<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User'); // Load user model to display table
    }

    public function index()
    {
        $users = $this->userModel->getUsers();
        $data = [
            'title' => 'Welcome',
            'users' => $users
        ];

        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = ['title' => 'About'];

        $this->view('pages/about', $data);
    }
}
