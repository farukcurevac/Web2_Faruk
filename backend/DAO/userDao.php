<?php
require_once 'baseDao.php';

class UserDao extends BaseDao {
    public function __construct() {
        parent::__construct('users');
    }

    public function getUserByEmail($email) {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE email = :email", ['email' => $email]);
    }
}
?>