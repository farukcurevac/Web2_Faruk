<?php
require_once 'baseDao.php';

class ReviewsDao extends BaseDao {
    public function __construct() {
        parent::__construct('reviews');
    }

    public function getReviewsByUserId($userId) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id", ['user_id' => $userId]);
    }

    public function getReviewsByDestinationId($destinationId) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE destination_id = :destination_id", ['destination_id' => $destinationId]);
    }
}
?>