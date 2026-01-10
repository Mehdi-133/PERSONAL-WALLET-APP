<?php

namespace App\Models;

use App\Core\Database;

class Category
{
    private $db;

    public function __construct()
    {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY name";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function addCategory($name, $icon)
    {
        $sql = "INSERT INTO categories (name, icon) VALUES (:name, :icon)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute(['name' => $name, 'icon' => $icon]);
    }
}
