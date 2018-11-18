<?php

require_once 'db.php';
require_once 'User.php';

$user = new User(2);

$users = User::getAll();
// echo '<pre>';
// var_dump($users);

foreach ($users as $user) {
    $user->print();
}

if (User::isSet($id)) {
    
}
