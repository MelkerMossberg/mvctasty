<?php require APPROOT . '/views/inc/header.php'; ?>

    <a href="<?= URLROOT ?>/posts" class="btn btn-light"><i class="fa fa-backward"></i> Back</a>

    <div class="card card-body bg-light mt-5">
        <h2>Add Post</h2>
        <p>Create a posts with this form</p>
        <form action="<?= URLROOT; ?>/posts/add" method="post">
            <div class="form-group">
                <label for="title">Title: <sup>*</sup></label>
                <input type="text" name="title" class="form-control form-control-lg <?=(!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?= $data['title_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="img_url">Image URL: <sup>*</sup></label>
                <input type="text" name="img_url" class="form-control form-control-lg <?=(!empty($data['img_url_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['img_url']; ?>">
                <span class="invalid-feedback"><?= $data['img_url_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="body">Description: <sup>*</sup></label>
                <textarea name="body" class="form-control form-control-lg <?= (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?=$data['body'] ?></textarea>
                <span class="invalid-feedback"><?= $data['body_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="ingredients">Ingredients separated by "|": <sup>*</sup></label>
                <input type="text" name="ingredients" class="form-control form-control-lg <?= (!empty($data['ingredients_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['ingredients']; ?>">
                <span class="invalid-feedback"><?= $data['ingredients_err']; ?></span>
            </div>
            <div class="form-group">
                <label for="instructions">Instructions separated by "|": <sup>*</sup></label>
                <input type="text" name="instructions" class="form-control form-control-lg <?= (!empty($data['instructions_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['instructions']; ?>">
                <span class="invalid-feedback"><?= $data['instructions_err']; ?></span>
            </div>
            <input type="submit" class="btn btn-success" value="Submit">
        </form>
    </div>


<?php require APPROOT . '/views/inc/footer.php'; ?>



