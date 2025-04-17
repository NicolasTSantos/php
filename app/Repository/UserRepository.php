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

    function save(User $user): array {
        try {
            $db = Database::connectDb();

            $query = "INSERT INTO users (id, username, email, password, created_at, updated_at) VALUES (:id, :username, :email, :password, :created_at, :updated_at)";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $user->id);
            $stmt->bindParam(':username', $user->username);
            $stmt->bindParam(':email', $user->email);

            $stmt->execute();

            $resp = [
                'status' => 'error',
                'message' => 'Failed to create user'
            ];

            if ($stmt->rowCount() > 0) {
                $resp = [
                    'status' => 'success',
                    'message' => 'User created successfully',
                    'user' => $user
                ];
            }

            return $resp;
        } catch (\PDOException $e) { //substitute try-catch to throwing custom exception
            return [
                'status' => 'error',
                'message' => 'Failed to connect to db : ' . $e->getMessage()
            ];
        }
    }
}