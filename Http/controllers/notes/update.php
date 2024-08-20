<?php

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$currentUserId = 4;

// find the note
$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_POST['id']
])->fetchOrFail();

// authprize the user
authorize($note['user_id'] === $currentUserId);

// validate the form
$errors = [];

if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'A body of no more than 1000 characters is required';
}


// if no validation errors, update the record in the note database table.
if (count($errors)) {
    return view('notes/edit.view.php', [
        'heqding' => 'Edit Note',
        'errors' => $errors,
        'note' => $note,
    ]);
}

$db->query('UPDATE notes SET body = :body WHERE id = :id', [
    'id' => $_POST['id'],
    'body' => $_POST['body'],
]);


// redirect user
header('location: /notes');
die();