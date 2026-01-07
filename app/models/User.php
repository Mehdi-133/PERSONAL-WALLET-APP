<?php

namespace App\Models;

use App\Core\Database;


class User
{

    private $id;
    private $nom;
    private $email;
    private $password;

    private $db;


    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getProfile( $id)
    {
        $sql = "SELECT id, nom, email FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $id]);

        return $stmt->fetch();
    }

    public function register( $nom,  $email,  $password): bool
    {
        $sql = "INSERT INTO users (nom, email, password)
                VALUES (:nom, :email, :password)";

        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'nom'      => $nom,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ]);
    }

    public function login( $email,  $password)
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
}
