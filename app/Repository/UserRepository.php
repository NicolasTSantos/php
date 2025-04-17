<?php

namespace Repository;

use Models\User;
use Utils\Database;
class UserRepository {
    public string $id;
    public string $username;
    public string $email;
    public string $password;
    public string $created_at;
    public string $updated_at;
    public string $deleted_at;

    function getAllUsers() {
        $db = Database::connectDb();
        $query = "SELECT * FROM users";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, User::class);
    }

    function save(User $user): bool {
        $db = Database::connectDb();
        $query = "INSERT INTO users (id, username, email, password, created_at, updated_at) VALUES (:id, :username, :email, :password, :created_at, :updated_at)";
        $stmt = $db->prepare($query);
        $stmt->bindParam(':id', $user->id);
        $stmt->bindParam(':username', $user->username);
        $stmt->bindParam(':email', $user->email);
        $stmt->execute();
        return ($db->lastInsertId() != 0) ? true : false;
    }
}