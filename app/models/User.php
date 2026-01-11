<?php

namespace App\Models;

use App\Core\Database;


class User
{

    private $db;


    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getProfile($id)
    {
        $sql = "SELECT id, name, email, created_at FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    public function register($nom,  $email,  $password): bool
    {
        $sql = "INSERT INTO users (name, email, password)
                VALUES (:name, :email, :password)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'name'      => $nom,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function login($email,  $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        $user = $stmt->fetch();

        if (!$user) {
            return false;
        }

        if (!password_verify($password, $user['password'])) {
            return false;
        }
        $_SESSION['user_id'] = $user['id'];

        return true;
    }


    public function logout()
    {
        session_unset();
        session_destroy();
    }

    public function emailExists($email): bool
    {
        $sql = "SELECT id FROM users WHERE email = :email LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['email' => $email]);

        return $stmt->fetch() !== false;
    }

    public function updateProfile($user_id, $name, $email)
    {
        $sql = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'id' => $user_id
        ]);
    }

    public function updatePassword($user_id, $currentPassword, $newPassword)
    {

        $sql = "SELECT password FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $user_id]);
        $user = $stmt->fetch();

        if (!$user || !password_verify($currentPassword, $user['password'])) {
            return false;
        }
        $sql = "UPDATE users SET password = :password WHERE id = :id";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'password' => password_hash($newPassword, PASSWORD_DEFAULT),
            'id' => $user_id
        ]);
    }
}
