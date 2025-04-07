<?php
require_once 'baseDao.php';

class BookingsDao extends BaseDao {
    public function __construct() {
        parent::__construct('bookings');
    }

    public function getBookingsByUserId($userId) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id", ['user_id' => $userId]);
    }

    public function getBookingsByDestinationId($destinationId) {
        return $this->query("SELECT * FROM " . $this->table_name . " WHERE destination_id = :destination_id", ['destination_id' => $destinationId]);
    }

    public function updateBookingStatus($id, $status) {
        return $this->update(['status' => $status], $id);
    }
}
?>