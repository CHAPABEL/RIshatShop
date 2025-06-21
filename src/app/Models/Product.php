<?php
require_once __DIR__ . '/../Core/Model.php';
class Product extends Model {
    public function getById($id) {
        $stmt = $this->db->prepare('SELECT p.*, c.name as category FROM products p LEFT JOIN categories c ON p.category_id = c.id WHERE p.id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch();
    }
    public function getPopular($limit = 6) {
        $stmt = $this->db->prepare('SELECT * FROM products WHERE popular = 1 LIMIT :limit');
        $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getAll($filters = []) {
        $stmt = $this->db->query('SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON p.category_id = c.id ORDER BY p.id DESC');
        $all = $stmt->fetchAll();
        $filtered = [];
        foreach ($all as $product) {
            $img = $_SERVER['DOCUMENT_ROOT'].'/assets/img/'.$product['image'];
            $hasImage = file_exists($img);
            $hasValidName = !preg_match('/[ÐÑ�]/u', $product['name']);
            $hasValidDesc = empty($product['description']) || !preg_match('/[ÐÑ�]/u', $product['description']);
            if ($hasImage && $hasValidName && $hasValidDesc) {
                $filtered[] = $product;
            }
        }
        // Фильтрация по категории
        if (!empty($filters['category'])) {
            $filtered = array_filter($filtered, function($product) use ($filters) {
                return $product['category_id'] == $filters['category'];
            });
        }
        // Фильтрация по поиску
        if (!empty($filters['search'])) {
            $q = mb_strtolower($filters['search']);
            $filtered = array_filter($filtered, function($product) use ($q) {
                return mb_stripos(mb_strtolower($product['name']), $q) !== false
                    || mb_stripos(mb_strtolower($product['description']), $q) !== false;
            });
        }
        // Фильтрация по цене
        if (!empty($filters['min_price'])) {
            $filtered = array_filter($filtered, function($product) use ($filters) {
                return $product['price'] >= $filters['min_price'];
            });
        }
        if (!empty($filters['max_price'])) {
            $filtered = array_filter($filtered, function($product) use ($filters) {
                return $product['price'] <= $filters['max_price'];
            });
        }
        return array_values($filtered);
    }
    /**
     * Публичный геттер для получения PDO
     */
    public function getPdo() {
        return $this->db;
    }
}
