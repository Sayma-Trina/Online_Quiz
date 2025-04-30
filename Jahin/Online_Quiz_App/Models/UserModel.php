<?php

require_once 'Model.php';

class UserModel extends Model {
    protected $table = 'users';
    protected $allowedFields = [
        'username',
        'email',
        'password',
        'role',
        'name',
        'created_at',
        'updated_at'
    ];

    public function __construct() {
        parent::__construct();
    }

    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function validateLogin($email, $password) {
        $user = $this->findByEmail($email);
        if (!$user) {
            return false;
        }
        return password_verify($password, $user['password']);
    }

    public function createUser($data) {
        if ($this->findByEmail($data['email']) || $this->findByUsername($data['username'])) {
            throw new Exception('Email or username already exists');
        }

        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->create($data);
    }

    public function updateUser($id, $data) {
        if (isset($data['email']) && ($user = $this->findByEmail($data['email'])) && $user['id'] != $id) {
            throw new Exception('Email already exists');
        }

        if (isset($data['username']) && ($user = $this->findByUsername($data['username'])) && $user['id'] != $id) {
            throw new Exception('Username already exists');
        }

        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }

        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->update($id, $data);
    }

    public function validateRegistration($data) {
        $errors = [];

        if (empty($data['username']) || !preg_match('/^[a-zA-Z0-9_]{3,20}$/', $data['username'])) {
            $errors['username'] = 'Username must be 3-20 characters (letters, numbers, underscore)';
        }

        if (empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address';
        }

        if (empty($data['password']) || strlen($data['password']) < 8) {
            $errors['password'] = 'Password must be at least 8 characters';
        }

        if (empty($data['name']) || !preg_match('/^[a-zA-Z\s]{2,50}$/', $data['name'])) {
            $errors['name'] = 'Please enter a valid name (2-50 characters)';
        }

        return $errors;
    }
}