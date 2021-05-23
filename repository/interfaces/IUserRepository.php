<?php
interface IUserRepository
{
    public function getByUsername($username);
    public function doesUserExistByUsername($username);
    public function insert($name, $email, $username, $password);
}
?>