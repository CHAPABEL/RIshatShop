<?php
require_once __DIR__ . '/../Core/Model.php';
class User extends Model {
    public function findByEmail($email) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        return $stmt->fetch();
    }
    public function create($email, $password, $name, $role = 'user') {
        $stmt = $this->db->prepare('INSERT INTO users (email, password, name, role) VALUES (:email, :password, :name, :role)');
        return $stmt->execute([
            ':email' => $email,
            ':password' => $password,
            ':name' => $name,
            ':role' => $role
        ]);
    }
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    /**
     * Публичный геттер для получения PDO
     */
    public function getPdo() {
        return $this->db;
    }
}
