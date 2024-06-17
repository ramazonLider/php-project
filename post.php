<?php
$title = "Post";
require 'includes/navbar.php';

require 'database.php';

$id = $_GET['id'];

$statement = $pdo->prepare('SELECT * FROM posts WHERE id= :id');
$statement->execute(['id' => $id]);
$post = $statement->fetch();

// var_dump($post);
    ?>

<div class="container mt-5">
    <h5><?= $post['id'] ?></h5>
    <h1><?= $post['title'] ?></h1>
    <p class="fs-5 col-md-8"><?= $post['body'] ?></p>

    <p><?= $post['created_at'] ?></p>

    <hr class="col-3 col-md-2 mb-5">
</div>

<?php
require 'includes/footer.php'
    ?>