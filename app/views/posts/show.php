<?php require APPROOT . '/views/inc/header.php'; ?>
<?php flash('comments_message')?>

    <a href="<?=URLROOT ?>/posts" class="btn btn-light mb-3"><i class="fa fa-backward"></i> Back</a>

    <?php if (!empty($_SESSION['user_id']) && $data['post']->user_id == $_SESSION['user_id']) : ?>
        <div class="row pr-3">
            <div class="row author-row ml-auto">
                <p class="mt-1 mr-3" ><strong>You are the author of this post</strong></p>
                <div>
                    <a href="<?= URLROOT?>/posts/edit/<?= $data['post']->id ?>" class="btn btn-dark mx-2">Edit</a>
                </div>
                <form class="inline-block mx-3" action="<?= URLROOT ?>/posts/delete/<?= $data['post']->id ?>" method="post">
                    <input type="submit" value="Delete" class="btn btn-danger">
                </form>
            </div>
        </div>
    <?php endif; ?>

    <div class="jumbotron jumbotron-flud recipe-img text-center px-0 mx-0"
         style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(<?php echo $data['post']->img_url?>)">
        <div class="container">
            <h1 class="display-3"><?= $data['post']->title ?></h1>
            <p class="lead">Written by <?= $data['user']->name; ?></br><?= $data['post']->created_at ?></p>
        </div>
    </div>
    <div class="row p-0 m-0">
        <div class="col-md-4 mr-auto px-0">
            <h5 class="mb-3">Ingredients</h5>
            <ul class="list-group">
                <?= $data['post']->ingredients ?>
            </ul>
        </div>
        <div class="col-md-8 pr-0" id="recipe-texts">
            <h5 class="mb-3">Description</h5>
            <div class="card card-body p-4">
                <p><?=$data['post']->body ?></p>
            </div>
            <h5 class="mt-3">Instruktioner</h5>
            <div class="card card-body py-4 px-5">
                <ol class="list-group">
                    <?= $data['post']->instructions ?>
                </ol>
            </div>
        </div>
    </div>

    <?php if (!empty($data['comments'])) :?>
    <div class="card card-body my-3">
        <h5 class="mt-2 mb-3">Comments</h5>
        <?php foreach ($data['comments'] as $comment) :?>
            <div class="card card-body mb-3">
                <div class="row m-0">
                    <p class="mt-1"><strong>From: </strong><?php echo $comment->userName ?></p>
                    <?php if ($comment->user_id == $_SESSION['user_id']): ?>
                        <div class="ml-auto mr-2">
                            <a class="btn btn-outline-danger delete-btn"
                               href="<?= URLROOT ?>/posts/deleteComment/<?= $comment->id ?>/<?= $data['post']->id ?> " role="button">Delete</a>
                        </div>
                    <?php endif; ?>

                </div>
                <?= $comment->body ?>
            </div>
        <?php endforeach; ?>
    </div>
    <?php endif; ?>

    <?php if (isLoggedIn()) : ?>
        <div class="card card-body my-3">
            <form action="<?= URLROOT; ?>/posts/addComment/<?= $data['post']->id; ?>" method="post">
                <div class="form-group">
                    <label for="title">Post a comment:</label>
                    <input type="text" name="body" class="form-control form-control-lg" value="">
                    <span class="invalid-feedback"><?= $data['body_err']; ?></span>
                </div>
                <input type="submit" class="btn btn-success" value="Submit comment">
            </form>
        </div>
    <?php endif; ?>

<?php require APPROOT . '/views/inc/footer.php'; ?>
