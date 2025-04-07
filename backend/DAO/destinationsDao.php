<?php
require_once 'baseDao.php';

class DestinationsDao extends BaseDao {
    public function __construct() {
        parent::__construct('destinations');
    }

    public function getDestinationsByCategoryId($categoryId) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE category_id = :category_id", ['category_id' => $categoryId]);
    }

    public function getDestinationsByPriceRange($minPrice, $maxPrice) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE price BETWEEN :min_price AND :max_price", [
            'min_price' => $minPrice,
            'max_price' => $maxPrice
        ]);
    }
}
?>