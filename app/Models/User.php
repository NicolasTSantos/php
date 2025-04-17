<?php

namespace Models;
use Repository\UserRepository;
use Utils\SnowFlakeId;

class User {
    public string $id;
    public string $username;
    public string $email;
    public string $password;
    public string $created_at;
    public string $updated_at;
    public ?string $deleted_at;


    function __construct(string $username, string $email, string $password) {
        $this->id = SnowFlakeId::generate();
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        // $this->password = password_hash($password, PASSWORD_BCRYPT);
    }

    public static function list(): array {
        $userRepository = new UserRepository();

        $users = $userRepository->getAllUsers();
        $userList = [];
        foreach ($users as $user) {
            $userList[] = [
                'username' => $user->username,
                'email' => $user->email,
                'password' => $user->password,
            ];
        }

        return $userList;
    }

    public static function create(): array {
        $user = new UserDTO('testuser', 'test@user.com', '427746');
        $userRepository->save($user);
        $userRepository = new UserRepository();
        return $userRepository->getUserById($user->id);
    }
}