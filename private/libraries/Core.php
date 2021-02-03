<?php

// Creates URL & loads Core controller
// URL format - /controller/method/params

class Core
{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index'; // Homepage
    protected $params = [];

    public function __construct()
    {
        // print_r($this->getURL());
        $url = $this->getURL();

        // check if url is set
        if (isset($url[0])) {
            // Check if controller exists and  sets as current controller
            if (file_exists('../private/controllers/' . ucwords($url[0]) . '.php')) {
                $this->currentController = ucwords($url[0]);
                unset($url[0]); // Unset Controller from array
            }
        }

        // Require Controller
        require_once '../private/controllers/' . $this->currentController . '.php';
        // Instantiate Selected controller
        $this->currentController = new $this->currentController;

        // Check if 2nd part of url is method
        if (isset($url[1])) {

            // If method exists then set as current method
            if (method_exists($this->currentController, $url[1])) {
                $this->currentMethod = $url[1];
                unset($url[1]); // Remove from array
            }
        }


        // If other parts of URL then add to parameters otherwise empty array
        $this->params = $url ? array_values($url) : [];

        // Call the controller method with params
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/'); // Remove end slash
            $url = filter_var($url, FILTER_SANITIZE_URL); // Remove illegal characters
            $url = explode('/', $url); // Put params into an array
            return $url;
        }
    }
}
