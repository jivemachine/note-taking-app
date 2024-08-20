<?php

use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$currentUserId = 4;


$note = $db->query('SELECT * FROM notes WHERE id = :id', [
    'id' => $_GET['id']
])->fetchOrFail();

authorize($note['user_id'] === $currentUserId);

view("notes/edit.view.php", [
    'heading' => "Edit Note",
    'errors' => [],
    'note' => $note,
]);