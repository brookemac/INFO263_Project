<?php

require_once "../models/User.php";
require_once "interfaces/IUserRepository.php";
require_once "BaseRepository.php";

class UserRepository extends BaseRepository implements IUserRepository {
    public function getByUsername($username) {
        $user = null;
        $sql = "SELECT user_id, name, username, email, password FROM vw_user_info WHERE username = ?";
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
        $user = $this->getByUsername($username);
        return $user != null;
    }

    public function insert($name, $email, $username, $password) {
        $succeded = false;
        $sql = "call add_user(?, ?, ?, ?)";
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
}
?>