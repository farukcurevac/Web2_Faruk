<?php
require_once '../config.php';

class BaseDao {
    protected $connection;
    protected $table_name;

    public function __construct($table_name) {
        $this->table_name = $table_name;
        try {
            $this->connection = Database::connect();
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Generic query method
    protected function query($query, $params = []) {
        $stmt = $this->connection->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Query for a single unique result
    protected function query_unique($query, $params = []) {
        $results = $this->query($query, $params);
        return reset($results);
    }

    // Add a new record
    public function add($entity) {
        $columns = implode(", ", array_keys($entity));
        $placeholders = ":" . implode(", :", array_keys($entity));
        $query = "INSERT INTO " . $this->table_name . " ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($query);
        $stmt->execute($entity);
        $entity['id'] = $this->connection->lastInsertId();
        return $entity;
    }

    // Update an existing record
    public function update($entity, $id, $id_column = "id") {
        $fields = "";
        foreach ($entity as $column => $value) {
            $fields .= "$column = :$column, ";
        }
        $fields = rtrim($fields, ", ");
        $query = "UPDATE " . $this->table_name . " SET $fields WHERE $id_column = :id";
        $stmt = $this->connection->prepare($query);
        $entity['id'] = $id;
        $stmt->execute($entity);
        return $entity;
    }

    // Delete a record
    public function delete($id, $id_column = "id") {
        $query = "DELETE FROM " . $this->table_name . " WHERE $id_column = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
    }

    // Get all records
    public function get_all() {
        return $this->query("SELECT * FROM " . $this->table_name);
    }

    // Get a record by ID
    public function get_by_id($id, $id_column = "id") {
        return $this->query_unique("SELECT * FROM " . $this->table_name . " WHERE $id_column = :id", ['id' => $id]);
    }
}
?>