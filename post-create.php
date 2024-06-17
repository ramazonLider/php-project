<?php
$title = "Create post";
require 'includes/navbar.php';
require 'includes/navbar3.php';
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // var_dump($_POST);
    $title = $_POST['title'];
    $body = $_POST['body'];

    $statement = $pdo->prepare('INSERT INTO posts (title, body) VALUES (:title, :body)');
    $statement->execute([
        'title' => $title,
        'body' => $body,
    ]);

    $_SESSION['yaratildi'] = "Post created";

    header('Location: blog.php');

    echo 'Post yaratildi';
}

?>

<form method="POST" action="">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Title</label>
        <input name="title" type="text" class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label class="form-label">Matn</label>
        <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <button class="btn btn-primary btn-lg" type="submit">Saqlash</button>
</form>



<?php
require 'includes/footer.php'
    ?>