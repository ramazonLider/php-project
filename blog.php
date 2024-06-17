<?php
$title = "Blog page";
require 'includes/navbar.php';
require 'database.php';

$statement = $pdo->prepare('SELECT * FROM posts');
$statement->execute();

$posts = $statement->fetchAll();

// var_dump($posts);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['DELETE'])) {
    $post_id = $_POST['post_id'];
    $statement = $pdo->prepare('DELETE FROM posts WHERE id = ?');
    $statement->execute([$post_id]);

    $_SESSION['post-ochirildi'] = "Post yoq qilindi";
    header('Location: blog.php');

    exit;  
}
?>

<main>

    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <h1 class="fw-light">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the
                    creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it
                    entirely.</p>
                <p>
                    <a href="post-create.php" class="btn btn-primary my-2">
                        Post yaratish
                    </a>
                    <a href="https://getbootstrap.com/docs/5.0/examples/album/#"
                        class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </div>
    </section>

    <div class="album py-5 bg-light">
        <div class="container">

            <?php if (isset($_SESSION['yaratildi'])): ?>
                <div class="alert alert-succes" role="alert">
                    <?= $_SESSION['yaratildi'] ?>
                    <?php unset($_SESSION['yaratildi']) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['yaratildi'])): ?>
                <div class="alert alert-danger" role="alert">
                    <?= $_SESSION['post-ochirildi'] ?>
                    <?php unset($_SESSION['post-ochirildi']) ?>
                </div>
            <?php endif; ?>
            <?php if (isset($_SESSION['ozgartirildi'])): ?>
                <div class="alert alert-succes" role="alert">
                    <?= $_SESSION['ozgartirildi'] ?>
                    <?php unset($_SESSION['ozgartirildi']) ?>
                </div>
            <?php endif; ?>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <?php foreach ($posts as $post): ?>
                    <div class="col">
                        <div class="card shadow-sm">
                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225"
                                xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail"
                                preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Placeholder</title>
                                <rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef"
                                    dy=".3em">Thumbnail</text>
                            </svg>

                            <div class="card-body">
                                <a href="post.php?id=<?= $post['id'] ?>">
                                    <h5><?= $post['title'] ?></h5>
                                </a>
                                <p class="card-text"><?= $post['body'] ?></p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="btn-group">
                                        <a href="/post-edit.php?id=<?= $post['id'] ?>" class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form method="POST" onsubmit="return confirm('Rostdan ham o`chirmoqchimisiz?')">
                                            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                                            <input type="hidden" name="DELETE">
                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                                        </form>
                                    </div>
                                </div>
                                <small><?= $post['created_at'] ?></small>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

</main>

<footer class="text-muted py-5">
    <div class="container">
        <p class="float-end mb-1">
            <a href="https://getbootstrap.com/docs/5.0/examples/album/#">Back to top</a>
        </p>
        <p class="mb-1">Album example is © Bootstrap, but please download and customize it for yourself!</p>
        <p class="mb-0">New to Bootstrap? <a href="https://getbootstrap.com/">Visit the homepage</a> or read our <a
                href="https://getbootstrap.com/docs/5.0/getting-started/introduction/">getting started guide</a>.
        </p>
    </div>
</footer>


<?php
require 'includes/footer.php';
?>