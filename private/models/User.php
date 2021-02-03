<?php

class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getUsers()
    {

        // Get all users

        $this->db->query("SELECT * FROM users");

        return $this->db->resultSet();
    }

    public function isEmailInUse($email)
    {

        $this->getUserByEmail($email);
        if ($this->db->rowCount() != 0) {
            // If more than 1 row email is not in use
            return true;
        } else {
            return false;
        }
    }

    public function getUserByEmail($email)
    {

        // Get user by email for Login

        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);

        return $this->db->single();
    }

    public function registerUser($data)
    {
        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();
    }

    public function login($email, $password)
    {

        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $result = $this->db->single();
        if (password_verify($password, $result->password)) {
            return $result;
        } else {
            return false;
        }
    }

    public function isVerifiedEmail($email)
    {
        $this->getUserByEmail($email);
    }

    public function resetPassword($user_id, $email)
    {
        $token = bin2hex(random_bytes(32));
        $url = URL_ROOT . '/users/new_password/' . $token;
        $message = 'Click here to reset your password <a href="' . $url . '>here</a>';

        $this->db->query("INSERT INTO password_reset(user_id, reset_token) VALUES (:user_id, :token)");
        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':token', $token);

        if ($this->db->execute()) {
            return mail($email, 'Reset Password', $message);
        } else {
            return false;
        }
    }

    public function getUserIdFromResetToken($token)
    {
        $this->db->query("SELECT * FROM password_reset WHERE reset_token = :token");
        $this->db->bind(':token', $token);
        return $this->db->single();
    }

    public function updatePassword($user_id, $password)
    {
        $this->db->query('UPDATE users SET password=:password WHERE user_id=:user_id');
        $password = password_hash($password, PASSWORD_DEFAULT);

        $this->db->bind(':user_id', $user_id);
        $this->db->bind(':password', $password);

        $this->db->execute();
    }

    public function deleteUsedToken($user_id)
    {
        $this->db->query("DELETE FROM password_reset WHERE user_id = :user_id");
        $this->db->bind(':user_id', $user_id);
        return $this->db->execute();
    }
}
