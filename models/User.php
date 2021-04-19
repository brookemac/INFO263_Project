<?php
class User {
    private $id;
    private $name;
    private $username;
    private $email;
    private $hashedPassword;

    /**
     * User constructor
     *
     * @param int $id
     * @param string $name
     * @param string $username
     * @param string $email
     * @param string $hashedPassword
     */
    public function __construct($id, $name, $username, $email, $hashedPassword) {
        $this->id = $id;
        $this->name = $name;
        $this->username = $username;
        $this->email = $email;
        $this->hashedPassword = $hashedPassword;
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->id = $name;
    }

    public function getUsername() {
        return $this->username;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->id = $email;
    }

    public function getHashedPassword() {
        return $this->hashedPassword;
    }

    public function setHashedPassword($hashedPassword) {
        $this->hashedPassword = $hashedPassword;
    }
}
?>