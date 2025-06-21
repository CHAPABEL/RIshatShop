<?php
require_once __DIR__ . '/../Core/Model.php';
class Category extends Model {
    public function getAll() {
        $stmt = $this->db->query('SELECT * FROM categories ORDER BY name');
        return $stmt->fetchAll();
    }
}
