<!-------------------------- COMMENTS ------------------------------>
<?php
require_once 'inc/class/User.php';
require_once 'inc/class/Product.php';
require_once "inc/class/Comment.php";
require_once 'inc/class/Wishlist.php';
$user = new User();
$product = new Product();
$comment = new Comment();
$wishlist = new Wishlist();
?>

<section class="container bg-light border radius p-2">
    <h1>Comments</h1>
    <h1 class="ter">Comments</h1>
    <?php
    $id = $user->getUserId();
    $id = (int)$id;
    if (!is_int($id)) {
        // Handle the error
        echo "Error: id should be an integer";
    } else {
        $comments = $comment->getComments($id);
        if ($comments !== null) {
            foreach ($comments as $c) :
                $id = $c['id_user'];
                $login = $c['author'];
                $date = $c['date'];
                $commentary = $c['comment'];
                $subject = $c['subject'];
    ?>
                <div class="comment">
                    <h3><?= $subject ?></h3>
                    <small class="comment-meta">Publié le <?= $date ?> par <?= $login ?></small>
                    <p><?= $commentary ?></p>
                    <hr>
                </div>
    <?php
            endforeach;
        } else {
            echo '<p>There is no Comment, be the first !</p>';
        }
    }
    ?>

</section>

<!-- Leave a comment -->
<section class="container my-5">
    <h2 class="mt-5">Leave a comment</h2>
    <div class="row">
        <div class="col">
            <?php
            if (!$user->isLogged()) {
                echo '<p>You must logIn or register, to leave a comment.</p>';
            } else {

                ?>
                <form action="./inc/php/leaveComment.php" method="post" class="needs-validation bg-light p-3 rounded">
                    <input type="hidden" name="id_user" value="<?= $id ?>">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="comment">Subject</label>
                            <input type="subject" class="" name="subject" placeholder="Subject">
                            Please enter a subject for your comment.
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="comment">Comment :</label>
                            <textarea class="form-control" name="comment" rows="5" required></textarea>
                            <div class="invalid-feedback">
                            Please enter your comment.
                        </div>
                    </div>
                    <button class="btn btn-dark" type="submit">SEND</button>

                </form>
                <?php
            }
            ?>
        </div>
    </div>
</section>