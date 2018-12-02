<?php require APPROOT . '/views/inc/header.php'; ?>
  <div class="jumbotron jumbotron-flud text-center">
    <div class="container">
        <h1 class="display-3"><?= $data['title']; ?></h1>
        <p class="lead"><?= $data['description']; ?></p>


        <a class="btn btn-success" href="<?= URLROOT; ?>/users/register" role="button">Register</a>
        <a class="btn btn-outline-success ml-2" href="<?= URLROOT; ?>/users/login" role="button">Login</a>

    </div>
  </div> 
<?php require APPROOT . '/views/inc/footer.php'; ?>
