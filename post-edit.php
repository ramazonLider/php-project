<?php
$title = "Edit post";
require 'includes/navbar.php';
require 'includes/navbar3.php';
require 'database.php';

$post_id = $_GET['id'];
$statement = $pdo->prepare('SELECT * FROM posts WHERE id= :id');
$statement->execute(['id' => $post_id]);
$post = $statement->fetch();


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['PUT'])) {
    // var_dump($_POST);
    $id = $_POST['post_id'];
    $title = $_POST['title'];
    $body = $_POST['body'];

    $statement = $pdo->prepare('UPDATE posts SET title = :title, body = :body WHERE id = :id');
    $statement->execute([ 
        'title' => $title,
        'body' => $body,
        'id' => $id,
    ]);

    $_SESSION['ozgartirildi'] = "Post edited";

    header('Location: blog.php');

    // echo 'Post yaratildi';
    exit;
}

?>

<form method="POST" action="">
    <div class="mb-3">
        <h1><?= $post['id'] ?></h1>
        <input type="hidden" name="PUT">
        <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input name="title" type="text" class="form-control" value="<?= $post['title'] ?>" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label class="form-label">Matn</label>
        <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"><?= $post['body'] ?></textarea>
    </div>
    <button class="btn btn-primary btn-lg" type="submit">Saqlash</button>
</form>



<?php
require 'includes/footer.php'
    ?>