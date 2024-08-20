<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

// validate the form inputs
$errors = [];
if (! Validator::email($email)) {
    $errors['email'] = 'Please provide a valid email address';
}

if (! Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters';
}

if (!empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

$db = App::resolve(Database::class);
// check if account already exists
$user = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email
])->fetch();


if ($user) {
    // then someone with that email already exists & has an account
    // if yes, redirect to login page
    header('location: /');
    exit();
} else {
    // if not, save to dba, log user in & redirect
    $db->query("INSERT INTO users (email, password) VALUES (:email, :password)", [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);

    // mark that the user has logged in
    login([
        'email' => $email
    ]);

    header('location: /');
    exit();
}