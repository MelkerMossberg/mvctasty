<?php require APPROOT . '/views/inc/header.php'; ?>
    <?php flash('post_message')?>
    <div class="row mb-3">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6 pr-3">
            <a href="<?= URLROOT; ?>/posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add post
            </a>
        </div>
    </div>

    <div class="row m-0">
        <?php foreach ($data['posts'] as $post) : ?>
        <div class="col-md-4 col-sm-6 p-0 pr-2 recipe my-2">
            <div class="card ">
                <img class="card-img-top" src="<?= $post->img_url ?>" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?= $post->title ?></h5>
                    <div class="card-text">
                        <p class="module"><?= $post->body;?></p>
                        <div class="fade-out"></div>
                    </div>
                    <div class="bg-light p-2 my-3">
                        Written by <?= $post->name; ?> on <?= $post->postCreated; ?>
                    </div>
                    <a href="<?= URLROOT ?>/posts/show/<?=$post->postId; ?>" class="btn btn-dark">Go to Recipe</a>
                </div>

            </div>
        </div>
        <?php endforeach; ?>
    </div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
