<?php

require_once __DIR__ . '/../libs/utils.php';

class User {
    private int $id;
    private string $username;
    private string $password;
    private string $email;
    private ?string $createdAt;
    private ?string $updatedAt;
    function __construct($password, $email)
    {
        // $this->id = $id;
        // $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }
    public function setName($username)
    {
        $this->username = $username;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
    public function setPassword($password) {
        $this->password = $password;
    }

    public function register(): bool {
        try {
            $createdAt = $updatedAt = $this->getCurrentTime();
            $password = $this->getHashedPassword();
            db('insert into users (username, email, password, created_at, updated_at) values (?, ?, ?, ?, ?)', $this->username, $this->email, $password, $createdAt, $updatedAt);
            return true;
        } catch (Exception $e) {
            exit($e . 'User class');
            return false;
        }
    }
    private function getCurrentTime() {
        return date('Y-m-d');
    }
    private function getHashedPassword() {
        return password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function login() {
        // 与えられたパラメータがDBのemailとpasswordに一致したらログイン成功、失敗したらfalseを返す
        $exsists = $this->exsistsUserByEmail();
        if ($exsists) {
            if($this->password_verify()) {

                return true;
            }
        }
        return false;
        // $existsUser = db('select ');
    }
    private function exsistsUserByEmail() {
        $exsists = db('select email from users where email = ?', $this->email);
        return count($exsists) === 1;
    }
    private function password_verify() {
        $password = db('select password from users where email = ?', $this->email);
        return password_verify($this->password, $password[0]['password']);
    }
}
// $u = new User('15', 'AA', 'p', 'a');
// var_dump($u);
// $u->setEmail('mail');
// $u->register();
