<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
    {
        // Store data for form if something goes wrong
        // Error message if password wrong etc.
        $data = [
            'email' => '',
            'password' => '',
            'email_error' => '',
            'password_error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            //Validate
            $isValidEmail = false;
            $isValidPassword = false;

            $data['email'] = $_POST['inputEmail'];
            $data['password'] = $_POST['inputPassword'];


            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter your email address';
            } else {
                // Check email not taken
                // Check email syntax?

                $user = $this->userModel->getUserByEmail($data['email']);

                if (empty($user->email)) {
                    $data['email_error'] = 'This email is not registered';
                } else {
                    if (empty($data['password'])) {
                        $data['password_error'] = 'Please enter your password';
                    } elseif (strlen($data['password']) < 8) {
                    } else {
                        $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                        if ($loggedInUser) {
                            // Create session
                            // Redirect
                            $this->createUserSession($loggedInUser);
                            //die('SUCCESS');
                        } else {
                            // Display error
                            $data['password_error'] = 'Password incorrect';
                            $this->view('users/login', $data);
                        }
                    }
                }
            }

            $this->view('users/login', $data);
        } else {

            // Load Form
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;

        header('Location: ' . URL_ROOT . '/pages/index');
    }

    public function register()
    {
        // Store data for form if something goes wrong
        // Error message if password wrong etc.
        $data = [
            'name' => '',
            'email' => '',
            'password' => '',
            'password_confirm' => '',
            'name_error' => '',
            'email_error' => '',
            'password_error' => '',
            'password_confirm_error' => ''
        ];

        //Check if form submitted
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data['name'] = $_POST['inputName'];
            $data['email'] = $_POST['inputEmail'];
            $data['password'] = $_POST['inputPassword'];
            $data['password_confirm'] = $_POST['inputPasswordConfirm'];

            $isValidInfo = true;

            if (empty($data['email'])) {
                $data['email_error'] = 'Please enter your email address';
                $isValidInfo = false;
            } else {
                // Check email not taken
                // Check email syntax?
                if ($this->userModel->isEmailInUse($data['email'])) {
                    $data['email_error'] = 'Email is already in use';
                    $isValidInfo = false;
                }
            }

            if (empty($data['name'])) {
                $data['name_error'] = 'Please enter your name';
                $isValidInfo = false;
            }

            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter your password';
                $isValidInfo = false;
            } elseif (strlen($data['password']) < 8) {
                $data['password_error'] = 'Password must 8 characters or more';
                $isValidInfo = false;
            } elseif (false) {
                // Password strength regex?
            }

            // More password validation

            if (empty($data['password_confirm'])) {
                $data['password_confirm_error'] = 'Please confirm your password';
                $isValidInfo = false;
            } else {
                if ($data['password'] != $data['password_confirm']) {
                    $data['password_confirm_error'] = 'Passwords do not match';
                    $isValidInfo = false;
                }
            }
            if ($isValidInfo) {

                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if ($this->userModel->registerUser($data)) {
                    flash('register_success', 'Your account has been created. Please verify your email.');
                    //$this->userModel->verifyEmail($data['email']);
                    header('Location: ' . URL_ROOT . '/users/login');
                }
            } else {
                $this->view('users/register', $data);
            }
        } else {
            // Load Form
            $this->view('users/register', $data);
        }
    }

    public function forgot_password()
    {

        if (isset($_POST['inputEmail'])) {

            $data['email'] = $_POST['inputEmail'];
            $user = $this->userModel->getUserByEmail($data['email']);
            if ($user) {
                $this->userModel->resetPassword($user->user_id, $user->email);
                flash('password_reset_email', 'You have been sent an email to reset your password');
                header('Location: ' . URL_ROOT . '/users/login');
            }
        } else {
            $data['email_error'] = 'Please enter your email';
            $this->view('users/forgot_password', $data);
        }
    }

    public function profile($params = '')
    {
        if ($this->isLoggedIn()) {

            $data['email'] = $_SESSION['user_email'];
            $data['name'] = $_SESSION['user_name'];
            $data['edit'] = $params;

            if (isset($_POST[''])) {

            }

            $this->view('users/profile', $data);
        } else {
            flash('error_not_logged_in', 'Please log in to view this page', 'alert alert-danger');
            header('Location: ' . URL_ROOT . '/users/login');
        }
    }

    public function isLoggedIn()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        } else {
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy(); // Remove session & redirect to homepage

        header('Location: ' . URL_ROOT . '/pages/index');
    }

    public function new_password($token = '')
    {

        // if url or session has reset token
        if (!empty($token) || isset($_SESSION['reset_token'])) {
            // validate token
            if (!isset($_SESSION['reset_token'])) {
                $_SESSION['reset_token'] = $token;
            }

            if (isset($_POST['inputPassword'])) {
                // validate password input
                $row = $this->userModel->getUserIdFromResetToken($_SESSION['reset_token']);

                $this->userModel->updatePassword($row->user_id, $_POST['inputPassword']);

                $this->userModel->deleteUsedToken($row->user_id);
                unset($_SESSION['reset_token']);
                flash('password_reset', 'Your password has been reset. You can now log in');
                header('Location: ' . URL_ROOT . '/users/login');
                return;
            } else {
                $this->view('users/new_password', $data = '');
            }
        } else {
            $this->view('users/login', $data = '');
        }
    }
}
