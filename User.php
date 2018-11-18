<?php

class User 
{
    private $id;
    private $name;
    private $login;
    private $role;

    public static $roles = [1, 2];

    public static function getAll() 
    {
        global $mysqli;

        $result = $mysqli->query("SELECT user_id FROM users");
        $users = [];
        while ($user_data = $result->fetch_assoc()) {
            $users[] = new self($user_data['user_id']);
        }
        return $users;
    }

    public function __construct($id) 
    {
        global $mysqli;

        $result = $mysqli->query("SELECT * FROM users WHERE user_id=$id");
        $user_data = $result->fetch_assoc();
        
        $this->id = $user_data['user_id'];
        $this->name = $user_data['name'];
        $this->login = $user_data['login'];
        $this->role = $user_data['role'];
    }

    public function print()
    {
        echo '<h3>'.$this->name.'</h3>';
        echo '<i>'.$this->getRole().'</i>';
    }

    public function getName() 
    {
        return $this->name;
    }

    public function getRole() 
    {
        if ($this->role === 1) {
            return 'Администратор';
        } else {
            return 'Пользователь';
        }
    }

    private function setRole($role) 
    {
        if (!in_array($role, self::$roles)) {
            $role = 1;
        }
        $this->role = $role;
    }
}