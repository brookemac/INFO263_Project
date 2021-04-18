<?php

require_once "../models/User.php";
require_once "IUserRepository.php";

class UserRepository implements IUserRepository{

    const TABLE = 'user';
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    function __destruct() {
        $this->mysqli->close();
    }

    public function getByUsername($username) {
        $user = null;
        $sql = "SELECT user_id, name, username, email, password FROM ".self::TABLE." WHERE username = ?";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
            if ($stmt->execute()) {
                $stmt->store_result();
                if($stmt->num_rows == 1) {
                    $stmt->bind_result($id, $name, $username, $email, $hashed_password);
                    if($stmt->fetch()) {
                        $user = new User($id, $name, $username, $email, $hashed_password);
                    }
                }
            }
            $stmt->close();
        }
        return $user;
    }

    public function doesUserExistByUsername($username) {
        $exists = false;
        $sql = "SELECT COUNT(*) FROM ".self::TABLE." WHERE username = ?";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $stmt->bind_param("s", $param_username);
            $param_username = $username;
            if ($stmt->execute()) {
                $row = $stmt->get_result()->fetch_row();
                $numberOfRows = $row[0];
                $exists = $numberOfRows > 0;
            }
            $stmt->close();
        }
        return $exists;
    }

    public function insert($name, $email, $username, $password) {
        $succeded = false;
        $sql = "INSERT INTO ".self::TABLE." (name, email, username, password) VALUES (?, ?, ?, ?)";
        if ($stmt = $this->mysqli->prepare($sql)) {
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt->bind_param("ssss", $name, $email, $username, $param_password);
            if ($stmt->execute()) {
                $succeded = true;
            }
            $stmt->close();
        }
        return $succeded;
    }

    public function update($user) {
        // TODO: Implement update() method.
    }

    public function delete($username) {
        // TODO: Implement delete() method.
    }
}
?>