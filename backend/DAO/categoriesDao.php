<?php
require_once 'baseDao.php';

class CategoriesDao extends BaseDao {
    public function __construct() {
        parent::__construct('categories');
    }

    public function getCategoryByName($name) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE name = :name", ['name' => $name]);
    }
}
?>
