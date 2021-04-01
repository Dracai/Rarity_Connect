<div class="jumbotron">
    <div class='container'>

    <?php if (session()->get('posted')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->get('posted')?>
        </div>
    <?php endif; ?>

    <h1 class="display-4">CodeIngniter Practice</h1>
    <p class="lead">CodeIgniter is a tool that will help me pass Data Driven Systems !</p>
    <hr class="my-4">
    <p>Hey, I hope you have a good day !</p>
    <p class="lead">
      <a class="btn btn-primary btn-lg" href="createPost" role="button">Create Post</a>
    </p>
  </div>
</div>
</section>
<section class="forum-section">
  <div class="container">
    <?php if ($news): ?>
      <?php foreach ($news as $newsItem): ?>
        <h3><a href="<?php echo base_url();?>/forum/<?= $newsItem['postID']?>"><?= $newsItem['title'] ?></a></h3>
      <?php endforeach; ?> 
    <?php else: ?>
      <p class="text-center">No post have been found</p>
    <?php endif; ?>
  </div>
</section>